@extends('admin.layouts.master')

@section('title', __('companies.companies_list'))

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
                    {{ __('common.companies') }}
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
                    <li class="breadcrumb-item text-muted">{{ __('common.client_management') }}</li>
                    <li class="breadcrumb-item">
                        <span class="bullet bg-gray-400 w-5px h-2px"></span>
                    </li>
                    <li class="breadcrumb-item text-muted">{{ __('common.companies') }}</li>
                </ul>
                <!--end::Breadcrumb-->
            </div>
            <!--end::Page title-->
            <!--begin::Actions-->
            <div class="d-flex align-items-center gap-2 gap-lg-3">
                @if(auth()->user()->can(\App\Enums\PermissionEnum::CREATE_CLIENTS->value))
                <a href="{{ route('admin.companies.create') }}" class="btn btn-sm fw-bold btn-primary">
                    <i class="fas fa-plus fs-2"></i>{{ __('common.add_company') }}
                </a>
                @endif
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
            @if(auth()->user()->isEmployee())
            <!--begin::Employee Notice-->
            <div class="alert alert-info d-flex align-items-center p-5 mb-10">
                <i class="fas fa-info-circle fs-2hx text-info me-4"></i>
                <div class="d-flex flex-column">
                    <h4 class="mb-1 text-info">{{ __('companies.assigned_companies_only') }}</h4>
                    <span>{{ __('companies.assigned_companies_message') }}</span>
                </div>
            </div>
            <!--end::Employee Notice-->
            @endif

            <!--begin::Card-->
            <div class="card">
                <!--begin::Card header-->
                <div class="card-header border-0 pt-6">
                    <!--begin::Card title-->
                    <div class="card-title">
                        <!--begin::Search-->
                        <div class="d-flex align-items-center position-relative my-1">
                            <i class="fas fa-search fs-3 position-absolute ms-5"></i>
                            <input type="text" data-kt-companies-table-filter="search"
                                   class="form-control form-control-solid w-250px ps-13"
                                   placeholder="{{ __('companies.search_companies') }}"
                                   value="{{ request('search') }}" />
                        </div>
                        <!--end::Search-->
                    </div>
                    <!--end::Card title-->
                    <!--begin::Card toolbar-->
                    <div class="card-toolbar">
                        <!--begin::Toolbar-->
                        <div class="d-flex justify-content-end" data-kt-companies-table-toolbar="base">
                            <!--begin::Filter-->
                            <button type="button" class="btn btn-light-primary me-3" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">
                                <i class="fas fa-filter fs-2"></i>{{ __('common.filter') }}
                            </button>
                            <!--begin::Menu 1-->
                            <div class="menu menu-sub menu-sub-dropdown w-300px w-md-325px" data-kt-menu="true">
                                <!--begin::Header-->
                                <div class="px-7 py-5">
                                    <div class="fs-5 text-dark fw-bold">{{ __('companies.filter_options') }}</div>
                                </div>
                                <!--end::Header-->
                                <!--begin::Separator-->
                                <div class="separator border-gray-200"></div>
                                <!--end::Separator-->
                                <!--begin::Content-->
                                <div class="px-7 py-5" data-kt-companies-table-filter="form">
                                    <!--begin::Input group-->
                                    <div class="mb-10">
                                        <label class="form-label fs-6 fw-semibold">{{ __('common.status') }}:</label>
                                        <select class="form-select form-select-solid fw-bold" data-kt-select2="true" data-placeholder="{{ __('companies.select_status') }}" data-allow-clear="true" data-kt-companies-table-filter="status">
                                            <option></option>
                                            <option value="active">{{ __('common.active') }}</option>
                                            <option value="inactive">{{ __('common.inactive') }}</option>
                                            <option value="suspended">{{ __('companies.suspended') }}</option>
                                        </select>
                                    </div>
                                    <!--end::Input group-->
                                    <!--begin::Input group-->
                                    <div class="mb-10">
                                        <label class="form-label fs-6 fw-semibold">{{ __('companies.region') }}:</label>
                                        <select class="form-select form-select-solid fw-bold" data-kt-select2="true" data-placeholder="{{ __('companies.select_region') }}" data-allow-clear="true" data-kt-companies-table-filter="region">
                                            <option></option>
                                            @foreach($regions as $region)
                                                <option value="{{ $region }}">{{ $region }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <!--end::Input group-->
                                    <!--begin::Input group-->
                                    <div class="mb-10">
                                        <label class="form-label fs-6 fw-semibold">{{ __('companies.company_type') }}:</label>
                                        <select class="form-select form-select-solid fw-bold" data-kt-select2="true" data-placeholder="{{ __('companies.select_company_type') }}" data-allow-clear="true" data-kt-companies-table-filter="company_type">
                                            <option></option>
                                            @foreach($companyTypes as $type)
                                                <option value="{{ $type }}">{{ $type }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <!--end::Input group-->
                                    <!--begin::Input group-->
                                    <div class="mb-10">
                                        <label class="form-check form-check-sm form-check-custom form-check-solid me-5 me-lg-20">
                                            <input class="form-check-input" type="checkbox" data-kt-companies-table-filter="expiring_soon" value="1" />
                                            <span class="form-check-label text-gray-600 fw-semibold fs-6">{{ __('companies.expiring_documents') }}</span>
                                        </label>
                                    </div>
                                    <!--end::Input group-->
                                    <!--begin::Actions-->
                                    <div class="d-flex justify-content-end">
                                        <button type="reset" class="btn btn-light btn-active-light-primary fw-semibold me-2 px-6" data-kt-menu-dismiss="true" data-kt-companies-table-filter="reset">{{ __('common.reset') }}</button>
                                        <button type="submit" class="btn btn-primary fw-semibold px-6" data-kt-menu-dismiss="true" data-kt-companies-table-filter="filter">{{ __('common.apply') }}</button>
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
                        <table class="table align-middle table-row-dashed fs-6 gy-5" id="kt_companies_table">
                            <thead>
                                <tr class="text-start text-muted fw-bold fs-7 text-uppercase gs-0">
                                    <th class="min-w-125px">{{ __('common.company') }}</th>
                                    <th class="min-w-125px">{{ __('companies.cr_number') }}</th>
                                    <th class="min-w-125px">{{ __('common.contact') }}</th>
                                    <th class="min-w-125px">{{ __('common.location') }}</th>
                                    <th class="min-w-100px">{{ __('common.employees') }}</th>
                                    <th class="min-w-100px">{{ __('common.documents') }}</th>
                                    <th class="min-w-100px">{{ __('common.status') }}</th>
                                    <th class="text-end min-w-100px">{{ __('common.actions') }}</th>
                                </tr>
                            </thead>
                            <tbody class="text-gray-600 fw-semibold">
                                @forelse($companies as $company)
                                    <tr>
                                        <td>
                                            <div class="d-flex flex-column">
                                                <a href="{{ route('admin.companies.show', $company) }}" class="text-gray-800 text-hover-primary mb-1">
                                                    {{ $company->company_name_ar }}
                                                </a>
                                                <span class="text-muted">{{ $company->company_name_en }}</span>
                                            </div>
                                        </td>
                                        <td>
                                            <span class="badge badge-light-info">{{ $company->cr_number }}</span>
                                        </td>
                                        <td>
                                            <div class="d-flex flex-column">
                                                @if($company->phone)
                                                    <span class="text-gray-600 mb-1">
                                                        <i class="fas fa-phone fs-6 me-2"></i>{{ $company->phone }}
                                                    </span>
                                                @endif
                                                @if($company->email)
                                                    <span class="text-gray-600">
                                                        <i class="fas fa-envelope fs-6 me-2"></i>{{ $company->email }}
                                                    </span>
                                                @endif
                                            </div>
                                        </td>
                                        <td>
                                            <div class="d-flex flex-column">
                                                <span class="text-gray-800 mb-1">{{ $company->city }}</span>
                                                <span class="text-muted">{{ $company->region }}</span>
                                            </div>
                                        </td>
                                        <td>
                                            <span class="badge badge-light-primary">{{ $company->employees_count ?? $company->employees->count() }}</span>
                                        </td>
                                        <td>
                                            <div class="d-flex flex-column">
                                                @php
                                                    $totalDocs = $company->total_documents_count;
                                                    $activeDocs = $company->active_documents_count;
                                                    $expiringDocs = $company->expiring_soon_documents_count;
                                                    $expiredDocs = $company->expired_documents_count;
                                                @endphp
                                                <span class="badge badge-light-primary mb-1">{{ $totalDocs }} {{ __('common.total') }}</span>
                                                @if($activeDocs > 0)
                                                    <span class="badge badge-light-success mb-1">{{ $activeDocs }} {{ __('common.active') }}</span>
                                                @endif
                                                @if($expiringDocs > 0)
                                                    <span class="badge badge-light-warning mb-1">{{ $expiringDocs }} {{ __('common.expiring_soon') }}</span>
                                                @endif
                                                @if($expiredDocs > 0)
                                                    <span class="badge badge-light-danger">{{ $expiredDocs }} {{ __('common.expired') }}</span>
                                                @endif
                                            </div>
                                        </td>
                                        <td>
                                            @switch($company->status)
                                                @case('active')
                                                    <span class="badge badge-light-success">{{ __('common.active') }}</span>
                                                    @break
                                                @case('inactive')
                                                    <span class="badge badge-secondary">{{ __('common.inactive') }}</span>
                                                    @break
                                                @case('suspended')
                                                    <span class="badge badge-light-danger">{{ __('companies.suspended') }}</span>
                                                    @break
                                            @endswitch
                                        </td>
                                        <td class="text-end">
                                            <a href="#" class="btn btn-light btn-active-light-primary btn-flex btn-center btn-sm" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">
                                                {{ __('common.actions') }}
                                                <i class="fas fa-chevron-down fs-5 ms-1"></i>
                                            </a>
                                            <!--begin::Menu-->
                                            <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-600 menu-state-bg-light-primary fw-semibold fs-7 w-125px py-4" data-kt-menu="true">
                                                <!--begin::Menu item-->
                                                <div class="menu-item px-3">
                                                    <a href="{{ route('admin.companies.show', $company) }}" class="menu-link px-3">{{ __('companies.view') }}</a>
                                                </div>
                                                <!--end::Menu item-->
                                                @if(auth()->user()->can(\App\Enums\PermissionEnum::UPDATE_CLIENTS->value))
                                                <!--begin::Menu item-->
                                                <div class="menu-item px-3">
                                                    <a href="{{ route('admin.companies.edit', $company) }}" class="menu-link px-3">{{ __('companies.edit') }}</a>
                                                </div>
                                                <!--end::Menu item-->
                                                @endif
                                                @if(auth()->user()->can(\App\Enums\PermissionEnum::UPDATE_CLIENTS->value))
                                                <!--begin::Menu item-->
                                                <div class="menu-item px-3">
                                                    <a href="{{ route('admin.companies.workflow', $company) }}" class="menu-link px-3">{{ __('companies.workflow') }}</a>
                                                </div>
                                                <!--end::Menu item-->
                                                @endif
                                                @if(auth()->user()->can(\App\Enums\PermissionEnum::DELETE_CLIENTS->value))
                                                <!--begin::Menu item-->
                                                <div class="menu-item px-3">
                                                    <a href="#" class="menu-link px-3" data-kt-companies-table-filter="delete_row" data-company-id="{{ $company->id }}">{{ __('common.delete') }}</a>
                                                </div>
                                                <!--end::Menu item-->
                                                @endif
                                            </div>
                                            <!--end::Menu-->
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="8" class="text-center py-10">
                                            <div class="d-flex flex-column align-items-center">
                                                <i class="fas fa-search fs-3x text-muted mb-4"></i>
                                                <span class="text-muted fs-6">{{ __('companies.no_companies_found') }}</span>
                                            </div>
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                    <!--end::Table-->

                    <!--begin::Pagination-->
                    @if($companies->hasPages())
                        <div class="d-flex justify-content-between align-items-center flex-wrap">
                            <div class="d-flex align-items-center py-3">
                                <span class="text-muted">
                                    {{ __('companies.showing') }} {{ $companies->firstItem() }} {{ __('companies.to') }} {{ $companies->lastItem() }} {{ __('companies.of') }} {{ $companies->total() }} {{ __('companies.results') }}
                                </span>
                            </div>
                            {{ $companies->links() }}
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

<!--begin::Modals-->
<!--begin::Modal - Delete Company-->
<div class="modal fade" id="kt_modal_delete_company" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered mw-650px">
        <div class="modal-content">
            <div class="modal-header">
                <h2 class="fw-bold">{{ __('companies.delete_company') }}</h2>
                <div class="btn btn-icon btn-sm btn-active-icon-primary" data-kt-companies-modal-action="close">
                    <i class="fas fa-times fs-1"></i>
                </div>
            </div>
            <div class="modal-body scroll-y mx-5 mx-xl-15 my-7">
                <form id="kt_modal_delete_company_form" class="form" action="" method="POST">
                    @csrf
                    @method('DELETE')
                    <div class="fv-row mb-7">
                        <div class="notice d-flex bg-light-warning rounded border-warning border border-dashed p-6">
                            <i class="fas fa-info-circle fs-2tx text-warning me-4"></i>
                            <div class="d-flex flex-stack flex-grow-1">
                                <div class="fw-semibold">
                                    <h4 class="text-gray-900 fw-bold">{{ __('companies.are_you_sure') }}</h4>
                                    <div class="fs-6 text-gray-700">{{ __('companies.delete_company_warning') }}</div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="text-center pt-15">
                                                                <button type="reset" class="btn btn-light me-3" data-kt-companies-modal-action="cancel">{{ __('common.cancel') }}</button>
                        <button type="submit" class="btn btn-danger" data-kt-companies-modal-action="submit">
                                                                        <span class="indicator-label">{{ __('common.delete') }}</span>
                                            <span class="indicator-progress">{{ __('companies.please_wait') }}
                                <span class="spinner-border spinner-border-sm align-middle ms-2"></span>
                            </span>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!--end::Modal - Delete Company-->
<!--end::Modals-->
@endsection

@push('scripts')
<script>
"use strict";

// Class definition
var KTCompaniesList = function () {
    // Define shared variables
    var table = document.getElementById('kt_companies_table');
    var filterForm = document.querySelector('[data-kt-companies-table-filter="form"]');
    var deleteModal = document.getElementById('kt_modal_delete_company');
    var deleteForm = document.getElementById('kt_modal_delete_company_form');

    // Private functions
    var initDeleteModal = function () {
        if (!deleteModal) return;

        // Handle modal close buttons
        deleteModal.querySelectorAll('[data-kt-companies-modal-action="close"]').forEach(function (element) {
            element.addEventListener('click', function (e) {
                e.preventDefault();
                $('#kt_modal_delete_company').modal('hide');
            });
        });

        deleteModal.querySelectorAll('[data-kt-companies-modal-action="cancel"]').forEach(function (element) {
            element.addEventListener('click', function (e) {
                e.preventDefault();
                $('#kt_modal_delete_company').modal('hide');
            });
        });
    }

    var handleDeleteActions = function () {
        // Select all delete buttons
        const deleteButtons = table.querySelectorAll('[data-kt-companies-table-filter="delete_row"]');

        deleteButtons.forEach(d => {
            // Delete button on click
            d.addEventListener('click', function (e) {
                e.preventDefault();

                // Get company ID from the clicked element
                const companyId = e.currentTarget.dataset.companyId;
                
                // Set form action with the company ID
                deleteForm.action = '{{ route("admin.companies.destroy", ":id") }}'.replace(':id', companyId);

                // Show modal
                $('#kt_modal_delete_company').modal('show');
            })
        });
    }

    var handleSearchDatatable = function () {
        const filterSearch = document.querySelector('[data-kt-companies-table-filter="search"]');
        filterSearch.addEventListener('keyup', function (e) {
            // Implementation depends on if you're using server-side pagination
            // For now, we'll trigger a form submission
            setTimeout(function() {
                window.location.href = updateUrlParameter(window.location.href, 'search', e.target.value);
            }, 500);
        });
    }

    var handleFilterDatatable = function () {
        // Set variables
        const filterButton = filterForm.querySelector('[data-kt-companies-table-filter="filter"]');
        const resetButton = filterForm.querySelector('[data-kt-companies-table-filter="reset"]');
        const statusFilter = filterForm.querySelector('[data-kt-companies-table-filter="status"]');
        const regionFilter = filterForm.querySelector('[data-kt-companies-table-filter="region"]');
        const companyTypeFilter = filterForm.querySelector('[data-kt-companies-table-filter="company_type"]');
        const expiringSoonFilter = filterForm.querySelector('[data-kt-companies-table-filter="expiring_soon"]');

        // Filter button event
        filterButton.addEventListener('click', function () {
            var url = new URL(window.location);

            if (statusFilter.value) {
                url.searchParams.set('status', statusFilter.value);
            } else {
                url.searchParams.delete('status');
            }

            if (regionFilter.value) {
                url.searchParams.set('region', regionFilter.value);
            } else {
                url.searchParams.delete('region');
            }

            if (companyTypeFilter.value) {
                url.searchParams.set('company_type', companyTypeFilter.value);
            } else {
                url.searchParams.delete('company_type');
            }

            if (expiringSoonFilter.checked) {
                url.searchParams.set('expiring_soon', '1');
            } else {
                url.searchParams.delete('expiring_soon');
            }

            window.location.href = url.toString();
        });

        // Reset button event
        resetButton.addEventListener('click', function () {
            var url = new URL(window.location);
            url.searchParams.delete('status');
            url.searchParams.delete('region');
            url.searchParams.delete('company_type');
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

            initDeleteModal();
            handleDeleteActions();
            handleSearchDatatable();
            handleFilterDatatable();
        }
    }
}();

// On document ready
KTUtil.onDOMContentLoaded(function () {
    KTCompaniesList.init();
});
</script>
@endpush
