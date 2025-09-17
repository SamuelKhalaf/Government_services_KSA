<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Task extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'title',
        'description',
        'assigned_to',
        'status',
        'due_date',
        'created_by',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'due_date' => 'date',
    ];

    /**
     * Task status constants
     */
    const STATUS_NEW = 'new';
    const STATUS_IN_PROGRESS = 'in_progress';
    const STATUS_COMPLETED = 'completed';
    const STATUS_PENDING = 'pending';


    /**
     * Get all available task statuses
     */
    public static function getStatuses(): array
    {
        return [
            self::STATUS_NEW => __('tasks.new'),
            self::STATUS_IN_PROGRESS => __('tasks.in_progress'),
            self::STATUS_COMPLETED => __('tasks.completed'),
            self::STATUS_PENDING => __('tasks.pending'),
        ];
    }


    /**
     * Get the user assigned to the task
     */
    public function assignedUser(): BelongsTo
    {
        return $this->belongsTo(User::class, 'assigned_to');
    }

    /**
     * Get the user who created the task
     */
    public function creator(): BelongsTo
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    /**
     * Get all task histories
     */
    public function histories(): HasMany
    {
        return $this->hasMany(TaskHistory::class);
    }

    /**
     * Get all task documents (many-to-many relationship)
     */
    public function taskDocuments(): HasMany
    {
        return $this->hasMany(TaskDocument::class);
    }

    /**
     * Get all company documents for this task
     */
    public function companyDocuments()
    {
        return $this->hasManyThrough(
            CompanyDocument::class,
            TaskDocument::class,
            'task_id',
            'id',
            'id',
            'document_id'
        )->where('task_documents.document_type', TaskDocument::TYPE_COMPANY);
    }

    /**
     * Get all employee documents for this task
     */
    public function employeeDocuments()
    {
        return $this->hasManyThrough(
            EmployeeDocument::class,
            TaskDocument::class,
            'task_id',
            'id',
            'id',
            'document_id'
        )->where('task_documents.document_type', TaskDocument::TYPE_EMPLOYEE);
    }

    /**
     * Check if task is new
     */
    public function isNew(): bool
    {
        return $this->status === self::STATUS_NEW;
    }

    /**
     * Check if task is in progress
     */
    public function isInProgress(): bool
    {
        return $this->status === self::STATUS_IN_PROGRESS;
    }

    /**
     * Check if task is completed
     */
    public function isCompleted(): bool
    {
        return $this->status === self::STATUS_COMPLETED;
    }

    /**
     * Check if task is pending
     */
    public function isPending(): bool
    {
        return $this->status === self::STATUS_PENDING;
    }

    /**
     * Check if task is overdue
     */
    public function isOverdue(): bool
    {
        return $this->due_date && $this->due_date->isPast() && !$this->isCompleted();
    }

    /**
     * Get task status color for UI
     */
    public function getStatusColor(): string
    {
        return match ($this->status) {
            self::STATUS_NEW => 'primary',
            self::STATUS_IN_PROGRESS => 'warning',
            self::STATUS_COMPLETED => 'success',
            self::STATUS_PENDING => 'info',
            default => 'secondary',
        };
    }

    /**
     * Get task status badge class for UI
     */
    public function getStatusBadgeClass(): string
    {
        return match ($this->status) {
            self::STATUS_NEW => 'badge-light-primary',
            self::STATUS_IN_PROGRESS => 'badge-light-warning',
            self::STATUS_COMPLETED => 'badge-light-success',
            self::STATUS_PENDING => 'badge-light-info',
            default => 'badge-light-secondary',
        };
    }

    /**
     * Scope to filter tasks by status
     */
    public function scopeByStatus($query, $status)
    {
        return $query->where('status', $status);
    }

    /**
     * Scope to filter tasks assigned to a user
     */
    public function scopeAssignedTo($query, $userId)
    {
        return $query->where('assigned_to', $userId);
    }


    /**
     * Scope to filter overdue tasks
     */
    public function scopeOverdue($query)
    {
        return $query->where('due_date', '<', now())
                    ->where('status', '!=', self::STATUS_COMPLETED);
    }

    /**
     * Scope to filter tasks due soon (within 7 days)
     */
    public function scopeDueSoon($query)
    {
        return $query->whereBetween('due_date', [now(), now()->addDays(7)])
                    ->where('status', '!=', self::STATUS_COMPLETED);
    }

    /**
     * Get all available document types for tasks
     */
    public static function getDocumentTypes(): array
    {
        return [
            TaskDocument::TYPE_COMPANY => __('tasks.company_document'),
            TaskDocument::TYPE_EMPLOYEE => __('tasks.employee_document'),
            TaskDocument::TYPE_CIVIL_DEFENSE => __('tasks.civil_defense_license'),
            TaskDocument::TYPE_MUNICIPALITY => __('tasks.municipality_license'),
            TaskDocument::TYPE_BRANCH_REGISTRATION => __('tasks.branch_registration'),
        ];
    }

    /**
     * Check if task has company documents
     */
    public function hasCompanyDocuments(): bool
    {
        return $this->taskDocuments()->where('document_type', TaskDocument::TYPE_COMPANY)->exists();
    }

    /**
     * Check if task has employee documents
     */
    public function hasEmployeeDocuments(): bool
    {
        return $this->taskDocuments()->where('document_type', TaskDocument::TYPE_EMPLOYEE)->exists();
    }

    /**
     * Get all document titles for display (comma-separated)
     */
    public function getDocumentTitles(): string
    {
        $titles = [];
        
        foreach ($this->taskDocuments as $taskDoc) {
            $titles[] = $taskDoc->getDocumentTitle();
        }
        
        return implode(', ', $titles);
    }

    /**
     * Get document count for display
     */
    public function getDocumentCount(): int
    {
        return $this->taskDocuments()->count();
    }

    /**
     * Get mixed document types summary
     */
    public function getDocumentTypesSummary(): array
    {
        $companyCount = $this->taskDocuments()->where('document_type', TaskDocument::TYPE_COMPANY)->count();
        $employeeCount = $this->taskDocuments()->where('document_type', TaskDocument::TYPE_EMPLOYEE)->count();
        $civilDefenseCount = $this->taskDocuments()->where('document_type', TaskDocument::TYPE_CIVIL_DEFENSE)->count();
        $municipalityCount = $this->taskDocuments()->where('document_type', TaskDocument::TYPE_MUNICIPALITY)->count();
        $branchRegistrationCount = $this->taskDocuments()->where('document_type', TaskDocument::TYPE_BRANCH_REGISTRATION)->count();
        
        return [
            'company' => $companyCount,
            'employee' => $employeeCount,
            'civil_defense' => $civilDefenseCount,
            'municipality' => $municipalityCount,
            'branch_registration' => $branchRegistrationCount,
            'total' => $companyCount + $employeeCount + $civilDefenseCount + $municipalityCount + $branchRegistrationCount,
        ];
    }

    /**
     * Get the client (company) associated with this task from documents
     */
    public function getClient()
    {
        // First try to get from company documents
        $companyDocument = $this->taskDocuments()
            ->where('document_type', TaskDocument::TYPE_COMPANY)
            ->first();
            
        if ($companyDocument) {
            $companyDoc = CompanyDocument::find($companyDocument->document_id);
            return $companyDoc?->company;
        }

        // Try civil defense licenses
        $civilDefenseDocument = $this->taskDocuments()
            ->where('document_type', TaskDocument::TYPE_CIVIL_DEFENSE)
            ->first();
            
        if ($civilDefenseDocument) {
            $civilDefenseDoc = CivilDefenseLicense::find($civilDefenseDocument->document_id);
            return $civilDefenseDoc?->company;
        }

        // Try municipality licenses
        $municipalityDocument = $this->taskDocuments()
            ->where('document_type', TaskDocument::TYPE_MUNICIPALITY)
            ->first();
            
        if ($municipalityDocument) {
            $municipalityDoc = MunicipalityLicense::find($municipalityDocument->document_id);
            return $municipalityDoc?->company;
        }

        // Try branch registrations
        $branchDocument = $this->taskDocuments()
            ->where('document_type', TaskDocument::TYPE_BRANCH_REGISTRATION)
            ->first();
            
        if ($branchDocument) {
            $branchDoc = BranchCommercialRegistration::find($branchDocument->document_id);
            return $branchDoc?->company;
        }

        // If no company-related documents, try employee documents
        $employeeDocument = $this->taskDocuments()
            ->where('document_type', TaskDocument::TYPE_EMPLOYEE)
            ->first();
            
        if ($employeeDocument) {
            $empDoc = EmployeeDocument::with('employee.company')->find($employeeDocument->document_id);
            return $empDoc?->employee?->company;
        }

        return null;
    }

    /**
     * Get the client ID associated with this task from documents
     */
    public function getClientId()
    {
        return $this->getClient()?->id;
    }

    /**
     * Get the client name associated with this task from documents
     */
    public function getClientName()
    {
        return $this->getClient()?->company_name_en ?? 'Unknown Client';
    }
}
