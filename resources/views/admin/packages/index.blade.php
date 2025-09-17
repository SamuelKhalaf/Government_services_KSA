@extends('admin.layouts.master')

@section('title', __('packages.packages_management'))

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
                    {{ __('packages.packages') }}
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
                    <li class="breadcrumb-item text-muted">{{ __('common.finance_management') }}</li>
                    <li class="breadcrumb-item">
                        <span class="bullet bg-gray-400 w-5px h-2px"></span>
                    </li>
                    <li class="breadcrumb-item text-muted">{{ __('packages.packages') }}</li>
                </ul>
                <!--end::Breadcrumb-->
            </div>
            <!--end::Page title-->
            <!--begin::Actions-->
            <div class="d-flex align-items-center gap-2 gap-lg-3">
                @if(auth()->user()->can(\App\Enums\PermissionEnum::CREATE_FINANCIAL_PACKAGES->value))
                <a href="{{ route('admin.packages.create') }}" class="btn btn-sm fw-bold btn-primary">
                    <i class="fas fa-plus fs-2"></i>{{ __('packages.create_new_package') }}
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
            <!--begin::Card-->
            <div class="card">
                <!--begin::Card header-->
                <div class="card-header border-0 pt-6">
                    <!--begin::Card title-->
                    <div class="card-title">
                        <!--begin::Search-->
                        <div class="d-flex align-items-center position-relative my-1">
                            <i class="fas fa-search position-absolute ms-4 fs-3"></i>
                            <input type="text" data-kt-packages-table-filter="search" class="form-control form-control-solid w-250px ps-14" placeholder="{{ __('common.search') }}" />
                        </div>
                        <!--end::Search-->
                    </div>
                    <!--begin::Card title-->
                </div>
                <!--end::Card header-->
                <!--begin::Card body-->
                <div class="card-body pt-0">
                    <!--begin::Table-->
                    <table class="table align-middle table-row-dashed fs-6 gy-5" id="kt_packages_table">
                        <thead>
                            <tr class="text-start text-muted fw-bold fs-7 text-uppercase gs-0">
                                <th class="w-10px pe-2">
                                    <div class="form-check form-check-sm form-check-custom form-check-solid me-3">
                                        <input class="form-check-input" type="checkbox" data-kt-check="true" data-kt-check-target="#kt_packages_table .form-check-input" value="1" />
                                    </div>
                                </th>
                                <th class="min-w-125px">{{ __('packages.table.name') }}</th>
                                <th class="min-w-100px">{{ __('packages.table.price') }}</th>
                                <th class="min-w-100px">{{ __('packages.table.duration') }}</th>
                                <th class="min-w-100px">{{ __('packages.table.max_employees') }}</th>
                                <th class="min-w-100px">{{ __('packages.table.max_employee_documents') }}</th>
                                <th class="min-w-100px">{{ __('packages.table.max_company_documents') }}</th>
                                <th class="text-end min-w-100px">{{ __('packages.table.actions') }}</th>
                            </tr>
                        </thead>
                        <tbody class="text-gray-600 fw-semibold">
                            @forelse($packages as $package)
                            <tr>
                                <td>
                                    <div class="form-check form-check-sm form-check-custom form-check-solid">
                                        <input class="form-check-input" type="checkbox" value="{{ $package->id }}" />
                                    </div>
                                </td>
                                <td>
                                    <div class="d-flex flex-column">
                                        <a href="{{ route('admin.packages.show', $package) }}" class="text-gray-800 text-hover-primary mb-1">{{ $package->name }}</a>
                                        @if($package->description)
                                        <span class="text-muted fs-7">{{ Str::limit($package->description, 50) }}</span>
                                        @endif
                                    </div>
                                </td>
                                <td>
                                    <span class="text-gray-800 fw-bold">{{ number_format($package->price, 2) }} {{ __('common.currency') }}</span>
                                </td>
                                <td>
                                    <span class="badge badge-light-primary">{{ $package->duration }} {{ __('common.months') }}</span>
                                </td>
                                <td>
                                    <span class="text-gray-800">{{ $package->max_employees ?? __('common.unlimited') }}</span>
                                </td>
                                <td>
                                    <span class="text-gray-800">{{ $package->max_employee_documents ?? __('common.unlimited') }}</span>
                                </td>
                                <td>
                                    <span class="text-gray-800">{{ $package->max_company_documents ?? __('common.unlimited') }}</span>
                                </td>
                                <td class="text-end">
                                    <a href="#" class="btn btn-light btn-active-light-primary btn-sm" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">
                                        {{ __('common.actions') }}
                                        <i class="fas fa-chevron-down fs-5 ms-1"></i>
                                    </a>
                                    <!--begin::Menu-->
                                    <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-600 menu-state-bg-light-primary fw-semibold fs-7 w-125px py-4" data-kt-menu="true">
                                        @can('view_financial_packages')
                                        <div class="menu-item px-3">
                                            <a href="{{ route('admin.packages.show', $package) }}" class="menu-link px-3">{{ __('packages.view') }}</a>
                                        </div>
                                        @endcan
                                        @can('update_financial_packages')
                                        <div class="menu-item px-3">
                                            <a href="{{ route('admin.packages.edit', $package) }}" class="menu-link px-3">{{ __('packages.edit') }}</a>
                                        </div>
                                        @endcan
                                        @can('delete_financial_packages')
                                        <div class="menu-item px-3">
                                            <a href="#" class="menu-link px-3 text-danger" data-kt-packages-table-filter="delete_row" data-package-id="{{ $package->id }}">{{ __('packages.delete') }}</a>
                                        </div>
                                        @endcan
                                    </div>
                                    <!--end::Menu-->
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="7" class="text-center py-15">
                                    <div class="d-flex flex-column align-items-center justify-content-center">
                                        <i class="fas fa-box-open fs-2x text-gray-400 mb-5"></i>
                                        <div class="text-gray-600 fs-5 fw-semibold">{{ __('packages.messages.no_packages_found') }}</div>
                                    </div>
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                    <!--end::Table-->
                    
                    <!--begin::Pagination-->
                    @if($packages->hasPages())
                    <div class="d-flex flex-stack flex-wrap pt-10">
                        <div class="fs-6 fw-semibold text-gray-700">
                            {{ __('common.showing') }} {{ $packages->firstItem() }} {{ __('common.to') }} {{ $packages->lastItem() }} {{ __('common.of') }} {{ $packages->total() }} {{ __('common.entries') }}
                        </div>
                        <ul class="pagination">
                            {{ $packages->links() }}
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
</div>
<!--end::Content wrapper-->
@endsection

@push('scripts')
<script>
    "use strict";

    // Class definition
    var KTPackagesList = function () {
        // Define shared variables
        var table = document.getElementById('kt_packages_table');
        var datatable;
        var filterSearch;

        // Private functions
        var initPackagesTable = function () {
            // Set date data order
            const tableRows = table.querySelectorAll('tbody tr');

            tableRows.forEach(row => {
                const dateRow = row.querySelectorAll('td');
                const realDate = moment(dateRow[5].innerHTML, "DD MMM YYYY, LT").format();
                dateRow[5].setAttribute('data-order', realDate);
            });

            // Init datatable --- more info on datatables: https://datatables.net/manual/
            datatable = $(table).DataTable({
                "info": false,
                "order": [],
                "pageLength": 10,
                "lengthChange": false,
                "columnDefs": [
                    { orderable: false, targets: 0 }, // Disable ordering on column 0 (checkbox)
                    { orderable: false, targets: 6 }, // Disable ordering on column 6 (actions)
                ]
            });
        }

        // Search Datatable --- official docs reference: https://datatables.net/reference/api/search()
        var handleSearchDatatable = function () {
            const filterSearch = document.querySelector('[data-kt-packages-table-filter="search"]');
            filterSearch.addEventListener('keyup', function (e) {
                datatable.search(e.target.value).draw();
            });
        }


        // Delete customer
        var handleDeleteRows = () => {
            // Select all delete buttons
            const deleteButtons = table.querySelectorAll('[data-kt-packages-table-filter="delete_row"]');

            deleteButtons.forEach(d => {
                d.addEventListener('click', function (e) {
                    e.preventDefault();

                    // Select parent row
                    const row = d.closest('tr');
                    const packageId = d.getAttribute('data-package-id');

                    // SweetAlert2 pop up --- official docs reference: https://sweetalert2.github.io/
                    Swal.fire({
                        text: "{{ __('packages.are_you_sure_delete') }}",
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
                            // Create form and submit
                            const form = document.createElement('form');
                            form.method = 'POST';
                            form.action = "{{ route('admin.packages.destroy', '') }}/" + packageId;
                            
                            // Add CSRF token
                            const csrfToken = document.createElement('input');
                            csrfToken.type = 'hidden';
                            csrfToken.name = '_token';
                            csrfToken.value = '{{ csrf_token() }}';
                            form.appendChild(csrfToken);
                            
                            // Add method override
                            const methodField = document.createElement('input');
                            methodField.type = 'hidden';
                            methodField.name = '_method';
                            methodField.value = 'DELETE';
                            form.appendChild(methodField);
                            
                            document.body.appendChild(form);
                            form.submit();
                        }
                    });
                });
            });
        }

        // Public methods
        return {
            init: function () {
                if (!table) {
                    return;
                }

                initPackagesTable();
                handleSearchDatatable();
                handleDeleteRows();
            }
        };
    }();

    // On document ready
    KTUtil.onDOMContentLoaded(function () {
        KTPackagesList.init();
    });
</script>
@endpush
