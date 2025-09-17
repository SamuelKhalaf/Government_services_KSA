<?php

use App\Enums\PermissionEnum;
use App\Enums\RoleEnum;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\URL;
use Spatie\Permission\Models\Role;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Authentication routes (registration is disabled - only login, password reset, and email verification)
Auth::routes(['register' => false]);

// Language switching routes (accessible to everyone)
Route::get('/language/switch/{language}', [App\Http\Controllers\admin\LanguageController::class, 'switch'])
    ->name('language.switch')
    ->where('language', 'ar|en');

Route::get('/language/current', [App\Http\Controllers\admin\LanguageController::class, 'current'])
    ->name('language.current');

Route::get('/', [HomeController::class, 'index'])->name('home');

Route::get('/401', function () {
    abort(401);
});
Route::get('/500', function () {
    abort(500);
});

Route::get('/test', function () {
    $adminRole = Role::firstOrCreate(['name' => RoleEnum::ADMIN->value]);
    $adminRole->givePermissionTo(PermissionEnum::all());
});

// Employee Monitoring API Routes (moved from api.php for better session handling)
Route::middleware(['auth:web'])->prefix('api/employee-monitoring')->group(function () {
    // Track click activity
    Route::post('/track-click', function (Request $request) {
        $user = $request->user();
        
        if (!$user->isEmployee()) {
            return response()->json(['error' => 'Unauthorized'], 403);
        }
        
        $clickData = $request->validate([
            'element_type' => 'required|string|max:50',
            'element_id' => 'nullable|string|max:100',
            'element_class' => 'nullable|string|max:200',
            'element_text' => 'nullable|string|max:500',
            'page_url' => 'required|string|max:500',
            'x_position' => 'nullable|integer',
            'y_position' => 'nullable|integer',
        ]);
        
        app(\App\Services\EmployeeMonitoringService::class)->trackClick($user, $clickData);
        
        return response()->json(['success' => true]);
    });
    
    // Update screen time
    Route::post('/update-screen-time', function (Request $request) {
        $user = $request->user();
        
        if (!$user->isEmployee()) {
            return response()->json(['error' => 'Unauthorized'], 403);
        }
        
        $activityData = $request->validate([
            'active_seconds' => 'required|integer|min:0',
            'idle_seconds' => 'required|integer|min:0',
            'clicks' => 'required|integer|min:0',
            'keypresses' => 'required|integer|min:0',
            'scrolls' => 'required|integer|min:0',
            'breaks' => 'nullable|array',
        ]);
        
        app(\App\Services\EmployeeMonitoringService::class)->updateScreenTimeSession($user, $activityData);
        
        return response()->json(['success' => true]);
    });
    
    
    // Get employee statistics
    Route::get('/my-statistics', function (Request $request) {
        $user = $request->user();
        
        if (!$user->isEmployee()) {
            return response()->json(['error' => 'Unauthorized'], 403);
        }
        
        $days = $request->get('days', 30);
        $statistics = app(\App\Services\EmployeeMonitoringService::class)->getProductivityMetrics($user, $days);
        
        return response()->json($statistics);
    });
});



// Client Management Module Routes
Route::middleware(['auth'])->prefix('admin')->name('admin.')->group(function () {

    // Admin Dashboard - Redirect to Employee Monitoring
    Route::get('dashboard', function () {
        return redirect()->route('admin.employee-monitoring.index');
    })->name('dashboard');

    ############################### Start: Companies Management Routes #####################################
    // Companies - Create (must come before parameterized routes)
    Route::middleware('permission:' . PermissionEnum::CREATE_CLIENTS->value)->group(function () {
        Route::get('companies/create', [App\Http\Controllers\admin\CompanyController::class, 'create'])->name('companies.create');
        Route::post('companies', [App\Http\Controllers\admin\CompanyController::class, 'store'])->name('companies.store');
    });

    ############################### Start: Employees Management Routes (must come before company show route) #####################################
    // Employees - Create
    Route::middleware('permission:' . PermissionEnum::CREATE_CLIENT_EMPLOYEES->value)->group(function () {
        Route::get('companies/{company}/employees/create', [App\Http\Controllers\admin\EmployeeController::class, 'create'])->name('companies.employees.create');
        Route::post('companies/{company}/employees', [App\Http\Controllers\admin\EmployeeController::class, 'store'])->name('companies.employees.store');
    });

    // Employees - Update
    Route::middleware('permission:' . PermissionEnum::UPDATE_CLIENT_EMPLOYEES->value)->group(function () {
        Route::get('companies/{company}/employees/{employee}/edit', [App\Http\Controllers\admin\EmployeeController::class, 'edit'])->name('companies.employees.edit');
        Route::put('companies/{company}/employees/{employee}', [App\Http\Controllers\admin\EmployeeController::class, 'update'])->name('companies.employees.update');
    });

    // Employees - Delete
    Route::middleware('permission:' . PermissionEnum::DELETE_CLIENT_EMPLOYEES->value)->group(function () {
        Route::delete('companies/{company}/employees/{employee}', [App\Http\Controllers\admin\EmployeeController::class, 'destroy'])->name('companies.employees.destroy');
    });

    // Employees - View (company-specific)
    Route::middleware('permission:' . PermissionEnum::VIEW_CLIENT_EMPLOYEES->value)->group(function () {
        Route::get('companies/{company}/employees/{employee}', [App\Http\Controllers\admin\EmployeeController::class, 'show'])->name('companies.employees.show');
    });

    // Companies - View All/Assigned
    Route::middleware('permission:' . PermissionEnum::VIEW_ALL_CLIENTS->value . '|' . PermissionEnum::VIEW_ASSIGNED_CLIENTS->value)->group(function () {
        Route::get('companies', [App\Http\Controllers\admin\CompanyController::class, 'index'])->name('companies.index');
        Route::get('companies/{company}/workflow', [App\Http\Controllers\admin\CompanyController::class, 'workflow'])->name('companies.workflow');
        Route::post('companies/{company}/workflow-step', [App\Http\Controllers\admin\CompanyController::class, 'processWorkflowStep'])->name('companies.workflow-step');
        Route::get('companies/{company}', [App\Http\Controllers\admin\CompanyController::class, 'show'])->name('companies.show');
    });

    // Companies - Update
    Route::middleware('permission:' . PermissionEnum::UPDATE_CLIENTS->value)->group(function () {
        Route::get('companies/{company}/edit', [App\Http\Controllers\admin\CompanyController::class, 'edit'])->name('companies.edit');
        Route::put('companies/{company}', [App\Http\Controllers\admin\CompanyController::class, 'update'])->name('companies.update');
    });

    // Companies - Delete
    Route::delete('companies/{company}', [App\Http\Controllers\admin\CompanyController::class, 'destroy'])
        ->middleware('permission:' . PermissionEnum::DELETE_CLIENTS->value)
        ->name('companies.destroy');

    ############################### Start: Company Documents Management Routes #####################################
    Route::prefix('companies/{company}')->name('companies.')->group(function () {
        // Civil Defense Licenses
        Route::middleware('permission:' . PermissionEnum::MANAGE_CIVIL_DEFENSE_LICENSES->value)->group(function () {
            Route::resource('civil-defense-licenses', App\Http\Controllers\admin\CivilDefenseLicenseController::class)->except(['index']);
        });

        // Municipality Licenses
        Route::middleware('permission:' . PermissionEnum::MANAGE_MUNICIPALITY_LICENSES->value)->group(function () {
            Route::resource('municipality-licenses', App\Http\Controllers\admin\MunicipalityLicenseController::class)->except(['index']);
        });

        // Branch Registrations
        Route::middleware('permission:' . PermissionEnum::MANAGE_BRANCH_REGISTRATIONS->value)->group(function () {
            Route::resource('branch-registrations', App\Http\Controllers\admin\BranchCommercialRegistrationController::class)->except(['index']);
        });

        // Dynamic Company Documents - Company Specific
        Route::middleware('permission:' . PermissionEnum::VIEW_ALL_DOCUMENTS->value . '|' . PermissionEnum::VIEW_ASSIGNED_DOCUMENTS->value)->group(function () {
            Route::get('/documents', [App\Http\Controllers\admin\CompanyDocumentController::class, 'index'])->name('documents.index');
            Route::get('/documents/create', [App\Http\Controllers\admin\CompanyDocumentController::class, 'create'])->name('documents.create');
            Route::post('/documents', [App\Http\Controllers\admin\CompanyDocumentController::class, 'store'])->name('documents.store');
            Route::get('/documents/{document}', [App\Http\Controllers\admin\CompanyDocumentController::class, 'show'])->name('documents.show');
            Route::get('/documents/{document}/edit', [App\Http\Controllers\admin\CompanyDocumentController::class, 'edit'])->name('documents.edit');
            Route::put('/documents/{document}', [App\Http\Controllers\admin\CompanyDocumentController::class, 'update'])->name('documents.update');
            Route::delete('/documents/{document}', [App\Http\Controllers\admin\CompanyDocumentController::class, 'destroy'])->name('documents.destroy');
            Route::get('/documents/{document}/download', [App\Http\Controllers\admin\CompanyDocumentController::class, 'download'])->name('documents.download');
        });
    });

    // Dynamic Company Documents - General Index (All Companies)
    Route::middleware('permission:' . PermissionEnum::VIEW_ALL_DOCUMENTS->value . '|' . PermissionEnum::VIEW_ASSIGNED_DOCUMENTS->value)->group(function () {
        Route::get('company-documents', [App\Http\Controllers\admin\CompanyDocumentController::class, 'allIndex'])->name('company-documents.index');
    });
    ############################### Start: Employees Management Routes (general employee routes) #####################################
    // Employees - View (general employee routes, not company-specific)
    Route::middleware('permission:' . PermissionEnum::VIEW_CLIENT_EMPLOYEES->value)->group(function () {
        Route::get('employees', [App\Http\Controllers\admin\EmployeeController::class, 'index'])->name('employees.index');
        Route::get('employees/{employee}', [App\Http\Controllers\admin\EmployeeController::class, 'show'])->name('employees.show');
    });

    // Employees - Update (general employee routes)
    Route::middleware('permission:' . PermissionEnum::UPDATE_CLIENT_EMPLOYEES->value)->group(function () {
        Route::get('employees/{employee}/edit', [App\Http\Controllers\admin\EmployeeController::class, 'edit'])->name('employees.edit');
        Route::put('employees/{employee}', [App\Http\Controllers\admin\EmployeeController::class, 'update'])->name('employees.update');
    });

    // Employees - Delete (general employee routes)
    Route::middleware('permission:' . PermissionEnum::DELETE_CLIENT_EMPLOYEES->value)->group(function () {
        Route::delete('employees/{employee}', [App\Http\Controllers\admin\EmployeeController::class, 'destroy'])->name('employees.destroy');
    });

    ############################### Start: Employee Documents Management Routes #####################################
    // Employee Documents - Create & Upload
    Route::middleware('permission:' . PermissionEnum::UPLOAD_DOCUMENTS->value)->group(function () {
        Route::get('employees/{employee}/documents/create', [App\Http\Controllers\admin\EmployeeDocumentController::class, 'create'])->name('employees.documents.create');
        Route::post('employees/{employee}/documents', [App\Http\Controllers\admin\EmployeeDocumentController::class, 'store'])->name('employees.documents.store');
    });

    // Employee Documents - View
    Route::middleware('permission:' . PermissionEnum::VIEW_ALL_DOCUMENTS->value . '|' . PermissionEnum::VIEW_ASSIGNED_DOCUMENTS->value)->group(function () {
        Route::get('documents', [App\Http\Controllers\admin\EmployeeDocumentController::class, 'index'])->name('documents.index');
        Route::get('employees/{employee}/documents/{document}', [App\Http\Controllers\admin\EmployeeDocumentController::class, 'show'])->name('employees.documents.show');
    });

    // Employee Documents - Update
    Route::middleware('permission:' . PermissionEnum::UPDATE_DOCUMENTS->value)->group(function () {
        Route::get('employees/{employee}/documents/{document}/edit', [App\Http\Controllers\admin\EmployeeDocumentController::class, 'edit'])->name('employees.documents.edit');
        Route::put('employees/{employee}/documents/{document}', [App\Http\Controllers\admin\EmployeeDocumentController::class, 'update'])->name('employees.documents.update');
    });

    // Employee Documents - Delete
    Route::delete('employees/{employee}/documents/{document}', [App\Http\Controllers\admin\EmployeeDocumentController::class, 'destroy'])
        ->middleware('permission:' . PermissionEnum::DELETE_DOCUMENTS->value)
        ->name('employees.documents.destroy');

    // Employee Documents - Download (legacy route)
    Route::post('documents/{document}/download', [App\Http\Controllers\admin\EmployeeDocumentController::class, 'downloadLegacy'])
        ->middleware('permission:' . PermissionEnum::DOWNLOAD_DOCUMENTS->value)
        ->name('documents.download');

    // Employee Documents - Download (with employee parameter)
    Route::get('employees/{employee}/documents/{document}/download', [App\Http\Controllers\admin\EmployeeDocumentController::class, 'download'])
        ->middleware('permission:' . PermissionEnum::DOWNLOAD_DOCUMENTS->value)
        ->name('employees.documents.download');

    ############################### Start: Document Dashboard Routes #####################################
    Route::middleware('permission:' . PermissionEnum::VIEW_DOCUMENT_DASHBOARD->value)->group(function () {
        Route::get('document-dashboard', [App\Http\Controllers\admin\DocumentDashboardController::class, 'index'])->name('document-dashboard');
        Route::get('expiring-documents', [App\Http\Controllers\admin\DocumentDashboardController::class, 'getExpiringDocumentsApi'])->name('expiring-documents');
    });

    ############################### Start: Document Types Management Routes #####################################
    Route::middleware('permission:'. PermissionEnum::VIEW_DOCUMENT_TYPES->value)->group(function () {
        Route::get('document-types', [App\Http\Controllers\admin\DocumentTypeController::class, 'index'])->name('document-types.index');
    });

    Route::post('document-types', [App\Http\Controllers\admin\DocumentTypeController::class, 'store'])
        ->middleware('permission:'. PermissionEnum::CREATE_DOCUMENT_TYPES->value)
        ->name('document-types.store');

    Route::middleware('permission:'. PermissionEnum::UPDATE_DOCUMENT_TYPES->value)->group(function () {
        Route::get('document-types/create', [App\Http\Controllers\admin\DocumentTypeController::class, 'create'])->name('document-types.create');
        Route::get('document-types/{type}/edit', [App\Http\Controllers\admin\DocumentTypeController::class, 'edit'])->name('document-types.edit');
        Route::put('document-types/{type}', [App\Http\Controllers\admin\DocumentTypeController::class, 'update'])->name('document-types.update');
    });

    Route::delete('document-types/{type}', [App\Http\Controllers\admin\DocumentTypeController::class, 'destroy'])
        ->middleware('permission:'. PermissionEnum::DELETE_DOCUMENT_TYPES->value)
        ->name('document-types.destroy');

    ############################### Start: API Routes for AJAX #####################################
    Route::prefix('api')->name('api.')->group(function () {
        // Document Types API (requires document view permission)
        Route::middleware('permission:' . PermissionEnum::VIEW_ALL_DOCUMENTS->value . '|' . PermissionEnum::VIEW_ASSIGNED_DOCUMENTS->value)->group(function () {
            Route::get('document-types', [App\Http\Controllers\admin\DocumentTypeController::class, 'index'])->name('document-types.index');
            Route::get('document-types/{type}/fields', [App\Http\Controllers\admin\DocumentTypeController::class, 'getFields'])->name('document-types.fields');
        });

        // Search APIs (requires respective view permissions)
        Route::get('companies/search', [App\Http\Controllers\admin\CompanyController::class, 'search'])
            ->middleware('permission:' . PermissionEnum::VIEW_ALL_CLIENTS->value . '|' . PermissionEnum::VIEW_ASSIGNED_CLIENTS->value)
            ->name('companies.search');

        Route::get('employees/search', [App\Http\Controllers\admin\EmployeeController::class, 'search'])
            ->middleware('permission:' . PermissionEnum::VIEW_CLIENT_EMPLOYEES->value)
            ->name('employees.search');
    });

    ############################### Start: File Management Routes #####################################
    Route::prefix('files')->name('files.')->group(function () {
        // File preview and download (requires document view permission)
        Route::middleware('permission:' . PermissionEnum::VIEW_ALL_DOCUMENTS->value . '|' . PermissionEnum::VIEW_ASSIGNED_DOCUMENTS->value)->group(function () {
            Route::get('preview', [App\Http\Controllers\admin\FileController::class, 'preview'])->name('preview');
            Route::get('download', [App\Http\Controllers\admin\FileController::class, 'download'])->name('download');
            Route::get('info', [App\Http\Controllers\admin\FileController::class, 'info'])->name('info');
        });

        // File deletion (requires delete permission)
        Route::middleware('permission:' . PermissionEnum::DELETE_DOCUMENTS->value)->group(function () {
            Route::delete('delete', [App\Http\Controllers\admin\FileController::class, 'delete'])->name('delete');
            Route::delete('bulk-delete', [App\Http\Controllers\admin\FileController::class, 'bulkDelete'])->name('bulk-delete');
        });
    });

    ############################### Start: Tasks Management Routes #####################################
    // Tasks - Create
    Route::middleware('permission:' . PermissionEnum::CREATE_TASKS->value)->group(function () {
        Route::get('tasks/create', [App\Http\Controllers\TaskController::class, 'create'])->name('tasks.create');
        Route::post('tasks', [App\Http\Controllers\TaskController::class, 'store'])->name('tasks.store');
        
        // Document Assignment Interface
        Route::get('tasks/assign-documents', [App\Http\Controllers\TaskController::class, 'showAssignDocuments'])->name('tasks.assign-documents');
        Route::post('tasks/bulk-assign', [App\Http\Controllers\TaskController::class, 'bulkAssignDocuments'])->name('tasks.bulk-assign');
    });
    
    // Tasks - View All/Assigned
    Route::middleware('permission:' . PermissionEnum::VIEW_ALL_TASKS->value . '|' . PermissionEnum::VIEW_ASSIGNED_TASKS->value)->group(function () {
        Route::get('tasks', [App\Http\Controllers\TaskController::class, 'index'])->name('tasks.index');
        Route::get('tasks/{task}', [App\Http\Controllers\TaskController::class, 'show'])->name('tasks.show');
    });

    // Tasks - Update
    Route::middleware('permission:' . PermissionEnum::UPDATE_TASKS->value)->group(function () {
        Route::get('tasks/{task}/edit', [App\Http\Controllers\TaskController::class, 'edit'])->name('tasks.edit');
        Route::put('tasks/{task}', [App\Http\Controllers\TaskController::class, 'update'])->name('tasks.update');
    });

    // Tasks - Delete
    Route::delete('tasks/{task}', [App\Http\Controllers\TaskController::class, 'destroy'])
        ->middleware('permission:' . PermissionEnum::DELETE_TASKS->value)
        ->name('tasks.destroy');

    // Tasks - AJAX endpoints for dynamic selection
    Route::middleware('permission:' . PermissionEnum::CREATE_TASKS->value . '|' . PermissionEnum::UPDATE_TASKS->value)->group(function () {
        Route::get('tasks/ajax/company-employees', [App\Http\Controllers\TaskController::class, 'getCompanyEmployees'])->name('tasks.ajax.company-employees');
        Route::get('tasks/ajax/company-documents', [App\Http\Controllers\TaskController::class, 'getCompanyDocuments'])->name('tasks.ajax.company-documents');
        Route::get('tasks/ajax/company-licenses', [App\Http\Controllers\TaskController::class, 'getCompanyLicenses'])->name('tasks.ajax.company-licenses');
        Route::get('tasks/ajax/employee-documents', [App\Http\Controllers\TaskController::class, 'getEmployeeDocuments'])->name('tasks.ajax.employee-documents');
        Route::get('tasks/ajax/employees-for-assignment', [App\Http\Controllers\TaskController::class, 'getEmployeesForAssignment'])->name('tasks.ajax.employees-for-assignment');
    });

    // Notifications
    Route::prefix('notifications')->name('notifications.')->group(function () {
        // View own notifications
        Route::middleware('permission:' . PermissionEnum::VIEW_OWN_NOTIFICATIONS->value)->group(function () {
            Route::get('/', [App\Http\Controllers\NotificationController::class, 'index'])->name('index');
            Route::get('/all', [App\Http\Controllers\NotificationController::class, 'showAll'])->name('all');
            Route::get('/count', [App\Http\Controllers\NotificationController::class, 'unreadCount'])->name('count');
        });
        
        // Mark notifications as read/unread
        Route::middleware('permission:' . PermissionEnum::MARK_NOTIFICATIONS_READ->value)->group(function () {
            Route::post('/{id}/read', [App\Http\Controllers\NotificationController::class, 'markAsRead'])->name('read');
            Route::post('/{id}/unread', [App\Http\Controllers\NotificationController::class, 'markAsUnread'])->name('unread');
            Route::post('/mark-all-read', [App\Http\Controllers\NotificationController::class, 'markAllAsRead'])->name('mark_all_read');
        });
        
        // Delete notifications
        Route::middleware('permission:' . PermissionEnum::DELETE_NOTIFICATIONS->value)->group(function () {
            Route::delete('/{id}', [App\Http\Controllers\NotificationController::class, 'destroy'])->name('destroy');
        });
    });

    ############################### Start: Packages Management Routes #####################################
    // Packages - Create
    Route::middleware('permission:' . PermissionEnum::CREATE_FINANCIAL_PACKAGES->value)->group(function () {
        Route::get('packages/create', [App\Http\Controllers\PackageController::class, 'create'])->name('packages.create');
        Route::post('packages', [App\Http\Controllers\PackageController::class, 'store'])->name('packages.store');
    });
    
    // Packages - View
    Route::middleware('permission:' . PermissionEnum::VIEW_FINANCIAL_PACKAGES->value)->group(function () {
        Route::get('packages', [App\Http\Controllers\PackageController::class, 'index'])->name('packages.index');
        Route::get('packages/{package}', [App\Http\Controllers\PackageController::class, 'show'])->name('packages.show');
    });
    
    // Packages - Update
    Route::middleware('permission:' . PermissionEnum::UPDATE_FINANCIAL_PACKAGES->value)->group(function () {
        Route::get('packages/{package}/edit', [App\Http\Controllers\PackageController::class, 'edit'])->name('packages.edit');
        Route::put('packages/{package}', [App\Http\Controllers\PackageController::class, 'update'])->name('packages.update');
    });
    
    // Packages - Delete
    Route::delete('packages/{package}', [App\Http\Controllers\PackageController::class, 'destroy'])
        ->middleware('permission:' . PermissionEnum::DELETE_FINANCIAL_PACKAGES->value)
        ->name('packages.destroy');

    ############################### Start: Client Package Management Routes #####################################
    // Client Package - Assign
    Route::middleware('permission:' . PermissionEnum::ASSIGN_PACKAGES_TO_CLIENTS->value)->group(function () {
        Route::get('companies/{company}/packages/assign', [App\Http\Controllers\ClientPackageController::class, 'create'])->name('companies.packages.assign');
        Route::post('companies/{company}/packages', [App\Http\Controllers\ClientPackageController::class, 'store'])->name('companies.packages.store');
        Route::get('companies/{company}/packages/{clientPackage}/change', [App\Http\Controllers\ClientPackageController::class, 'change'])->name('companies.packages.change');
        Route::post('companies/{company}/packages/{clientPackage}/change', [App\Http\Controllers\ClientPackageController::class, 'changePackage'])->name('companies.packages.change.store');
    });
    
    // Client Package - Renew
    Route::middleware('permission:' . PermissionEnum::RENEW_CLIENT_PACKAGES->value)->group(function () {
        Route::get('companies/{company}/packages/{clientPackage}/renew', [App\Http\Controllers\ClientPackageController::class, 'edit'])->name('companies.packages.renew');
        Route::put('companies/{company}/packages/{clientPackage}/renew', [App\Http\Controllers\ClientPackageController::class, 'update'])->name('companies.packages.renew.store');
    });
    
    // Client Package - Cancel
    Route::delete('companies/{company}/packages/{clientPackage}', [App\Http\Controllers\ClientPackageController::class, 'destroy'])
        ->middleware('permission:' . PermissionEnum::CANCEL_CLIENT_PACKAGES->value)
        ->name('companies.packages.cancel');
});
