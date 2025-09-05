@extends('admin.layouts.master')

@section('title', __('employees.add_new_employee'))

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
                    {{ __('employees.add_new_employee') }}
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
                    <li class="breadcrumb-item text-muted">@lang('employees.add_employee')</li>
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
                    <div class="card-title fs-3 fw-bold">{{ __('employees.employee_information') }}</div>
                    <!--end::Card title-->
                </div>
                <!--end::Card header-->

                <!--begin::Form-->
                <form id="kt_employee_form" class="form" action="{{ route('admin.companies.employees.store', $company) }}" method="POST">
                    @csrf
                    <!--begin::Card body-->
                    <div class="card-body p-9">
                        <!--begin::Row-->
                        <div class="row mb-8">
                            <!--begin::Col-->
                            <div class="col-xl-3">
                                <div class="fs-6 fw-semibold mt-2 mb-3">{{ __('employees.personal_information') }}</div>
                            </div>
                            <!--end::Col-->
                            <!--begin::Col-->
                            <div class="col-xl-9 fv-row">
                                <!--begin::Row-->
                                <div class="row g-9 mb-8">
                                    <!--begin::Col-->
                                    <div class="col-md-6 fv-row">
                                        <label class="required fs-6 fw-semibold mb-2">{{ __('employees.full_name_ar') }}</label>
                                        <input type="text" class="form-control form-control-solid @error('full_name_ar') is-invalid @enderror"
                                               name="full_name_ar" value="{{ old('full_name_ar') }}" />
                                        @error('full_name_ar')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <!--end::Col-->
                                    <!--begin::Col-->
                                    <div class="col-md-6 fv-row">
                                        <label class="required fs-6 fw-semibold mb-2">{{ __('employees.full_name_en') }}</label>
                                        <input type="text" class="form-control form-control-solid @error('full_name_en') is-invalid @enderror"
                                               name="full_name_en" value="{{ old('full_name_en') }}" />
                                        @error('full_name_en')
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
                                        <label class="required fs-6 fw-semibold mb-2">{{ __('employees.type') }}</label>
                                        <select class="form-select form-select-solid @error('type') is-invalid @enderror" name="type" id="employee_type">
                                            <option value="">{{ __('employees.select_employee_type') }}</option>
                                            <option value="saudi" @selected(old('type') == 'saudi')>{{ __('employees.saudi') }}</option>
                                            <option value="expat" @selected(old('type') == 'expat')>{{ __('employees.expat') }}</option>
                                        </select>
                                        @error('type')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <!--end::Col-->
                                    <!--begin::Col-->
                                    <div class="col-md-6 fv-row">
                                        <label class="required fs-6 fw-semibold mb-2">{{ __('employees.nationality') }}</label>
                                        <input type="text" class="form-control form-control-solid @error('nationality') is-invalid @enderror"
                                               name="nationality" value="{{ old('nationality') }}" />
                                        @error('nationality')
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
                                        <label class="required fs-6 fw-semibold mb-2">{{ __('employees.dob_greg') }}</label>
                                        <input type="date" class="form-control form-control-solid @error('dob_greg') is-invalid @enderror"
                                               name="dob_greg" value="{{ old('dob_greg') }}" />
                                        @error('dob_greg')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <!--end::Col-->
                                    <!--begin::Col-->
                                    <div class="col-md-6 fv-row">
                                        <label class="fs-6 fw-semibold mb-2">{{ __('employees.dob_hijri') }}</label>
                                        <input type="text" class="form-control form-control-solid @error('dob_hijri') is-invalid @enderror"
                                               name="dob_hijri" value="{{ old('dob_hijri') }}" placeholder="1445/05/15" />
                                        @error('dob_hijri')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <!--end::Col-->
                                </div>
                                <!--end::Row-->
                                <!--begin::Row-->
                                <div class="row g-9 mb-8">
                                    <!--begin::Col-->
                                    <div class="col-md-4 fv-row">
                                        <label class="required fs-6 fw-semibold mb-2">{{ __('employees.pob') }}</label>
                                        <input type="text" class="form-control form-control-solid @error('pob') is-invalid @enderror"
                                               name="pob" value="{{ old('pob') }}" />
                                        @error('pob')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <!--end::Col-->
                                    <!--begin::Col-->
                                    <div class="col-md-4 fv-row">
                                        <label class="required fs-6 fw-semibold mb-2">{{ __('employees.gender') }}</label>
                                        <select class="form-select form-select-solid @error('gender') is-invalid @enderror" name="gender">
                                            <option value="">{{ __('employees.select_gender') }}</option>
                                            <option value="male" @selected(old('gender') == 'male')>{{ __('employees.male') }}</option>
                                            <option value="female" @selected(old('gender') == 'female')>{{ __('employees.female') }}</option>
                                        </select>
                                        @error('gender')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <!--end::Col-->
                                    <!--begin::Col-->
                                    <div class="col-md-4 fv-row">
                                        <label class="required fs-6 fw-semibold mb-2">{{ __('employees.marital_status') }}</label>
                                        <select class="form-select form-select-solid @error('marital_status') is-invalid @enderror" name="marital_status">
                                            <option value="">{{ __('employees.select_status') }}</option>
                                            <option value="single" @selected(old('marital_status') == 'single')>{{ __('employees.single') }}</option>
                                            <option value="married" @selected(old('marital_status') == 'married')>{{ __('employees.married') }}</option>
                                            <option value="divorced" @selected(old('marital_status') == 'divorced')>{{ __('employees.divorced') }}</option>
                                            <option value="widowed" @selected(old('marital_status') == 'widowed')>{{ __('employees.widowed') }}</option>
                                        </select>
                                        @error('marital_status')
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

                        <!--begin::Identity Section - Saudi-->
                        <div class="row mb-8" id="saudi_identity_section" style="display: none;">
                            <!--begin::Col-->
                            <div class="col-xl-3">
                                <div class="fs-6 fw-semibold mt-2 mb-3">{{ __('employees.identity_information_saudi') }}</div>
                            </div>
                            <!--end::Col-->
                            <!--begin::Col-->
                            <div class="col-xl-9 fv-row">
                                <!--begin::Row-->
                                <div class="row g-9 mb-8">
                                    <!--begin::Col-->
                                    <div class="col-md-6 fv-row">
                                        <label class="required fs-6 fw-semibold mb-2">{{ __('employees.national_id') }}</label>
                                        <input type="text" class="form-control form-control-solid @error('national_id') is-invalid @enderror"
                                               name="national_id" value="{{ old('national_id') }}" />
                                        @error('national_id')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <!--end::Col-->
                                    <!--begin::Col-->
                                    <div class="col-md-6 fv-row">
                                        <label class="required fs-6 fw-semibold mb-2">{{ __('employees.national_id_issue_place') }}</label>
                                        <input type="text" class="form-control form-control-solid @error('national_id_issue_place') is-invalid @enderror"
                                               name="national_id_issue_place" value="{{ old('national_id_issue_place') }}" />
                                        @error('national_id_issue_place')
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
                                        <label class="required fs-6 fw-semibold mb-2">{{ __('employees.national_id_issue_date') }}</label>
                                        <input type="date" class="form-control form-control-solid @error('national_id_issue_date') is-invalid @enderror"
                                               name="national_id_issue_date" value="{{ old('national_id_issue_date') }}" />
                                        @error('national_id_issue_date')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <!--end::Col-->
                                    <!--begin::Col-->
                                    <div class="col-md-6 fv-row">
                                        <label class="required fs-6 fw-semibold mb-2">{{ __('employees.national_id_expiry_date') }}</label>
                                        <input type="date" class="form-control form-control-solid @error('national_id_expiry_date') is-invalid @enderror"
                                               name="national_id_expiry_date" value="{{ old('national_id_expiry_date') }}" />
                                        @error('national_id_expiry_date')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <!--end::Col-->
                                </div>
                                <!--end::Row-->
                            </div>
                            <!--end::Col-->
                        </div>
                        <!--end::Identity Section - Saudi-->

                        <!--begin::Identity Section - Expat-->
                        <div class="row mb-8" id="expat_identity_section" style="display: none;">
                            <!--begin::Col-->
                            <div class="col-xl-3">
                                <div class="fs-6 fw-semibold mt-2 mb-3">{{ __('employees.identity_information_expat') }}</div>
                            </div>
                            <!--end::Col-->
                            <!--begin::Col-->
                            <div class="col-xl-9 fv-row">
                                <!--begin::Row-->
                                <div class="row g-9 mb-8">
                                    <!--begin::Col-->
                                    <div class="col-md-6 fv-row">
                                        <label class="required fs-6 fw-semibold mb-2">{{ __('employees.iqama_number') }}</label>
                                        <input type="text" class="form-control form-control-solid @error('iqama_number') is-invalid @enderror"
                                               name="iqama_number" value="{{ old('iqama_number') }}" />
                                        @error('iqama_number')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <!--end::Col-->
                                    <!--begin::Col-->
                                    <div class="col-md-6 fv-row">
                                        <label class="fs-6 fw-semibold mb-2">{{ __('employees.border_number') }}</label>
                                        <input type="text" class="form-control form-control-solid @error('border_number') is-invalid @enderror"
                                               name="border_number" value="{{ old('border_number') }}" />
                                        @error('border_number')
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
                                        <label class="required fs-6 fw-semibold mb-2">{{ __('employees.iqama_issue_date') }}</label>
                                        <input type="date" class="form-control form-control-solid @error('iqama_issue_date') is-invalid @enderror"
                                               name="iqama_issue_date" value="{{ old('iqama_issue_date') }}" />
                                        @error('iqama_issue_date')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <!--end::Col-->
                                    <!--begin::Col-->
                                    <div class="col-md-6 fv-row">
                                        <label class="required fs-6 fw-semibold mb-2">{{ __('employees.iqama_expiry_date') }}</label>
                                        <input type="date" class="form-control form-control-solid @error('iqama_expiry_date') is-invalid @enderror"
                                               name="iqama_expiry_date" value="{{ old('iqama_expiry_date') }}" />
                                        @error('iqama_expiry_date')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <!--end::Col-->
                                </div>
                                <!--end::Row-->
                                <!--begin::Row-->
                                <div class="row g-9">
                                    <!--begin::Col-->
                                    <div class="col-md-4 fv-row">
                                        <label class="required fs-6 fw-semibold mb-2">{{ __('employees.passport_number') }}</label>
                                        <input type="text" class="form-control form-control-solid @error('passport_number') is-invalid @enderror"
                                               name="passport_number" value="{{ old('passport_number') }}" />
                                        @error('passport_number')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <!--end::Col-->
                                    <!--begin::Col-->
                                    <div class="col-md-4 fv-row">
                                        <label class="required fs-6 fw-semibold mb-2">{{ __('employees.passport_issue_date') }}</label>
                                        <input type="date" class="form-control form-control-solid @error('passport_issue_date') is-invalid @enderror"
                                               name="passport_issue_date" value="{{ old('passport_issue_date') }}" />
                                        @error('passport_issue_date')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <!--end::Col-->
                                    <!--begin::Col-->
                                    <div class="col-md-4 fv-row">
                                        <label class="required fs-6 fw-semibold mb-2">{{ __('employees.passport_expiry_date') }}</label>
                                        <input type="date" class="form-control form-control-solid @error('passport_expiry_date') is-invalid @enderror"
                                               name="passport_expiry_date" value="{{ old('passport_expiry_date') }}" />
                                        @error('passport_expiry_date')
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
                                        <label class="required fs-6 fw-semibold mb-2">{{ __('employees.passport_issue_place') }}</label>
                                        <input type="text" class="form-control form-control-solid @error('passport_issue_place') is-invalid @enderror"
                                               name="passport_issue_place" value="{{ old('passport_issue_place') }}" />
                                        @error('passport_issue_place')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <!--end::Col-->
                                    <!--begin::Col-->
                                    <div class="col-md-6 fv-row">
                                        <!-- Empty column for spacing -->
                                    </div>
                                    <!--end::Col-->
                                </div>
                                <!--end::Row-->
                            </div>
                            <!--end::Col-->
                        </div>
                        <!--end::Identity Section - Expat-->

                        <!--begin::Address Section-->
                        <div class="row mb-8">
                            <!--begin::Col-->
                            <div class="col-xl-3">
                                <div class="fs-6 fw-semibold mt-2 mb-3">{{ __('employees.address_information') }}</div>
                            </div>
                            <!--end::Col-->
                            <!--begin::Col-->
                            <div class="col-xl-9 fv-row">
                                <!--begin::Row-->
                                <div class="row g-9 mb-8">
                                    <!--begin::Col-->
                                    <div class="col-md-6 fv-row">
                                        <label class="required fs-6 fw-semibold mb-2">{{ __('employees.region') }}</label>
                                        <input type="text" class="form-control form-control-solid @error('region') is-invalid @enderror"
                                               name="region" value="{{ old('region') }}" />
                                        @error('region')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <!--end::Col-->
                                    <!--begin::Col-->
                                    <div class="col-md-6 fv-row">
                                        <label class="required fs-6 fw-semibold mb-2">{{ __('employees.city') }}</label>
                                        <input type="text" class="form-control form-control-solid @error('city') is-invalid @enderror"
                                               name="city" value="{{ old('city') }}" />
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
                                        <label class="required fs-6 fw-semibold mb-2">{{ __('employees.district') }}</label>
                                        <input type="text" class="form-control form-control-solid @error('district') is-invalid @enderror"
                                               name="district" value="{{ old('district') }}" />
                                        @error('district')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <!--end::Col-->
                                    <!--begin::Col-->
                                    <div class="col-md-6 fv-row">
                                        <label class="required fs-6 fw-semibold mb-2">{{ __('employees.street') }}</label>
                                        <input type="text" class="form-control form-control-solid @error('street') is-invalid @enderror"
                                               name="street" value="{{ old('street') }}" />
                                        @error('street')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <!--end::Col-->
                                </div>
                                <!--end::Row-->
                                <!--begin::Row-->
                                <div class="row g-9">
                                    <!--begin::Col-->
                                    <div class="col-md-4 fv-row">
                                        <label class="fs-6 fw-semibold mb-2">{{ __('employees.building_number') }}</label>
                                        <input type="text" class="form-control form-control-solid @error('building_number') is-invalid @enderror"
                                               name="building_number" value="{{ old('building_number') }}" />
                                        @error('building_number')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <!--end::Col-->
                                    <!--begin::Col-->
                                    <div class="col-md-4 fv-row">
                                        <label class="fs-6 fw-semibold mb-2">{{ __('employees.postal_code') }}</label>
                                        <input type="text" class="form-control form-control-solid @error('postal_code') is-invalid @enderror"
                                               name="postal_code" value="{{ old('postal_code') }}" />
                                        @error('postal_code')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <!--end::Col-->
                                    <!--begin::Col-->
                                    <div class="col-md-4 fv-row">
                                        <label class="fs-6 fw-semibold mb-2">{{ __('employees.pobox') }}</label>
                                        <input type="text" class="form-control form-control-solid @error('pobox') is-invalid @enderror"
                                               name="pobox" value="{{ old('pobox') }}" />
                                        @error('pobox')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <!--end::Col-->
                                </div>
                                <!--end::Row-->
                            </div>
                            <!--end::Col-->
                        </div>
                        <!--end::Address Section-->

                        <!--begin::Row-->
                        <div class="row mb-8">
                            <!--begin::Col-->
                            <div class="col-xl-3">
                                <div class="fs-6 fw-semibold mt-2 mb-3">{{ __('employees.contact_information') }}</div>
                            </div>
                            <!--end::Col-->
                            <!--begin::Col-->
                            <div class="col-xl-9 fv-row">
                                <!--begin::Row-->
                                <div class="row g-9">
                                    <!--begin::Col-->
                                    <div class="col-md-4 fv-row">
                                        <label class="required fs-6 fw-semibold mb-2">{{ __('employees.primary_mobile') }}</label>
                                        <input type="text" class="form-control form-control-solid @error('primary_mobile') is-invalid @enderror"
                                               name="primary_mobile" value="{{ old('primary_mobile') }}" />
                                        @error('primary_mobile')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <!--end::Col-->
                                    <!--begin::Col-->
                                    <div class="col-md-4 fv-row">
                                        <label class="fs-6 fw-semibold mb-2">{{ __('employees.secondary_mobile') }}</label>
                                        <input type="text" class="form-control form-control-solid @error('secondary_mobile') is-invalid @enderror"
                                               name="secondary_mobile" value="{{ old('secondary_mobile') }}" />
                                        @error('secondary_mobile')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <!--end::Col-->
                                    <!--begin::Col-->
                                    <div class="col-md-4 fv-row">
                                        <label class="fs-6 fw-semibold mb-2">{{ __('employees.email') }}</label>
                                        <input type="email" class="form-control form-control-solid @error('email') is-invalid @enderror"
                                               name="email" value="{{ old('email') }}" />
                                        @error('email')
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
                                <div class="fs-6 fw-semibold mt-2 mb-3">{{ __('employees.job_information') }}</div>
                            </div>
                            <!--end::Col-->
                            <!--begin::Col-->
                            <div class="col-xl-9 fv-row">
                                <!--begin::Row-->
                                <div class="row g-9 mb-8">
                                    <!--begin::Col-->
                                    <div class="col-md-6 fv-row">
                                        <label class="required fs-6 fw-semibold mb-2">{{ __('employees.job_title') }}</label>
                                        <input type="text" class="form-control form-control-solid @error('job_title') is-invalid @enderror"
                                               name="job_title" value="{{ old('job_title') }}" />
                                        @error('job_title')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <!--end::Col-->
                                    <!--begin::Col-->
                                    <div class="col-md-6 fv-row">
                                        <label class="required fs-6 fw-semibold mb-2">{{ __('employees.contract_type') }}</label>
                                        <select class="form-select form-select-solid @error('contract_type') is-invalid @enderror" name="contract_type">
                                            <option value="">{{ __('employees.select_contract_type') }}</option>
                                            <option value="permanent" @selected(old('contract_type') == 'permanent')>{{ __('employees.permanent') }}</option>
                                            <option value="temporary" @selected(old('contract_type') == 'temporary')>{{ __('employees.temporary') }}</option>
                                            <option value="part_time" @selected(old('contract_type') == 'part_time')>{{ __('employees.part_time') }}</option>
                                            <option value="contract" @selected(old('contract_type') == 'contract')>{{ __('employees.contract') }}</option>
                                        </select>
                                        @error('contract_type')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <!--end::Col-->
                                </div>
                                <!--end::Row-->
                                <!--begin::Row-->
                                <div class="row g-9">
                                    <!--begin::Col-->
                                    <div class="col-md-4 fv-row">
                                        <label class="required fs-6 fw-semibold mb-2">{{ __('employees.hire_date') }}</label>
                                        <input type="date" class="form-control form-control-solid @error('hire_date') is-invalid @enderror"
                                               name="hire_date" value="{{ old('hire_date') }}" />
                                        @error('hire_date')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <!--end::Col-->
                                    <!--begin::Col-->
                                    <div class="col-md-4 fv-row">
                                        <label class="required fs-6 fw-semibold mb-2">{{ __('employees.basic_salary_sar') }}</label>
                                        <input type="number" min="0" step="0.01" class="form-control form-control-solid @error('basic_salary') is-invalid @enderror"
                                               name="basic_salary" value="{{ old('basic_salary') }}" />
                                        @error('basic_salary')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <!--end::Col-->
                                    <!--begin::Col-->
                                    <div class="col-md-4 fv-row">
                                        <label class="fs-6 fw-semibold mb-2">{{ __('employees.allowances_sar') }}</label>
                                        <input type="number" min="0" step="0.01" class="form-control form-control-solid @error('allowances') is-invalid @enderror"
                                               name="allowances" value="{{ old('allowances', 0) }}" />
                                        @error('allowances')
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
                                        <label class="fs-6 fw-semibold mb-2">{{ __('employees.status') }}</label>
                                        <select class="form-select form-select-solid @error('status') is-invalid @enderror" name="status">
                                            <option value="active" @selected(old('status', 'active') == 'active')>{{ __('employees.active') }}</option>
                                            <option value="inactive" @selected(old('status', 'active') == 'inactive')>{{ __('employees.inactive') }}</option>
                                            <option value="terminated" @selected(old('status', 'active') == 'terminated')>{{ __('employees.terminated') }}</option>
                                            <option value="on_leave" @selected(old('status', 'active') == 'on_leave')>{{ __('employees.on_leave') }}</option>
                                        </select>
                                        @error('status')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <!--end::Col-->
                                    <!--begin::Col-->
                                    <div class="col-md-6 fv-row">
                                        <!-- Empty column for spacing -->
                                    </div>
                                    <!--end::Col-->
                                </div>
                                <!--end::Row-->
                            </div>
                            <!--end::Col-->
                        </div>
                        <!--end::Row-->

                        <!--begin::Insurance Section-->
                        <div class="row mb-8">
                            <!--begin::Col-->
                            <div class="col-xl-3">
                                <div class="fs-6 fw-semibold mt-2 mb-3">{{ __('employees.social_insurance') }}</div>
                            </div>
                            <!--end::Col-->
                            <!--begin::Col-->
                            <div class="col-xl-9 fv-row">
                                <!--begin::Row-->
                                <div class="row g-9">
                                    <!--begin::Col-->
                                    <div class="col-md-4 fv-row">
                                        <label class="fs-6 fw-semibold mb-2">{{ __('employees.gosi_number') }}</label>
                                        <input type="text" class="form-control form-control-solid @error('gosi_number') is-invalid @enderror"
                                               name="gosi_number" value="{{ old('gosi_number') }}" />
                                        @error('gosi_number')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <!--end::Col-->
                                    <!--begin::Col-->
                                    <div class="col-md-4 fv-row">
                                        <label class="fs-6 fw-semibold mb-2">{{ __('employees.medical_insurance_number') }}</label>
                                        <input type="text" class="form-control form-control-solid @error('medical_insurance_number') is-invalid @enderror"
                                               name="medical_insurance_number" value="{{ old('medical_insurance_number') }}" />
                                        @error('medical_insurance_number')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <!--end::Col-->
                                    <!--begin::Col-->
                                    <div class="col-md-4 fv-row">
                                        <label class="fs-6 fw-semibold mb-2">{{ __('employees.saned_number') }}</label>
                                        <input type="text" class="form-control form-control-solid @error('saned_number') is-invalid @enderror"
                                               name="saned_number" value="{{ old('saned_number') }}" />
                                        @error('saned_number')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <!--end::Col-->
                                </div>
                                <!--end::Row-->
                            </div>
                            <!--end::Col-->
                        </div>
                        <!--end::Insurance Section-->
                    </div>
                    <!--end::Card body-->

                    <!--begin::Card footer-->
                    <div class="card-footer d-flex justify-content-end py-6 px-9">
                        <a href="{{ route('admin.companies.show', $company) }}" class="btn btn-light btn-active-light-primary me-2">
                            @lang('common.cancel')
                        </a>
                        <button type="submit" class="btn btn-primary" id="kt_employee_submit">
                            <span class="indicator-label">{{ __('employees.save_employee') }}</span>
                            <span class="indicator-progress">{{ __('common.please_wait') }}
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
var KTEmployeeCreate = function () {
    // Elements
    var form;
    var submitButton;
    var employeeTypeSelect;

    // Private functions
    var initEmployeeTypeHandler = function () {
        employeeTypeSelect.addEventListener('change', function () {
            var selectedType = this.value;
            var saudiSection = document.getElementById('saudi_identity_section');
            var expatSection = document.getElementById('expat_identity_section');

            // Hide both sections initially
            saudiSection.style.display = 'none';
            expatSection.style.display = 'none';

            if (selectedType === 'saudi') {
                saudiSection.style.display = 'block';
                // Clear expat fields and make them not required
                clearSectionFields(expatSection);
                toggleFieldRequirements(expatSection, false);
                toggleFieldRequirements(saudiSection, true);
            } else if (selectedType === 'expat') {
                expatSection.style.display = 'block';
                // Clear saudi fields and make them not required
                clearSectionFields(saudiSection);
                toggleFieldRequirements(saudiSection, false);
                toggleFieldRequirements(expatSection, true);
            } else {
                // No type selected, clear both sections and make fields not required
                clearSectionFields(saudiSection);
                clearSectionFields(expatSection);
                toggleFieldRequirements(saudiSection, false);
                toggleFieldRequirements(expatSection, false);
            }
        });

        // Trigger change event on page load if value is set
        if (employeeTypeSelect.value) {
            employeeTypeSelect.dispatchEvent(new Event('change'));
        }

        // Also check for old values from form validation errors
        var oldType = '{{ old("type") }}';
        if (oldType && oldType !== '') {
            employeeTypeSelect.value = oldType;
            employeeTypeSelect.dispatchEvent(new Event('change'));
        } else {
            // If no type is selected, ensure both sections are hidden
            var saudiSection = document.getElementById('saudi_identity_section');
            var expatSection = document.getElementById('expat_identity_section');
            saudiSection.style.display = 'none';
            expatSection.style.display = 'none';
        }
    }

    var clearSectionFields = function (section) {
        var inputs = section.querySelectorAll('input');
        inputs.forEach(function (input) {
            input.value = '';
        });
    }

    var toggleFieldRequirements = function (section, isRequired) {
        var inputs = section.querySelectorAll('input');
        var labels = section.querySelectorAll('label');

        labels.forEach(function (label) {
            if (isRequired) {
                label.classList.add('required');
            } else {
                label.classList.remove('required');
            }
        });
    }

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
            form = document.querySelector('#kt_employee_form');
            submitButton = document.querySelector('#kt_employee_submit');
            employeeTypeSelect = document.querySelector('#employee_type');

            if (!form) {
                return;
            }

            if (!employeeTypeSelect) {
                return;
            }

            initEmployeeTypeHandler();
            handleSubmit();
        }
    }
}();

// On document ready
KTUtil.onDOMContentLoaded(function () {
    KTEmployeeCreate.init();
});
</script>
@endpush
