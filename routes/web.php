<?php

use App\Enums\PermissionEnum;
use App\Enums\RoleEnum;
use App\Models\User;
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



// Client Management Module Routes
Route::middleware(['auth'])->prefix('admin')->name('admin.')->group(function () {

    // Admin Dashboard
    Route::get('dashboard', [App\Http\Controllers\admin\DashboardController::class, 'index'])->name('dashboard');

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
});
