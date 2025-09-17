<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\View\View;
use App\Models\User;
use App\Models\EmployeeLoginLog;
use App\Models\EmployeeActivityLog;
use App\Models\EmployeeClickTracking;
use App\Models\EmployeeActiveScreenTime;
use App\Enums\PermissionEnum;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class EmployeeMonitoringController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('permission:' . PermissionEnum::VIEW_EMPLOYEE_MONITORING->value);
    }

    /**
     * Display the employee monitoring dashboard
     */
    public function index(): View
    {
        $this->middleware('permission:' . PermissionEnum::VIEW_EMPLOYEE_MONITORING->value);

        // Get summary statistics
        $totalEmployees = User::employees()->count();
        $activeEmployees = User::employees()->whereHas('loginLogs', function ($query) {
            $query->where('status', 'active');
        })->count();
        
        $todayLogins = EmployeeLoginLog::whereDate('login_at', today())->count();
        $todayActivities = EmployeeActivityLog::whereDate('created_at', today())->count();
        $todayClicks = EmployeeClickTracking::whereDate('clicked_at', today())->count();

        // Get recent activities
        $recentActivities = EmployeeActivityLog::with('user')
            ->latest()
            ->limit(10)
            ->get();

        // Get active sessions
        $activeSessions = EmployeeLoginLog::with('user')
            ->active()
            ->latest()
            ->get();

        return view('admin.employee-monitoring.index', compact(
            'totalEmployees',
            'activeEmployees',
            'todayLogins',
            'todayActivities',
            'todayClicks',
            'recentActivities',
            'activeSessions'
        ));
    }

    /**
     * Display login logs
     */
    public function loginLogs(Request $request): View
    {
        $this->middleware('permission:' . PermissionEnum::VIEW_EMPLOYEE_LOGIN_LOGS->value);

        $query = EmployeeLoginLog::with('user');

        // Apply filters
        if ($request->filled('employee_id')) {
            $query->where('user_id', $request->employee_id);
        }

        if ($request->filled('date_from')) {
            $query->whereDate('login_at', '>=', $request->date_from);
        }

        if ($request->filled('date_to')) {
            $query->whereDate('login_at', '<=', $request->date_to);
        }

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        $loginLogs = $query->latest('login_at')->paginate(20);
        $employees = User::employees()->select('id', 'name')->get();

        return view('admin.employee-monitoring.login-logs', compact('loginLogs', 'employees'));
    }

    /**
     * Display activity logs
     */
    public function activityLogs(Request $request): View
    {
        $this->middleware('permission:' . PermissionEnum::VIEW_EMPLOYEE_ACTIVITY_LOGS->value);

        $query = EmployeeActivityLog::with('user');

        // Apply filters
        if ($request->filled('employee_id')) {
            $query->where('user_id', $request->employee_id);
        }

        if ($request->filled('action_type')) {
            $query->where('action_type', $request->action_type);
        }

        if ($request->filled('model_type')) {
            $query->where('model_type', $request->model_type);
        }

        if ($request->filled('date_from')) {
            $query->whereDate('created_at', '>=', $request->date_from);
        }

        if ($request->filled('date_to')) {
            $query->whereDate('created_at', '<=', $request->date_to);
        }

        $activityLogs = $query->latest()->paginate(20);
        $employees = User::employees()->select('id', 'name')->get();

        $actionTypes = EmployeeActivityLog::distinct('action_type')->pluck('action_type');
        $modelTypes = EmployeeActivityLog::distinct('model_type')->pluck('model_type');

        return view('admin.employee-monitoring.activity-logs', compact(
            'activityLogs',
            'employees',
            'actionTypes',
            'modelTypes'
        ));
    }

    /**
     * Display click tracking
     */
    public function clickTracking(Request $request): View
    {
        $this->middleware('permission:' . PermissionEnum::VIEW_EMPLOYEE_CLICK_TRACKING->value);

        $query = EmployeeClickTracking::with('user');

        // Apply filters
        if ($request->filled('employee_id')) {
            $query->where('user_id', $request->employee_id);
        }

        if ($request->filled('page_url')) {
            $query->where('page_url', 'like', '%' . $request->page_url . '%');
        }

        if ($request->filled('element_type')) {
            $query->where('element_type', $request->element_type);
        }

        if ($request->filled('date_from')) {
            $query->whereDate('clicked_at', '>=', $request->date_from);
        }

        if ($request->filled('date_to')) {
            $query->whereDate('clicked_at', '<=', $request->date_to);
        }

        $clickTracking = $query->latest('clicked_at')->paginate(20);
        $employees = User::employees()->select('id', 'name')->get();

        $elementTypes = EmployeeClickTracking::distinct('element_type')->pluck('element_type');
        $pageUrls = EmployeeClickTracking::distinct('page_url')->pluck('page_url');

        return view('admin.employee-monitoring.click-tracking', compact(
            'clickTracking',
            'employees',
            'elementTypes',
            'pageUrls'
        ));
    }

    /**
     * Display screen time reports
     */
    public function screenTime(Request $request): View
    {
        $this->middleware('permission:' . PermissionEnum::VIEW_EMPLOYEE_SCREEN_TIME->value);

        $query = EmployeeActiveScreenTime::with('user');

        // Apply filters
        if ($request->filled('employee_id')) {
            $query->where('user_id', $request->employee_id);
        }

        if ($request->filled('date_from')) {
            $query->whereDate('date', '>=', $request->date_from);
        }

        if ($request->filled('date_to')) {
            $query->whereDate('date', '<=', $request->date_to);
        }

        $screenTime = $query->latest('date')->paginate(20);
        $employees = User::employees()->select('id', 'name')->get();

        // Get summary statistics
        $totalActiveTime = $query->sum('total_seconds');
        $totalIdleTime = $query->sum('idle_seconds');
        $averageProductivity = $query->avg(DB::raw('(total_seconds / (total_seconds + idle_seconds)) * 100'));

        return view('admin.employee-monitoring.screen-time', compact(
            'screenTime',
            'employees',
            'totalActiveTime',
            'totalIdleTime',
            'averageProductivity'
        ));
    }


    /**
     * Get monitoring statistics for dashboard
     */
    public function getStatistics(Request $request): JsonResponse
    {
        $this->middleware('permission:' . PermissionEnum::VIEW_EMPLOYEE_MONITORING->value);

        $dateFrom = $request->get('date_from', now()->subDays(7));
        $dateTo = $request->get('date_to', now());

        $statistics = [
            'login_logs' => EmployeeLoginLog::dateRange($dateFrom, $dateTo)->count(),
            'activity_logs' => EmployeeActivityLog::dateRange($dateFrom, $dateTo)->count(),
            'click_tracking' => EmployeeClickTracking::dateRange($dateFrom, $dateTo)->count(),
            'active_employees' => User::employees()->whereHas('loginLogs', function ($query) use ($dateFrom, $dateTo) {
                $query->dateRange($dateFrom, $dateTo)->where('status', 'active');
            })->count(),
        ];

        return response()->json($statistics);
    }

    /**
     * Get employee activity chart data
     */
    public function getActivityChartData(Request $request): JsonResponse
    {
        $this->middleware('permission:' . PermissionEnum::VIEW_EMPLOYEE_ACTIVITY_LOGS->value);

        $days = $request->get('days', 7);
        $employeeId = $request->get('employee_id');

        $query = EmployeeActivityLog::select(
            DB::raw('DATE(created_at) as date'),
            DB::raw('COUNT(*) as count')
        )->where('created_at', '>=', now()->subDays($days));

        if ($employeeId) {
            $query->where('user_id', $employeeId);
        }

        $data = $query->groupBy('date')
            ->orderBy('date')
            ->get()
            ->pluck('count', 'date');

        return response()->json($data);
    }

    /**
     * Get screen time chart data
     */
    public function getScreenTimeChartData(Request $request): JsonResponse
    {
        $this->middleware('permission:' . PermissionEnum::VIEW_EMPLOYEE_SCREEN_TIME->value);

        $days = $request->get('days', 7);
        $employeeId = $request->get('employee_id');

        $query = EmployeeActiveScreenTime::select(
            'date',
            DB::raw('SUM(total_seconds) as total_seconds'),
            DB::raw('SUM(idle_seconds) as idle_seconds')
        )->where('date', '>=', now()->subDays($days));

        if ($employeeId) {
            $query->where('user_id', $employeeId);
        }

        $data = $query->groupBy('date')
            ->orderBy('date')
            ->get()
            ->map(function ($item) {
                return [
                    'date' => $item->date->format('Y-m-d'),
                    'active_hours' => round($item->total_seconds / 3600, 2),
                    'idle_hours' => round($item->idle_seconds / 3600, 2),
                ];
            });

        return response()->json($data);
    }

}