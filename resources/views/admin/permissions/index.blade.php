@use(\App\Enums\PermissionEnum)
@extends('admin.layouts.master')

@section('title', __('permissions.permissions_list'))

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
                    <h1 class="page-heading d-flex text-dark fw-bold fs-3 flex-column justify-content-center my-0">{{ __('permissions.permissions_list') }}</h1>
                    <!--end::Title-->
                    <!--begin::Breadcrumb-->
                    <ul class="breadcrumb breadcrumb-separatorless fw-semibold fs-7 my-0 pt-1">
                        <!--begin::Item-->
                        <li class="breadcrumb-item text-muted">
                            <a href="{{route('admin.dashboard')}}" class="text-muted text-hover-primary">{{ __('permissions.breadcrumb_home') }}</a>
                        </li>
                        <!--end::Item-->
                        <!--begin::Item-->
                        <li class="breadcrumb-item">
                            <span class="bullet bg-gray-400 w-5px h-2px"></span>
                        </li>
                        <!--end::Item-->
                        <!--begin::Item-->
                        <li class="breadcrumb-item text-muted">{{ __('permissions.breadcrumb_user_management') }}</li>
                        <!--end::Item-->
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
                <div class="card card-flush">
                    <!--begin::Card header-->
                    <div class="card-header mt-6">
                        <!--begin::Card title-->
                        <div class="card-title">
                            <!--begin::Search-->
                            <div class="d-flex align-items-center position-relative my-1 me-5">
                                <!--begin::Svg Icon | path: icons/duotune/general/gen021.svg-->
                                <span class="svg-icon svg-icon-1 position-absolute ms-6">
                                    <i class="fa-solid fa-magnifying-glass"></i>
                                </span>
                                <!--end::Svg Icon-->
                                <input type="text" data-kt-permissions-table-filter="search" class="form-control form-control-solid w-250px ps-15" placeholder="{{ __('permissions.search_permissions') }}" />
                            </div>
                            <!--end::Search-->
                        </div>
                        <!--end::Card title-->
                        <!--begin::Card toolbar-->
                        <div class="card-toolbar">
                            @if(auth()->user()->hasPermissionTo(PermissionEnum::CREATE_PERMISSIONS->value))
                                <!--begin::Button-->
                                <button type="button" class="btn btn-light-primary" data-bs-toggle="modal" data-bs-target="#kt_modal_add_permission">
                                    <!--begin::Svg Icon | path: icons/duotune/general/gen035.svg-->
                                    <span class="svg-icon svg-icon-3">
                                    <i class="fa-solid fa-plus"></i>
                                </span>
                                    <!--end::Svg Icon-->{{ __('permissions.add_permission_button') }}</button>
                                <!--end::Button-->
                            @endif
                        </div>
                        <!--end::Card toolbar-->
                    </div>
                    <!--end::Card header-->
                    <!--begin::Card body-->
                    <div class="card-body pt-0">
                        <!--begin::Table-->
                        <table class="table align-middle table-row-dashed fs-6 gy-5 mb-0" id="kt_permissions_table">
                            <!--begin::Table head-->
                            <thead>
                            <!--begin::Table row-->
                            <tr class="text-start text-gray-400 fw-bold fs-7 text-uppercase gs-0">
                                <th class="w-auto text-start">{{ __('permissions.table_name') }}</th>
                                <th class="w-auto text-start">{{ __('permissions.table_assigned_to') }}</th>
                                <th class="w-auto text-start">{{ __('permissions.table_created_date') }}</th>
                                <th class="w-auto text-start">{{ __('permissions.table_actions') }}</th>
                            </tr>
                            <!--end::Table row-->
                            </thead>
                            <!--end::Table head-->
                            <!--begin::Table body-->
                            <tbody class="fw-semibold text-gray-600">

                            </tbody>
                            <!--end::Table body-->
                        </table>
                        <!--end::Table-->
                    </div>
                    <!--end::Card body-->
                </div>
                <!--end::Card-->
                <!--begin::Modals-->
                @if(auth()->user()->hasPermissionTo(PermissionEnum::CREATE_PERMISSIONS->value))
                    <!--begin::Modal - Add permissions-->
                    @include('admin.permissions.modals.create')
                    <!--end::Modal - Add permissions-->
                @endif
                <!--end::Modals-->
            </div>
            <!--end::Content container-->
        </div>
        <!--end::Content-->
    </div>
    <!--end::Content wrapper-->
@endsection

@section('scripts')
    {{--list and delete--}}
    @if(auth()->user()->hasAnyPermission([PermissionEnum::VIEW_PERMISSIONS->value, PermissionEnum::DELETE_PERMISSIONS->value]))
        <script>
            "use strict";

            // Class definition
            var KTUsersPermissionsList = function () {
                // Shared variables
                var datatable;
                var table;

                // Init add schedule modal
                var initPermissionsList = () => {
                    // Set date data order
                    const tableRows = table.querySelectorAll('tbody tr');

                    tableRows.forEach(row => {
                        const dateRow = row.querySelectorAll('td');
                        const realDate = moment(dateRow[2].innerHTML, 'DD MMM YYYY, hh:mm A').format(); // select date from 2nd column in table
                        dateRow[2].setAttribute('data-order', realDate);
                    });

                    // Init datatable --- more info on datatables: https://datatables.net/manual/
                    datatable = $(table).DataTable({
                        "processing": true,
                        "serverSide": true,
                        "ajax": "/permissions-data",
                        "columns": [
                            { data: 'name', name: 'name', width: '25%' },
                            { data: 'assigned_roles', name: 'assigned_roles', width: '35%' },
                            { data: 'created_at', name: 'created_at', width: '25%'},
                            { data: 'actions', name: 'actions', width: '15%' }
                        ],
                        'order':[],
                        'columnDefs': [
                            { orderable: false, targets: 1 },
                            { orderable: false, targets: 3 },
                            { className: "text-start", targets: [0, 1, 2, 3] }
                        ],
                        "autoWidth": false,
                        "responsive": true
                    });
                }

                // Search Datatable --- official docs reference: https://datatables.net/reference/api/search()
                var handleSearchDatatable = () => {
                    const filterSearch = document.querySelector('[data-kt-permissions-table-filter="search"]');
                    filterSearch.addEventListener('keyup', function (e) {
                        datatable.search(e.target.value).draw();
                    });
                }

                // Delete permission
                var handleDeleteRows = () => {
                    // Use event delegation for dynamically loaded elements
                    $('#kt_permissions_table').on('click', '[data-kt-permissions-table-filter="delete_row"]', function (e) {
                        e.preventDefault();

                        // Select parent row
                        const parent = $(this).closest('tr');
                        const permissionId = $(this).data('id'); // Ensure you pass the ID in the button's data-id attribute
                        const permissionName = parent.find('td:first').text().trim();

                        // SweetAlert2 confirmation
                        Swal.fire({
                            text: "{{ __('permissions.delete_confirmation_detailed') }}".replace(':name', permissionName),
                            icon: "warning",
                            showCancelButton: true,
                            buttonsStyling: false,
                            confirmButtonText: "{{ __('common.yes_delete') }}",
                            cancelButtonText: "{{ __('common.cancel') }}",
                            customClass: {
                                confirmButton: "btn fw-bold btn-danger",
                                cancelButton: "btn fw-bold btn-active-light-primary"
                            }
                        }).then(function (result) {
                            if (result.isConfirmed) {
                                $.ajax({
                                    url: "/permissions/" + permissionId,
                                    type: "DELETE",
                                    headers: {
                                        "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content")
                                    },
                                    success: function (response) {
                                        Swal.fire({
                                            text: response.message,
                                            icon: "success",
                                            buttonsStyling: false,
                                            confirmButtonText: "{{ __('common.ok_got_it') }}",
                                            customClass: {
                                                confirmButton: "btn fw-bold btn-primary",
                                            }
                                        }).then(function () {
                                            // Remove row from DataTable
                                            datatable.row(parent).remove().draw();
                                        });
                                    },
                                    error: function (xhr) {
                                        let errorMessage = "{{ __('common.error_occurred') }}";

                                        if (xhr.status === 422 && xhr.responseJSON) {
                                            errorMessage = xhr.responseJSON.message;
                                        } else if (xhr.status === 403) {
                                            errorMessage = "{{ __('common.access_denied') }}";
                                        } else if (xhr.status === 500) {
                                            errorMessage = "{{ __('common.system_error') }}";
                                        }

                                        Swal.fire({
                                            text: errorMessage,
                                            icon: "error",
                                            buttonsStyling: false,
                                            confirmButtonText: "{{ __('common.ok_got_it') }}",
                                            customClass: {
                                                confirmButton: "btn fw-bold btn-primary"
                                            }
                                        });
                                    }
                                });
                            }
                        });
                    });
                };



                return {
                    // Public functions
                    init: function () {
                        table = document.querySelector('#kt_permissions_table');

                        if (!table) {
                            return;
                        }

                        initPermissionsList();
                        handleSearchDatatable();
                        handleDeleteRows();
                    }
                };
            }();

            // On document ready
            KTUtil.onDOMContentLoaded(function () {
                KTUsersPermissionsList.init();
            });
        </script>
    @endif
    {{--  create  --}}
    @if(auth()->user()->hasPermissionTo(PermissionEnum::CREATE_PERMISSIONS->value))
        <script>
            "use strict";

            // Class definition
            var KTUsersAddPermission = function () {
                // Shared variables
                const element = document.getElementById('kt_modal_add_permission');
                const form = element.querySelector('#kt_modal_add_permission_form');
                const modal = new bootstrap.Modal(element);

                // Init add schedule modal
                var initAddPermission = () => {

                    // Init form validation rules. For more info check the FormValidation plugin's official documentation:https://formvalidation.io/
                    var validator = FormValidation.formValidation(
                        form,
                        {
                            fields: {
                                'permission_name': {
                                    validators: {
                                        notEmpty: {
                                            message: '{{ __('permissions.permission_name_required') }}'
                                        }
                                    }
                                },
                            },

                            plugins: {
                                trigger: new FormValidation.plugins.Trigger(),
                                bootstrap: new FormValidation.plugins.Bootstrap5({
                                    rowSelector: '.fv-row',
                                    eleInvalidClass: '',
                                    eleValidClass: ''
                                })
                            }
                        }
                    );

                    // Close button handler
                    const closeButton = element.querySelector('[data-kt-permissions-modal-action="close"]');
                    closeButton.addEventListener('click', e => {
                        e.preventDefault();

                        Swal.fire({
                            text: "{{ __('common.confirm_close') }}",
                            icon: "warning",
                            showCancelButton: true,
                            buttonsStyling: false,
                            confirmButtonText: "{{ __('common.yes_close') }}",
                            cancelButtonText: "{{ __('common.no_return') }}",
                            customClass: {
                                confirmButton: "btn btn-primary",
                                cancelButton: "btn btn-active-light"
                            }
                        }).then(function (result) {
                            if (result.value) {
                                modal.hide(); // Hide modal
                            }
                        });
                    });

                    // Cancel button handler
                    const cancelButton = element.querySelector('[data-kt-permissions-modal-action="cancel"]');
                    cancelButton.addEventListener('click', e => {
                        e.preventDefault();

                        Swal.fire({
                            text: "{{ __('common.confirm_cancel') }}",
                            icon: "warning",
                            showCancelButton: true,
                            buttonsStyling: false,
                            confirmButtonText: "{{ __('common.yes_cancel') }}",
                            cancelButtonText: "{{ __('common.no_return') }}",
                            customClass: {
                                confirmButton: "btn btn-primary",
                                cancelButton: "btn btn-active-light"
                            }
                        }).then(function (result) {
                            if (result.value) {
                                form.reset(); // Reset form
                                modal.hide(); // Hide modal
                            } else if (result.dismiss === 'cancel') {
                                Swal.fire({
                                    text: "{{ __('common.form_not_cancelled') }}",
                                    icon: "error",
                                    buttonsStyling: false,
                                    confirmButtonText: "{{ __('common.ok_got_it') }}",
                                    customClass: {
                                        confirmButton: "btn btn-primary",
                                    }
                                });
                            }
                        });
                    });

                    // Submit button handler
                    const submitButton = element.querySelector('[data-kt-permissions-modal-action="submit"]');
                    submitButton.addEventListener('click', function (e) {
                        // Prevent default button action
                        e.preventDefault();

                        // Validate form before submit
                        if (validator) {
                            validator.validate().then(function (status) {

                                if (status === 'Valid') {
                                    // Show loading indication
                                    submitButton.setAttribute('data-kt-indicator', 'on');

                                    // Disable button to avoid multiple click
                                    submitButton.disabled = true;

                                    // Prepare form data
                                    let formData = new FormData(form);

                                    // AJAX request to add permission
                                    $.ajax({
                                        url: form.getAttribute('action'),
                                        type: "POST",
                                        data: formData,
                                        processData: false,
                                        contentType: false,
                                        success: function (response) {
                                            // Remove loading indication
                                            submitButton.removeAttribute('data-kt-indicator');
                                            submitButton.disabled = false; // Enable button

                                            // Show success message
                                            Swal.fire({
                                                text: response.message,
                                                icon: "success",
                                                buttonsStyling: false,
                                                confirmButtonText: "{{ __('common.ok_got_it') }}",
                                                customClass: {
                                                    confirmButton: "btn btn-primary"
                                                }
                                            }).then(function () {
                                                $("#kt_modal_add_permission").modal("hide");
                                                setTimeout(function () {
                                                    form.reset();
                                                    $('#kt_permissions_table').DataTable().ajax.reload();
                                                }, 100);
                                            });
                                        },
                                        error: function (xhr) {
                                            // Handle error response
                                            submitButton.removeAttribute('data-kt-indicator');
                                            submitButton.disabled = false;

                                            let errorMsg = "{{ __('common.error_occurred') }}";
                                            if (xhr.responseJSON && xhr.responseJSON.message) {
                                                errorMsg = xhr.responseJSON.message;
                                            }

                                            Swal.fire({
                                                text: errorMsg,
                                                icon: "error",
                                                buttonsStyling: false,
                                                confirmButtonText: "{{ __('common.ok_got_it') }}",
                                                customClass: {
                                                    confirmButton: "btn btn-primary"
                                                }
                                            });
                                        }
                                    });
                                } else {
                                    // Show popup warning. For more info check the plugin's official documentation: https://sweetalert2.github.io/
                                    Swal.fire({
                                        text: "{{ __('common.validation_error') }}",
                                        icon: "error",
                                        buttonsStyling: false,
                                        confirmButtonText: "{{ __('common.ok_got_it') }}",
                                        customClass: {
                                            confirmButton: "btn btn-primary"
                                        }
                                    });
                                }
                            });
                        }
                    });
                }

                return {
                    // Public functions
                    init: function () {
                        initAddPermission();
                    }
                };
            }();

            // On document ready
            KTUtil.onDOMContentLoaded(function () {
                KTUsersAddPermission.init();
            });
        </script>
    @endif

@endsection
