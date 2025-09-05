@extends('admin.layouts.master')

@section('title', __('employees.employees_list'))

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
                    @lang('common.employees')
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
                    <li class="breadcrumb-item text-muted">@lang('common.client_management')</li>
                    <li class="breadcrumb-item">
                        <span class="bullet bg-gray-400 w-5px h-2px"></span>
                    </li>
                    <li class="breadcrumb-item text-muted">@lang('common.employees')</li>
                </ul>
                <!--end::Breadcrumb-->
            </div>
            <!--end::Page title-->
            <!--begin::Actions-->
            <div class="d-flex align-items-center gap-2 gap-lg-3">
                <a href="{{ route('admin.companies.index') }}" class="btn btn-sm fw-bold btn-light">
                    <i class="ki-duotone ki-building fs-2"></i>@lang('common.companies')
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
                            <i class="ki-duotone ki-magnifier fs-3 position-absolute ms-5">
                                <span class="path1"></span>
                                <span class="path2"></span>
                            </i>
                            <input type="text" data-kt-employees-table-filter="search"
                                   class="form-control form-control-solid w-250px ps-13"
                                   placeholder="{{ __('employees.search_employees') }}"
                                   value="{{ request('search') }}" />
                        </div>
                        <!--end::Search-->
                    </div>
                    <!--end::Card title-->
                    <!--begin::Card toolbar-->
                    <div class="card-toolbar">
                        <!--begin::Toolbar-->
                        <div class="d-flex justify-content-end" data-kt-employees-table-toolbar="base">
                            <!--begin::Filter-->
                            <button type="button" class="btn btn-light-primary me-3" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">
                                <i class="ki-duotone ki-filter fs-2">
                                    <span class="path1"></span>
                                    <span class="path2"></span>
                                </i>@lang('common.filter')
                            </button>
                            <!--begin::Menu 1-->
                            <div class="menu menu-sub menu-sub-dropdown w-300px w-md-325px" data-kt-menu="true">
                                <!--begin::Header-->
                                <div class="px-7 py-5">
                                    <div class="fs-5 text-dark fw-bold">{{ __('employees.filter_options') }}</div>
                                </div>
                                <!--end::Header-->
                                <!--begin::Separator-->
                                <div class="separator border-gray-200"></div>
                                <!--end::Separator-->
                                <!--begin::Content-->
                                <div class="px-7 py-5" data-kt-employees-table-filter="form">
                                    <!--begin::Input group-->
                                    <div class="mb-10">
                                        <label class="form-label fs-6 fw-semibold">{{ __('employees.company') }}:</label>
                                        <select class="form-select form-select-solid fw-bold" data-kt-select2="true" data-placeholder="{{ __('employees.select_company') }}" data-allow-clear="true" data-kt-employees-table-filter="company_id">
                                            <option></option>
                                            @foreach($companies as $company)
                                                <option value="{{ $company->id }}">{{ $company->company_name_en }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <!--end::Input group-->
                                    <!--begin::Input group-->
                                    <div class="mb-10">
                                        <label class="form-label fs-6 fw-semibold">{{ __('employees.type') }}:</label>
                                        <select class="form-select form-select-solid fw-bold" data-kt-select2="true" data-placeholder="{{ __('employees.select_type') }}" data-allow-clear="true" data-kt-employees-table-filter="type">
                                            <option></option>
                                            <option value="saudi">{{ __('employees.saudi') }}</option>
                                            <option value="expat">{{ __('employees.expat') }}</option>
                                        </select>
                                    </div>
                                    <!--end::Input group-->
                                    <!--begin::Input group-->
                                    <div class="mb-10">
                                        <label class="form-label fs-6 fw-semibold">{{ __('employees.nationality') }}:</label>
                                        <select class="form-select form-select-solid fw-bold" data-kt-select2="true" data-placeholder="{{ __('employees.select_nationality') }}" data-allow-clear="true" data-kt-employees-table-filter="nationality">
                                            <option></option>
                                            @foreach($nationalities as $nationality)
                                                <option value="{{ $nationality }}">{{ $nationality }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <!--end::Input group-->
                                    <!--begin::Input group-->
                                    <div class="mb-10">
                                        <label class="form-label fs-6 fw-semibold">@lang('common.status'):</label>
                                        <select class="form-select form-select-solid fw-bold" data-kt-select2="true" data-placeholder="{{ __('employees.select_status') }}" data-allow-clear="true" data-kt-employees-table-filter="status">
                                            <option></option>
                                            <option value="active">@lang('common.active')</option>
                                            <option value="inactive">@lang('common.inactive')</option>
                                            <option value="terminated">{{ __('employees.terminated') }}</option>
                                            <option value="on_leave">{{ __('employees.on_leave') }}</option>
                                        </select>
                                    </div>
                                    <!--end::Input group-->
                                    <!--begin::Input group-->
                                    <div class="mb-10">
                                        <label class="form-check form-check-sm form-check-custom form-check-solid me-5 me-lg-20">
                                            <input class="form-check-input" type="checkbox" data-kt-employees-table-filter="expiring_soon" value="1" />
                                            <span class="form-check-label text-gray-600 fw-semibold fs-6">{{ __('employees.documents_expiring_soon') }}</span>
                                        </label>
                                    </div>
                                    <!--end::Input group-->
                                    <!--begin::Actions-->
                                    <div class="d-flex justify-content-end">
                                        <button type="reset" class="btn btn-light btn-active-light-primary fw-semibold me-2 px-6" data-kt-menu-dismiss="true" data-kt-employees-table-filter="reset">{{ __('employees.reset') }}</button>
                                        <button type="submit" class="btn btn-primary fw-semibold px-6" data-kt-menu-dismiss="true" data-kt-employees-table-filter="filter">{{ __('employees.apply') }}</button>
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
                        <table class="table align-middle table-row-dashed fs-6 gy-5" id="kt_employees_table">
                            <thead>
                                <tr class="text-start text-muted fw-bold fs-7 text-uppercase gs-0">
                                    <th class="min-w-125px">{{ __('employees.employee') }}</th>
                                    <th class="min-w-125px">{{ __('employees.company') }}</th>
                                    <th class="min-w-100px">{{ __('employees.type') }}</th>
                                    <th class="min-w-125px">{{ __('employees.job_title') }}</th>
                                    <th class="min-w-125px">{{ __('employees.contact') }}</th>
                                    <th class="min-w-100px">@lang('common.documents')</th>
                                    <th class="min-w-100px">@lang('common.status')</th>
                                    <th class="text-end min-w-100px">{{ __('employees.actions') }}</th>
                                </tr>
                            </thead>
                            <tbody class="text-gray-600 fw-semibold">
                                @forelse($employees as $employee)
                                    <tr>
                                        <td>
                                            <div class="d-flex flex-column">
                                                <a href="{{ route('admin.employees.show', $employee) }}" class="text-gray-800 text-hover-primary mb-1">
                                                    {{ $employee->full_name_ar }}
                                                </a>
                                                <span class="text-muted">{{ $employee->full_name_en }}</span>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="d-flex flex-column">
                                                <a href="{{ route('admin.companies.show', $employee->company) }}" class="text-gray-800 text-hover-primary mb-1">
                                                    {{ $employee->company->company_name_en }}
                                                </a>
                                                <span class="text-muted">{{ $employee->company->company_name_ar }}</span>
                                            </div>
                                        </td>
                                        <td>
                                            @if($employee->type === 'saudi')
                                                <span class="badge badge-light-success">{{ __('employees.saudi') }}</span>
                                            @else
                                                <span class="badge badge-light-info">{{ __('employees.expat') }}</span>
                                            @endif
                                        </td>
                                        <td>
                                            <div class="d-flex flex-column">
                                                <span class="text-gray-800 mb-1">{{ $employee->job_title }}</span>
                                                <span class="text-muted">{{ ucfirst($employee->contract_type) }}</span>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="d-flex flex-column">
                                                <span class="text-gray-600 mb-1">
                                                    <i class="ki-duotone ki-phone fs-6 me-2"></i>{{ $employee->primary_mobile }}
                                                </span>
                                                @if($employee->email)
                                                    <span class="text-gray-600">
                                                        <i class="ki-duotone ki-sms fs-6 me-2"></i>{{ $employee->email }}
                                                    </span>
                                                @endif
                                            </div>
                                        </td>
                                        <td>
                                            <div class="d-flex flex-column">
                                                @php
                                                    $totalDocs = $employee->documents->count();
                                                    $expiringDocs = $employee->expiring_soon_documents->count();
                                                @endphp
                                                <span class="badge badge-light-primary mb-1">{{ $totalDocs }} {{ __('employees.total') }}</span>
                                                @if($expiringDocs > 0)
                                                    <span class="badge badge-light-warning">{{ $expiringDocs }} {{ __('employees.expiring') }}</span>
                                                @endif
                                            </div>
                                        </td>
                                        <td>
                                            @switch($employee->status)
                                                @case('active')
                                                    <span class="badge badge-light-success">@lang('common.active')</span>
                                                    @break
                                                @case('inactive')
                                                    <span class="badge badge-light-secondary">@lang('common.inactive')</span>
                                                    @break
                                                @case('terminated')
                                                    <span class="badge badge-light-danger">{{ __('employees.terminated') }}</span>
                                                    @break
                                                @case('on_leave')
                                                    <span class="badge badge-light-warning">{{ __('employees.on_leave') }}</span>
                                                    @break
                                            @endswitch
                                        </td>
                                        <td class="text-end">
                                            <a href="#" class="btn btn-light btn-active-light-primary btn-flex btn-center btn-sm" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">
                                                {{ __('employees.actions') }}
                                                <i class="ki-duotone ki-down fs-5 ms-1"></i>
                                            </a>
                                            <!--begin::Menu-->
                                            <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-600 menu-state-bg-light-primary fw-semibold fs-7 w-125px py-4" data-kt-menu="true">
                                                <!--begin::Menu item-->
                                                <div class="menu-item px-3">
                                                    <a href="{{ route('admin.employees.show', $employee) }}" class="menu-link px-3">{{ __('employees.view') }}</a>
                                                </div>
                                                <!--end::Menu item-->
                                                <!--begin::Menu item-->
                                                <div class="menu-item px-3">
                                                    <a href="{{ route('admin.employees.edit', $employee) }}" class="menu-link px-3">{{ __('employees.edit') }}</a>
                                                </div>
                                                <!--end::Menu item-->
                                                <!--begin::Menu item-->
                                                <div class="menu-item px-3">
                                                    <a href="{{ route('admin.employees.documents.create', $employee) }}" class="menu-link px-3">{{ __('employees.add_document') }}</a>
                                                </div>
                                                <!--end::Menu item-->
                                                <!--begin::Menu item-->
                                                <div class="menu-item px-3">
                                                    <a href="#" class="menu-link px-3" data-kt-employees-table-filter="delete_row" data-employee-id="{{ $employee->id }}">@lang('common.delete')</a>
                                                </div>
                                                <!--end::Menu item-->
                                            </div>
                                            <!--end::Menu-->
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="8" class="text-center py-10">
                                            <div class="d-flex flex-column align-items-center">
                                                <i class="ki-duotone ki-search-list fs-3x text-muted mb-4">
                                                    <span class="path1"></span>
                                                    <span class="path2"></span>
                                                    <span class="path3"></span>
                                                </i>
                                                <span class="text-muted fs-6">{{ __('employees.no_employees_found') }}</span>
                                            </div>
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                    <!--end::Table-->

                    <!--begin::Pagination-->
                    @if($employees->hasPages())
                        <div class="d-flex justify-content-between align-items-center flex-wrap">
                            <div class="d-flex align-items-center py-3">
                                <span class="text-muted">
                                    {{ __('employees.showing') }} {{ $employees->firstItem() }} {{ __('employees.to') }} {{ $employees->lastItem() }} {{ __('employees.of') }} {{ $employees->total() }} {{ __('employees.results') }}
                                </span>
                            </div>
                            {{ $employees->links() }}
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
var KTEmployeesList = function () {
    // Define shared variables
    var table = document.getElementById('kt_employees_table');
    var filterForm = document.querySelector('[data-kt-employees-table-filter="form"]');

    // Private functions
    var handleSearchDatatable = function () {
        const filterSearch = document.querySelector('[data-kt-employees-table-filter="search"]');
        filterSearch.addEventListener('keyup', function (e) {
            setTimeout(function() {
                window.location.href = updateUrlParameter(window.location.href, 'search', e.target.value);
            }, 500);
        });
    }

    var handleFilterDatatable = function () {
        const filterButton = filterForm.querySelector('[data-kt-employees-table-filter="filter"]');
        const resetButton = filterForm.querySelector('[data-kt-employees-table-filter="reset"]');

        // Filter button event
        filterButton.addEventListener('click', function () {
            var url = new URL(window.location);

            // Get all filter values
            const companyId = filterForm.querySelector('[data-kt-employees-table-filter="company_id"]').value;
            const type = filterForm.querySelector('[data-kt-employees-table-filter="type"]').value;
            const nationality = filterForm.querySelector('[data-kt-employees-table-filter="nationality"]').value;
            const status = filterForm.querySelector('[data-kt-employees-table-filter="status"]').value;
            const expiringSoon = filterForm.querySelector('[data-kt-employees-table-filter="expiring_soon"]').checked;

            // Set URL parameters
            if (companyId) {
                url.searchParams.set('company_id', companyId);
            } else {
                url.searchParams.delete('company_id');
            }

            if (type) {
                url.searchParams.set('type', type);
            } else {
                url.searchParams.delete('type');
            }

            if (nationality) {
                url.searchParams.set('nationality', nationality);
            } else {
                url.searchParams.delete('nationality');
            }

            if (status) {
                url.searchParams.set('status', status);
            } else {
                url.searchParams.delete('status');
            }

            if (expiringSoon) {
                url.searchParams.set('expiring_soon', '1');
            } else {
                url.searchParams.delete('expiring_soon');
            }

            window.location.href = url.toString();
        });

        // Reset button event
        resetButton.addEventListener('click', function () {
            var url = new URL(window.location);
            url.searchParams.delete('company_id');
            url.searchParams.delete('type');
            url.searchParams.delete('nationality');
            url.searchParams.delete('status');
            url.searchParams.delete('expiring_soon');
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

    // Public methods
    return {
        init: function () {
            if (!table) {
                return;
            }

            handleSearchDatatable();
            handleFilterDatatable();
        }
    }
}();

// On document ready
KTUtil.onDOMContentLoaded(function () {
    KTEmployeesList.init();
});
</script>
@endpush
