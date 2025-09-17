@extends('admin.layouts.master')

@section('title', __('companies.add_branch_registration') . ' - ' . $company->company_name_en)

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
                    {{ __('companies.add_branch_registration') }}
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
                    <li class="breadcrumb-item text-muted">
                        <a href="{{ route('admin.companies.index') }}" class="text-muted text-hover-primary">@lang('common.companies')</a>
                    </li>
                    <li class="breadcrumb-item">
                        <span class="bullet bg-gray-400 w-5px h-2px"></span>
                    </li>
                    <li class="breadcrumb-item text-muted">
                        <a href="{{ route('admin.companies.show', $company) }}" class="text-muted text-hover-primary">{{ $company->company_name_en }}</a>
                    </li>
                    <li class="breadcrumb-item">
                        <span class="bullet bg-gray-400 w-5px h-2px"></span>
                    </li>
                    <li class="breadcrumb-item text-muted">{{ __('companies.add_branch_registration') }}</li>
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
                <div class="card-header">
                    <!--begin::Card title-->
                    <div class="card-title fs-3 fw-bold">{{ __('companies.add_branch_registration_for') }} {{ $company->company_name_en }}</div>
                    <!--end::Card title-->
                </div>
                <!--end::Card header-->

                <!--begin::Form-->
                <form id="kt_branch_form" class="form" action="{{ route('admin.companies.branch-registrations.store', $company) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <!--begin::Card body-->
                    <div class="card-body p-9">
                        <!--begin::Row-->
                        <div class="row mb-8">
                            <!--begin::Col-->
                            <div class="col-xl-3">
                                <div class="fs-6 fw-semibold mt-2 mb-3">{{ __('companies.registration_information') }}</div>
                            </div>
                            <!--end::Col-->
                            <!--begin::Col-->
                            <div class="col-xl-9 fv-row">
                                <!--begin::Row-->
                                <div class="row g-9 mb-8">
                                    <!--begin::Col-->
                                    <div class="col-md-6 fv-row">
                                        <label class="required fs-6 fw-semibold mb-2">{{ __('companies.branch_registration_number') }}</label>
                                        <input type="text" class="form-control form-control-solid @error('branch_reg_number') is-invalid @enderror"
                                               name="branch_reg_number" value="{{ old('branch_reg_number') }}" />
                                        @error('branch_reg_number')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <!--end::Col-->
                                    <!--begin::Col-->
                                    <div class="col-md-6 fv-row">
                                        <label class="required fs-6 fw-semibold mb-2">{{ __('companies.parent_cr_number') }}</label>
                                        <input type="text" class="form-control form-control-solid @error('parent_cr_number') is-invalid @enderror"
                                               name="parent_cr_number" value="{{ old('parent_cr_number') }}"
                                               placeholder="{{ __('companies.main_company_cr_number') }}" />
                                        @error('parent_cr_number')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <!--end::Col-->
                                </div>
                                <!--end::Row-->
                                <!--begin::Row-->
                                <div class="row g-9 mb-8">
                                    <!--begin::Col-->
                                    <div class="col-md-6 fv-row">
                                        <label class="required fs-6 fw-semibold mb-2">{{ __('companies.branch_type') }}</label>
                                        <select class="form-select form-select-solid @error('branch_type') is-invalid @enderror" name="branch_type">
                                            <option value="">{{ __('companies.select_branch_type') }}</option>
                                            <option value="main_branch" @selected(old('branch_type') == 'main_branch')>{{ __('companies.main_branch') }}</option>
                                            <option value="sub_branch" @selected(old('branch_type') == 'sub_branch')>{{ __('companies.sub_branch') }}</option>
                                            <option value="regional_office" @selected(old('branch_type') == 'regional_office')>{{ __('companies.regional_office') }}</option>
                                            <option value="representative_office" @selected(old('branch_type') == 'representative_office')>{{ __('companies.representative_office') }}</option>
                                            <option value="sales_office" @selected(old('branch_type') == 'sales_office')>{{ __('companies.sales_office') }}</option>
                                            <option value="warehouse" @selected(old('branch_type') == 'warehouse')>{{ __('companies.warehouse') }}</option>
                                            <option value="other" @selected(old('branch_type') == 'other')>{{ __('companies.other') }}</option>
                                        </select>
                                        @error('branch_type')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <!--end::Col-->
                                    <!--begin::Col-->
                                    <div class="col-md-6 fv-row">
                                        <label class="required fs-6 fw-semibold mb-2">{{ __('companies.legal_form') }}</label>
                                        <select class="form-select form-select-solid @error('legal_form') is-invalid @enderror" name="legal_form">
                                            <option value="">{{ __('companies.select_legal_form') }}</option>
                                            <option value="LLC" @selected(old('legal_form') == 'LLC')>{{ __('companies.limited_liability_company_llc') }}</option>
                                            <option value="JSC" @selected(old('legal_form') == 'JSC')>{{ __('companies.joint_stock_company_jsc') }}</option>
                                            <option value="Partnership" @selected(old('legal_form') == 'Partnership')>{{ __('companies.partnership') }}</option>
                                            <option value="Sole_Proprietorship" @selected(old('legal_form') == 'Sole_Proprietorship')>{{ __('companies.sole_proprietorship') }}</option>
                                            <option value="Branch_Office" @selected(old('legal_form') == 'Branch_Office')>{{ __('companies.branch_office') }}</option>
                                            <option value="Representative_Office" @selected(old('legal_form') == 'Representative_Office')>{{ __('companies.representative_office') }}</option>
                                        </select>
                                        @error('legal_form')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <!--end::Col-->
                                </div>
                                <!--end::Row-->
                                <!--begin::Row-->
                                <div class="row g-9 mb-8">
                                    <!--begin::Col-->
                                    <div class="col-md-6 fv-row">
                                        <label class="required fs-6 fw-semibold mb-2">{{ __('companies.registration_date') }}</label>
                                        <input type="date" class="form-control form-control-solid @error('registration_date') is-invalid @enderror"
                                               name="registration_date" value="{{ old('registration_date') }}" />
                                        @error('registration_date')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <!--end::Col-->
                                    <!--begin::Col-->
                                    <div class="col-md-6 fv-row">
                                        <label class="required fs-6 fw-semibold mb-2">{{ __('companies.authorized_capital_sar') }}</label>
                                        <input type="number" min="0" step="0.01" class="form-control form-control-solid @error('authorized_capital') is-invalid @enderror"
                                               name="authorized_capital" value="{{ old('authorized_capital') }}" />
                                        @error('authorized_capital')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <!--end::Col-->
                                </div>
                                <!--end::Row-->
                                <!--begin::Row-->
                                <div class="row g-9 mb-8">
                                    <!--begin::Col-->
                                    <div class="col-md-6 fv-row">
                                        <label class="fs-6 fw-semibold mb-2">{{ __('companies.issue_date') }}</label>
                                        <input type="date" class="form-control form-control-solid @error('issue_date') is-invalid @enderror"
                                               name="issue_date" value="{{ old('issue_date') }}" />
                                        @error('issue_date')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <!--end::Col-->
                                    <!--begin::Col-->
                                    <div class="col-md-6 fv-row">
                                        <label class="fs-6 fw-semibold mb-2">{{ __('companies.expiry_date') }}</label>
                                        <input type="date" class="form-control form-control-solid @error('expiry_date') is-invalid @enderror"
                                               name="expiry_date" value="{{ old('expiry_date') }}" />
                                        @error('expiry_date')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <!--end::Col-->
                                </div>
                                <!--end::Row-->
                                <!--begin::Row-->
                                <div class="row g-9 mb-8">
                                    <!--begin::Col-->
                                    <div class="col-md-12 fv-row">
                                        <label class="fs-6 fw-semibold mb-2">{{ __('companies.issuing_authority') }}</label>
                                        <input type="text" class="form-control form-control-solid @error('issuing_authority') is-invalid @enderror"
                                               name="issuing_authority" value="{{ old('issuing_authority') }}"
                                               placeholder="{{ __('companies.ministry_of_commerce') }}" />
                                        @error('issuing_authority')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <!--end::Col-->
                                </div>
                                <!--end::Row-->
                            </div>
                            <!--end::Col-->
                        </div>
                        <!--end::Row-->

                        <!--begin::Manager Section-->
                        <div class="row mb-8">
                            <!--begin::Col-->
                            <div class="col-xl-3">
                                <div class="fs-6 fw-semibold mt-2 mb-3">{{ __('companies.manager_information') }}</div>
                            </div>
                            <!--end::Col-->
                            <!--begin::Col-->
                            <div class="col-xl-9 fv-row">
                                <!--begin::Row-->
                                <div class="row g-9 mb-8">
                                    <!--begin::Col-->
                                    <div class="col-md-6 fv-row">
                                        <label class="required fs-6 fw-semibold mb-2">{{ __('companies.manager_name') }}</label>
                                        <input type="text" class="form-control form-control-solid @error('manager_name') is-invalid @enderror"
                                               name="manager_name" value="{{ old('manager_name') }}" />
                                        @error('manager_name')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <!--end::Col-->
                                    <!--begin::Col-->
                                    <div class="col-md-6 fv-row">
                                        <label class="required fs-6 fw-semibold mb-2">{{ __('companies.manager_id_number') }}</label>
                                        <input type="text" class="form-control form-control-solid @error('manager_id_number') is-invalid @enderror"
                                               name="manager_id_number" value="{{ old('manager_id_number') }}" />
                                        @error('manager_id_number')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <!--end::Col-->
                                </div>
                                <!--end::Row-->
                                <!--begin::Row-->
                                <div class="row g-9 mb-8">
                                    <!--begin::Col-->
                                    <div class="col-md-6 fv-row">
                                        <label class="required fs-6 fw-semibold mb-2">{{ __('companies.manager_nationality') }}</label>
                                        <input type="text" class="form-control form-control-solid @error('manager_nationality') is-invalid @enderror"
                                               name="manager_nationality" value="{{ old('manager_nationality') }}" />
                                        @error('manager_nationality')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <!--end::Col-->
                                    <!--begin::Col-->
                                    <div class="col-md-6 fv-row">
                                        <label class="required fs-6 fw-semibold mb-2">{{ __('companies.manager_position') }}</label>
                                        <input type="text" class="form-control form-control-solid @error('manager_position') is-invalid @enderror"
                                               name="manager_position" value="{{ old('manager_position') }}"
                                               placeholder="{{ __('companies.general_manager_branch_manager') }}" />
                                        @error('manager_position')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <!--end::Col-->
                                </div>
                                <!--end::Row-->
                            </div>
                            <!--end::Col-->
                        </div>
                        <!--end::Manager Section-->

                        <!--begin::Activity Section-->
                        <div class="row mb-8">
                            <!--begin::Col-->
                            <div class="col-xl-3">
                                <div class="fs-6 fw-semibold mt-2 mb-3">{{ __('companies.activity_files') }}</div>
                            </div>
                            <!--end::Col-->
                            <!--begin::Col-->
                            <div class="col-xl-9 fv-row">
                                <!--begin::Row-->
                                <div class="row g-9 mb-8">
                                    <!--begin::Col-->
                                    <div class="col-md-12 fv-row">
                                        <label class="required fs-6 fw-semibold mb-2">{{ __('companies.branch_activity') }}</label>
                                        <textarea class="form-control form-control-solid @error('branch_activity') is-invalid @enderror"
                                                  name="branch_activity" rows="3"
                                                  placeholder="{{ __('companies.describe_branch_activities') }}">{{ old('branch_activity') }}</textarea>
                                        @error('branch_activity')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <!--end::Col-->
                                </div>
                                <!--end::Row-->
                                <!--begin::Row-->
                                <div class="row g-9 mb-8">
                                    <!--begin::Col-->
                                    <div class="col-md-12 fv-row">
                                        <label class="fs-6 fw-semibold mb-2">{{ __('companies.activities_list') }}</label>
                                        <textarea class="form-control form-control-solid @error('activities_list') is-invalid @enderror"
                                                  name="activities_list" rows="3"
                                                  placeholder="{{ __('companies.list_of_authorized_activities') }}">{{ old('activities_list') }}</textarea>
                                        @error('activities_list')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <!--end::Col-->
                                </div>
                                <!--end::Row-->
                                <!--begin::Row-->
                                <div class="row g-9 mb-8">
                                    <!--begin::Col-->
                                    <div class="col-md-6 fv-row">
                                        <label class="fs-6 fw-semibold mb-2">{{ __('companies.certificate_file') }}</label>
                                        <input type="file" class="form-control form-control-solid @error('certificate_file') is-invalid @enderror"
                                               name="certificate_file" accept=".pdf,.jpg,.jpeg,.png" />
                                        <div class="form-text">{{ __('companies.allowed_file_types_pdf_jpg_png') }}</div>
                                        @error('certificate_file')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <!--end::Col-->
                                    <!--begin::Col-->
                                    <div class="col-md-6 fv-row">
                                        <label class="fs-6 fw-semibold mb-2">{{ __('companies.notes') }}</label>
                                        <textarea class="form-control form-control-solid @error('notes') is-invalid @enderror"
                                                  name="notes" rows="4">{{ old('notes') }}</textarea>
                                        @error('notes')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <!--end::Col-->
                                </div>
                                <!--end::Row-->
                            </div>
                            <!--end::Col-->
                        </div>
                        <!--end::Activity Section-->

                        <!--begin::Reminder Section-->
                        <div class="row mb-8">
                            <!--begin::Col-->
                            <div class="col-xl-3">
                                <div class="fs-6 fw-semibold mt-2 mb-3">{{ __('documents.reminder_settings') }}</div>
                            </div>
                            <!--end::Col-->
                            <!--begin::Col-->
                            <div class="col-xl-9 fv-row">
                                <!--begin::Row-->
                                <div class="row g-9">
                                    <!--begin::Col-->
                                    <div class="col-md-6 fv-row">
                                        <div class="form-check form-switch form-check-custom form-check-solid">
                                            <input class="form-check-input" type="checkbox" name="enable_reminder"
                                                   id="enable_reminder" value="1" @checked(old('enable_reminder', false)) />
                                            <label class="form-check-label fw-semibold text-gray-400 ms-3" for="enable_reminder">
                                                {{ __('documents.enable_expiry_reminder') }}
                                            </label>
                                        </div>
                                    </div>
                                    <!--end::Col-->
                                    <!--begin::Col-->
                                    <div class="col-md-6 fv-row" id="reminder_days_field">
                                        <label class="fs-6 fw-semibold mb-2">{{ __('documents.remind_before_days') }}</label>
                                        <input type="number" min="1" max="365" class="form-control form-control-solid @error('reminder_days') is-invalid @enderror"
                                               name="reminder_days" value="{{ old('reminder_days', 30) }}" />
                                        <div class="form-text">{{ __('documents.reminder_help_text') }}</div>
                                        @error('reminder_days')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <!--end::Col-->
                                </div>
                                <!--end::Row-->
                            </div>
                            <!--end::Col-->
                        </div>
                        <!--end::Reminder Section-->
                    </div>
                    <!--end::Card body-->

                    <!--begin::Card footer-->
                    <div class="card-footer d-flex justify-content-end py-6 px-9">
                        <a href="{{ route('admin.companies.workflow', $company) }}" class="btn btn-light btn-active-light-primary me-2">
                            @lang('common.cancel')
                        </a>
                        <button type="submit" class="btn btn-primary" id="kt_branch_submit">
                            <span class="indicator-label">{{ __('companies.add_registration') }}</span>
                            <span class="indicator-progress">{{ __('companies.please_wait') }}
                                <span class="spinner-border spinner-border-sm align-middle ms-2"></span>
                            </span>
                        </button>
                    </div>
                    <!--end::Card footer-->
                </form>
                <!--end::Form-->
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
var KTBranchCreate = function () {
    // Elements
    var form;
    var submitButton;
    var enableReminderCheckbox;
    var reminderDaysField;

    // Private functions
    var handleSubmit = function () {
        submitButton.addEventListener('click', function (e) {
            e.preventDefault();

            // Show loading indication
            submitButton.setAttribute('data-kt-indicator', 'on');

            // Disable button to avoid multiple click
            submitButton.disabled = true;

            // Submit form
            setTimeout(function() {
                form.submit();
            }, 1000);
        });
    }

    var handleReminderToggle = function () {
        if (enableReminderCheckbox) {
            enableReminderCheckbox.addEventListener('change', function () {
                if (this.checked) {
                    reminderDaysField.style.display = 'block';
                    reminderDaysField.querySelector('input').setAttribute('required', 'required');
                } else {
                    reminderDaysField.style.display = 'none';
                    reminderDaysField.querySelector('input').removeAttribute('required');
                }
            });

            // Initial state
            if (!enableReminderCheckbox.checked) {
                reminderDaysField.style.display = 'none';
            }
        }
    }

    // Public methods
    return {
        init: function () {
            form = document.querySelector('#kt_branch_form');
            submitButton = document.querySelector('#kt_branch_submit');
            enableReminderCheckbox = document.querySelector('#enable_reminder');
            reminderDaysField = document.querySelector('#reminder_days_field');

            if (!form) {
                return;
            }

            handleSubmit();
            handleReminderToggle();
        }
    }
}();

// On document ready
KTUtil.onDOMContentLoaded(function () {
    KTBranchCreate.init();
});
</script>
@endpush
