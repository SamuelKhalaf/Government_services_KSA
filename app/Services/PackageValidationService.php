<?php

namespace App\Services;

use App\Models\Company;
use App\Models\Employee;
use Carbon\Carbon;

class PackageValidationService
{
    /**
     * Validate if company can add a new employee based on package limits
     */
    public function canAddEmployee(Company $company): array
    {
        $activePackage = $company->active_package;
        
        if (!$activePackage) {
            return [
                'allowed' => false,
                'message' => __('packages.validation.no_active_package'),
                'type' => 'no_package'
            ];
        }

        // Check if package is expired
        if ($this->isPackageExpired($company, $activePackage)) {
            return [
                'allowed' => false,
                'message' => __('packages.validation.package_expired'),
                'type' => 'expired_package'
            ];
        }

        // Check employee limit
        if ($activePackage->package->max_employees !== null) {
            $currentEmployeeCount = $company->employees()->count();
            
            if ($currentEmployeeCount >= $activePackage->package->max_employees) {
                return [
                    'allowed' => false,
                    'message' => __('packages.validation.employee_limit_exceeded', [
                        'current' => $currentEmployeeCount,
                        'max' => $activePackage->package->max_employees
                    ]),
                    'type' => 'employee_limit',
                    'current_count' => $currentEmployeeCount,
                    'max_allowed' => $activePackage->package->max_employees
                ];
            }
        }

        return [
            'allowed' => true,
            'message' => __('packages.validation.employee_addition_allowed'),
            'type' => 'success'
        ];
    }

    /**
     * Validate if company can add a new employee document based on package limits
     */
    public function canAddEmployeeDocument(Company $company): array
    {
        $activePackage = $company->active_package;
        
        if (!$activePackage) {
            return [
                'allowed' => false,
                'message' => __('packages.validation.no_active_package'),
                'type' => 'no_package'
            ];
        }

        // Check if package is expired
        if ($this->isPackageExpired($company, $activePackage)) {
            return [
                'allowed' => false,
                'message' => __('packages.validation.package_expired'),
                'type' => 'expired_package'
            ];
        }

        // Check employee document limit
        if ($activePackage->package->max_employee_documents !== null) {
            $currentEmployeeDocumentCount = $this->getEmployeeDocumentCount($company);
            
            if ($currentEmployeeDocumentCount >= $activePackage->package->max_employee_documents) {
                return [
                    'allowed' => false,
                    'message' => __('packages.validation.employee_document_limit_exceeded', [
                        'current' => $currentEmployeeDocumentCount,
                        'max' => $activePackage->package->max_employee_documents
                    ]),
                    'type' => 'employee_document_limit',
                    'current_count' => $currentEmployeeDocumentCount,
                    'max_allowed' => $activePackage->package->max_employee_documents
                ];
            }
        }

        return [
            'allowed' => true,
            'message' => __('packages.validation.employee_document_addition_allowed'),
            'type' => 'success'
        ];
    }

    /**
     * Validate if company can add a new company document based on package limits
     */
    public function canAddCompanyDocument(Company $company): array
    {
        $activePackage = $company->active_package;
        
        if (!$activePackage) {
            return [
                'allowed' => false,
                'message' => __('packages.validation.no_active_package'),
                'type' => 'no_package'
            ];
        }

        // Check if package is expired
        if ($this->isPackageExpired($company, $activePackage)) {
            return [
                'allowed' => false,
                'message' => __('packages.validation.package_expired'),
                'type' => 'expired_package'
            ];
        }

        // Check company document limit
        if ($activePackage->package->max_company_documents !== null) {
            $currentCompanyDocumentCount = $this->getCompanyDocumentCount($company);
            
            if ($currentCompanyDocumentCount >= $activePackage->package->max_company_documents) {
                return [
                    'allowed' => false,
                    'message' => __('packages.validation.company_document_limit_exceeded', [
                        'current' => $currentCompanyDocumentCount,
                        'max' => $activePackage->package->max_company_documents
                    ]),
                    'type' => 'company_document_limit',
                    'current_count' => $currentCompanyDocumentCount,
                    'max_allowed' => $activePackage->package->max_company_documents
                ];
            }
        }

        return [
            'allowed' => true,
            'message' => __('packages.validation.company_document_addition_allowed'),
            'type' => 'success'
        ];
    }

    /**
     * Get comprehensive package status for a company
     */
    public function getPackageStatus(Company $company): array
    {
        $currentPackage = $company->current_package;
        
        if (!$currentPackage) {
            return [
                'has_package' => false,
                'is_expired' => false,
                'package_name' => null,
                'expiry_date' => null,
                'days_until_expiry' => null,
                'limits' => [
                    'employees' => [
                        'current' => $company->employees()->count(),
                        'max' => null,
                        'unlimited' => true
                    ],
                    'employee_documents' => [
                        'current' => $this->getEmployeeDocumentCount($company),
                        'max' => null,
                        'unlimited' => true
                    ],
                    'company_documents' => [
                        'current' => $this->getCompanyDocumentCount($company),
                        'max' => null,
                        'unlimited' => true
                    ]
                ]
            ];
        }

        $isExpired = $this->isPackageExpired($company, $currentPackage);
        $daysUntilExpiry = $this->getDaysUntilExpiry($currentPackage);

        // Get actual counts
        $employeeCount = $company->employees()->count();
        $employeeDocumentCount = $this->getEmployeeDocumentCount($company);
        $companyDocumentCount = $this->getCompanyDocumentCount($company);

        return [
            'has_package' => true,
            'has_active_package' => $currentPackage->isActive(),
            'is_expired' => $isExpired,
            'package_name' => $currentPackage->package->name,
            'expiry_date' => $currentPackage->end_date,
            'days_until_expiry' => $daysUntilExpiry,
            'employee_count' => $employeeCount,
            'employee_document_count' => $employeeDocumentCount,
            'company_document_count' => $companyDocumentCount,
            'max_employees' => $currentPackage->package->max_employees,
            'max_employee_documents' => $currentPackage->package->max_employee_documents,
            'max_company_documents' => $currentPackage->package->max_company_documents,
            'employee_percentage' => $currentPackage->package->max_employees ? min(($employeeCount / $currentPackage->package->max_employees) * 100, 100) : 0,
            'employee_document_percentage' => $currentPackage->package->max_employee_documents ? min(($employeeDocumentCount / $currentPackage->package->max_employee_documents) * 100, 100) : 0,
            'company_document_percentage' => $currentPackage->package->max_company_documents ? min(($companyDocumentCount / $currentPackage->package->max_company_documents) * 100, 100) : 0,
            'employee_remaining' => $currentPackage->package->max_employees ? max($currentPackage->package->max_employees - $employeeCount, 0) : null,
            'employee_document_remaining' => $currentPackage->package->max_employee_documents ? max($currentPackage->package->max_employee_documents - $employeeDocumentCount, 0) : null,
            'company_document_remaining' => $currentPackage->package->max_company_documents ? max($currentPackage->package->max_company_documents - $companyDocumentCount, 0) : null,
            'limits' => [
                'employees' => [
                    'current' => $employeeCount,
                    'max' => $currentPackage->package->max_employees,
                    'unlimited' => $currentPackage->package->max_employees === null,
                    'can_add' => $this->canAddEmployee($company)['allowed']
                ],
                'employee_documents' => [
                    'current' => $employeeDocumentCount,
                    'max' => $currentPackage->package->max_employee_documents,
                    'unlimited' => $currentPackage->package->max_employee_documents === null,
                    'can_add' => $this->canAddEmployeeDocument($company)['allowed']
                ],
                'company_documents' => [
                    'current' => $companyDocumentCount,
                    'max' => $currentPackage->package->max_company_documents,
                    'unlimited' => $currentPackage->package->max_company_documents === null,
                    'can_add' => $this->canAddCompanyDocument($company)['allowed']
                ]
            ]
        ];
    }

    /**
     * Check if package is expired based on end date
     */
    private function isPackageExpired(Company $company, $activePackage): bool
    {
        if (!$activePackage || !$activePackage->end_date) {
            return true;
        }

        return Carbon::parse($activePackage->end_date)->isPast();
    }

    /**
     * Get days until package expires
     */
    private function getDaysUntilExpiry($activePackage): ?int
    {
        if (!$activePackage || !$activePackage->end_date) {
            return null;
        }

        $endDate = Carbon::parse($activePackage->end_date);
        $now = Carbon::now();

        if ($endDate->isPast()) {
            return 0; // Expired
        }

        return $now->diffInDays($endDate);
    }

    /**
     * Get total employee document count for company
     */
    private function getEmployeeDocumentCount(Company $company): int
    {
        return $company->employees()
            ->withCount('documents')
            ->get()
            ->sum('documents_count');
    }

    /**
     * Get total company document count
     */
    private function getCompanyDocumentCount(Company $company): int
    {
        // Count all company documents including legacy ones
        $companyDocuments = $company->companyDocuments()->count();
        $municipalityLicenses = $company->municipalityLicenses()->count();
        $civilDefenseLicenses = $company->civilDefenseLicenses()->count();
        $branchRegistrations = $company->branchCommercialRegistrations()->count();

        return $companyDocuments + $municipalityLicenses + $civilDefenseLicenses + $branchRegistrations;
    }

    /**
     * Validate multiple operations at once
     */
    public function validateBulkOperations(Company $company, array $operations): array
    {
        $results = [];
        
        foreach ($operations as $operation) {
            switch ($operation['type']) {
                case 'add_employee':
                    $results['add_employee'] = $this->canAddEmployee($company);
                    break;
                case 'add_employee_document':
                    $results['add_employee_document'] = $this->canAddEmployeeDocument($company);
                    break;
                case 'add_company_document':
                    $results['add_company_document'] = $this->canAddCompanyDocument($company);
                    break;
            }
        }

        return $results;
    }

    /**
     * Get warning messages for approaching limits
     */
    public function getWarningMessages(Company $company): array
    {
        $warnings = [];
        $currentPackage = $company->current_package;

        if (!$currentPackage) {
            return $warnings;
        }

        // Check if package is expired
        if ($currentPackage->isExpired()) {
            $warnings[] = [
                'type' => 'package_expired',
                'message' => __('packages.validation.package_expired'),
                'severity' => 'danger'
            ];
        } else {
            // Check expiry warning (30 days) - only for active packages
            $daysUntilExpiry = $this->getDaysUntilExpiry($currentPackage);
            if ($daysUntilExpiry !== null && $daysUntilExpiry <= 30 && $daysUntilExpiry > 0) {
                $warnings[] = [
                    'type' => 'package_expiring',
                    'message' => __('packages.validation.package_expiring_soon', ['days' => $daysUntilExpiry]),
                    'severity' => $daysUntilExpiry <= 7 ? 'danger' : 'warning'
                ];
            }
        }

        // Check employee limit warning (90% threshold)
        if ($currentPackage->package->max_employees !== null) {
            $currentCount = $company->employees()->count();
            $threshold = ceil($currentPackage->package->max_employees * 0.9);
            
            if ($currentCount >= $threshold) {
                $warnings[] = [
                    'type' => 'employee_limit_warning',
                    'message' => __('packages.validation.employee_limit_warning', [
                        'current' => $currentCount,
                        'max' => $currentPackage->package->max_employees
                    ]),
                    'severity' => 'warning'
                ];
            }
        }

        // Check employee document limit warning (90% threshold)
        if ($currentPackage->package->max_employee_documents !== null) {
            $currentCount = $this->getEmployeeDocumentCount($company);
            $threshold = ceil($currentPackage->package->max_employee_documents * 0.9);
            
            if ($currentCount >= $threshold) {
                $warnings[] = [
                    'type' => 'employee_document_limit_warning',
                    'message' => __('packages.validation.employee_document_limit_warning', [
                        'current' => $currentCount,
                        'max' => $currentPackage->package->max_employee_documents
                    ]),
                    'severity' => 'warning'
                ];
            }
        }

        // Check company document limit warning (90% threshold)
        if ($currentPackage->package->max_company_documents !== null) {
            $currentCount = $this->getCompanyDocumentCount($company);
            $threshold = ceil($currentPackage->package->max_company_documents * 0.9);
            
            if ($currentCount >= $threshold) {
                $warnings[] = [
                    'type' => 'company_document_limit_warning',
                    'message' => __('packages.validation.company_document_limit_warning', [
                        'current' => $currentCount,
                        'max' => $currentPackage->package->max_company_documents
                    ]),
                    'severity' => 'warning'
                ];
            }
        }

        return $warnings;
    }
}
