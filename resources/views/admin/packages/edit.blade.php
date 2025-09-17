@extends('admin.layouts.master')

@section('title', __('packages.edit_package'))

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
                    {{ __('packages.edit_package') }}
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
                    <li class="breadcrumb-item text-muted">
                        <a href="{{ route('admin.packages.index') }}" class="text-muted text-hover-primary">{{ __('packages.packages') }}</a>
                    </li>
                    <li class="breadcrumb-item">
                        <span class="bullet bg-gray-400 w-5px h-2px"></span>
                    </li>
                    <li class="breadcrumb-item text-muted">{{ __('packages.edit_package') }}</li>
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
            <!--begin::Form-->
            <form id="kt_package_edit_form" class="form" action="{{ route('admin.packages.update', $package) }}" method="POST">
                @csrf
                @method('PUT')
                <!--begin::Card-->
                <div class="card card-flush py-4">
                    <!--begin::Card header-->
                    <div class="card-header">
                        <div class="card-title">
                            <h2>{{ __('packages.edit_package') }}</h2>
                        </div>
                    </div>
                    <!--end::Card header-->
                    <!--begin::Card body-->
                    <div class="card-body pt-0">
                        <div class="row">
                            <!--begin::Input group-->
                            <div class="col-md-6 mb-10 fv-row">
                                <label class="required form-label">{{ __('packages.name') }}</label>
                                <input type="text" name="name" class="form-control mb-2" placeholder="{{ __('packages.placeholders.name') }}" value="{{ old('name', $package->name) }}" />
                                @error('name')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <!--end::Input group-->

                            <!--begin::Input group-->
                            <div class="col-md-6 mb-10 fv-row">
                                <label class="required form-label">{{ __('packages.price') }}</label>
                                <div class="input-group">
                                    <input type="number" name="price" class="form-control" placeholder="{{ __('packages.placeholders.price') }}" value="{{ old('price', $package->price) }}" step="0.01" min="0" />
                                    <span class="input-group-text">{{ __('common.currency') }}</span>
                                </div>
                                <div class="form-text">{{ __('packages.help.price') }}</div>
                                @error('price')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <!--end::Input group-->

                            <!--begin::Input group-->
                            <div class="col-md-6 mb-10 fv-row">
                                <label class="required form-label">{{ __('packages.duration') }}</label>
                                <div class="input-group">
                                    <input type="number" name="duration" class="form-control" placeholder="{{ __('packages.placeholders.duration') }}" value="{{ old('duration', $package->duration) }}" min="1" />
                                    <span class="input-group-text">{{ __('common.months') }}</span>
                                </div>
                                <div class="form-text">{{ __('packages.help.duration') }}</div>
                                @error('duration')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <!--end::Input group-->

                            <!--begin::Input group-->
                            <div class="col-md-6 mb-10 fv-row">
                                <label class="form-label">{{ __('packages.max_employees') }}</label>
                                <input type="number" name="max_employees" class="form-control mb-2" placeholder="{{ __('packages.placeholders.max_employees') }}" value="{{ old('max_employees', $package->max_employees) }}" min="1" />
                                <div class="form-text">{{ __('packages.help.max_employees') }}</div>
                                @error('max_employees')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <!--end::Input group-->

                            <!--begin::Input group-->
                            <div class="col-md-6 mb-10 fv-row">
                                <label class="form-label">{{ __('packages.max_employee_documents') }}</label>
                                <input type="number" name="max_employee_documents" class="form-control mb-2" placeholder="{{ __('packages.placeholders.max_employee_documents') }}" value="{{ old('max_employee_documents', $package->max_employee_documents) }}" min="1" />
                                <div class="form-text">{{ __('packages.help.max_employee_documents') }}</div>
                                @error('max_employee_documents')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <!--end::Input group-->

                            <!--begin::Input group-->
                            <div class="col-md-6 mb-10 fv-row">
                                <label class="form-label">{{ __('packages.max_company_documents') }}</label>
                                <input type="number" name="max_company_documents" class="form-control mb-2" placeholder="{{ __('packages.placeholders.max_company_documents') }}" value="{{ old('max_company_documents', $package->max_company_documents) }}" min="1" />
                                <div class="form-text">{{ __('packages.help.max_company_documents') }}</div>
                                @error('max_company_documents')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <!--end::Input group-->

                            <!--begin::Input group-->
                            <div class="col-12 mb-10 fv-row">
                                <label class="form-label">{{ __('packages.description') }}</label>
                                <textarea name="description" class="form-control mb-2" rows="4" placeholder="{{ __('packages.placeholders.description') }}">{{ old('description', $package->description) }}</textarea>
                                @error('description')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <!--end::Input group-->
                        </div>
                    </div>
                    <!--end::Card body-->
                    <!--begin::Card footer-->
                    <div class="card-footer">
                        <div class="d-flex justify-content-end">
                            <a href="{{ route('admin.packages.index') }}" class="btn btn-light me-5">{{ __('packages.cancel') }}</a>
                            <button id="kt_package_edit_submit" type="submit" class="btn btn-primary">
                                <span class="indicator-label">{{ __('packages.save') }}</span>
                                <span class="indicator-progress">{{ __('common.please_wait') }}...
                                    <span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                            </button>
                        </div>
                    </div>
                    <!--end::Card footer-->
                </div>
                <!--end::Card-->
            </form>
            <!--end::Form-->
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
    var KTPackageEdit = function () {
        // Private functions
        var initValidation = function () {
            // Init form validation rules. For more info check the FormValidation plugin's official documentation:https://formvalidation.io/
            var form = document.getElementById('kt_package_edit_form');
            var validator = FormValidation.formValidation(
                form,
                {
                    fields: {
                        'name': {
                            validators: {
                                notEmpty: {
                                    message: '{{ __('packages.validation.name_required') }}'
                                },
                                stringLength: {
                                    max: 255,
                                    message: '{{ __('packages.validation.name_max') }}'
                                }
                            }
                        },
                        'price': {
                            validators: {
                                notEmpty: {
                                    message: '{{ __('packages.validation.price_required') }}'
                                },
                                numeric: {
                                    message: '{{ __('packages.validation.price_numeric') }}'
                                },
                                greaterThan: {
                                    min: 0,
                                    message: '{{ __('packages.validation.price_min') }}'
                                }
                            }
                        },
                        'duration': {
                            validators: {
                                notEmpty: {
                                    message: '{{ __('packages.validation.duration_required') }}'
                                },
                                integer: {
                                    message: '{{ __('packages.validation.duration_integer') }}'
                                },
                                greaterThan: {
                                    min: 1,
                                    message: '{{ __('packages.validation.duration_min') }}'
                                }
                            }
                        },
                        'max_employees': {
                            validators: {
                                integer: {
                                    message: '{{ __('packages.validation.max_employees_integer') }}'
                                },
                                greaterThan: {
                                    min: 1,
                                    message: '{{ __('packages.validation.max_employees_min') }}'
                                }
                            }
                        },
                        'max_documents': {
                            validators: {
                                integer: {
                                    message: '{{ __('packages.validation.max_documents_integer') }}'
                                },
                                greaterThan: {
                                    min: 1,
                                    message: '{{ __('packages.validation.max_documents_min') }}'
                                }
                            }
                        }
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

            // Submit button handler
            const submitButton = document.getElementById('kt_package_edit_submit');
            submitButton.addEventListener('click', function (e) {
                e.preventDefault();

                if (validator) {
                    validator.validate().then(function (status) {
                        if (status == 'Valid') {
                            submitButton.setAttribute('data-kt-indicator', 'on');
                            submitButton.disabled = true;

                            // Submit form
                            form.submit();
                        }
                    });
                }
            });
        }

        // Public methods
        return {
            init: function () {
                initValidation();
            }
        };
    }();

    // On document ready
    KTUtil.onDOMContentLoaded(function () {
        KTPackageEdit.init();
    });
</script>
@endpush
