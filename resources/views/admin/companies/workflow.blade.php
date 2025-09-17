@extends('admin.layouts.master')

@section('title', __('companies.company_setup_workflow'))

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
                    {{ __('companies.company_setup_workflow') }}
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
                    <li class="breadcrumb-item text-muted">{{ $company->company_name_en }}</li>
                    <li class="breadcrumb-item">
                        <span class="bullet bg-gray-400 w-5px h-2px"></span>
                    </li>
                    <li class="breadcrumb-item text-muted">{{ __('companies.workflow') }}</li>
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
                    <div class="card-title">
                        <h2>{{ $company->company_name_en }} - {{ __('companies.setup_progress') }}</h2>
                    </div>
                    <!--end::Card title-->
                </div>
                <!--end::Card header-->

                <!--begin::Card body-->
                <div class="card-body">
                    <!--begin::Stepper-->
                    <div class="stepper stepper-pills stepper-column d-flex flex-column flex-xl-row flex-row-fluid gap-10" id="kt_create_account_stepper">
                        <!--begin::Aside-->
                        <div class="card d-flex justify-content-center justify-content-xl-start flex-row-auto w-100 w-xl-300px w-xxl-400px">
                            <div class="card-body px-6 px-lg-10 px-xxl-15 py-20">
                                <!--begin::Nav-->
                                <div class="stepper-nav">
                                    <!--begin::Step 1-->
                                    <div class="stepper-item @if($currentStep >= 1) current @endif" data-kt-stepper-element="nav">
                                        <div class="stepper-wrapper">
                                            <div class="stepper-icon w-40px h-40px">
                                                @if($currentStep > 1)
                                                    <i class="fa-solid fa-check fs-2 stepper-check text-white" style="display: block"></i>
                                                @else
                                                    <span class="stepper-number">1</span>
                                                @endif
                                            </div>
                                            <div class="stepper-label">
                                                <h3 class="stepper-title">{{ __('companies.company_information') }}</h3>
                                                <div class="stepper-desc fw-semibold">{{ __('companies.basic_company_details') }}</div>
                                            </div>
                                        </div>
                                        <div class="stepper-line h-40px"></div>
                                    </div>
                                    <!--end::Step 1-->

                                    <!--begin::Step 2-->
                                    <div class="stepper-item @if($currentStep >= 2) current @endif" data-kt-stepper-element="nav">
                                        <div class="stepper-wrapper">
                                            <div class="stepper-icon w-40px h-40px">
                                                @if($currentStep > 2)
                                                    <i class="fa-solid fa-check fs-2 stepper-check text-white" style="display: block"></i>
                                                @else
                                                    <span class="stepper-number">2</span>
                                                @endif
                                            </div>
                                            <div class="stepper-label">
                                                <h3 class="stepper-title">{{ __('companies.company_documents') }}</h3>
                                                <div class="stepper-desc fw-semibold">{{ __('companies.upload_licenses_registrations') }}</div>
                                            </div>
                                        </div>
                                        <div class="stepper-line h-40px"></div>
                                    </div>
                                    <!--end::Step 2-->

                                    <!--begin::Step 3-->
                                    <div class="stepper-item @if($currentStep >= 3) current @endif" data-kt-stepper-element="nav">
                                        <div class="stepper-wrapper">
                                            <div class="stepper-icon w-40px h-40px">
                                                @if($currentStep > 3)
                                                    <i class="fa-solid fa-check fs-2 stepper-check text-white" style="display: block"></i>
                                                @else
                                                    <span class="stepper-number">3</span>
                                                @endif
                                            </div>
                                            <div class="stepper-label">
                                                <h3 class="stepper-title">{{ __('common.employees') }}</h3>
                                                <div class="stepper-desc fw-semibold">{{ __('companies.register_company_employees') }}</div>
                                            </div>
                                        </div>
                                        <div class="stepper-line h-40px"></div>
                                    </div>
                                    <!--end::Step 3-->

                                    <!--begin::Step 4-->
                                    <div class="stepper-item @if($currentStep >= 4) current @endif" data-kt-stepper-element="nav">
                                        <div class="stepper-wrapper">
                                            <div class="stepper-icon w-40px h-40px">
                                                @if($currentStep > 4)
                                                    <i class="fa-solid fa-check fs-2 stepper-check text-white" style="display: block"></i>
                                                @else
                                                    <span class="stepper-number">4</span>
                                                @endif
                                            </div>
                                            <div class="stepper-label">
                                                <h3 class="stepper-title">{{ __('companies.employee_documents') }}</h3>
                                                <div class="stepper-desc fw-semibold">{{ __('companies.upload_employee_documents') }}</div>
                                            </div>
                                        </div>
                                        <div class="stepper-line h-40px"></div>
                                    </div>
                                    <!--end::Step 4-->

                                    <!--begin::Step 5-->
                                    <div class="stepper-item @if($currentStep >= 5) current @endif" data-kt-stepper-element="nav">
                                        <div class="stepper-wrapper">
                                            <div class="stepper-icon w-40px h-40px">
                                                @if($currentStep >= 5)
                                                    <i class="fa-solid fa-check fs-2 stepper-check text-white" style="display: block"></i>
                                                @else
                                                    <span class="stepper-number">5</span>
                                                @endif
                                            </div>
                                            <div class="stepper-label">
                                                <h3 class="stepper-title">{{ __('common.complete') }}</h3>
                                                <div class="stepper-desc fw-semibold">{{ __('companies.setup_completed') }}</div>
                                            </div>
                                        </div>
                                    </div>
                                    <!--end::Step 5-->
                                </div>
                                <!--end::Nav-->
                            </div>
                        </div>
                        <!--end::Aside-->

                        <!--begin::Content-->
                        <div class="card d-flex flex-row-fluid flex-center">
                            <div class="card-body py-20 w-100 mw-xl-700px px-9">
                                <!--begin::Form-->
                                <form class="my-auto pb-5" novalidate="novalidate" id="kt_create_account_form">

                                    @switch($currentStep)
                                        @case(1)
                                            <!--begin::Step 1-->
                                            <div class="current" data-kt-stepper-element="content">
                                                <div class="w-100">
                                                    <!--begin::Heading-->
                                                    <div class="pb-10 pb-lg-15">
                                                        <h2 class="fw-bold text-dark">{{ __('companies.company_information') }}</h2>
                                                        <div class="text-muted fw-semibold fs-6">{{ __('companies.basic_company_details_added') }}</div>
                                                    </div>
                                                    <!--end::Heading-->

                                                    <!--begin::Company info display-->
                                                    <div class="d-flex flex-column gap-7 gap-lg-10">
                                                        <div class="row g-9">
                                                            <div class="col-md-6">
                                                                <label class="fs-6 fw-semibold mb-2">{{ __('companies.company_name_ar') }}</label>
                                                                <div class="form-control form-control-solid">{{ $company->company_name_ar }}</div>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <label class="fs-6 fw-semibold mb-2">{{ __('companies.company_name_en') }}</label>
                                                                <div class="form-control form-control-solid">{{ $company->company_name_en }}</div>
                                                            </div>
                                                        </div>
                                                        <div class="row g-9">
                                                            <div class="col-md-6">
                                                                <label class="fs-6 fw-semibold mb-2">{{ __('companies.cr_number') }}</label>
                                                                <div class="form-control form-control-solid">{{ $company->cr_number }}</div>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <label class="fs-6 fw-semibold mb-2">{{ __('companies.company_type') }}</label>
                                                                <div class="form-control form-control-solid">{{ $company->company_type }}</div>
                                                            </div>
                                                        </div>
                                                        <div class="row g-9">
                                                            <div class="col-md-6">
                                                                <label class="fs-6 fw-semibold mb-2">{{ __('companies.city') }}</label>
                                                                <div class="form-control form-control-solid">{{ $company->city }}</div>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <label class="fs-6 fw-semibold mb-2">{{ __('companies.region') }}</label>
                                                                <div class="form-control form-control-solid">{{ $company->region }}</div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <!--end::Company info display-->
                                                </div>
                                            </div>
                                            <!--end::Step 1-->
                                            @break

                                        @case(2)
                                            <!--begin::Step 2-->
                                            <div class="current" data-kt-stepper-element="content">
                                                <div class="w-100">
                                                    <!--begin::Heading-->
                                                    <div class="pb-10 pb-lg-15">
                                                        <h2 class="fw-bold text-dark">{{ __('companies.upload_company_documents') }}</h2>
                                                        <div class="text-muted fw-semibold fs-6">{{ __('companies.upload_required_licenses') }}</div>
                                                    </div>
                                                    <!--end::Heading-->

                                                    <!--begin::Documents checklist-->
                                                    <div class="d-flex flex-column gap-7 gap-lg-10">
                                                        <!--begin::Civil Defense License-->
                                                        <div class="card card-flush py-4">
                                                            <div class="card-header">
                                                                <div class="card-title">
                                                                    <h2>{{ __('companies.civil_defense_license') }}</h2>
                                                                </div>
                                                                <div class="card-toolbar">
                                                                    @if($company->civilDefenseLicenses->count() > 0)
                                                                        <span class="badge badge-light-success">{{ __('Uploaded') }}</span>
                                                                    @else
                                                                        @if(auth()->user()->can(\App\Enums\PermissionEnum::CREATE_COMPANY_DOCUMENTS->value))
                                                                        <a href="{{ route('admin.companies.civil-defense-licenses.create', $company) }}" class="btn btn-sm btn-primary">{{ __('companies.add_license') }}</a>
                                                                        @endif
                                                                    @endif
                                                                </div>
                                                            </div>
                                                            @if($company->civilDefenseLicenses->count() > 0)
                                                                <div class="card-body pt-0">
                                                                    @foreach($company->civilDefenseLicenses as $license)
                                                                        <div class="d-flex align-items-center mb-3">
                                                                            <i class="fas fa-shield-alt fs-3 text-success me-3"></i>
                                                                            <div class="flex-grow-1">
                                                                                <div class="fw-bold">{{ __('companies.license_number') }}{{ $license->license_number }}</div>
                                                                                <div class="text-muted">{{ __('companies.expires') }}: {{ $license->expiry_date->format('Y-m-d') }}</div>
                                                                            </div>
                                                                        </div>
                                                                    @endforeach
                                                                </div>
                                                            @endif
                                                        </div>
                                                        <!--end::Civil Defense License-->

                                                        <!--begin::Municipality License-->
                                                        <div class="card card-flush py-4">
                                                            <div class="card-header">
                                                                <div class="card-title">
                                                                    <h2>{{ __('companies.municipality_license') }}</h2>
                                                                </div>
                                                                <div class="card-toolbar">
                                                                    @if($company->municipalityLicenses->count() > 0)
                                                                        <span class="badge badge-light-success">{{ __('Uploaded') }}</span>
                                                                    @else
                                                                        @if(auth()->user()->can(\App\Enums\PermissionEnum::CREATE_COMPANY_DOCUMENTS->value))
                                                                        <a href="{{ route('admin.companies.municipality-licenses.create', $company) }}" class="btn btn-sm btn-primary">{{ __('companies.add_license') }}</a>
                                                                        @endif
                                                                    @endif
                                                                </div>
                                                            </div>
                                                            @if($company->municipalityLicenses->count() > 0)
                                                                <div class="card-body pt-0">
                                                                    @foreach($company->municipalityLicenses as $license)
                                                                        <div class="d-flex align-items-center mb-3">
                                                                            <i class="fas fa-building fs-3 text-success me-3"></i>
                                                                            <div class="flex-grow-1">
                                                                                <div class="fw-bold">{{ __('companies.license_number') }}{{ $license->license_number }}</div>
                                                                                <div class="text-muted">{{ __('companies.expires') }}: {{ $license->expiry_date->format('Y-m-d') }}</div>
                                                                            </div>
                                                                        </div>
                                                                    @endforeach
                                                                </div>
                                                            @endif
                                                        </div>
                                                        <!--end::Municipality License-->

                                                        <!--begin::Branch Registration-->
                                                        <div class="card card-flush py-4">
                                                            <div class="card-header">
                                                                <div class="card-title">
                                                                    <h2>{{ __('companies.branch_commercial_registration') }}</h2>
                                                                </div>
                                                                <div class="card-toolbar">
                                                                    @if($company->branchCommercialRegistrations->count() > 0)
                                                                        <span class="badge badge-light-success">{{ __('Uploaded') }}</span>
                                                                    @else
                                                                        @if(auth()->user()->can(\App\Enums\PermissionEnum::CREATE_COMPANY_DOCUMENTS->value))
                                                                        <a href="{{ route('admin.companies.branch-registrations.create', $company) }}" class="btn btn-sm btn-primary">{{ __('companies.add_registration') }}</a>
                                                                        @endif
                                                                    @endif
                                                                </div>
                                                            </div>
                                                            @if($company->branchCommercialRegistrations->count() > 0)
                                                                <div class="card-body pt-0">
                                                                    @foreach($company->branchCommercialRegistrations as $registration)
                                                                        <div class="d-flex align-items-center mb-3">
                                                                            <i class="fas fa-file-alt fs-3 text-success me-3"></i>
                                                                            <div class="flex-grow-1">
                                                                                <div class="fw-bold">{{ __('companies.registration_number') }}{{ $registration->branch_reg_number }}</div>
                                                                                <div class="text-muted">{{ __('companies.expires') }}: {{ $registration->expiry_date->format('Y-m-d') }}</div>
                                                                            </div>
                                                                        </div>
                                                                    @endforeach
                                                                </div>
                                                            @endif
                                                        </div>
                                                        <!--end::Branch Registration-->

                                                        <!--begin::Additional Documents-->
                                                        <div class="card card-flush py-4">
                                                            <div class="card-header">
                                                                <div class="card-title">
                                                                    <h2>{{ __('companies.additional_documents') }}</h2>
                                                                </div>
                                                                <div class="card-toolbar">
                                                                    @if($company->companyDocuments->count() > 0)
                                                                        <span class="badge badge-light-success">{{ $company->companyDocuments->count() }} {{ __('companies.documents_uploaded') }}</span>
                                                                    @else
                                                                        <span class="badge badge-light-warning">{{ __('companies.no_additional_documents') }}</span>
                                                                    @endif
                                                                </div>
                                                            </div>
                                                            <div class="card-body pt-0">
                                                                <div class="d-flex justify-content-between align-items-center">
                                                                    <div>
                                                                        <div class="fw-bold text-gray-800">{{ __('companies.other_company_documents') }}</div>
                                                                        <div class="text-muted fs-7">{{ __('companies.add_other_documents_description') }}</div>
                                                                    </div>
                                                                    <a href="{{ route('admin.companies.documents.create', $company) }}" class="btn btn-sm btn-primary">
                                                                        <i class="fa-solid fa-plus fs-4 me-1"></i>{{ __('companies.add_document') }}
                                                                    </a>
                                                                </div>
                                                                @if($company->companyDocuments->count() > 0)
                                                                    <div class="mt-5">
                                                                        @foreach($company->companyDocuments->take(3) as $document)
                                                                            <div class="d-flex align-items-center mb-3">
                                                                                <i class="fa-solid fa-file-circle-check fs-3 text-success me-3"></i>
                                                                                <div class="flex-grow-1">
                                                                                    <div class="fw-bold">{{ app()->getLocale() === 'ar' ? $document->documentType->name_ar : $document->documentType->name_en }}</div>
                                                                                    <div class="text-muted fs-7">{{ $document->getCustomFieldValue('document_number') ?? __('common.n_a') }}</div>
                                                                                </div>
                                                                                <a href="{{ route('admin.companies.documents.show', [$company, $document]) }}" class="btn btn-sm btn-light">{{ __('common.view') }}</a>
                                                                            </div>
                                                                        @endforeach
                                                                        @if($company->companyDocuments->count() > 1)
                                                                            <div class="text-center">
                                                                                <a href="{{ route('admin.companies.documents.index', $company) }}" class="btn btn-sm btn-light-primary">
                                                                                    {{ __('companies.view_all_documents') }} ({{ $company->companyDocuments->count() - 3 }} {{ __('common.more') }})
                                                                                </a>
                                                                            </div>
                                                                        @endif
                                                                    </div>
                                                                @endif
                                                            </div>
                                                        </div>
                                                        <!--end::Additional Documents-->

                                                    </div>
                                                    <!--end::Documents checklist-->
                                                </div>
                                            </div>
                                            <!--end::Step 2-->
                                            @break

                                        @case(3)
                                            <!--begin::Step 3-->
                                            <div class="current" data-kt-stepper-element="content">
                                                <div class="w-100">
                                                    <!--begin::Heading-->
                                                    <div class="pb-10 pb-lg-15">
                                                        <h2 class="fw-bold text-dark">{{ __('common.employees') }}</h2>
                                                        <div class="text-muted fw-semibold fs-6">{{ __('companies.register_employees_company') }}</div>
                                                    </div>
                                                    <!--end::Heading-->

                                                    <!--begin::Employees list-->
                                                    <div class="d-flex flex-column gap-7 gap-lg-10">
                                                        @if($company->employees->count() > 0)
                                                            @foreach($company->employees as $employee)
                                                                <div class="card card-flush py-4">
                                                                    <div class="card-body d-flex align-items-center">
                                                                        <i class="fas fa-user fs-3 text-primary me-3"></i>
                                                                        <div class="flex-grow-1">
                                                                            <div class="fw-bold">{{ $employee->full_name_en }}</div>
                                                                            <div class="text-muted">{{ $employee->job_title }} - {{ ucfirst($employee->type) }}</div>
                                                                        </div>
                                                                        <span class="badge badge-light-success">{{ __('companies.added') }}</span>
                                                                    </div>
                                                                </div>
                                                            @endforeach
                                                        @endif

                                                        <div class="card card-flush py-4 border-dashed border-primary">
                                                            <div class="card-body text-center">
                                                                <i class="fas fa-user-plus fs-3x text-primary mb-4"></i>
                                                                <h3 class="text-gray-800 fw-bold mb-3">{{ __('companies.add_more_employees') }}</h3>
                                                                <p class="text-gray-600 mb-5">{{ __('companies.add_employees_manage_info') }}</p>
                                                                @if(auth()->user()->can(\App\Enums\PermissionEnum::CREATE_CLIENT_EMPLOYEES->value))
                                                                <a href="{{ route('admin.companies.employees.create', $company) }}" class="btn btn-primary">{{ __('common.add_employee') }}</a>
                                                                @endif
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <!--end::Employees list-->
                                                </div>
                                            </div>
                                            <!--end::Step 3-->
                                            @break

                                        @case(4)
                                            <!--begin::Step 4-->
                                            <div class="current" data-kt-stepper-element="content">
                                                <div class="w-100">
                                                    <!--begin::Heading-->
                                                    <div class="pb-10 pb-lg-15">
                                                        <h2 class="fw-bold text-dark">{{ __('companies.employee_documents') }}</h2>
                                                        <div class="text-muted fw-semibold fs-6">{{ __('companies.upload_required_employee_docs') }}</div>
                                                    </div>
                                                    <!--end::Heading-->

                                                    <!--begin::Employee documents status-->
                                                    <div class="d-flex flex-column gap-7 gap-lg-10">
                                                        @forelse($company->employees as $employee)
                                                            <div class="card card-flush py-4">
                                                                <div class="card-header">
                                                                    <div class="card-title">
                                                                        <h3>{{ $employee->full_name_en }}</h3>
                                                                    </div>
                                                                    <div class="card-toolbar">
                                                                        @if($employee->documents->count() > 0)
                                                                            <span class="badge badge-light-success">{{ $employee->documents->count() }} {{ __('common.documents') }}</span>
                                                                        @else
                                                                            @if(auth()->user()->can(\App\Enums\PermissionEnum::CREATE_CLIENT_EMPLOYEES->value))
                                                                            <a href="{{ route('admin.employees.documents.create', $employee) }}" class="btn btn-sm btn-primary">{{ __('companies.add_documents') }}</a>
                                                                            @endif
                                                                        @endif
                                                                    </div>
                                                                </div>
                                                                @if($employee->documents->count() > 0)
                                                                    <div class="card-body pt-0">
                                                                        @foreach($employee->documents as $document)
                                                                            <div class="d-flex align-items-center mb-3">
                                                                                <i class="fas fa-file-alt fs-3 text-success me-3"></i>
                                                                                <div class="flex-grow-1">
                                                                                    <div class="fw-bold">{{ $document->documentType->name_en }}</div>
                                                                                    <div class="text-muted">{{ $document->document_number }}</div>
                                                                                </div>
                                                                            </div>
                                                                        @endforeach
                                                                    </div>
                                                                @endif
                                                            </div>
                                                        @empty
                                                            <div class="card card-flush py-4 border-dashed border-warning">
                                                                <div class="card-body text-center">
                                                                    <i class="fas fa-info-circle fs-3x text-warning mb-4"></i>
                                                                    <h3 class="text-gray-800 fw-bold mb-3">{{ __('companies.no_employees_added') }}</h3>
                                                                    <p class="text-gray-600 mb-5">{{ __('companies.add_employees_first') }}</p>
                                                                    @if(auth()->user()->can(\App\Enums\PermissionEnum::CREATE_CLIENT_EMPLOYEES->value))
                                                                    <a href="{{ route('admin.companies.employees.create', $company) }}" class="btn btn-warning">{{ __('common.add_employee') }}</a>
                                                                    @endif
                                                                </div>
                                                            </div>
                                                        @endforelse
                                                    </div>
                                                    <!--end::Employee documents status-->
                                                </div>
                                            </div>
                                            <!--end::Step 4-->
                                            @break

                                        @default
                                            <!--begin::Step 5 - Complete-->
                                            <div class="current" data-kt-stepper-element="content">
                                                <div class="w-100">
                                                    <!--begin::Heading-->
                                                    <div class="pb-10 pb-lg-15 text-center">
                                                        <h1 class="fw-bold text-success">{{ __('companies.setup_complete') }}</h1>
                                                        <div class="text-muted fw-semibold fs-6">{{ __('companies.company_setup_completed') }}</div>
                                                    </div>
                                                    <!--end::Heading-->

                                                    <!--begin::Summary-->
                                                    <div class="d-flex flex-column gap-7 gap-lg-10">
                                                        <div class="card card-flush py-4">
                                                            <div class="card-body">
                                                                <div class="row text-center g-9">
                                                                    <div class="col-md-3">
                                                                        <div class="fw-bold fs-1 text-primary">1</div>
                                                                        <div class="text-muted">{{ __('common.company') }}</div>
                                                                    </div>
                                                                    <div class="col-md-3">
                                                                        <div class="fw-bold fs-1 text-success">{{ $company->civilDefenseLicenses->count() + $company->municipalityLicenses->count() + $company->branchCommercialRegistrations->count() }}</div>
                                                                        <div class="text-muted">{{ __('common.documents') }}</div>
                                                                    </div>
                                                                    <div class="col-md-3">
                                                                        <div class="fw-bold fs-1 text-info">{{ $company->employees->count() }}</div>
                                                                        <div class="text-muted">{{ __('common.employees') }}</div>
                                                                    </div>
                                                                    <div class="col-md-3">
                                                                        <div class="fw-bold fs-1 text-warning">{{ $company->employees->sum(function($emp) { return $emp->documents->count(); }) }}</div>
                                                                        <div class="text-muted">{{ __('companies.employee_documents') }}</div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <!--end::Summary-->
                                                </div>
                                            </div>
                                            <!--end::Step 5-->
                                    @endswitch
                                </form>
                                <!--end::Form-->

                                <!--begin::Actions-->
                                <div class="d-flex flex-stack pt-15">
                                    <div class="mr-2">
                                        @if($currentStep > 1)
                                            <a href="{{ route('admin.companies.show', $company) }}" class="btn btn-lg btn-light-primary me-3">
                                                <i class="fas fa-arrow-left fs-4 me-1"></i>{{ __('companies.view_company') }}
                                            </a>
                                        @endif
                                    </div>
                                    <div>
                                        @switch($currentStep)
                                            @case(2)
                                                @if($company->civilDefenseLicenses->count() > 0 || $company->municipalityLicenses->count() > 0 || $company->branchCommercialRegistrations->count() > 0)
                                                    <form action="{{ route('admin.companies.workflow-step', $company) }}" method="POST" style="display: inline;">
                                                        @csrf
                                                        <input type="hidden" name="step" value="employees">
                                                        <button type="submit" class="btn btn-lg btn-primary">
                                                            {{ __('companies.continue_to_employees') }}
                                                            <i class="fas fa-arrow-right fs-4 ms-1"></i>
                                                        </button>
                                                    </form>
                                                @endif
                                                @break
                                            @case(3)
                                                @if($company->employees->count() > 0)
                                                    <form action="{{ route('admin.companies.workflow-step', $company) }}" method="POST" style="display: inline;">
                                                        @csrf
                                                        <input type="hidden" name="step" value="documents">
                                                        <button type="submit" class="btn btn-lg btn-primary">
                                                            {{ __('companies.continue_to_documents') }}
                                                            <i class="fas fa-arrow-right fs-4 ms-1"></i>
                                                        </button>
                                                    </form>
                                                @endif
                                                @break
                                            @case(4)
                                                @if($company->employees()->whereHas('documents')->count() > 0)
                                                    <form action="{{ route('admin.companies.workflow-step', $company) }}" method="POST" style="display: inline;">
                                                        @csrf
                                                        <input type="hidden" name="step" value="complete">
                                                        <button type="submit" class="btn btn-lg btn-success">
                                                            {{ __('companies.complete_setup') }}
                                                            <i class="fa-solid fa-check fs-4 ms-1" style="display: block">
                                                                <span class="path1"></span>
                                                                <span class="path2"></span>
                                                            </i>
                                                        </button>
                                                    </form>
                                                @endif
                                                @break
                                            @default
                                                <a href="{{ route('admin.companies.show', $company) }}" class="btn btn-lg btn-success">
                                                    {{ __('companies.view_company_details') }}
                                                    <i class="ki-duotone ki-arrow-right fs-4 ms-1">
                                                        <span class="path1"></span>
                                                        <span class="path2"></span>
                                                    </i>
                                                </a>
                                        @endswitch
                                    </div>
                                </div>
                                <!--end::Actions-->
                            </div>
                        </div>
                        <!--end::Content-->
                    </div>
                    <!--end::Stepper-->
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
