@extends('admin.layouts.master')

@section('title', __('employee_monitoring.employee_monitoring_dashboard'))

@section('content')
<!--begin::Content wrapper-->
<div class="d-flex flex-column flex-column-fluid">
    <!--begin::Toolbar-->
    <div id="kt_app_toolbar" class="app-toolbar py-3 py-lg-6">
        <!--begin::Toolbar container-->
        <div id="kt_app_toolbar_container" class="app-container container-xxl d-flex flex-stack">
            <!--begin::Page title-->
            <div class="page-title d-flex flex-column justify-content-center flex-wrap me-3">
                <!--begin::Title-->
                <h1 class="page-heading d-flex text-dark fw-bold fs-3 flex-column justify-content-center my-0">
                    {{ __('employee_monitoring.employee_monitoring_dashboard') }}
                </h1>
                <!--end::Title-->
                <!--begin::Breadcrumb-->
                <ul class="breadcrumb breadcrumb-separatorless fw-semibold fs-7 my-0 pt-1">
                    <li class="breadcrumb-item text-muted">
                        <a href="{{ route('admin.dashboard') }}" class="text-muted text-hover-primary">{{ __('common.dashboard') }}</a>
                    </li>
                    <li class="breadcrumb-item">
                        <span class="bullet bg-gray-400 w-5px h-2px"></span>
                    </li>
                    <li class="breadcrumb-item text-muted">{{ __('employee_monitoring.employee_monitoring') }}</li>
                </ul>
                <!--end::Breadcrumb-->
            </div>
            <!--end::Page title-->
            <!--begin::Actions-->
            <div class="d-flex align-items-center gap-2 gap-lg-3">
                
            </div>
            <!--end::Actions-->
        </div>
        <!--end::Toolbar container-->
    </div>
    <!--end::Toolbar-->

    <!--begin::Content-->
    <div id="kt_app_content" class="app-content flex-column-fluid">
        <!--begin::Content container-->
        <div id="kt_app_content_container" class="app-container container-xxl">

    <!-- Statistics Cards -->
    <div class="row mb-4">
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">{{ __('employee_monitoring.total_employees') }}</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $totalEmployees }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-users fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-success shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">{{ __('employee_monitoring.active_employees') }}</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $activeEmployees }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-user-check fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-info shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-info text-uppercase mb-1">{{ __('employee_monitoring.todays_activities') }}</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $todayActivities }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-chart-line fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>

    <!-- Charts Row -->
    <div class="row mb-4">
        <div class="col-lg-8">
            <div class="card shadow">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">{{ __('employee_monitoring.activity_trends') }}</h6>
                </div>
                <div class="card-body">
                    <canvas id="activityChart" width="400" height="200"></canvas>
                </div>
            </div>
        </div>
        <div class="col-lg-4">
            <div class="card shadow">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">{{ __('employee_monitoring.screen_time_distribution') }}</h6>
                </div>
                <div class="card-body">
                    <canvas id="screenTimeChart" width="400" height="200"></canvas>
                </div>
            </div>
        </div>
    </div>

    <!-- Quick Access Cards -->
    <div class="row mb-4">
        <div class="col-lg-2 col-md-4 col-sm-6 mb-3">
            <div class="card shadow h-100">
                <div class="card-body text-center">
                    <i class="fas fa-sign-in-alt fa-2x text-primary mb-2"></i>
                    <h6 class="card-title">{{ __('employee_monitoring.login_logs') }}</h6>
                    <p class="card-text small">{{ $todayLogins }} {{ __('employee_monitoring.today') }}</p>
                    <a href="{{ route('admin.employee-monitoring.login-logs') }}" class="btn btn-sm btn-primary">{{ __('employee_monitoring.view') }}</a>
                </div>
            </div>
        </div>
        <div class="col-lg-2 col-md-4 col-sm-6 mb-3">
            <div class="card shadow h-100">
                <div class="card-body text-center">
                    <i class="fas fa-history fa-2x text-success mb-2"></i>
                    <h6 class="card-title">{{ __('employee_monitoring.activity_logs') }}</h6>
                    <p class="card-text small">{{ $todayActivities }} {{ __('employee_monitoring.today') }}</p>
                    <a href="{{ route('admin.employee-monitoring.activity-logs') }}" class="btn btn-sm btn-success">{{ __('employee_monitoring.view') }}</a>
                </div>
            </div>
        </div>
        <div class="col-lg-2 col-md-4 col-sm-6 mb-3">
            <div class="card shadow h-100">
                <div class="card-body text-center">
                    <i class="fas fa-mouse-pointer fa-2x text-info mb-2"></i>
                    <h6 class="card-title">{{ __('employee_monitoring.click_tracking_data') }}</h6>
                    <p class="card-text small">{{ $todayClicks }} {{ __('employee_monitoring.today') }}</p>
                    <a href="{{ route('admin.employee-monitoring.click-tracking') }}" class="btn btn-sm btn-info">{{ __('employee_monitoring.view') }}</a>
                </div>
            </div>
        </div>
        <div class="col-lg-2 col-md-4 col-sm-6 mb-3">
            <div class="card shadow h-100">
                <div class="card-body text-center">
                    <i class="fas fa-clock fa-2x text-warning mb-2"></i>
                    <h6 class="card-title">{{ __('employee_monitoring.screen_time') }}</h6>
                    <p class="card-text small">{{ __('employee_monitoring.view_reports') }}</p>
                    <a href="{{ route('admin.employee-monitoring.screen-time') }}" class="btn btn-sm btn-warning">{{ __('employee_monitoring.view') }}</a>
                </div>
            </div>
        </div>
    </div>

    <!-- Recent Activities and Active Sessions -->
    <div class="row">
        <div class="col-lg-8">
            <div class="card shadow">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">{{ __('employee_monitoring.recent_activities') }}</h6>
                    <a href="{{ route('admin.employee-monitoring.activity-logs') }}" class="btn btn-sm btn-primary">{{ __('employee_monitoring.view_all') }}</a>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-sm">
                            <thead>
                                <tr>
                                    <th>{{ __('employee_monitoring.employee') }}</th>
                                    <th>{{ __('employee_monitoring.action') }}</th>
                                    <th>{{ __('employee_monitoring.description') }}</th>
                                    <th>{{ __('employee_monitoring.timestamp') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($recentActivities as $activity)
                                <tr>
                                    <td>{{ $activity->user->name }}</td>
                                    <td>
                                        <span class="badge badge-{{ $activity->action_type === 'create' ? 'success' : ($activity->action_type === 'update' ? 'warning' : ($activity->action_type === 'delete' ? 'danger' : 'info')) }}">
                                            {{ $activity->getActionDisplayName() }}
                                        </span>
                                    </td>
                                    <td>{{ $activity->description }}</td>
                                    <td>{{ $activity->created_at->diffForHumans() }}</td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="4" class="text-center">{{ __('employee_monitoring.no_recent_activities') }}</td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-4">
            <div class="card shadow">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">{{ __('employee_monitoring.active_sessions') }}</h6>
                </div>
                <div class="card-body">
                    @forelse($activeSessions as $session)
                    <div class="d-flex align-items-center mb-3">
                        <div class="flex-shrink-0">
                            <img class="rounded-circle" src="{{ $session->user->getAvatarUrl() }}" width="40" height="40">
                        </div>
                        <div class="flex-grow-1 ms-3">
                            <div class="fw-bold">{{ $session->user->name }}</div>
                            <div class="text-muted small">
                                {{ __('employee_monitoring.logged_in') }} {{ $session->login_at->diffForHumans() }}
                            </div>
                        </div>
                        <div class="flex-shrink-0">
                            <span class="badge badge-success">{{ __('employee_monitoring.active') }}</span>
                        </div>
                    </div>
                    @empty
                    <div class="text-center text-muted">{{ __('employee_monitoring.no_active_sessions') }}</div>
                    @endforelse
                </div>
            </div>
        </div>
        <!--end::Content container-->
    </div>
    <!--end::Content-->
</div>
<!--end::Content wrapper-->
@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
let activityChart, screenTimeChart;

$(document).ready(function() {
    loadCharts();
});

function loadCharts() {
    // Load activity chart
    $.get('{{ route("admin.employee-monitoring.activity-chart") }}', function(data) {
        const ctx = document.getElementById('activityChart').getContext('2d');
        activityChart = new Chart(ctx, {
            type: 'line',
            data: {
                labels: Object.keys(data),
                datasets: [{
                    label: 'Activities',
                    data: Object.values(data),
                    borderColor: 'rgb(75, 192, 192)',
                    backgroundColor: 'rgba(75, 192, 192, 0.2)',
                    tension: 0.1
                }]
            },
            options: {
                responsive: true,
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
    });

    // Load screen time chart
    $.get('{{ route("admin.employee-monitoring.screen-time-chart") }}', function(data) {
        const ctx = document.getElementById('screenTimeChart').getContext('2d');
        screenTimeChart = new Chart(ctx, {
            type: 'doughnut',
            data: {
                labels: ['Active Time', 'Idle Time'],
                datasets: [{
                    data: [data[0]?.active_hours || 0, data[0]?.idle_hours || 0],
                    backgroundColor: ['#28a745', '#dc3545']
                }]
            },
            options: {
                responsive: true
            }
        });
    });
}

function refreshData() {
    location.reload();
}
</script>
@endpush
