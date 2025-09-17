<?php

use App\Enums\PermissionEnum;
use App\Http\Controllers\admin\DashboardController;
use App\Http\Controllers\admin\LanguageController;
use App\Http\Controllers\admin\PermissionsController;
use App\Http\Controllers\admin\RolesController;
use App\Http\Controllers\admin\UsersController;
use App\Http\Controllers\EmployeeMonitoringController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Admin Routes
|--------------------------------------------------------------------------
|
| Here is where you can register admin routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/
Route::middleware(['auth'])->name('admin.')->group(function () {

    // View Dashboard - Redirect to Employee Monitoring
    Route::get('/dashboard', function () {
        return redirect()->route('admin.employee-monitoring.index');
    })->name('admin.dashboard');
    ############################### Start:Users Routes #####################################
    Route::middleware('permission:'. PermissionEnum::VIEW_USERS->value)->group(function () {
        Route::get('users', [UsersController::class, 'index'])->name('users.index');
        Route::get('/user/all', [UsersController::class, 'getUsersDatatable'])->name('users.datatable');
    });

    Route::post('users', [UsersController::class, 'store'])
        ->middleware('permission:'. PermissionEnum::CREATE_USERS->value)
        ->name('users.store');

    Route::middleware('permission:'. PermissionEnum::UPDATE_USERS->value)->group(function () {
        Route::get('users/{user}/edit', [UsersController::class, 'edit'])->name('users.edit');
        Route::put('users/{user}', [UsersController::class, 'update'])->name('users.update');
    });

    Route::delete('users/{user}', [UsersController::class, 'destroy'])
        ->middleware('permission:'. PermissionEnum::DELETE_USERS->value)
        ->name('users.destroy');
    ###############################  End:Users Routes  #####################################

    ############################### Start:Roles Routes #####################################
    Route::get('/roles', [RolesController::class, 'index'])
        ->middleware('permission:'.PermissionEnum::VIEW_ROLES->value)
        ->name('roles.index');

    Route::post('/roles', [RolesController::class, 'store'])
        ->name('roles.store')
        ->middleware('permission:'.PermissionEnum::CREATE_ROLES->value);

    Route::middleware('permission:'. PermissionEnum::VIEW_ROLES->value)->group(function () {
        Route::get('/roles/{role}', [RolesController::class, 'show'])->name('roles.show');
        Route::get('/roles/{id}/users', [RolesController::class, 'getSpecificRoleUsersData'])->name('admin.roles.users');
    });

    Route::middleware('permission:'. PermissionEnum::UPDATE_ROLES->value)->group(function () {
        Route::get('/roles/{role}/edit', [RolesController::class, 'edit'])->name('roles.edit');
        Route::put('/roles/{role}', [RolesController::class, 'update'])->name('roles.update');
    });

    Route::middleware('permission:'. PermissionEnum::DELETE_ROLES->value)->group(function () {
        Route::delete('/roles/{role}', [RolesController::class, 'destroy'])->name('roles.destroy');
        Route::delete('/roles/{role}/users/{user}', [RolesController::class, 'deleteUsersAssignedToRole']);
    });
    ###############################  End:Roles Routes  #####################################

    ############################### Start:Permissions Routes #####################################
    Route::middleware('permission:'. PermissionEnum::VIEW_PERMISSIONS->value)->group(function () {
        Route::get('/permissions', [PermissionsController::class, 'index'])->name('permissions.index');
        Route::get('/permissions-data', [PermissionsController::class, 'getPermissionsDatatable'])->name('permissions.data');
    });

    Route::post('/permissions', [PermissionsController::class, 'store'])
        ->middleware('permission:'.PermissionEnum::CREATE_PERMISSIONS->value)
        ->name('permissions.store');

    Route::delete('/permissions/{permission}', [PermissionsController::class, 'destroy'])
        ->middleware('permission:'.PermissionEnum::DELETE_PERMISSIONS->value)
        ->name('permissions.destroy');
    ###############################  End:Permissions Routes  #####################################

    ############################### Start:Employee Monitoring Routes #####################################
    Route::middleware('permission:'. PermissionEnum::VIEW_EMPLOYEE_MONITORING->value)->group(function () {
        Route::get('/employee-monitoring', [EmployeeMonitoringController::class, 'index'])->name('employee-monitoring.index');
        Route::get('/employee-monitoring/statistics', [EmployeeMonitoringController::class, 'getStatistics'])->name('employee-monitoring.statistics');
        Route::get('/employee-monitoring/activity-chart', [EmployeeMonitoringController::class, 'getActivityChartData'])->name('employee-monitoring.activity-chart');
        Route::get('/employee-monitoring/screen-time-chart', [EmployeeMonitoringController::class, 'getScreenTimeChartData'])->name('employee-monitoring.screen-time-chart');
    });

    Route::middleware('permission:'. PermissionEnum::VIEW_EMPLOYEE_LOGIN_LOGS->value)->group(function () {
        Route::get('/employee-monitoring/login-logs', [EmployeeMonitoringController::class, 'loginLogs'])->name('employee-monitoring.login-logs');
    });

    Route::middleware('permission:'. PermissionEnum::VIEW_EMPLOYEE_ACTIVITY_LOGS->value)->group(function () {
        Route::get('/employee-monitoring/activity-logs', [EmployeeMonitoringController::class, 'activityLogs'])->name('employee-monitoring.activity-logs');
    });

    Route::middleware('permission:'. PermissionEnum::VIEW_EMPLOYEE_CLICK_TRACKING->value)->group(function () {
        Route::get('/employee-monitoring/click-tracking', [EmployeeMonitoringController::class, 'clickTracking'])->name('employee-monitoring.click-tracking');
    });

    Route::middleware('permission:'. PermissionEnum::VIEW_EMPLOYEE_SCREEN_TIME->value)->group(function () {
        Route::get('/employee-monitoring/screen-time', [EmployeeMonitoringController::class, 'screenTime'])->name('employee-monitoring.screen-time');
    });


    Route::middleware('permission:'. PermissionEnum::MANAGE_EMPLOYEE_MONITORING->value)->group(function () {
        Route::get('/employee-monitoring/export/{type}', [EmployeeMonitoringController::class, 'export'])->name('employee-monitoring.export');
    });
    ###############################  End:Employee Monitoring Routes  #####################################

});
