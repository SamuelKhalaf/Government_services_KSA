@extends('admin.layouts.master')

@section('title', __('employee_monitoring.employee_login_logs'))

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
                        {{ __('employee_monitoring.employee_login_logs') }}
                    </h1>
                    <!--end::Title-->
                    <!--begin::Breadcrumb-->
                    <ul class="breadcrumb breadcrumb-separatorless fw-semibold fs-7 my-0 pt-1">
                        <li class="breadcrumb-item text-muted">
                            <a href="{{ route('admin.dashboard') }}" class="text-muted text-hover-primary">@lang('common.dashboard')</a>
                        </li>
                        <li class="breadcrumb-item">
                            <span class="bullet bg-gray-400 w-5px h-2px"></span>
                        </li>
                        <li class="breadcrumb-item text-muted">{{ __('employee_monitoring.employee_monitoring') }}</li>
                        <li class="breadcrumb-item">
                            <span class="bullet bg-gray-400 w-5px h-2px"></span>
                        </li>
                        <li class="breadcrumb-item text-muted">{{ __('employee_monitoring.login_logs') }}</li>
                    </ul>
                    <!--end::Breadcrumb-->
                </div>
                <!--end::Page title-->
                <!--begin::Actions-->
                <div class="d-flex align-items-center gap-2 gap-lg-3">
                    <a href="{{ route('admin.employee-monitoring.index') }}" class="btn btn-sm fw-bold btn-light">
                        <i class="ki-duotone ki-arrow-left fs-2">
                            <span class="path1"></span>
                            <span class="path2"></span>
                        </i>
                        {{ __('employee_monitoring.back_to_dashboard') }}
                    </a>
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

                <!--begin::Card-->
                <div class="card">
                    <!--begin::Card header-->
                    <div class="card-header border-0 pt-6">
                        <!--begin::Card title-->
                        <div class="card-title">
                            <!--begin::Search-->
                            <div class="d-flex align-items-center position-relative my-1">
                                <i class="fas fa-search fs-3 position-absolute ms-5"></i>
                                <input type="text" data-kt-login-logs-table-filter="search"
                                       class="form-control form-control-solid w-250px ps-13"
                                       placeholder="{{ __('employee_monitoring.search_login_logs') }}"
                                       value="{{ request('search') }}" />
                            </div>
                            <!--end::Search-->
                        </div>
                        <!--end::Card title-->
                        <!--begin::Card toolbar-->
                        <div class="card-toolbar">
                            <!--begin::Toolbar-->
                            <div class="d-flex justify-content-end" data-kt-login-logs-table-toolbar="base">
                                <!--begin::Filter-->
                                <button type="button" class="btn btn-light-primary me-3" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">
                                    <i class="fas fa-filter fs-2"></i>@lang('common.filter')
                                </button>
                                <!--begin::Menu 1-->
                                <div class="menu menu-sub menu-sub-dropdown w-300px w-md-325px" data-kt-menu="true">
                                    <!--begin::Header-->
                                    <div class="px-7 py-5">
                                        <div class="fs-5 text-dark fw-bold">{{ __('employee_monitoring.filter_options') }}</div>
                                    </div>
                                    <!--end::Header-->
                                    <!--begin::Separator-->
                                    <div class="separator border-gray-200"></div>
                                    <!--end::Separator-->
                                    <!--begin::Content-->
                                    <div class="px-7 py-5" data-kt-login-logs-table-filter="form">
                                        <!--begin::Input group-->
                                        <div class="mb-10">
                                            <label class="form-label fs-6 fw-semibold">{{ __('employee_monitoring.employee') }}:</label>
                                            <select class="form-select form-select-solid fw-bold" data-kt-select2="true" data-placeholder="{{ __('employee_monitoring.all_employees') }}" data-allow-clear="true" data-kt-login-logs-table-filter="employee_id">
                                                <option></option>
                                                @foreach($employees as $employee)
                                                    <option value="{{ $employee->id }}" {{ request('employee_id') == $employee->id ? 'selected' : '' }}>
                                                        {{ $employee->name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <!--end::Input group-->
                                        <!--begin::Input group-->
                                        <div class="mb-10">
                                            <label class="form-label fs-6 fw-semibold">{{ __('employee_monitoring.status') }}:</label>
                                            <select class="form-select form-select-solid fw-bold" data-kt-select2="true" data-placeholder="{{ __('employee_monitoring.all_status') }}" data-allow-clear="true" data-kt-login-logs-table-filter="status">
                                                <option></option>
                                                <option value="active" {{ request('status') == 'active' ? 'selected' : '' }}>{{ __('employee_monitoring.active') }}</option>
                                                <option value="logged_out" {{ request('status') == 'logged_out' ? 'selected' : '' }}>{{ __('employee_monitoring.logged_out') }}</option>
                                                <option value="expired" {{ request('status') == 'expired' ? 'selected' : '' }}>{{ __('employee_monitoring.expired') }}</option>
                                            </select>
                                        </div>
                                        <!--end::Input group-->
                                        <!--begin::Input group-->
                                        <div class="mb-10">
                                            <label class="form-label fs-6 fw-semibold">{{ __('employee_monitoring.from_date') }}:</label>
                                            <input type="date" class="form-control form-control-solid" data-kt-login-logs-table-filter="date_from" value="{{ request('date_from') }}" />
                                        </div>
                                        <!--end::Input group-->
                                        <!--begin::Input group-->
                                        <div class="mb-10">
                                            <label class="form-label fs-6 fw-semibold">{{ __('employee_monitoring.to_date') }}:</label>
                                            <input type="date" class="form-control form-control-solid" data-kt-login-logs-table-filter="date_to" value="{{ request('date_to') }}" />
                                        </div>
                                        <!--end::Input group-->
                                        <!--begin::Actions-->
                                        <div class="d-flex justify-content-end">
                                            <button type="reset" class="btn btn-light btn-active-light-primary fw-semibold me-2 px-6" data-kt-menu-dismiss="true" data-kt-login-logs-table-filter="reset">@lang('common.reset')</button>
                                            <button type="submit" class="btn btn-primary fw-semibold px-6" data-kt-menu-dismiss="true" data-kt-login-logs-table-filter="filter">@lang('common.apply')</button>
                                        </div>
                                        <!--end::Actions-->
                                    </div>
                                    <!--end::Content-->
                                </div>
                                <!--end::Menu 1-->
                                <!--end::Filter-->
                                
                            </div>
                            <!--end::Toolbar-->
                        </div>
                        <!--end::Card toolbar-->
                    </div>
                    <!--end::Card header-->

                    <!--begin::Card body-->
                    <div class="card-body py-4">
                        <!--begin::Table-->
                        <div class="table-responsive">
                            <table class="table align-middle table-row-dashed fs-6 gy-5" id="kt_login_logs_table">
                                <thead>
                                <tr class="text-start text-muted fw-bold fs-7 text-uppercase gs-0">
                                    <th class="min-w-150px">@lang('common.employee')</th>
                                    <th class="min-w-125px">{{ __('employee_monitoring.login_time') }}</th>
                                    <th class="min-w-125px">{{ __('employee_monitoring.logout_time') }}</th>
                                    <th class="min-w-100px">{{ __('employee_monitoring.duration') }}</th>
                                    <th class="min-w-100px">{{ __('employee_monitoring.status') }}</th>
                                    <th class="min-w-100px">{{ __('employee_monitoring.ip_address') }}</th>
                                    <th class="min-w-200px">{{ __('employee_monitoring.user_agent') }}</th>
                                </tr>
                                </thead>
                                <tbody class="text-gray-600 fw-semibold">
                                @forelse($loginLogs as $log)
                                    <tr>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                <img src="{{ $log->user->getAvatarUrl() }}" class="rounded-circle me-3" width="40" height="40">
                                                <div class="d-flex flex-column">
                                                    <a href="#" class="text-gray-800 text-hover-primary mb-1 fw-bold">
                                                        {{ $log->user->name }}
                                                    </a>
                                                    <span class="text-muted">{{ $log->user->email }}</span>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="d-flex flex-column">
                                                <span class="text-gray-800 mb-1">{{ $log->login_at->format('Y-m-d H:i:s') }}</span>
                                                <span class="text-muted">{{ $log->login_at->diffForHumans() }}</span>
                                            </div>
                                        </td>
                                        <td>
                                            @if($log->logout_at)
                                                <div class="d-flex flex-column">
                                                    <span class="text-gray-800 mb-1">{{ $log->logout_at->format('Y-m-d H:i:s') }}</span>
                                                    <span class="text-muted">{{ $log->logout_at->diffForHumans() }}</span>
                                                </div>
                                            @else
                                                <span class="text-muted">-</span>
                                            @endif
                                        </td>
                                        <td>
                                            @if($log->duration_minutes)
                                                <span class="badge badge-light-info">{{ $log->duration_minutes }} {{ __('employee_monitoring.minutes') }}</span>
                                            @elseif($log->isActive())
                                                <span class="badge badge-light-success">{{ __('employee_monitoring.in_progress') }}</span>
                                            @else
                                                <span class="text-muted">-</span>
                                            @endif
                                        </td>
                                        <td>
                                            @switch($log->status)
                                                @case('active')
                                                    <span class="badge badge-light-success">{{ __('employee_monitoring.active') }}</span>
                                                    @break
                                                @case('logged_out')
                                                    <span class="badge badge-light-secondary">{{ __('employee_monitoring.logged_out') }}</span>
                                                    @break
                                                @case('expired')
                                                    <span class="badge badge-light-warning">{{ __('employee_monitoring.expired') }}</span>
                                                    @break
                                            @endswitch
                                        </td>
                                        <td>
                                            <code class="text-gray-800">{{ $log->ip_address }}</code>
                                        </td>
                                        <td>
                                            <span class="text-truncate d-inline-block" style="max-width: 200px;" title="{{ $log->user_agent }}">
                                                {{ $log->user_agent }}
                                            </span>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="7" class="text-center py-10">
                                            <div class="d-flex flex-column align-items-center">
                                                <i class="fas fa-search fs-3x text-muted mb-4"></i>
                                                <span class="text-muted fs-6">{{ __('employee_monitoring.no_login_logs_found') }}</span>
                                            </div>
                                        </td>
                                    </tr>
                                @endforelse
                                </tbody>
                            </table>
                        </div>
                        <!--end::Table-->

                        <!--begin::Pagination-->
                        @if($loginLogs->hasPages())
                            <div class="d-flex justify-content-between align-items-center flex-wrap">
                                <div class="d-flex align-items-center py-3">
                                <span class="text-muted">
                                    @lang('common.showing') {{ $loginLogs->firstItem() }} @lang('common.to') {{ $loginLogs->lastItem() }} @lang('common.of') {{ $loginLogs->total() }} @lang('common.results')
                                </span>
                                </div>
                                {{ $loginLogs->appends(request()->query())->links('pagination::bootstrap-4') }}
                            </div>
                        @endif
                        <!--end::Pagination-->
                    </div>
                    <!--end::Card body-->
                </div>
                <!--end::Card-->
            </div>
            <!--end::Content container-->
        </div>
        <!--end::Content-->
    </div>
    <!--end::Content wrapper-->
@endsection

@push('scripts')
    <script>
        "use strict";

        // Class definition
        var KTLoginLogsList = function () {
            // Define shared variables
            var table = document.getElementById('kt_login_logs_table');
            var filterForm = document.querySelector('[data-kt-login-logs-table-filter="form"]');

            // Private functions
            var handleSearchDatatable = function () {
                const filterSearch = document.querySelector('[data-kt-login-logs-table-filter="search"]');
                filterSearch.addEventListener('keyup', function (e) {
                    setTimeout(function() {
                        window.location.href = updateUrlParameter(window.location.href, 'search', e.target.value);
                    }, 500);
                });
            }

            var handleFilterDatatable = function () {
                const filterButton = filterForm.querySelector('[data-kt-login-logs-table-filter="filter"]');
                const resetButton = filterForm.querySelector('[data-kt-login-logs-table-filter="reset"]');

                // Filter button event
                filterButton.addEventListener('click', function () {
                    var url = new URL(window.location);

                    // Get all filter values
                    const employeeId = filterForm.querySelector('[data-kt-login-logs-table-filter="employee_id"]').value;
                    const status = filterForm.querySelector('[data-kt-login-logs-table-filter="status"]').value;
                    const dateFrom = filterForm.querySelector('[data-kt-login-logs-table-filter="date_from"]').value;
                    const dateTo = filterForm.querySelector('[data-kt-login-logs-table-filter="date_to"]').value;

                    // Set URL parameters
                    if (employeeId) {
                        url.searchParams.set('employee_id', employeeId);
                    } else {
                        url.searchParams.delete('employee_id');
                    }

                    if (status) {
                        url.searchParams.set('status', status);
                    } else {
                        url.searchParams.delete('status');
                    }

                    if (dateFrom) {
                        url.searchParams.set('date_from', dateFrom);
                    } else {
                        url.searchParams.delete('date_from');
                    }

                    if (dateTo) {
                        url.searchParams.set('date_to', dateTo);
                    } else {
                        url.searchParams.delete('date_to');
                    }

                    window.location.href = url.toString();
                });

                // Reset button event
                resetButton.addEventListener('click', function () {
                    var url = new URL(window.location);
                    url.searchParams.delete('employee_id');
                    url.searchParams.delete('status');
                    url.searchParams.delete('date_from');
                    url.searchParams.delete('date_to');
                    window.location.href = url.toString();
                });
            }

            // Helper function to update URL parameters
            function updateUrlParameter(url, param, paramVal) {
                var newAdditionalURL = "";
                var tempArray = url.split("?");
                var baseURL = tempArray[0];
                var additionalURL = tempArray[1];
                var temp = "";
                if (additionalURL) {
                    tempArray = additionalURL.split("&");
                    for (var i = 0; i < tempArray.length; i++) {
                        if (tempArray[i].split('=')[0] != param) {
                            newAdditionalURL += temp + tempArray[i];
                            temp = "&";
                        }
                    }
                }
                if (paramVal) {
                    var rows_txt = temp + "" + param + "=" + paramVal;
                    return baseURL + "?" + newAdditionalURL + rows_txt;
                } else {
                    return baseURL + "?" + newAdditionalURL;
                }
            }

            // Set default date range to last 7 days if no dates are selected
            var setDefaultDateRange = function () {
                const dateFromInput = document.querySelector('[data-kt-login-logs-table-filter="date_from"]');
                const dateToInput = document.querySelector('[data-kt-login-logs-table-filter="date_to"]');
                
                if (dateFromInput && dateToInput && !dateFromInput.value && !dateToInput.value) {
                    const today = new Date();
                    const lastWeek = new Date(today.getTime() - 7 * 24 * 60 * 60 * 1000);
                    
                    dateFromInput.value = lastWeek.toISOString().split('T')[0];
                    dateToInput.value = today.toISOString().split('T')[0];
                }
            }

            // Public methods
            return {
                init: function () {
                    if (!table) {
                        return;
                    }

                    setDefaultDateRange();
                    handleSearchDatatable();
                    handleFilterDatatable();
                }
            }
        }();

        // On document ready
        KTUtil.onDOMContentLoaded(function () {
            KTLoginLogsList.init();
        });
    </script>
@endpush
