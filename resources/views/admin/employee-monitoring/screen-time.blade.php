@extends('admin.layouts.master')

@section('title', __('employee_monitoring.employee_screen_time'))

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
                        {{ __('employee_monitoring.employee_screen_time') }}
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
                        <li class="breadcrumb-item text-muted">{{ __('employee_monitoring.screen_time') }}</li>
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

                <!-- Summary Statistics -->
                <div class="row mb-4">
                    <div class="col-md-4">
                        <div class="card border-left-primary shadow h-100 py-2">
                            <div class="card-body">
                                <div class="row no-gutters align-items-center">
                                    <div class="col mr-2">
                                        <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">{{ __('employee_monitoring.total_active_time') }}</div>
                                        <div class="h5 mb-0 font-weight-bold text-gray-800">{{ round($totalActiveTime / 3600, 2) }} {{ __('employee_monitoring.hours') }}</div>
                                    </div>
                                    <div class="col-auto">
                                        <i class="fas fa-clock fa-2x text-gray-300"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card border-left-warning shadow h-100 py-2">
                            <div class="card-body">
                                <div class="row no-gutters align-items-center">
                                    <div class="col mr-2">
                                        <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">{{ __('employee_monitoring.total_idle_time') }}</div>
                                        <div class="h5 mb-0 font-weight-bold text-gray-800">{{ round($totalIdleTime / 3600, 2) }} {{ __('employee_monitoring.hours') }}</div>
                                    </div>
                                    <div class="col-auto">
                                        <i class="fas fa-pause-circle fa-2x text-gray-300"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card border-left-success shadow h-100 py-2">
                            <div class="card-body">
                                <div class="row no-gutters align-items-center">
                                    <div class="col mr-2">
                                        <div class="text-xs font-weight-bold text-success text-uppercase mb-1">{{ __('employee_monitoring.average_productivity') }}</div>
                                        <div class="h5 mb-0 font-weight-bold text-gray-800">{{ round($averageProductivity, 2) }}%</div>
                                    </div>
                                    <div class="col-auto">
                                        <i class="fas fa-chart-line fa-2x text-gray-300"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!--begin::Card-->
                <div class="card">
                    <!--begin::Card header-->
                    <div class="card-header border-0 pt-6">
                        <!--begin::Card title-->
                        <div class="card-title">
                            <!--begin::Search-->
                            <div class="d-flex align-items-center position-relative my-1">
                                <i class="fas fa-search fs-3 position-absolute ms-5"></i>
                                <input type="text" data-kt-screen-time-table-filter="search"
                                       class="form-control form-control-solid w-250px ps-13"
                                       placeholder="{{ __('employee_monitoring.search_screen_time') }}"
                                       value="{{ request('search') }}" />
                            </div>
                            <!--end::Search-->
                        </div>
                        <!--end::Card title-->
                        <!--begin::Card toolbar-->
                        <div class="card-toolbar">
                            <!--begin::Toolbar-->
                            <div class="d-flex justify-content-end" data-kt-screen-time-table-toolbar="base">
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
                                    <div class="px-7 py-5" data-kt-screen-time-table-filter="form">
                                        <!--begin::Input group-->
                                        <div class="mb-10">
                                            <label class="form-label fs-6 fw-semibold">{{ __('employee_monitoring.employee') }}:</label>
                                            <select class="form-select form-select-solid fw-bold" data-kt-select2="true" data-placeholder="{{ __('employee_monitoring.all_employees') }}" data-allow-clear="true" data-kt-screen-time-table-filter="employee_id">
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
                                            <label class="form-label fs-6 fw-semibold">{{ __('employee_monitoring.from_date') }}:</label>
                                            <input type="date" class="form-control form-control-solid" data-kt-screen-time-table-filter="date_from" value="{{ request('date_from') }}" />
                                        </div>
                                        <!--end::Input group-->
                                        <!--begin::Input group-->
                                        <div class="mb-10">
                                            <label class="form-label fs-6 fw-semibold">{{ __('employee_monitoring.to_date') }}:</label>
                                            <input type="date" class="form-control form-control-solid" data-kt-screen-time-table-filter="date_to" value="{{ request('date_to') }}" />
                                        </div>
                                        <!--end::Input group-->
                                        <!--begin::Actions-->
                                        <div class="d-flex justify-content-end">
                                            <button type="reset" class="btn btn-light btn-active-light-primary fw-semibold me-2 px-6" data-kt-menu-dismiss="true" data-kt-screen-time-table-filter="reset">@lang('common.reset')</button>
                                            <button type="submit" class="btn btn-primary fw-semibold px-6" data-kt-menu-dismiss="true" data-kt-screen-time-table-filter="filter">@lang('common.apply')</button>
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
                            <table class="table align-middle table-row-dashed fs-6 gy-5" id="kt_screen_time_table">
                                <thead>
                                <tr class="text-start text-muted fw-bold fs-7 text-uppercase gs-0">
                                    <th class="min-w-150px">@lang('common.employee')</th>
                                    <th class="min-w-100px">{{ __('employee_monitoring.date') }}</th>
                                    <th class="min-w-100px">{{ __('employee_monitoring.session_start') }}</th>
                                    <th class="min-w-100px">{{ __('employee_monitoring.session_end') }}</th>
                                    <th class="min-w-100px">{{ __('employee_monitoring.active_time') }}</th>
                                    <th class="min-w-100px">{{ __('employee_monitoring.idle_time') }}</th>
                                    <th class="min-w-100px">{{ __('employee_monitoring.productivity') }}</th>
                                    <th class="min-w-80px">{{ __('employee_monitoring.clicks') }}</th>
                                    <th class="min-w-80px">{{ __('employee_monitoring.keypresses') }}</th>
                                    <th class="min-w-80px">{{ __('employee_monitoring.scrolls') }}</th>
                                </tr>
                                </thead>
                                <tbody class="text-gray-600 fw-semibold">
                                @forelse($screenTime as $time)
                                    <tr>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                <img src="{{ $time->user->getAvatarUrl() }}" class="rounded-circle me-3" width="40" height="40">
                                                <div class="d-flex flex-column">
                                                    <a href="#" class="text-gray-800 text-hover-primary mb-1 fw-bold">
                                                        {{ $time->user->name }}
                                                    </a>
                                                    <span class="text-muted">{{ $time->user->email }}</span>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="d-flex flex-column">
                                                <span class="text-gray-800 mb-1">{{ $time->date->format('Y-m-d') }}</span>
                                                <span class="text-muted">{{ $time->date->format('l') }}</span>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="d-flex flex-column">
                                                <span class="text-gray-800 mb-1">{{ $time->session_start->format('H:i:s') }}</span>
                                                <span class="text-muted">{{ $time->session_start->diffForHumans() }}</span>
                                            </div>
                                        </td>
                                        <td>
                                            @if($time->session_end)
                                                <div class="d-flex flex-column">
                                                    <span class="text-gray-800 mb-1">{{ $time->session_end->format('H:i:s') }}</span>
                                                    <span class="text-muted">{{ $time->session_end->diffForHumans() }}</span>
                                                </div>
                                            @else
                                                <span class="badge badge-light-success">{{ __('employee_monitoring.active') }}</span>
                                            @endif
                                        </td>
                                        <td>
                                            <div class="d-flex flex-column">
                                                <span class="text-gray-800 mb-1 fw-bold text-success">{{ $time->getFormattedDuration() }}</span>
                                                <span class="text-muted">{{ $time->total_hours }} {{ __('employee_monitoring.hours') }}</span>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="d-flex flex-column">
                                                <span class="text-gray-800 mb-1 text-warning">{{ round($time->idle_seconds / 3600, 2) }}h</span>
                                                <span class="text-muted">{{ $time->idle_hours }} {{ __('employee_monitoring.hours') }}</span>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                <div class="progress me-2" style="width: 60px; height: 8px;">
                                                    <div class="progress-bar bg-{{ $time->productivity_percentage >= 80 ? 'success' : ($time->productivity_percentage >= 60 ? 'warning' : 'danger') }}" 
                                                         style="width: {{ $time->productivity_percentage }}%"></div>
                                                </div>
                                                <span class="fw-bold">{{ $time->productivity_percentage }}%</span>
                                            </div>
                                        </td>
                                        <td>
                                            <span class="badge badge-light-info">{{ number_format($time->click_count) }}</span>
                                        </td>
                                        <td>
                                            <span class="badge badge-secondary">{{ number_format($time->keypress_count) }}</span>
                                        </td>
                                        <td>
                                            <span class="badge badge-light">{{ number_format($time->scroll_count) }}</span>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="10" class="text-center py-10">
                                            <div class="d-flex flex-column align-items-center">
                                                <i class="fas fa-clock fs-3x text-muted mb-4"></i>
                                                <span class="text-muted fs-6">{{ __('employee_monitoring.no_screen_time_data_found') }}</span>
                                            </div>
                                        </td>
                                    </tr>
                                @endforelse
                                </tbody>
                            </table>
                        </div>
                        <!--end::Table-->

                        <!--begin::Pagination-->
                        @if($screenTime->hasPages())
                            <div class="d-flex justify-content-between align-items-center flex-wrap">
                                <div class="d-flex align-items-center py-3">
                                <span class="text-muted">
                                    @lang('common.showing') {{ $screenTime->firstItem() }} @lang('common.to') {{ $screenTime->lastItem() }} @lang('common.of') {{ $screenTime->total() }} @lang('common.results')
                                </span>
                                </div>
                                {{ $screenTime->appends(request()->query())->links('pagination::bootstrap-4') }}
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
        var KTScreenTimeList = function () {
            // Define shared variables
            var table = document.getElementById('kt_screen_time_table');
            var filterForm = document.querySelector('[data-kt-screen-time-table-filter="form"]');

            // Private functions
            var handleSearchDatatable = function () {
                const filterSearch = document.querySelector('[data-kt-screen-time-table-filter="search"]');
                filterSearch.addEventListener('keyup', function (e) {
                    setTimeout(function() {
                        window.location.href = updateUrlParameter(window.location.href, 'search', e.target.value);
                    }, 500);
                });
            }

            var handleFilterDatatable = function () {
                const filterButton = filterForm.querySelector('[data-kt-screen-time-table-filter="filter"]');
                const resetButton = filterForm.querySelector('[data-kt-screen-time-table-filter="reset"]');

                // Filter button event
                filterButton.addEventListener('click', function () {
                    var url = new URL(window.location);

                    // Get all filter values
                    const employeeId = filterForm.querySelector('[data-kt-screen-time-table-filter="employee_id"]').value;
                    const dateFrom = filterForm.querySelector('[data-kt-screen-time-table-filter="date_from"]').value;
                    const dateTo = filterForm.querySelector('[data-kt-screen-time-table-filter="date_to"]').value;

                    // Set URL parameters
                    if (employeeId) {
                        url.searchParams.set('employee_id', employeeId);
                    } else {
                        url.searchParams.delete('employee_id');
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
                const dateFromInput = document.querySelector('[data-kt-screen-time-table-filter="date_from"]');
                const dateToInput = document.querySelector('[data-kt-screen-time-table-filter="date_to"]');
                
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
            KTScreenTimeList.init();
        });
    </script>
@endpush
