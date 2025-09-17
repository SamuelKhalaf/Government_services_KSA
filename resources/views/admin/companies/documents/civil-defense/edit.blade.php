@extends('admin.layouts.master')

@section('title', __('companies.edit_civil_defense_license') . ' - ' . $civilDefenseLicense->license_number)

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
                    {{ __('companies.edit_civil_defense_license') }}
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
                        <a href="{{ route('admin.companies.show', $company) }}" class="text-muted text-hover-primary">{{ $company->company_name_en }}</a>
                    </li>
                    <li class="breadcrumb-item">
                        <span class="bullet bg-gray-400 w-5px h-2px"></span>
                    </li>
                    <li class="breadcrumb-item text-muted">{{ __('companies.edit_civil_defense_license') }}</li>
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
                    <div class="card-title fs-3 fw-bold">{{ __('companies.edit_civil_defense_license') }} - {{ $civilDefenseLicense->license_number }}</div>
                    <!--end::Card title-->
                </div>
                <!--end::Card header-->

                <!--begin::Form-->
                <form id="kt_civil_defense_form" class="form" action="{{ route('admin.companies.civil-defense-licenses.update', [$company, $civilDefenseLicense]) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <!--begin::Card body-->
                    <div class="card-body p-9">
                        <!--begin::Row-->
                        <div class="row mb-8">
                            <!--begin::Col-->
                            <div class="col-xl-3">
                                <div class="fs-6 fw-semibold mt-2 mb-3">{{ __('companies.license_information') }}</div>
                            </div>
                            <!--end::Col-->
                            <!--begin::Col-->
                            <div class="col-xl-9 fv-row">
                                <!--begin::Row-->
                                <div class="row g-9 mb-8">
                                    <!--begin::Col-->
                                    <div class="col-md-6 fv-row">
                                        <label class="required fs-6 fw-semibold mb-2">{{ __('companies.license_number') }}</label>
                                        <input type="text" class="form-control form-control-solid @error('license_number') is-invalid @enderror"
                                               name="license_number" value="{{ old('license_number', $civilDefenseLicense->license_number) }}" />
                                        @error('license_number')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <!--end::Col-->
                                    <!--begin::Col-->
                                    <div class="col-md-6 fv-row">
                                        <label class="required fs-6 fw-semibold mb-2">{{ __('companies.authority') }}</label>
                                        <input type="text" class="form-control form-control-solid @error('authority') is-invalid @enderror"
                                               name="authority" value="{{ old('authority', $civilDefenseLicense->authority) }}" />
                                        @error('authority')
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
                                        <label class="required fs-6 fw-semibold mb-2">{{ __('companies.issue_date') }}</label>
                                        <input type="date" class="form-control form-control-solid @error('issue_date') is-invalid @enderror"
                                               name="issue_date" value="{{ old('issue_date', $civilDefenseLicense->issue_date?->format('Y-m-d')) }}" />
                                        @error('issue_date')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <!--end::Col-->
                                    <!--begin::Col-->
                                    <div class="col-md-6 fv-row">
                                        <label class="required fs-6 fw-semibold mb-2">{{ __('companies.expiry_date') }}</label>
                                        <input type="date" class="form-control form-control-solid @error('expiry_date') is-invalid @enderror"
                                               name="expiry_date" value="{{ old('expiry_date', $civilDefenseLicense->expiry_date?->format('Y-m-d')) }}" />
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
                                    <div class="col-md-6 fv-row">
                                        <label class="required fs-6 fw-semibold mb-2">{{ __('companies.activity_classification') }}</label>
                                        <input type="text" class="form-control form-control-solid @error('activity_classification') is-invalid @enderror"
                                               name="activity_classification" value="{{ old('activity_classification', $civilDefenseLicense->activity_classification) }}" />
                                        @error('activity_classification')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <!--end::Col-->
                                    <!--begin::Col-->
                                    <div class="col-md-6 fv-row">
                                        <label class="required fs-6 fw-semibold mb-2">{{ __('companies.facility_type') }}</label>
                                        <select class="form-select form-select-solid @error('facility_type') is-invalid @enderror" name="facility_type">
                                            <option value="">{{ __('companies.select_facility_type') }}</option>
                                            <option value="office" @selected(old('facility_type', $civilDefenseLicense->facility_type) == 'office')>{{ __('companies.office_building') }}</option>
                                            <option value="warehouse" @selected(old('facility_type', $civilDefenseLicense->facility_type) == 'warehouse')>{{ __('companies.warehouse') }}</option>
                                            <option value="factory" @selected(old('facility_type', $civilDefenseLicense->facility_type) == 'factory')>{{ __('companies.factory_manufacturing') }}</option>
                                            <option value="retail" @selected(old('facility_type', $civilDefenseLicense->facility_type) == 'retail')>{{ __('companies.retail_store') }}</option>
                                            <option value="restaurant" @selected(old('facility_type', $civilDefenseLicense->facility_type) == 'restaurant')>{{ __('companies.restaurant_food_service') }}</option>
                                            <option value="medical" @selected(old('facility_type', $civilDefenseLicense->facility_type) == 'medical')>{{ __('companies.medical_facility') }}</option>
                                            <option value="educational" @selected(old('facility_type', $civilDefenseLicense->facility_type) == 'educational')>{{ __('companies.educational_facility') }}</option>
                                            <option value="residential" @selected(old('facility_type', $civilDefenseLicense->facility_type) == 'residential')>{{ __('companies.residential_building') }}</option>
                                            <option value="mixed" @selected(old('facility_type', $civilDefenseLicense->facility_type) == 'mixed')>{{ __('companies.mixed_use') }}</option>
                                            <option value="other" @selected(old('facility_type', $civilDefenseLicense->facility_type) == 'other')>{{ __('companies.other') }}</option>
                                        </select>
                                        @error('facility_type')
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
                                        <label class="required fs-6 fw-semibold mb-2">{{ __('companies.total_area_m2') }}</label>
                                        <input type="number" min="0" step="0.01" class="form-control form-control-solid @error('total_area') is-invalid @enderror"
                                               name="total_area" value="{{ old('total_area', $civilDefenseLicense->total_area) }}" />
                                        @error('total_area')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <!--end::Col-->
                                    <!--begin::Col-->
                                    <div class="col-md-6 fv-row">
                                        <label class="required fs-6 fw-semibold mb-2">{{ __('companies.number_of_floors') }}</label>
                                        <input type="number" min="1" class="form-control form-control-solid @error('floors') is-invalid @enderror"
                                               name="floors" value="{{ old('floors', $civilDefenseLicense->floors) }}" />
                                        @error('floors')
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
                                        <label class="required fs-6 fw-semibold mb-2">{{ __('companies.safety_status') }}</label>
                                        <select class="form-select form-select-solid @error('safety_status') is-invalid @enderror" name="safety_status">
                                            <option value="">{{ __('companies.select_safety_status') }}</option>
                                            <option value="compliant" @selected(old('safety_status', $civilDefenseLicense->safety_status) == 'compliant')>{{ __('companies.compliant') }}</option>
                                            <option value="non_compliant" @selected(old('safety_status', $civilDefenseLicense->safety_status) == 'non_compliant')>{{ __('companies.non_compliant') }}</option>
                                            <option value="pending" @selected(old('safety_status', $civilDefenseLicense->safety_status) == 'pending')>{{ __('companies.pending_review') }}</option>
                                            <option value="under_review" @selected(old('safety_status', $civilDefenseLicense->safety_status) == 'under_review')>{{ __('companies.under_review') }}</option>
                                        </select>
                                        @error('safety_status')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <!--end::Col-->
                                    <!--begin::Col-->
                                    <div class="col-md-6 fv-row">
                                        <label class="required fs-6 fw-semibold mb-2">{{ __('companies.inspection_status') }}</label>
                                        <select class="form-select form-select-solid @error('inspection_status') is-invalid @enderror" name="inspection_status">
                                            <option value="">{{ __('companies.select_inspection_status') }}</option>
                                            <option value="passed" @selected(old('inspection_status', $civilDefenseLicense->inspection_status) == 'passed')>{{ __('companies.passed') }}</option>
                                            <option value="failed" @selected(old('inspection_status', $civilDefenseLicense->inspection_status) == 'failed')>{{ __('companies.failed') }}</option>
                                            <option value="pending" @selected(old('inspection_status', $civilDefenseLicense->inspection_status) == 'pending')>{{ __('companies.pending') }}</option>
                                            <option value="not_required" @selected(old('inspection_status', $civilDefenseLicense->inspection_status) == 'not_required')>{{ __('companies.not_required') }}</option>
                                        </select>
                                        @error('inspection_status')
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
                                        <label class="fs-6 fw-semibold mb-2">{{ __('companies.last_inspection_date') }}</label>
                                        <input type="date" class="form-control form-control-solid @error('last_inspection_date') is-invalid @enderror"
                                               name="last_inspection_date" value="{{ old('last_inspection_date', $civilDefenseLicense->last_inspection_date?->format('Y-m-d')) }}" />
                                        @error('last_inspection_date')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <!--end::Col-->
                                    <!--begin::Col-->
                                    <div class="col-md-6 fv-row">
                                        <label class="fs-6 fw-semibold mb-2">{{ __('companies.next_inspection_date') }}</label>
                                        <input type="date" class="form-control form-control-solid @error('next_inspection_date') is-invalid @enderror"
                                               name="next_inspection_date" value="{{ old('next_inspection_date', $civilDefenseLicense->next_inspection_date?->format('Y-m-d')) }}" />
                                        @error('next_inspection_date')
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
                                        <div class="form-text">
                                            @if($civilDefenseLicense->certificate_file_path)
                                                {{ __('companies.current_file') }}
                                                <a href="{{ asset('storage/' . $civilDefenseLicense->certificate_file_path) }}"
                                                   class="text-primary" target="_blank">{{ __('companies.view_certificate') }}</a>
                                                <br>
                                            @endif
                                            {{ __('companies.allowed_file_types_pdf_jpg_png') }}
                                        </div>
                                        @error('certificate_file')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <!--end::Col-->
                                    <!--begin::Col-->
                                    <div class="col-md-6 fv-row">
                                        <label class="fs-6 fw-semibold mb-2">{{ __('companies.notes') }}</label>
                                        <textarea class="form-control form-control-solid @error('notes') is-invalid @enderror"
                                                  name="notes" rows="4">{{ old('notes', $civilDefenseLicense->notes) }}</textarea>
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
                        <!--end::Row-->

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
                                                   id="enable_reminder" value="1" @checked(old('enable_reminder', $civilDefenseLicense->enable_reminder)) />
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
                                               name="reminder_days" value="{{ old('reminder_days', $civilDefenseLicense->reminder_days ?? 30) }}" />
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
                        <a href="{{ route('admin.companies.civil-defense-licenses.show', [$company, $civilDefenseLicense]) }}" class="btn btn-light btn-active-light-primary me-2">
                            @lang('common.cancel')
                        </a>
                        <button type="submit" class="btn btn-primary" id="kt_civil_defense_submit">
                            <span class="indicator-label">{{ __('companies.update_license') }}</span>
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
var KTCivilDefenseEdit = function () {
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
            form = document.querySelector('#kt_civil_defense_form');
            submitButton = document.querySelector('#kt_civil_defense_submit');
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
    KTCivilDefenseEdit.init();
});
</script>
@endpush
