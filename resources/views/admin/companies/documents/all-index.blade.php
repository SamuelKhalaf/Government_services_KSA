@extends('admin.layouts.master')

@section('title', __('companies.all_company_documents'))

@section('content')
    <!--begin::Toolbar-->
    <div id="kt_app_toolbar" class="app-toolbar py-3 py-lg-6">
        <!--begin::Toolbar container-->
        <div id="kt_app_toolbar_container" class="app-container container-xxl d-flex flex-stack">
            <!--begin::Page title-->
            <div class="page-title d-flex flex-column justify-content-center flex-wrap me-3">
                <!--begin::Title-->
                <h1 class="page-heading d-flex text-dark fw-bold fs-3 flex-column justify-content-center my-0">
                    {{ __('companies.all_company_documents') }}
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
                    <li class="breadcrumb-item text-muted">{{ __('companies.all_company_documents') }}</li>
                </ul>
                <!--end::Breadcrumb-->
            </div>
            <!--end::Page title-->
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
                        <div class="d-flex align-items-center position-relative my-1">
                            <i class="fa-solid fa-magnifying-glass position-absolute ms-4 fs-3"></i>
                            <input type="text" data-kt-document-table-filter="search" class="form-control form-control-solid w-250px ps-14" placeholder="{{ __('common.search') }}" />
                        </div>
                    </div>
                    <!--begin::Card title-->
                    <!--begin::Card toolbar-->
                    <div class="card-toolbar">
                        <!--begin::Toolbar-->
                        <div class="d-flex justify-content-end" data-kt-document-table-toolbar="base">
                            <!--begin::Filter-->
                            <button type="button" class="btn btn-light-primary me-3" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">
                                <i class="fa-solid fa-filter fs-2"></i>{{ __('common.filter') }}
                            </button>
                            <!--begin::Menu 1-->
                            <div class="menu menu-sub menu-sub-dropdown w-300px w-md-325px" data-kt-menu="true">
                                <!--begin::Header-->
                                <div class="px-7 py-5">
                                    <div class="fs-5 text-gray-900 fw-bold">{{ __('common.filter_options') }}</div>
                                </div>
                                <!--end::Header-->
                                <!--begin::Separator-->
                                <div class="separator border-gray-200"></div>
                                <!--end::Separator-->
                                <!--begin::Content-->
                                <div class="px-7 py-5" data-kt-document-table-filter="form">
                                    <!--begin::Input group-->
                                    <div class="mb-10">
                                        <label class="form-label fs-6 fw-semibold">{{ __('companies.company') }}:</label>
                                        <select class="form-select form-select-solid fw-bold" data-kt-select2="true" data-placeholder="{{ __('common.select_option') }}" data-allow-clear="true" data-kt-document-table-filter="company" data-hide-search="true">
                                            <option></option>
                                            @foreach(\App\Models\Company::all() as $company)
                                                <option value="{{ $company->id }}">{{ app()->getLocale() === 'ar' ? $company->company_name_ar : $company->company_name_en }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <!--end::Input group-->
                                    <!--begin::Input group-->
                                    <div class="mb-10">
                                        <label class="form-label fs-6 fw-semibold">{{ __('documents.status') }}:</label>
                                        <select class="form-select form-select-solid fw-bold" data-kt-select2="true" data-placeholder="{{ __('common.select_option') }}" data-allow-clear="true" data-kt-document-table-filter="status" data-hide-search="true">
                                            <option></option>
                                            <option value="active">{{ __('documents.status_active') }}</option>
                                            <option value="expired">{{ __('documents.status_expired') }}</option>
                                            <option value="cancelled">{{ __('documents.status_cancelled') }}</option>
                                            <option value="pending">{{ __('documents.status_pending') }}</option>
                                        </select>
                                    </div>
                                    <!--end::Input group-->
                                    <!--begin::Actions-->
                                    <div class="d-flex justify-content-end">
                                        <button type="reset" class="btn btn-light btn-active-light-primary fw-semibold me-2 px-6" data-kt-menu-dismiss="true" data-kt-document-table-filter="reset">{{ __('common.reset') }}</button>
                                        <button type="submit" class="btn btn-primary fw-semibold px-6" data-kt-menu-dismiss="true" data-kt-document-table-filter="filter">{{ __('common.apply') }}</button>
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
                    <table class="table align-middle table-row-dashed fs-6 gy-5" id="kt_documents_table">
                        <thead>
                            <tr class="text-start text-muted fw-bold fs-7 text-uppercase gs-0">
                                <th class="min-w-125px">{{ __('companies.company') }}</th>
                                <th class="min-w-125px">{{ __('documents.document_type') }}</th>
                                <th class="min-w-125px">{{ __('documents.document_number') }}</th>
                                <th class="min-w-125px">{{ __('documents.issue_date') }}</th>
                                <th class="min-w-125px">{{ __('documents.expiry_date') }}</th>
                                <th class="min-w-100px">{{ __('documents.status') }}</th>
                                <th class="text-end min-w-100px">{{ __('common.actions') }}</th>
                            </tr>
                        </thead>
                        <tbody class="text-gray-600 fw-semibold">
                            @forelse($documents as $document)
                                <tr>
                                    <td>
                                        <div class="d-flex flex-column">
                                            <a href="{{ route('admin.companies.show', $document->company) }}" class="text-dark text-hover-primary mb-1">
                                                {{ app()->getLocale() === 'ar' ? $document->company->company_name_ar : $document->company->company_name_en }}
                                            </a>
                                            <span class="text-muted fs-7">{{ $document->company->commercial_register_number }}</span>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="d-flex flex-column">
                                            <span class="text-dark fw-bold">
                                                {{ app()->getLocale() === 'ar' ? $document->documentType->name_ar : $document->documentType->name_en }}
                                            </span>
                                            <span class="text-muted fs-7">{{ $document->documentType->code }}</span>
                                        </div>
                                    </td>
                                    <td>
                                        <span class="text-dark fw-bold">
                                            {{ $document->getCustomFieldValue('document_number') ?? __('common.n_a') }}
                                        </span>
                                    </td>
                                    <td>
                                        <span class="text-dark">
                                            {{ $document->getCustomFieldValue('issue_date') ? \Carbon\Carbon::parse($document->getCustomFieldValue('issue_date'))->format('Y-m-d') : __('common.n_a') }}
                                        </span>
                                    </td>
                                    <td>
                                        @if($document->getCustomFieldValue('expiry_date'))
                                            <div class="d-flex flex-column">
                                                <span class="text-gray-800 mb-1">{{ \Carbon\Carbon::parse($document->getCustomFieldValue('expiry_date'))->format('Y-m-d') }}</span>
                                                @if($document->is_expiring_soon)
                                                    <span class="badge badge-light-warning">{{ __('documents.expiring_soon') }}</span>
                                                @elseif($document->is_expired)
                                                    <span class="badge badge-light-danger">{{ __('documents.expired') }}</span>
                                                @endif
                                            </div>
                                        @else
                                            <span class="text-muted">@lang('common.n_a')</span>
                                        @endif
                                    </td>
                                    <td>
                                        @switch($document->status)
                                            @case('active')
                                                <span class="badge badge-light-success">{{ __('documents.status_active') }}</span>
                                                @break
                                            @case('expired')
                                                <span class="badge badge-light-danger">{{ __('documents.status_expired') }}</span>
                                                @break
                                            @case('cancelled')
                                                <span class="badge badge-light-secondary">{{ __('documents.status_cancelled') }}</span>
                                                @break
                                            @case('pending')
                                                <span class="badge badge-light-warning">{{ __('documents.status_pending') }}</span>
                                                @break
                                            @default
                                                <span class="badge badge-light-secondary">{{ $document->status }}</span>
                                        @endswitch
                                    </td>
                                    <td class="text-end">
                                        <a href="#" class="btn btn-light btn-active-light-primary btn-flex btn-center btn-sm" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">
                                            {{ __('common.actions') }}
                                            <i class="fa-solid fa-down fs-5 ms-1"></i>
                                        </a>
                                        <!--begin::Menu-->
                                        <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-600 menu-state-bg-light-primary fw-semibold fs-7 w-125px py-4" data-kt-menu="true">
                                            <!--begin::Menu item-->
                                            <div class="menu-item px-3">
                                                <a href="{{ route('admin.companies.documents.show', [$document->company, $document]) }}" class="menu-link px-3">{{ __('common.view') }}</a>
                                            </div>
                                            <!--end::Menu item-->
                                            @if(auth()->user()->can(\App\Enums\PermissionEnum::UPDATE_COMPANY_DOCUMENTS->value))
                                            <!--begin::Menu item-->
                                            <div class="menu-item px-3">
                                                <a href="{{ route('admin.companies.documents.edit', [$document->company, $document]) }}" class="menu-link px-3">{{ __('common.edit') }}</a>
                                            </div>
                                            <!--end::Menu item-->
                                            @endif
                                            @if($document->hasFile())
                                            <!--begin::Menu item-->
                                            <div class="menu-item px-3">
                                                <a href="{{ route('admin.companies.documents.download', [$document->company, $document]) }}" class="menu-link px-3">{{ __('common.download') }}</a>
                                            </div>
                                            <!--end::Menu item-->
                                            @endif
                                            @if(auth()->user()->can(\App\Enums\PermissionEnum::DELETE_COMPANY_DOCUMENTS->value))
                                            <!--begin::Menu item-->
                                            <div class="menu-item px-3">
                                                <a href="#" class="menu-link px-3 text-danger" data-kt-document-table-filter="delete_row" data-company-id="{{ $document->company_id }}" data-document-id="{{ $document->id }}">{{ __('common.delete') }}</a>
                                            </div>
                                            <!--end::Menu item-->
                                            @endif
                                        </div>
                                        <!--end::Menu-->
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="7" class="text-center py-10">
                                        <div class="d-flex flex-column align-items-center">
                                            <i class="fa-solid fa-file-circle-plus fs-3x text-muted mb-5"></i>
                                            <h3 class="text-muted">{{ __('companies.no_company_documents_found') }}</h3>
                                            <p class="text-muted">{{ __('companies.no_company_documents_description') }}</p>
                                        </div>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                    <!--end::Table-->
                    
                    <!--begin::Pagination-->
                    @if($documents->hasPages())
                        <div class="d-flex flex-stack flex-wrap pt-10">
                            <div class="fs-6 fw-semibold text-gray-700">
                                {{ __('common.showing') }} {{ $documents->firstItem() }} {{ __('common.to') }} {{ $documents->lastItem() }} {{ __('common.of') }} {{ $documents->total() }} {{ __('common.entries') }}
                            </div>
                            <ul class="pagination">
                                {{ $documents->links() }}
                            </ul>
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
@endsection

@push('scripts')
<script>
    "use strict";

    // Class definition
    var KTDocumentsList = function () {
        // Define shared variables
        var table = document.getElementById('kt_documents_table');
        var datatable;
        var filterSearch;

        // Private functions
        var initDocumentsTable = function () {
            // Set date data order
            const tableRows = table.querySelectorAll('tbody tr');

            tableRows.forEach(row => {
                const dateRow = row.querySelectorAll('td');
                const realDate = moment(dateRow[3].innerHTML, "DD MMM YYYY, LT").format();
                dateRow[3].setAttribute('data-order', realDate);
            });

            // Init datatable --- more info on datatables: https://datatables.net/manual/
            datatable = $(table).DataTable({
                "info": false,
                "order": [],
                "pageLength": 10,
                "lengthChange": false,
                "columnDefs": [
                    { "orderable": false, "targets": 6 }, // Disable ordering on column 6 (actions)
                ]
            });
        }

        // Search Datatable --- official docs reference: https://datatables.net/reference/api/search()
        var handleSearchDatatable = function () {
            const filterSearch = document.querySelector('[data-kt-document-table-filter="search"]');
            filterSearch.addEventListener('keyup', function (e) {
                datatable.search(e.target.value).draw();
            });
        }

        // Filter Datatable
        var handleFilterDatatable = function () {
            // Select filter options
            filterSearch = document.querySelector('[data-kt-document-table-filter="search"]');
            const filterForm = document.querySelector('[data-kt-document-table-filter="form"]');
            const filterButton = filterForm.querySelector('[data-kt-document-table-filter="filter"]');
            const selectOptions = filterForm.querySelectorAll('select');

            // Filter datatable on submit
            filterButton.addEventListener('click', function () {
                var filterString = '';

                // Get filter values
                selectOptions.forEach((item, index) => {
                    if (item.value && item.value !== '') {
                        if (index !== 0) {
                            filterString += ' ';
                        }
                        filterString += item.value;
                    }
                });

                // Filter datatable --- official docs reference: https://datatables.net/reference/api/search()
                datatable.search(filterString).draw();
            });
        }

        // Reset Filter
        var handleResetForm = function () {
            // Select reset button
            const resetButton = document.querySelector('[data-kt-document-table-filter="reset"]');

            // Reset datatable
            resetButton.addEventListener('click', function () {
                // Select filter options
                filterSearch.value = '';
                const filterForm = document.querySelector('[data-kt-document-table-filter="form"]');
                const selectOptions = filterForm.querySelectorAll('select');

                // Reset select2 values -- more info: https://select2.org/programmatic-control/add-select-clear-options
                selectOptions.forEach(select => {
                    $(select).val('').trigger('change');
                });

                // Reset datatable --- official docs reference: https://datatables.net/reference/api/search()
                datatable.search('').draw();
            });
        }

        // Delete customer
        var handleDeleteRows = function () {
            // Select all delete buttons
            const deleteButtons = document.querySelectorAll('[data-kt-document-table-filter="delete_row"]');

            deleteButtons.forEach(d => {
                d.addEventListener('click', function (e) {
                    e.preventDefault();

                    // Select parent row
                    const row = d.closest('tr');
                    const companyId = e.currentTarget.getAttribute('data-company-id');
                    const documentId = e.currentTarget.getAttribute('data-document-id');

                    // SweetAlert2 pop up --- official docs reference: https://sweetalert2.github.io/
                    Swal.fire({
                        text: "{{ __('companies.delete_document_warning') }}",
                        icon: "warning",
                        showCancelButton: true,
                        buttonsStyling: false,
                        confirmButtonText: "{{ __('common.yes') }}",
                        cancelButtonText: "{{ __('common.no') }}",
                        customClass: {
                            confirmButton: "btn fw-bold btn-danger",
                            cancelButton: "btn fw-bold btn-active-light-primary"
                        }
                    }).then(function (result) {
                        if (result.value) {
                            // Send delete request
                            fetch(`/admin/companies/${companyId}/documents/${documentId}`, {
                                method: 'DELETE',
                                headers: {
                                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                                    'Content-Type': 'application/json',
                                    'Accept': 'application/json',
                                    'X-Requested-With': 'XMLHttpRequest'
                                },
                            })
                            .then(response => response.json())
                            .then(data => {
                                if (data.success) {
                                    // Remove row from datatable
                                    datatable.row(row).remove().draw();
                                    
                                    // Show success message
                                    Swal.fire({
                                        text: data.message || "{{ __('companies.document_deleted_successfully') }}",
                                        icon: "success",
                                        buttonsStyling: false,
                                        confirmButtonText: "{{ __('common.ok') }}",
                                        customClass: {
                                            confirmButton: "btn fw-bold btn-primary"
                                        }
                                    }).then(() => {
                                        // Reload the page to ensure data is fresh
                                        window.location.reload();
                                    });
                                } else {
                                    // Show error message
                                    Swal.fire({
                                        text: data.message || "{{ __('common.error_occurred') }}",
                                        icon: "error",
                                        buttonsStyling: false,
                                        confirmButtonText: "{{ __('common.ok') }}",
                                        customClass: {
                                            confirmButton: "btn fw-bold btn-primary"
                                        }
                                    });
                                }
                            })
                            .catch(error => {
                                console.error('Error:', error);
                                Swal.fire({
                                    text: "{{ __('common.error_occurred') }}",
                                    icon: "error",
                                    buttonsStyling: false,
                                    confirmButtonText: "{{ __('common.ok') }}",
                                    customClass: {
                                        confirmButton: "btn fw-bold btn-primary"
                                    }
                                });
                            });
                        }
                    });
                });
            });
        }

        // Public methods
        return {
            init: function () {
                initDocumentsTable();
                handleSearchDatatable();
                handleFilterDatatable();
                handleResetForm();
                handleDeleteRows();
            }
        };
    }();

    // On document ready
    KTUtil.onDOMContentLoaded(function () {
        KTDocumentsList.init();
    });
</script>
@endpush
