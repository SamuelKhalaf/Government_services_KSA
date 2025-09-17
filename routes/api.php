<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EmployeeMonitoringController;
use App\Enums\PermissionEnum;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// Employee Monitoring API Routes
Route::middleware(['auth:web'])->prefix('employee-monitoring')->group(function () {
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
