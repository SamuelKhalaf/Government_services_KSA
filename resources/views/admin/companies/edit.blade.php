@extends('admin.layouts.master')

@section('title', __('companies.edit_company') . ' - ' . $company->company_name_en)

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
                    {{ __('companies.edit_company') }}
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
                    <li class="breadcrumb-item text-muted">
                        <a href="{{ route('admin.companies.index') }}" class="text-muted text-hover-primary">{{ __('common.companies') }}</a>
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
                    <li class="breadcrumb-item text-muted">{{ __('companies.edit') }}</li>
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
                    <div class="card-title fs-3 fw-bold">{{ __('companies.edit_company_information') }}</div>
                    <!--end::Card title-->
                </div>
                <!--end::Card header-->

                <!--begin::Form-->
                <form id="kt_company_form" class="form" action="{{ route('admin.companies.update', $company) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <!--begin::Card body-->
                    <div class="card-body p-9">
                        <!--begin::Row-->
                        <div class="row mb-8">
                            <!--begin::Col-->
                            <div class="col-xl-3">
                                <div class="fs-6 fw-semibold mt-2 mb-3">{{ __('companies.basic_information') }}</div>
                            </div>
                            <!--end::Col-->
                            <!--begin::Col-->
                            <div class="col-xl-9 fv-row">
                                <!--begin::Row-->
                                <div class="row g-9 mb-8">
                                    <!--begin::Col-->
                                    <div class="col-md-6 fv-row">
                                        <label class="required fs-6 fw-semibold mb-2">{{ __('companies.company_name_ar') }}</label>
                                        <input type="text" class="form-control form-control-solid @error('company_name_ar') is-invalid @enderror"
                                               name="company_name_ar" value="{{ old('company_name_ar', $company->company_name_ar) }}" />
                                        @error('company_name_ar')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <!--end::Col-->
                                    <!--begin::Col-->
                                    <div class="col-md-6 fv-row">
                                        <label class="required fs-6 fw-semibold mb-2">{{ __('companies.company_name_en') }}</label>
                                        <input type="text" class="form-control form-control-solid @error('company_name_en') is-invalid @enderror"
                                               name="company_name_en" value="{{ old('company_name_en', $company->company_name_en) }}" />
                                        @error('company_name_en')
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
                                        <label class="required fs-6 fw-semibold mb-2">{{ __('companies.commercial_registration') }}</label>
                                        <input type="text" class="form-control form-control-solid @error('cr_number') is-invalid @enderror"
                                               name="cr_number" value="{{ old('cr_number', $company->cr_number) }}" />
                                        @error('cr_number')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <!--end::Col-->
                                    <!--begin::Col-->
                                    <div class="col-md-6 fv-row">
                                        <label class="fs-6 fw-semibold mb-2">{{ __('companies.tax_number') }}</label>
                                        <input type="text" class="form-control form-control-solid @error('tax_number') is-invalid @enderror"
                                               name="tax_number" value="{{ old('tax_number', $company->tax_number) }}" />
                                        @error('tax_number')
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
                                        <label class="required fs-6 fw-semibold mb-2">{{ __('companies.company_type') }}</label>
                                        <select class="form-select form-select-solid @error('company_type') is-invalid @enderror" name="company_type">
                                            <option value="">{{ __('companies.select_company_type') }}</option>
                                            <option value="LLC" @selected(old('company_type', $company->company_type) == 'LLC')>{{ __('companies.limited_liability_company') }}</option>
                                            <option value="JSC" @selected(old('company_type', $company->company_type) == 'JSC')>{{ __('companies.joint_stock_company') }}</option>
                                            <option value="Partnership" @selected(old('company_type', $company->company_type) == 'Partnership')>{{ __('companies.partnership') }}</option>
                                            <option value="Sole Proprietorship" @selected(old('company_type', $company->company_type) == 'Sole Proprietorship')>{{ __('companies.sole_proprietorship') }}</option>
                                            <option value="Branch" @selected(old('company_type', $company->company_type) == 'Branch')>{{ __('companies.branch_office') }}</option>
                                            <option value="Representative Office" @selected(old('company_type', $company->company_type) == 'Representative Office')>{{ __('companies.representative_office') }}</option>
                                        </select>
                                        @error('company_type')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <!--end::Col-->
                                    <!--begin::Col-->
                                    <div class="col-md-6 fv-row">
                                        <label class="fs-6 fw-semibold mb-2">{{ __('companies.isic_code') }}</label>
                                        <input type="text" class="form-control form-control-solid @error('isic_code') is-invalid @enderror"
                                               name="isic_code" value="{{ old('isic_code', $company->isic_code) }}" />
                                        @error('isic_code')
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

                        <!--begin::Row-->
                        <div class="row mb-8">
                            <!--begin::Col-->
                            <div class="col-xl-3">
                                <div class="fs-6 fw-semibold mt-2 mb-3">{{ __('companies.contact_information') }}</div>
                            </div>
                            <!--end::Col-->
                            <!--begin::Col-->
                            <div class="col-xl-9 fv-row">
                                <!--begin::Row-->
                                <div class="row g-9 mb-8">
                                    <!--begin::Col-->
                                    <div class="col-md-4 fv-row">
                                        <label class="fs-6 fw-semibold mb-2">{{ __('companies.phone') }}</label>
                                        <input type="text" class="form-control form-control-solid @error('phone') is-invalid @enderror"
                                               name="phone" value="{{ old('phone', $company->phone) }}" />
                                        @error('phone')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <!--end::Col-->
                                    <!--begin::Col-->
                                    <div class="col-md-4 fv-row">
                                        <label class="fs-6 fw-semibold mb-2">{{ __('companies.email') }}</label>
                                        <input type="email" class="form-control form-control-solid @error('email') is-invalid @enderror"
                                               name="email" value="{{ old('email', $company->email) }}" />
                                        @error('email')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <!--end::Col-->
                                    <!--begin::Col-->
                                    <div class="col-md-4 fv-row">
                                        <label class="fs-6 fw-semibold mb-2">{{ __('companies.website') }}</label>
                                        <input type="url" class="form-control form-control-solid @error('website') is-invalid @enderror"
                                               name="website" value="{{ old('website', $company->website) }}" />
                                        @error('website')
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

                        <!--begin::Row-->
                        <div class="row mb-8">
                            <!--begin::Col-->
                            <div class="col-xl-3">
                                <div class="fs-6 fw-semibold mt-2 mb-3">{{ __('companies.address_information') }}</div>
                            </div>
                            <!--end::Col-->
                            <!--begin::Col-->
                            <div class="col-xl-9 fv-row">
                                <!--begin::Row-->
                                <div class="row g-9 mb-8">
                                    <!--begin::Col-->
                                    <div class="col-md-6 fv-row">
                                        <label class="required fs-6 fw-semibold mb-2">{{ __('companies.region') }}</label>
                                        <select class="form-select form-select-solid @error('region') is-invalid @enderror" name="region">
                                            <option value="">{{ __('companies.select_region') }}</option>
                                            <option value="Riyadh" @selected(old('region', $company->region) == 'Riyadh')>{{ __('companies.riyadh') }}</option>
                                            <option value="Eastern Province" @selected(old('region', $company->region) == 'Eastern Province')>{{ __('companies.eastern_province') }}</option>
                                            <option value="Makkah" @selected(old('region', $company->region) == 'Makkah')>{{ __('companies.makkah') }}</option>
                                            <option value="Madinah" @selected(old('region', $company->region) == 'Madinah')>{{ __('companies.madinah') }}</option>
                                            <option value="Qassim" @selected(old('region', $company->region) == 'Qassim')>{{ __('companies.qassim') }}</option>
                                            <option value="Hail" @selected(old('region', $company->region) == 'Hail')>{{ __('companies.hail') }}</option>
                                            <option value="Tabuk" @selected(old('region', $company->region) == 'Tabuk')>{{ __('companies.tabuk') }}</option>
                                            <option value="Northern Borders" @selected(old('region', $company->region) == 'Northern Borders')>{{ __('companies.northern_borders') }}</option>
                                            <option value="Jazan" @selected(old('region', $company->region) == 'Jazan')>{{ __('companies.jazan') }}</option>
                                            <option value="Najran" @selected(old('region', $company->region) == 'Najran')>{{ __('companies.najran') }}</option>
                                            <option value="Al Bahah" @selected(old('region', $company->region) == 'Al Bahah')>{{ __('companies.al_bahah') }}</option>
                                            <option value="Al Jouf" @selected(old('region', $company->region) == 'Al Jouf')>{{ __('companies.al_jouf') }}</option>
                                            <option value="Asir" @selected(old('region', $company->region) == 'Asir')>{{ __('companies.asir') }}</option>
                                        </select>
                                        @error('region')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <!--end::Col-->
                                    <!--begin::Col-->
                                    <div class="col-md-6 fv-row">
                                        <label class="required fs-6 fw-semibold mb-2">{{ __('companies.city') }}</label>
                                        <input type="text" class="form-control form-control-solid @error('city') is-invalid @enderror"
                                               name="city" value="{{ old('city', $company->city) }}" />
                                        @error('city')
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
                                        <label class="required fs-6 fw-semibold mb-2">{{ __('companies.district') }}</label>
                                        <input type="text" class="form-control form-control-solid @error('district') is-invalid @enderror"
                                               name="district" value="{{ old('district', $company->district) }}" />
                                        @error('district')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <!--end::Col-->
                                    <!--begin::Col-->
                                    <div class="col-md-6 fv-row">
                                        <label class="required fs-6 fw-semibold mb-2">{{ __('companies.street') }}</label>
                                        <input type="text" class="form-control form-control-solid @error('street') is-invalid @enderror"
                                               name="street" value="{{ old('street', $company->street) }}" />
                                        @error('street')
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
                                        <label class="fs-6 fw-semibold mb-2">{{ __('companies.building_number') }}</label>
                                        <input type="text" class="form-control form-control-solid @error('building_number') is-invalid @enderror"
                                               name="building_number" value="{{ old('building_number', $company->building_number) }}" />
                                        @error('building_number')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <!--end::Col-->
                                    <!--begin::Col-->
                                    <div class="col-md-6 fv-row">
                                        <label class="fs-6 fw-semibold mb-2">{{ __('companies.postal_code') }}</label>
                                        <input type="text" class="form-control form-control-solid @error('postal_code') is-invalid @enderror"
                                               name="postal_code" value="{{ old('postal_code', $company->postal_code) }}" />
                                        @error('postal_code')
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
                                        <label class="fs-6 fw-semibold mb-2">{{ __('companies.additional_location') }}</label>
                                        <textarea class="form-control form-control-solid @error('additional_location') is-invalid @enderror"
                                                  name="additional_location" rows="3">{{ old('additional_location', $company->additional_location) }}</textarea>
                                        @error('additional_location')
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

                        <!--begin::Row-->
                        <div class="row mb-8">
                            <!--begin::Col-->
                            <div class="col-xl-3">
                                <div class="fs-6 fw-semibold mt-2 mb-3">{{ __('companies.legal_information') }}</div>
                            </div>
                            <!--end::Col-->
                            <!--begin::Col-->
                            <div class="col-xl-9 fv-row">
                                <!--begin::Row-->
                                <div class="row g-9 mb-8">
                                    <!--begin::Col-->
                                    <div class="col-md-6 fv-row">
                                        <label class="required fs-6 fw-semibold mb-2">{{ __('companies.owner_manager_name') }}</label>
                                        <input type="text" class="form-control form-control-solid @error('owner_name') is-invalid @enderror"
                                               name="owner_name" value="{{ old('owner_name', $company->owner_name) }}" />
                                        @error('owner_name')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <!--end::Col-->
                                    <!--begin::Col-->
                                    <div class="col-md-6 fv-row">
                                        <label class="required fs-6 fw-semibold mb-2">{{ __('companies.owner_id_number') }}</label>
                                        <input type="text" class="form-control form-control-solid @error('owner_id_number') is-invalid @enderror"
                                               name="owner_id_number" value="{{ old('owner_id_number', $company->owner_id_number) }}" />
                                        @error('owner_id_number')
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
                                        <label class="required fs-6 fw-semibold mb-2">{{ __('companies.owner_nationality') }}</label>
                                        <input type="text" class="form-control form-control-solid @error('owner_nationality') is-invalid @enderror"
                                               name="owner_nationality" value="{{ old('owner_nationality', $company->owner_nationality) }}" />
                                        @error('owner_nationality')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <!--end::Col-->
                                    <!--begin::Col-->
                                    <div class="col-md-6 fv-row">
                                        <label class="required fs-6 fw-semibold mb-2">{{ __('companies.legal_status') }}</label>
                                        <select class="form-select form-select-solid @error('legal_status') is-invalid @enderror" name="legal_status">
                                            <option value="">{{ __('companies.select_legal_status') }}</option>
                                            <option value="Active" @selected(old('legal_status', $company->legal_status) == 'Active')>{{ __('common.active') }}</option>
                                            <option value="Under Formation" @selected(old('legal_status', $company->legal_status) == 'Under Formation')>{{ __('companies.under_formation') }}</option>
                                            <option value="Suspended" @selected(old('legal_status', $company->legal_status) == 'Suspended')>{{ __('companies.suspended') }}</option>
                                            <option value="Liquidation" @selected(old('legal_status', $company->legal_status) == 'Liquidation')>{{ __('companies.under_liquidation') }}</option>
                                        </select>
                                        @error('legal_status')
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
                                        <label class="required fs-6 fw-semibold mb-2">{{ __('companies.establishment_date') }}</label>
                                        <input type="date" class="form-control form-control-solid @error('establishment_date') is-invalid @enderror"
                                               name="establishment_date" value="{{ old('establishment_date', $company->establishment_date?->format('Y-m-d')) }}" />
                                        @error('establishment_date')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <!--end::Col-->
                                    <!--begin::Col-->
                                    <div class="col-md-6 fv-row">
                                        <label class="fs-6 fw-semibold mb-2">{{ __('companies.capital_amount_sar') }}</label>
                                        <input type="number" min="0" step="0.01" class="form-control form-control-solid @error('capital_amount') is-invalid @enderror"
                                               name="capital_amount" value="{{ old('capital_amount', $company->capital_amount) }}" />
                                        @error('capital_amount')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <!--end::Col-->
                                </div>
                                <!--end::Row-->
                                <!--begin::Row-->
                                <div class="row g-9">
                                    <!--begin::Col-->
                                    <div class="col-md-6 fv-row">
                                        <label class="fs-6 fw-semibold mb-2">{{ __('common.status') }}</label>
                                        <select class="form-select form-select-solid @error('status') is-invalid @enderror" name="status">
                                            <option value="active" @selected(old('status', $company->status) == 'active')>{{ __('common.active') }}</option>
                                            <option value="inactive" @selected(old('status', $company->status) == 'inactive')>{{ __('common.inactive') }}</option>
                                            <option value="suspended" @selected(old('status', $company->status) == 'suspended')>{{ __('companies.suspended') }}</option>
                                        </select>
                                        @error('status')
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
                        <a href="{{ route('admin.companies.show', $company) }}" class="btn btn-light btn-active-light-primary me-2">
                            {{ __('common.cancel') }}
                        </a>
                        <button type="submit" class="btn btn-primary" id="kt_company_submit">
                            <span class="indicator-label">{{ __('companies.update_company') }}</span>
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
var KTCompanyEdit = function () {
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
            form = document.querySelector('#kt_company_form');
            submitButton = document.querySelector('#kt_company_submit');

            if (!form) {
                return;
            }

            handleSubmit();
        }
    }
}();

// On document ready
KTUtil.onDOMContentLoaded(function () {
    KTCompanyEdit.init();
});
</script>
@endpush
