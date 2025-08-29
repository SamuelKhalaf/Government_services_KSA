@use(\App\Enums\PermissionEnum)
@extends('admin.layouts.master')

@section('title', __('roles.roles_list'))

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
                    <h1 class="page-heading d-flex text-dark fw-bold fs-3 flex-column justify-content-center my-0">{{ __('roles.roles_list') }}</h1>
                    <!--end::Title-->
                    <!--begin::Breadcrumb-->
                    <ul class="breadcrumb breadcrumb-separatorless fw-semibold fs-7 my-0 pt-1">
                        <!--begin::Item-->
                        <li class="breadcrumb-item text-muted">
                            <a href="{{route('admin.dashboard')}}" class="text-muted text-hover-primary">{{ __('roles.breadcrumb_home') }}</a>
                        </li>
                        <!--end::Item-->
                        <!--begin::Item-->
                        <li class="breadcrumb-item">
                            <span class="bullet bg-gray-400 w-5px h-2px"></span>
                        </li>
                        <!--end::Item-->
                        <!--begin::Item-->
                        <li class="breadcrumb-item text-muted">{{ __('roles.breadcrumb_system_management') }}</li>
                        <!--end::Item-->
                        <!--begin::Item-->
                        <li class="breadcrumb-item">
                            <span class="bullet bg-gray-400 w-5px h-2px"></span>
                        </li>
                        <!--end::Item-->
                        <!--begin::Item-->
                        <li class="breadcrumb-item text-muted">{{ __('roles.breadcrumb_roles') }}</li>
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
                <!--begin::Row-->
                <div class="row row-cols-1 row-cols-md-2 row-cols-xl-3 g-5 g-xl-9">
                    @if(!empty($roles) && $roles->count() > 0)
                        @foreach($roles as $role)
                            <!--begin::Col-->
                            <div class="col-md-4">
                                <!--begin::Card-->
                                <div class="card card-flush h-md-100">
                                    <!--begin::Card header-->
                                    <div class="card-header d-flex justify-content-between align-items-center">
                                        <!--begin::Card title-->
                                        <div class="card-title">
                                            <h2>{{ __('roles.' . $role->name) }}</h2>
                                        </div>
                                        <!--end::Card title-->
                                        @if(auth()->user()->hasPermissionTo(PermissionEnum::DELETE_ROLES->value))
                                        <!--begin::Delete button-->
                                        <a href="#" class="btn deleteRoleButton p-2 d-flex align-items-center" data-role-id="{{ $role->id }}">
                                            <i class="bi bi-trash delete-icon fs-5 text-hover-danger" style="color: #ff6666;"></i>
                                        </a>
                                        <!--end::Delete button-->
                                        @endif
                                    </div>
                                    <!--end::Card header-->
                                    <!--begin::Card body-->
                                    <div class="card-body pt-1">
                                        <!--begin::Users-->
                                        <div class="fw-bold text-gray-600 mb-5">{{ __('roles.total_users') }}: {{$role->users_count}}</div>
                                        <!--end::Users-->
                                        <!--begin::Permissions-->
                                        <div class="d-flex flex-column text-gray-600">
                                            @if ($role->permissions->isNotEmpty())
                                                @foreach ($role->permissions->take(5) as $permission)
                                                    <div class="d-flex align-items-center py-2">
                                                        <span class="bullet bg-primary me-3"></span>
                                                        @php
                                                            $permissionEnum = collect(\App\Enums\PermissionEnum::cases())->first(function ($case) use ($permission) {
                                                                return $case->value === $permission->name;
                                                            });
                                                        @endphp
                                                        {{ $permissionEnum ? $permissionEnum->getDisplayName(app()->getLocale()) : $permission->name }}
                                                    </div>
                                                @endforeach

                                                @if ($role->permissions->count() > 5)
                                                    <div class="d-flex align-items-center py-2">
                                                        <span class="bullet bg-primary me-3"></span>
                                                        <em>{{ __('common.and') }} {{ $role->permissions->count() - 5 }} {{ __('common.more') }}...</em>
                                                    </div>
                                                @endif
                                            @else
                                                <div class="text-muted">{{ __('roles.no_permissions_assigned') }}</div>
                                            @endif
                                        </div>
                                        <!--end::Permissions-->
                                    </div>
                                    <!--end::Card body-->
                                    <!--begin::Card footer-->
                                    @if(auth()->user()->hasAnyPermission([PermissionEnum::VIEW_ROLES->value,PermissionEnum::UPDATE_ROLES->value]))
                                    <div class="card-footer flex-wrap pt-0">
                                        @if(auth()->user()->hasPermissionTo(PermissionEnum::VIEW_ROLES->value))
                                            <a href="{{route('admin.roles.show',$role->id)}}" class="btn btn-light btn-active-primary my-1 me-2">
                                                {{ __('roles.view_role') }}
                                            </a>
                                        @endif
                                        @if(auth()->user()->hasPermissionTo(PermissionEnum::UPDATE_ROLES->value))
                                            <button type="button" id="editRoleButton" class="btn btn-light btn-active-light-primary my-1"
                                                    data-role-id="{{ $role->id }}" data-bs-toggle="modal" data-bs-target="#kt_modal_update_role">
                                                {{ __('roles.edit_role') }}
                                            </button>
                                        @endif
                                    </div>
                                    @endif
                                    <!--end::Card footer-->
                                </div>
                                <!--end::Card-->
                            </div>
                            <!--end::Col-->
                        @endforeach
                    @endif
                    <!--begin::Add Role card-->
                        @if(auth()->user()->hasPermissionTo(PermissionEnum::CREATE_ROLES->value))
                            <div class="ol-md-4">
                                <!--begin::Card-->
                                <div class="card h-md-100">
                                    <!--begin::Card body-->
                                    <div class="card-body d-flex flex-center">
                                        <!--begin::Button-->
                                        <button type="button" class="btn btn-clear d-flex flex-column flex-center"
                                                data-bs-toggle="modal" data-bs-target="#kt_modal_add_role">
                                            <!--begin::Illustration-->
                                            <img src="{{asset('assets/media/illustrations/sketchy-1/4.png')}}" alt=""
                                                 class="mw-100 mh-150px mb-7"/>
                                            <!--end::Illustration-->
                                            <!--begin::Label-->
                                            <div class="fw-bold fs-3 text-gray-600 text-hover-primary">{{ __('roles.add_new_role') }}</div>
                                            <!--end::Label-->
                                        </button>
                                        <!--begin::Button-->
                                    </div>
                                    <!--begin::Card body-->
                                </div>
                                <!--begin::Card-->
                            </div>
                        @endif
                    <!--begin::Add Role card-->
                </div>
                <!--end::Row-->
            </div>
            <!--end::Content container-->
        </div>
        <!--end::Content-->
    </div>
    <!--end::Content wrapper-->

    <!--begin::Modals-->
    @if(auth()->user()->hasPermissionTo(PermissionEnum::CREATE_ROLES->value))
        <!--begin::Modal - Add role-->
        @include('admin.roles.modals.create')
        <!--end::Modal - Add role-->
    @endif
    @if(auth()->user()->hasPermissionTo(PermissionEnum::UPDATE_ROLES->value))
        <!--begin::Modal - Update role-->
        @include('admin.roles.modals.edit')
        <!--end::Modal - Update role-->
    @endif
    <!--end::Modals-->

@endsection
@section('scripts')
    @if(auth()->user()->hasPermissionTo(PermissionEnum::CREATE_ROLES->value))
        <script>
            "use strict";

            // Class definition
            var KTUsersAddRole = function () {
                // Shared variables
                const element = document.getElementById('kt_modal_add_role');
                const form = element.querySelector('#kt_modal_add_role_form');
                const modal = new bootstrap.Modal(element);

                // Init add schedule modal
                var initAddRole = () => {

                    // Init form validation rules. For more info check the FormValidation plugin's official documentation:https://formvalidation.io/
                    var validator = FormValidation.formValidation(
                        form,
                        {
                            fields: {
                                'role_name': {
                                    validators: {
                                        notEmpty: {
                                            message: '{{ __('roles.role_name_required') }}'
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
                    const closeButton = element.querySelector('[data-kt-roles-modal-action="close"]');
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
                    const cancelButton = element.querySelector('[data-kt-roles-modal-action="cancel"]');
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
                    const submitButton = element.querySelector('[data-kt-roles-modal-action="submit"]');
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

                                    // Collect form data
                                    let roleName = form.querySelector('[name="role_name"]').value;
                                    let selectedPermissions = [...form.querySelectorAll('input[name="permissions[]"]:checked')].map(el => el.value);

                                    // Send AJAX request using jQuery
                                    $.ajax({
                                        url: form.getAttribute('action'),
                                        method: "POST",
                                        data: {
                                            _token: $("meta[name='csrf-token']").attr("content"),
                                            role_name: roleName,
                                            permissions: selectedPermissions
                                        },
                                        success: function (data) {
                                            submitButton.removeAttribute('data-kt-indicator');
                                            submitButton.disabled = false;

                                            if (data.success) {
                                                                                            Swal.fire({
                                                text: data.message,
                                                icon: "success",
                                                confirmButtonText: "{{ __('common.ok_got_it') }}",
                                                customClass: {
                                                    confirmButton: "btn btn-primary"
                                                }
                                            }).then(() => {
                                                modal.hide();
                                                form.reset();
                                                window.location.reload();
                                            });
                                            } else {
                                                Swal.fire({
                                                    text: "{{ __('roles.error_saving_role') }}",
                                                    icon: "error",
                                                    confirmButtonText: "{{ __('common.ok_got_it') }}",
                                                    customClass: {
                                                        confirmButton: "btn btn-primary"
                                                    }
                                                });
                                            }
                                        },
                                        error: function (xhr, status, error) {
                                            submitButton.removeAttribute('data-kt-indicator');
                                            submitButton.disabled = false;

                                            let errorMessage = "{{ __('common.error_occurred') }}";

                                            if (xhr.responseJSON && xhr.responseJSON.errors) {
                                                errorMessage = Object.values(xhr.responseJSON.errors).join("\n");
                                            }

                                            Swal.fire({
                                                text: errorMessage,
                                                icon: "error",
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

                // Select all handler
                const handleSelectAll = () =>{
                    // Define the parent container (form)
                    const form = document.getElementById('kt_modal_add_role_form');

                    // Check if the form exists
                    if (!form) return;

                    form.addEventListener('change', function(e) {
                        // Handle the "Select All" checkbox change
                        if (e.target && e.target.id === 'kt_roles_select_all') {
                            const selectAllChecked = e.target.checked;
                            const allCheckboxes = form.querySelectorAll('[type="checkbox"]:not(#kt_roles_select_all)'); // Exclude the "Select All" checkbox

                            // Apply the checked state to all checkboxes
                            allCheckboxes.forEach(function(checkbox) {
                                checkbox.checked = selectAllChecked;
                            });
                        }
                        // Handle individual checkbox change
                        else if (e.target && e.target.type === 'checkbox') {
                            const allCheckboxes = form.querySelectorAll('[type="checkbox"]:not(#kt_roles_select_all)');
                            const selectAll = form.querySelector('#kt_roles_select_all');

                            // Check if all checkboxes are checked
                            const allChecked = Array.from(allCheckboxes).every(function(checkbox) {
                                return checkbox.checked;
                            });

                            // Update the "Select All" checkbox state
                            if (selectAll) {
                                selectAll.checked = allChecked;
                            }
                        }
                    });
                }

                return {
                    // Public functions
                    init: function () {
                        initAddRole();
                        handleSelectAll();
                    }
                };
            }();

            // On document ready
            KTUtil.onDOMContentLoaded(function () {
                KTUsersAddRole.init();
            });
        </script>
    @endif
    @if(auth()->user()->hasPermissionTo(PermissionEnum::UPDATE_ROLES->value))
        <!-- Fetch data to the Edit Modal role -->
        <script>
            $(document).on('click', '#editRoleButton', function (e) {
                e.preventDefault();

                let roleId = $(this).data('role-id');

                // Send AJAX request to fetch role data
                $.ajax({
                    url: '/roles/' + roleId + '/edit', // Make the request to the backend to fetch the role and its permissions
                    method: 'GET',
                    success: function(response) {
                        if (response.success) {

                            document.querySelector('#role_name').value = response.role.name;
                            document.querySelector('#role_id').value = response.role.id;

                            // Clear previous permissions and show select all section
                            $('#permissions_grid').empty();
                            $('#select_all_section').show();

                            // Build the enhanced permissions structure
                            var formattedPermissions = response.formatted_permissions;
                            var permissionsHtml = '';
                            
                            Object.keys(formattedPermissions).forEach(function(category) {
                                permissionsHtml += `
                                    <!--begin::Permission Category-->
                                    <div class="permission-category mb-6">
                                        <!--begin::Category Header-->
                                        <div class="d-flex align-items-center mb-4">
                                            <div class="symbol symbol-40px {{ app()->getLocale() == 'ar' ? 'ms-3' : 'me-3' }}">
                                                <div class="symbol-label bg-light-info">
                                                    <i class="fas fa-shield-alt text-info fs-4"></i>
                                                </div>
                                            </div>
                                            <h6 class="text-gray-800 fw-bold mb-0">${category}</h6>
                                        </div>
                                        <!--end::Category Header-->
                                        
                                        <!--begin::Permissions Grid-->
                                        <div class="row g-3">`;

                                // Loop through each permission under the category
                                formattedPermissions[category].forEach(function(permission) {
                                    // Check if the permission is assigned
                                    var isChecked = response.assigned_permissions.includes(permission.id) ? 'checked' : '';

                                    permissionsHtml += `
                                            <div class="col-md-6 col-lg-4">
                                                <div class="permission-item p-3 border border-gray-300 rounded bg-light-active-primary hover-elevate-up">
                                                    <label class="form-check form-check-custom form-check-solid w-100 cursor-pointer">
                                        <input class="form-check-input" type="checkbox" name="permissions[]" value="${permission.id}" ${isChecked} />
                                                        <div class="form-check-label w-100">
                                                            <div class="fw-semibold text-gray-800">${permission.name}</div>
                                                        </div>
                                    </label>
                                                </div>
                                            </div>`;
                                });

                                permissionsHtml += `
                                        </div>
                                        <!--end::Permissions Grid-->
                                    </div>
                                    <!--end::Permission Category-->`;
                            });
                            
                            $('#permissions_grid').html(permissionsHtml);

                            // Show the modal
                            $('#kt_modal_update_role').modal('show');

                        } else {
                            Swal.fire({
                                text: "{{ __('common.operation_failed') }}",
                                icon: "error",
                                buttonsStyling: false,
                                confirmButtonText: "{{ __('common.ok') }}",
                                customClass: {
                                    confirmButton: "btn btn-primary"
                                }
                            });
                        }
                    },
                    error: function() {
                        Swal.fire({
                            text: "{{ __('common.error_occurred') }}",
                            icon: "error",
                            buttonsStyling: false,
                            confirmButtonText: "{{ __('common.ok') }}",
                            customClass: {
                                confirmButton: "btn btn-primary"
                            }
                        });
                    }
                });

            });
        </script>
        <script>
            "use strict";

            // Class definition
            var KTUsersUpdatePermissions = function () {
                // Shared variables
                const element = document.getElementById('kt_modal_update_role');
                const form = element.querySelector('#kt_modal_update_role_form');
                const modal = new bootstrap.Modal(element);

                // Init add schedule modal
                var initUpdatePermissions = () => {

                    // Init form validation rules. For more info check the FormValidation plugin's official documentation:https://formvalidation.io/
                    var validator = FormValidation.formValidation(
                        form,
                        {
                            fields: {
                                'role_name': {
                                    validators: {
                                        notEmpty: {
                                            message: '{{ __('roles.role_name_required') }}'
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
                    const closeButton = element.querySelector('[data-kt-roles-modal-action="close"]');
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
                    const cancelButton = element.querySelector('[data-kt-roles-modal-action="cancel"]');
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
                    const submitButton = element.querySelector('[data-kt-roles-modal-action="submit"]');
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

                                    // Collect form data
                                    const roleId = $('#role_id').val();
                                    const roleName = $('#role_name').val();
                                    const permissions = [];
                                    document.querySelectorAll('[name="permissions[]"]:checked').forEach((checkbox) => {
                                        permissions.push(checkbox.value);
                                    });
                                    // Make the AJAX request to update role and permissions
                                    $.ajax({
                                        url: '/roles/' + roleId,
                                        method: 'PUT',
                                        data: {
                                            _token: $('meta[name="csrf-token"]').attr('content'),
                                            role_name: roleName,
                                            permissions: permissions
                                        },
                                        success: function (response) {
                                            // Remove loading indication
                                            submitButton.removeAttribute('data-kt-indicator');

                                            // Enable button
                                            submitButton.disabled = false;

                                            if (response.success) {
                                                // Show success message
                                                Swal.fire({
                                                    text: "{{ __('roles.role_updated_successfully') }}",
                                                    icon: "success",
                                                    buttonsStyling: false,
                                                    confirmButtonText: "{{ __('common.ok_got_it') }}",
                                                    customClass: {
                                                        confirmButton: "btn btn-primary"
                                                    }
                                                }).then(function (result) {
                                                    if (result.isConfirmed) {
                                                        modal.hide();
                                                        form.reset();
                                                        window.location.reload();
                                                    }
                                                });
                                            } else {
                                                // Show error message
                                                Swal.fire({
                                                    text: "{{ __('roles.failed_to_update_role') }}",
                                                    icon: "error",
                                                    buttonsStyling: false,
                                                    confirmButtonText: "{{ __('common.ok_got_it') }}",
                                                    customClass: {
                                                        confirmButton: "btn btn-primary"
                                                    }
                                                });
                                            }
                                        },
                                        error: function () {
                                            // Remove loading indication
                                            submitButton.removeAttribute('data-kt-indicator');

                                            // Enable button
                                            submitButton.disabled = false;

                                            // Show error message
                                            Swal.fire({
                                                text: "{{ __('roles.error_updating_role') }}",
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

                // Select all handler
                const handleSelectAll = () => {
                    // Define the parent container (form)
                    const form = document.getElementById('kt_modal_update_role_form');

                    // Check if the form exists
                    if (!form) return;

                    form.addEventListener('change', function(e) {
                        // Handle the "Select All" checkbox change
                        if (e.target && e.target.id === 'kt_roles_select_all') {
                            const selectAllChecked = e.target.checked;
                            const allCheckboxes = form.querySelectorAll('[type="checkbox"]:not(#kt_roles_select_all)'); // Exclude the "Select All" checkbox

                            // Apply the checked state to all checkboxes
                            allCheckboxes.forEach(function(checkbox) {
                                checkbox.checked = selectAllChecked;
                            });
                        }
                        // Handle individual checkbox change
                        else if (e.target && e.target.type === 'checkbox') {
                            const allCheckboxes = form.querySelectorAll('[type="checkbox"]:not(#kt_roles_select_all)');
                            const selectAll = form.querySelector('#kt_roles_select_all');

                            // Check if all checkboxes are checked
                            const allChecked = Array.from(allCheckboxes).every(function(checkbox) {
                                return checkbox.checked;
                            });

                            // Update the "Select All" checkbox state
                            if (selectAll) {
                                selectAll.checked = allChecked;
                            }
                        }
                    });
                }

                return {
                    // Public functions
                    init: function () {
                        initUpdatePermissions();
                        handleSelectAll();
                    }
                };
            }();

            // On document ready
            KTUtil.onDOMContentLoaded(function () {
                KTUsersUpdatePermissions.init();
            });
        </script>
    @endif
    @if(auth()->user()->hasPermissionTo(PermissionEnum::DELETE_ROLES->value))
        <!-- Handle Delete Role -->
        <script>
            $(document).on('click', '.deleteRoleButton', function (e) {
                e.preventDefault();

                let roleId = $(this).data('role-id');

                Swal.fire({
                    title: "{{ __('roles.delete_confirmation') }}",
                    text: "{{ __('roles.delete_confirmation_text') }}",
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonText: "{{ __('roles.soft_delete') }}",
                    cancelButtonText: "{{ __('roles.no_cancel') }}",
                    showDenyButton: true,
                    denyButtonText: "{{ __('roles.force_delete') }}",
                    customClass: {
                        confirmButton: "btn btn-danger",
                        cancelButton: "btn btn-secondary",
                        denyButton: "btn btn-warning"
                    }
                }).then((result) => {
                    if (result.isConfirmed || result.isDenied) {
                        let forceDelete = result.isDenied ? 1 : 0;

                        // Send AJAX request to delete role
                        $.ajax({
                            url: '/roles/' + roleId,
                            method: 'DELETE',
                            data: {
                                _token: $('meta[name="csrf-token"]').attr('content'),
                                force: forceDelete
                            },
                            success: function(response) {
                                if (response.success) {
                                    Swal.fire({
                                        text: "{{ __('roles.role_deleted') }}",
                                        icon: "success",
                                        buttonsStyling: false,
                                        confirmButtonText: "{{ __('common.ok') }}",
                                        customClass: {
                                            confirmButton: "btn btn-primary"
                                        }
                                    }).then(() => {
                                        location.reload();
                                    });
                                } else {
                                    Swal.fire({
                                        text: response.message,
                                        icon: "error",
                                        buttonsStyling: false,
                                        confirmButtonText: "{{ __('common.ok') }}",
                                        customClass: {
                                            confirmButton: "btn btn-primary"
                                        }
                                    });
                                }
                            },
                            error: function(xhr) {
                                Swal.fire({
                                    text: xhr.responseJSON?.message || "{{ __('common.error_occurred') }}",
                                    icon: "error",
                                    buttonsStyling: false,
                                    confirmButtonText: "{{ __('common.ok') }}",
                                    customClass: {
                                        confirmButton: "btn btn-primary"
                                    }
                                });
                            }
                        });
                    }
                });
            });
        </script>
    @endif
@endsection
