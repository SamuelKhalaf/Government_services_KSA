<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\User;
use App\Models\CompanyDocument;
use App\Models\EmployeeDocument;
use App\Models\BranchCommercialRegistration;
use App\Models\CivilDefenseLicense;
use App\Models\MunicipalityLicense;
use App\Models\TaskDocument;
use App\Services\NotificationService;
use Carbon\Carbon;

class CheckDocumentExpirationAlerts extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'documents:check-expiration-alerts';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Check for documents that are expiring soon and send notifications to users';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->info('Starting document expiration alert check...');

        // Get all admin users
        $admins = User::admins()->get();
        $this->info('Found ' . $admins->count() . ' admin users');

        // Get all employee users
        $employees = User::employees()->get();
        $this->info('Found ' . $employees->count() . ' employee users');

        $totalNotificationsSent = 0;

        // Send notifications to admins about all expiring documents
        foreach ($admins as $admin) {
            $notificationsSent = $this->sendAdminNotifications($admin);
            $totalNotificationsSent += $notificationsSent;
        }

        // Send notifications to employees about their assigned documents
        foreach ($employees as $employee) {
            $notificationsSent = $this->sendEmployeeNotifications($employee);
            $totalNotificationsSent += $notificationsSent;
        }

        $this->info("Document expiration alert check completed. Sent {$totalNotificationsSent} notifications.");
    }

    /**
     * Send notifications to admin about all expiring documents
     */
    private function sendAdminNotifications(User $admin): int
    {
        $notificationsSent = 0;
        $expiringDocuments = [];

        // Check Company Documents
        $companyDocs = $this->getExpiringCompanyDocuments();
        foreach ($companyDocs as $doc) {
            $expiringDocuments[] = [
                'document' => $doc,
                'type' => 'company',
                'days_until_expiry' => $this->getDaysUntilExpiry($doc, 'company')
            ];
        }

        // Check Employee Documents
        $employeeDocs = $this->getExpiringEmployeeDocuments();
        foreach ($employeeDocs as $doc) {
            $expiringDocuments[] = [
                'document' => $doc,
                'type' => 'employee',
                'days_until_expiry' => $this->getDaysUntilExpiry($doc, 'employee')
            ];
        }

        // Check Branch Commercial Registrations
        $branchRegs = $this->getExpiringBranchRegistrations();
        foreach ($branchRegs as $doc) {
            $expiringDocuments[] = [
                'document' => $doc,
                'type' => 'branch_registration',
                'days_until_expiry' => $this->getDaysUntilExpiry($doc, 'branch_registration')
            ];
        }

        // Check Civil Defense Licenses
        $civilDefenseLicenses = $this->getExpiringCivilDefenseLicenses();
        foreach ($civilDefenseLicenses as $doc) {
            $expiringDocuments[] = [
                'document' => $doc,
                'type' => 'civil_defense',
                'days_until_expiry' => $this->getDaysUntilExpiry($doc, 'civil_defense')
            ];
        }

        // Check Municipality Licenses
        $municipalityLicenses = $this->getExpiringMunicipalityLicenses();
        foreach ($municipalityLicenses as $doc) {
            $expiringDocuments[] = [
                'document' => $doc,
                'type' => 'municipality',
                'days_until_expiry' => $this->getDaysUntilExpiry($doc, 'municipality')
            ];
        }

        // Send individual notifications for each expiring document
        foreach ($expiringDocuments as $docData) {
            if ($docData['days_until_expiry'] <= $docData['document']->reminder_days) {
                NotificationService::notifyAdminDocumentExpiringSoon(
                    $docData['document'],
                    $admin->id,
                    $docData['days_until_expiry'],
                    $docData['type']
                );
                $notificationsSent++;
            }
        }

        // Send summary notification if there are expiring documents
        if (!empty($expiringDocuments)) {
            $employeeDocsCount = count(array_filter($expiringDocuments, fn($doc) => $doc['type'] === 'employee'));
            $companyDocsCount = count(array_filter($expiringDocuments, fn($doc) => in_array($doc['type'], ['company', 'branch_registration', 'civil_defense', 'municipality'])));
            
            NotificationService::notifyAdminExpiringDocumentsSummary(
                $admin->id,
                count($expiringDocuments),
                $employeeDocsCount,
                $companyDocsCount,
                30
            );
            $notificationsSent++;
        }

        return $notificationsSent;
    }

    /**
     * Send notifications to employee about their assigned documents
     */
    private function sendEmployeeNotifications(User $employee): int
    {
        $notificationsSent = 0;

        // Get all tasks assigned to this employee
        $assignedTasks = $employee->assignedTasks()->with('taskDocuments')->get();

        // Group task documents by type to avoid ID conflicts
        $taskDocumentsByType = [
            'company_document' => [],
            'employee_document' => [],
            'branch_registration' => [],
            'civil_defense' => [],
            'municipality' => []
        ];

        foreach ($assignedTasks as $task) {
            foreach ($task->taskDocuments as $taskDoc) {
                $taskDocumentsByType[$taskDoc->document_type][] = $taskDoc->document_id;
            }
        }

        $expiringDocuments = [];

        // Check Company Documents
        if (!empty($taskDocumentsByType['company_document'])) {
            $companyDocs = CompanyDocument::whereIn('id', $taskDocumentsByType['company_document'])
                ->where('enable_reminder', true)
                ->whereNotNull('reminder_days')
                ->get();

            foreach ($companyDocs as $doc) {
                if ($this->isDocumentExpiringSoon($doc, 'company')) {
                    $expiringDocuments[] = [
                        'document' => $doc,
                        'type' => 'company',
                        'days_until_expiry' => $this->getDaysUntilExpiry($doc, 'company')
                    ];
                }
            }
        }

        // Check Employee Documents
        if (!empty($taskDocumentsByType['employee_document'])) {
            $employeeDocs = EmployeeDocument::whereIn('id', $taskDocumentsByType['employee_document'])
                ->where('enable_reminder', true)
                ->whereNotNull('reminder_days')
                ->get();

            foreach ($employeeDocs as $doc) {
                if ($this->isDocumentExpiringSoon($doc, 'employee')) {
                    $expiringDocuments[] = [
                        'document' => $doc,
                        'type' => 'employee',
                        'days_until_expiry' => $this->getDaysUntilExpiry($doc, 'employee')
                    ];
                }
            }
        }

        // Check Branch Commercial Registrations
        if (!empty($taskDocumentsByType['branch_registration'])) {
            $branchRegs = BranchCommercialRegistration::whereIn('id', $taskDocumentsByType['branch_registration'])
                ->where('enable_reminder', true)
                ->whereNotNull('reminder_days')
                ->get();

            foreach ($branchRegs as $doc) {
                if ($this->isDocumentExpiringSoon($doc, 'branch_registration')) {
                    $expiringDocuments[] = [
                        'document' => $doc,
                        'type' => 'branch_registration',
                        'days_until_expiry' => $this->getDaysUntilExpiry($doc, 'branch_registration')
                    ];
                }
            }
        }

        // Check Civil Defense Licenses
        if (!empty($taskDocumentsByType['civil_defense'])) {
            $civilDefenseLicenses = CivilDefenseLicense::whereIn('id', $taskDocumentsByType['civil_defense'])
                ->where('enable_reminder', true)
                ->whereNotNull('reminder_days')
                ->get();

            foreach ($civilDefenseLicenses as $doc) {
                if ($this->isDocumentExpiringSoon($doc, 'civil_defense')) {
                    $expiringDocuments[] = [
                        'document' => $doc,
                        'type' => 'civil_defense',
                        'days_until_expiry' => $this->getDaysUntilExpiry($doc, 'civil_defense')
                    ];
                }
            }
        }

        // Check Municipality Licenses
        if (!empty($taskDocumentsByType['municipality'])) {
            $municipalityLicenses = MunicipalityLicense::whereIn('id', $taskDocumentsByType['municipality'])
                ->where('enable_reminder', true)
                ->whereNotNull('reminder_days')
                ->get();

            foreach ($municipalityLicenses as $doc) {
                if ($this->isDocumentExpiringSoon($doc, 'municipality')) {
                    $expiringDocuments[] = [
                        'document' => $doc,
                        'type' => 'municipality',
                        'days_until_expiry' => $this->getDaysUntilExpiry($doc, 'municipality')
                    ];
                }
            }
        }

        // Send notifications for each expiring document
        foreach ($expiringDocuments as $docData) {
            if ($docData['days_until_expiry'] <= $docData['document']->reminder_days) {
                NotificationService::notifyDocumentExpiringSoon(
                    $docData['document'],
                    $employee->id,
                    $docData['days_until_expiry']
                );
                $notificationsSent++;
            }
        }

        return $notificationsSent;
    }

    /**
     * Get expiring company documents
     */
    private function getExpiringCompanyDocuments()
    {
        return CompanyDocument::where('enable_reminder', true)
            ->whereNotNull('reminder_days')
            ->whereRaw("JSON_EXTRACT(custom_fields, '$.expiry_date') IS NOT NULL")
            ->whereRaw("JSON_EXTRACT(custom_fields, '$.expiry_date') <= ?", [now()->addDays(30)->toDateString()])
            ->whereRaw("JSON_EXTRACT(custom_fields, '$.expiry_date') >= ?", [now()->toDateString()])
            ->with(['company', 'documentType'])
            ->get();
    }

    /**
     * Get expiring employee documents
     */
    private function getExpiringEmployeeDocuments()
    {
        return EmployeeDocument::where('enable_reminder', true)
            ->whereNotNull('reminder_days')
            ->whereRaw("JSON_EXTRACT(custom_fields, '$.expiry_date') IS NOT NULL")
            ->whereRaw("JSON_EXTRACT(custom_fields, '$.expiry_date') <= ?", [now()->addDays(30)->toDateString()])
            ->whereRaw("JSON_EXTRACT(custom_fields, '$.expiry_date') >= ?", [now()->toDateString()])
            ->with(['employee.company', 'documentType'])
            ->get();
    }

    /**
     * Get expiring branch registrations
     */
    private function getExpiringBranchRegistrations()
    {
        return BranchCommercialRegistration::where('enable_reminder', true)
            ->whereNotNull('reminder_days')
            ->where('expiry_date', '<=', now()->addDays(30))
            ->where('expiry_date', '>=', now())
            ->with(['company'])
            ->get();
    }

    /**
     * Get expiring civil defense licenses
     */
    private function getExpiringCivilDefenseLicenses()
    {
        return CivilDefenseLicense::where('enable_reminder', true)
            ->whereNotNull('reminder_days')
            ->where('expiry_date', '<=', now()->addDays(30))
            ->where('expiry_date', '>=', now())
            ->with(['company'])
            ->get();
    }

    /**
     * Get expiring municipality licenses
     */
    private function getExpiringMunicipalityLicenses()
    {
        return MunicipalityLicense::where('enable_reminder', true)
            ->whereNotNull('reminder_days')
            ->where('expiry_date', '<=', now()->addDays(30))
            ->where('expiry_date', '>=', now())
            ->with(['company'])
            ->get();
    }

    /**
     * Check if document is expiring soon based on its reminder settings
     */
    private function isDocumentExpiringSoon($document, string $type): bool
    {
        if (!$document->enable_reminder || !$document->reminder_days) {
            return false;
        }

        $daysUntilExpiry = $this->getDaysUntilExpiry($document, $type);
        return $daysUntilExpiry <= $document->reminder_days && $daysUntilExpiry >= 0;
    }

    /**
     * Get days until expiry for a document
     */
    private function getDaysUntilExpiry($document, string $type): int
    {
        $expiryDate = null;

        switch ($type) {
            case 'company':
            case 'employee':
                $expiryDate = $document->getCustomFieldValue('expiry_date');
                if ($expiryDate) {
                    $expiryDate = Carbon::parse($expiryDate);
                }
                break;
            case 'branch_registration':
            case 'civil_defense':
            case 'municipality':
                $expiryDate = $document->expiry_date;
                break;
        }

        if (!$expiryDate) {
            return 999; // Return high number if no expiry date
        }

        return now()->diffInDays($expiryDate, false);
    }
}
