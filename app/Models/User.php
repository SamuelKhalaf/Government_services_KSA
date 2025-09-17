<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;
use App\Enums\RoleEnum;
use App\Models\Company;
use App\Models\Employee;
class User extends Authenticatable implements MustVerifyEmail
{
    use HasApiTokens, HasFactory, Notifiable, HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'phone_number',
        'status',
        'last_login_at',
        'national_id',
        'preferred_language',
        'avatar',
        'address',
        'created_by',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'last_login_at' => 'datetime',
        'password' => 'hashed',
    ];

    /**
     * Get the user who created this user
     */
    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    /**
     * Get users created by this user
     */
    public function createdUsers()
    {
        return $this->hasMany(User::class, 'created_by');
    }

    /**
     * Get notifications for this user
     */
    public function notifications()
    {
        return $this->hasMany(Notification::class);
    }

    /**
     * Get unread notifications for this user
     */
    public function unreadNotifications()
    {
        return $this->notifications()->unread();
    }

    /**
     * Get read notifications for this user
     */
    public function readNotifications()
    {
        return $this->notifications()->read();
    }

    /**
     * Check if user is active
     */
    public function isActive(): bool
    {
        return $this->status === 'active';
    }

    /**
     * Check if user is inactive
     */
    public function isInactive(): bool
    {
        return $this->status === 'inactive';
    }

    /**
     * Get user's display name based on preferred language
     */
    public function getDisplayName(): string
    {
        return $this->preferred_language === 'ar' ? $this->name : $this->name;
    }

    /**
     * Get user's avatar URL or default
     */
    public function getAvatarUrl(): string
    {
        if ($this->avatar) {
            return asset('storage/' . $this->avatar);
        }

        // Return default avatar based on preferred language
        return $this->preferred_language === 'ar'
            ? asset('assets/media/avatars/300-7.jpg')
            : asset('assets/media/avatars/300-1.jpg');
    }

    /**
     * Update last login timestamp
     */
    public function updateLastLogin(): void
    {
        // Use direct property assignment to avoid fillable restrictions
        $this->last_login_at = now();
        $this->save();
    }

    /**
     * Scope to filter active users
     */
    public function scopeActive($query)
    {
        return $query->where('status', 'active');
    }

    /**
     * Scope to filter inactive users
     */
    public function scopeInactive($query)
    {
        return $query->where('status', 'inactive');
    }

    /**
     * Scope to filter by preferred language
     */
    public function scopeByLanguage($query, $language)
    {
        return $query->where('preferred_language', $language);
    }

    /**
     * Get tasks assigned to this user
     */
    public function assignedTasks()
    {
        return $this->hasMany(Task::class, 'assigned_to');
    }

    /**
     * Get tasks created by this user
     */
    public function createdTasks()
    {
        return $this->hasMany(Task::class, 'created_by');
    }

    /**
     * Get task histories created by this user
     */
    public function taskHistories()
    {
        return $this->hasMany(TaskHistory::class, 'changed_by');
    }

    /**
     * Scope to filter users with employee role
     */
    public function scopeEmployees($query)
    {
        return $query->whereHas('roles', function ($q) {
            $q->where('name', RoleEnum::EMPLOYEE->value);
        });
    }

    /**
     * Scope to filter users with admin role
     */
    public function scopeAdmins($query)
    {
        return $query->whereHas('roles', function ($q) {
            $q->where('name', RoleEnum::ADMIN->value);
        });
    }

    /**
     * Check if user is an employee
     */
    public function isEmployee(): bool
    {
        return $this->hasRole(RoleEnum::EMPLOYEE->value);
    }

    /**
     * Check if user is an admin
     */
    public function isAdmin(): bool
    {
        return $this->hasRole(RoleEnum::ADMIN->value);
    }

    /**
     * Get companies assigned to this user through tasks
     */
    public function assignedCompanies()
    {
        return Company::whereHas('companyDocuments.taskDocuments.task', function ($query) {
            $query->where('assigned_to', $this->id);
        })->orWhereHas('employees.documents.taskDocuments.task', function ($query) {
            $query->where('assigned_to', $this->id);
        });
    }

    /**
     * Get employees assigned to this user through tasks
     */
    public function assignedEmployees()
    {
        return Employee::whereHas('documents.taskDocuments.task', function ($query) {
            $query->where('assigned_to', $this->id);
        });
    }

    /**
     * Get company IDs assigned to this user through tasks
     */
    public function getAssignedCompanyIds()
    {
        return $this->assignedCompanies()->pluck('id');
    }

    /**
     * Get employee IDs assigned to this user through tasks
     */
    public function getAssignedEmployeeIds()
    {
        return $this->assignedEmployees()->pluck('id');
    }

    /**
     * Get login logs for this user
     */
    public function loginLogs()
    {
        return $this->hasMany(EmployeeLoginLog::class);
    }

    /**
     * Get activity logs for this user
     */
    public function activityLogs()
    {
        return $this->hasMany(EmployeeActivityLog::class);
    }

    /**
     * Get click tracking for this user
     */
    public function clickTracking()
    {
        return $this->hasMany(EmployeeClickTracking::class);
    }

    /**
     * Get active screen time for this user
     */
    public function activeScreenTime()
    {
        return $this->hasMany(EmployeeActiveScreenTime::class);
    }


    /**
     * Get current active login session
     */
    public function currentLoginSession()
    {
        return $this->loginLogs()->active()->latest()->first();
    }

    /**
     * Get today's screen time
     */
    public function todayScreenTime()
    {
        return $this->activeScreenTime()->onDate(now()->toDateString())->first();
    }
}
