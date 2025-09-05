@extends('admin.layouts.master')

@section('title', __('companies.add_municipality_license') . ' - ' . $company->company_name_en)

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
                    {{ __('companies.add_municipality_license') }}
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
                    <li class="breadcrumb-item text-muted">{{ __('companies.add_municipality_license') }}</li>
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
                    <div class="card-title fs-3 fw-bold">{{ __('companies.add_municipality_license_for') }} {{ $company->company_name_en }}</div>
                    <!--end::Card title-->
                </div>
                <!--end::Card header-->

                <!--begin::Form-->
                <form id="kt_municipality_form" class="form" action="{{ route('admin.companies.municipality-licenses.store', $company) }}" method="POST" enctype="multipart/form-data">
                    @csrf
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
                                               name="license_number" value="{{ old('license_number') }}" />
                                        @error('license_number')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <!--end::Col-->
                                    <!--begin::Col-->
                                    <div class="col-md-6 fv-row">
                                        <label class="required fs-6 fw-semibold mb-2">{{ __('companies.municipality_name') }}</label>
                                        <input type="text" class="form-control form-control-solid @error('municipality_name') is-invalid @enderror"
                                               name="municipality_name" value="{{ old('municipality_name') }}"
                                               placeholder="{{ __('companies.riyadh_municipality') }}" />
                                        @error('municipality_name')
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
                                        <label class="required fs-6 fw-semibold mb-2">{{ __('companies.license_type') }}</label>
                                        <select class="form-select form-select-solid @error('license_type') is-invalid @enderror" name="license_type">
                                            <option value="">{{ __('companies.select_license_type') }}</option>
                                            <option value="commercial" @selected(old('license_type') == 'commercial')>{{ __('companies.commercial_license') }}</option>
                                            <option value="industrial" @selected(old('license_type') == 'industrial')>{{ __('companies.industrial_license') }}</option>
                                            <option value="residential" @selected(old('license_type') == 'residential')>{{ __('companies.residential_license') }}</option>
                                            <option value="construction" @selected(old('license_type') == 'construction')>{{ __('companies.construction_license') }}</option>
                                            <option value="demolition" @selected(old('license_type') == 'demolition')>{{ __('companies.demolition_license') }}</option>
                                            <option value="advertising" @selected(old('license_type') == 'advertising')>{{ __('companies.advertising_license') }}</option>
                                            <option value="event" @selected(old('license_type') == 'event')>{{ __('companies.event_license') }}</option>
                                            <option value="other" @selected(old('license_type') == 'other')>{{ __('companies.other') }}</option>
                                        </select>
                                        @error('license_type')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <!--end::Col-->
                                    <!--begin::Col-->
                                    <div class="col-md-6 fv-row">
                                        <label class="required fs-6 fw-semibold mb-2">{{ __('companies.land_use_type') }}</label>
                                        <select class="form-select form-select-solid @error('land_use_type') is-invalid @enderror" name="land_use_type">
                                            <option value="">{{ __('companies.select_land_use_type') }}</option>
                                            <option value="commercial" @selected(old('land_use_type') == 'commercial')>{{ __('companies.commercial') }}</option>
                                            <option value="industrial" @selected(old('land_use_type') == 'industrial')>{{ __('companies.industrial') }}</option>
                                            <option value="residential" @selected(old('land_use_type') == 'residential')>{{ __('companies.residential') }}</option>
                                            <option value="mixed" @selected(old('land_use_type') == 'mixed')>{{ __('companies.mixed_use') }}</option>
                                            <option value="administrative" @selected(old('land_use_type') == 'administrative')>{{ __('companies.administrative') }}</option>
                                            <option value="educational" @selected(old('land_use_type') == 'educational')>{{ __('companies.educational') }}</option>
                                            <option value="health" @selected(old('land_use_type') == 'health')>{{ __('companies.health_services') }}</option>
                                            <option value="recreational" @selected(old('land_use_type') == 'recreational')>{{ __('companies.recreational') }}</option>
                                        </select>
                                        @error('land_use_type')
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
                                               name="issue_date" value="{{ old('issue_date') }}" />
                                        @error('issue_date')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <!--end::Col-->
                                    <!--begin::Col-->
                                    <div class="col-md-6 fv-row">
                                        <label class="required fs-6 fw-semibold mb-2">{{ __('companies.expiry_date') }}</label>
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
                                    <div class="col-md-6 fv-row">
                                        <label class="required fs-6 fw-semibold mb-2">{{ __('companies.location_code') }}</label>
                                        <input type="text" class="form-control form-control-solid @error('location_code') is-invalid @enderror"
                                               name="location_code" value="{{ old('location_code') }}"
                                               placeholder="{{ __('companies.loc_001_2024') }}" />
                                        @error('location_code')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <!--end::Col-->
                                    <!--begin::Col-->
                                    <div class="col-md-6 fv-row">
                                        <label class="required fs-6 fw-semibold mb-2">{{ __('companies.area_m2') }}</label>
                                        <input type="number" min="0" step="0.01" class="form-control form-control-solid @error('area') is-invalid @enderror"
                                               name="area" value="{{ old('area') }}" />
                                        @error('area')
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
                                        <label class="required fs-6 fw-semibold mb-2">{{ __('companies.zone_classification') }}</label>
                                        <input type="text" class="form-control form-control-solid @error('zone_classification') is-invalid @enderror"
                                               name="zone_classification" value="{{ old('zone_classification') }}"
                                               placeholder="{{ __('companies.zone_a_commercial_district') }}" />
                                        @error('zone_classification')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <!--end::Col-->
                                    <!--begin::Col-->
                                    <div class="col-md-6 fv-row">
                                        <label class="fs-6 fw-semibold mb-2">{{ __('companies.building_permit_number') }}</label>
                                        <input type="text" class="form-control form-control-solid @error('building_permit_number') is-invalid @enderror"
                                               name="building_permit_number" value="{{ old('building_permit_number') }}" />
                                        @error('building_permit_number')
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
                                        <label class="fs-6 fw-semibold mb-2">{{ __('companies.license_fees_sar') }}</label>
                                        <input type="number" min="0" step="0.01" class="form-control form-control-solid @error('license_fees') is-invalid @enderror"
                                               name="license_fees" value="{{ old('license_fees') }}" />
                                        @error('license_fees')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <!--end::Col-->
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
                                </div>
                                <!--end::Row-->
                                <!--begin::Row-->
                                <div class="row g-9 mb-8">
                                    <!--begin::Col-->
                                    <div class="col-md-12 fv-row">
                                        <label class="required fs-6 fw-semibold mb-2">{{ __('companies.activity_description') }}</label>
                                        <textarea class="form-control form-control-solid @error('activity_desc') is-invalid @enderror"
                                                  name="activity_desc" rows="3"
                                                  placeholder="{{ __('companies.describe_licensed_activity') }}">{{ old('activity_desc') }}</textarea>
                                        @error('activity_desc')
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
                                        <label class="fs-6 fw-semibold mb-2">{{ __('companies.conditions_requirements') }}</label>
                                        <textarea class="form-control form-control-solid @error('conditions') is-invalid @enderror"
                                                  name="conditions" rows="3"
                                                  placeholder="{{ __('companies.list_special_conditions') }}">{{ old('conditions') }}</textarea>
                                        @error('conditions')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <!--end::Col-->
                                </div>
                                <!--end::Row-->
                                <!--begin::Row-->
                                <div class="row g-9">
                                    <!--begin::Col-->
                                    <div class="col-md-12 fv-row">
                                        <label class="fs-6 fw-semibold mb-2">{{ __('companies.notes') }}</label>
                                        <textarea class="form-control form-control-solid @error('notes') is-invalid @enderror"
                                                  name="notes" rows="3">{{ old('notes') }}</textarea>
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
                    </div>
                    <!--end::Card body-->

                    <!--begin::Card footer-->
                    <div class="card-footer d-flex justify-content-end py-6 px-9">
                        <a href="{{ route('admin.companies.workflow', $company) }}" class="btn btn-light btn-active-light-primary me-2">
                            @lang('common.cancel')
                        </a>
                        <button type="submit" class="btn btn-primary" id="kt_municipality_submit">
                            <span class="indicator-label">{{ __('companies.add_license') }}</span>
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
var KTMunicipalityCreate = function () {
    // Elements
    var form;
    var submitButton;

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

    // Public methods
    return {
        init: function () {
            form = document.querySelector('#kt_municipality_form');
            submitButton = document.querySelector('#kt_municipality_submit');

            if (!form) {
                return;
            }

            handleSubmit();
        }
    }
}();

// On document ready
KTUtil.onDOMContentLoaded(function () {
    KTMunicipalityCreate.init();
});
</script>
@endpush
