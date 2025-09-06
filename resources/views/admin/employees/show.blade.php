@extends('admin.layouts.master')

@section('title', $employee->full_name_en)

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
                    {{ $employee->full_name_en }}
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
                        <a href="{{ route('admin.companies.show', $employee->company) }}" class="text-muted text-hover-primary">{{ $employee->company->company_name_en }}</a>
                    </li>
                    <li class="breadcrumb-item">
                        <span class="bullet bg-gray-400 w-5px h-2px"></span>
                    </li>
                    <li class="breadcrumb-item text-muted">
                        <a href="{{ route('admin.employees.index') }}" class="text-muted text-hover-primary">@lang('common.employees')</a>
                    </li>
                    <li class="breadcrumb-item">
                        <span class="bullet bg-gray-400 w-5px h-2px"></span>
                    </li>
                    <li class="breadcrumb-item text-muted">{{ $employee->full_name_en }}</li>
                </ul>
                <!--end::Breadcrumb-->
            </div>
            <!--end::Page title-->
            <!--begin::Actions-->
            <div class="d-flex align-items-center gap-2 gap-lg-3">
                <a href="{{ route('admin.employees.documents.create', $employee) }}" class="btn btn-sm fw-bold btn-success">
                    <i class="ki-duotone ki-document fs-2"></i>{{ __('employees.add_document') }}
                </a>
                <a href="{{ route('admin.employees.edit', $employee) }}" class="btn btn-sm fw-bold btn-primary">
                    <i class="ki-duotone ki-pencil fs-2"></i>@lang('employees.edit_employee')
                </a>
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

            <!--begin::Layout-->
            <div class="d-flex flex-column flex-xl-row">
                <!--begin::Sidebar-->
                <div class="flex-column flex-lg-row-auto w-100 w-xl-350px mb-10">
                    <!--begin::Card-->
                    <div class="card mb-5 mb-xl-8">
                        <!--begin::Card body-->
                        <div class="card-body pt-15">
                            <!--begin::Summary-->
                            <div class="d-flex flex-center flex-column mb-5">
                                <!--begin::Avatar-->
                                <div class="symbol symbol-100px symbol-circle mb-7">
                                    <div class="symbol-label fs-3 bg-light-{{ $employee->type == 'saudi' ? 'success' : 'primary' }} text-{{ $employee->type == 'saudi' ? 'success' : 'primary' }}">
                                        {{ substr($employee->full_name_en, 0, 2) }}
                                    </div>
                                </div>
                                <!--end::Avatar-->
                                <!--begin::Name-->
                                <a href="#" class="fs-3 text-gray-800 text-hover-primary fw-bold mb-1">{{ $employee->full_name_en }}</a>
                                <!--end::Name-->
                                <!--begin::Position-->
                                <div class="fs-5 fw-semibold text-muted mb-6">{{ $employee->full_name_ar }}</div>
                                <!--end::Position-->
                                <!--begin::Info-->
                                <div class="d-flex flex-wrap flex-center">
                                    <!--begin::Stats-->
                                    <div class="border border-gray-300 border-dashed rounded py-3 px-3 mb-3">
                                        <div class="fs-4 fw-bold text-gray-700">
                                            <span class="w-75px">{{ $employee->documents->count() }}</span>
                                            <i class="ki-duotone ki-document fs-3 text-primary">
                                                <span class="path1"></span>
                                                <span class="path2"></span>
                                            </i>
                                        </div>
                                        <div class="fw-semibold text-muted">@lang('common.documents')</div>
                                    </div>
                                    <!--end::Stats-->
                                </div>
                                <!--end::Info-->
                            </div>
                            <!--end::Summary-->
                            <!--begin::Details toggle-->
                            <div class="d-flex flex-stack fs-4 py-3">
                                <div class="fw-bold rotate collapsible" data-bs-toggle="collapse" href="#kt_employee_view_details" role="button" aria-expanded="false" aria-controls="kt_employee_view_details">{{ __('employees.details') }}
                                    <span class="ms-2 rotate-180">
                                        <i class="ki-duotone ki-down fs-3"></i>
                                    </span>
                                </div>
                            </div>
                            <!--end::Details toggle-->
                            <div class="separator separator-dashed my-3"></div>
                            <!--begin::Details content-->
                            <div id="kt_employee_view_details" class="collapse show">
                                <div class="py-5 fs-6">
                                    <!--begin::Details item-->
                                    <div class="fw-bold mt-5">{{ __('employees.type') }}</div>
                                    <div class="text-gray-600">
                                        @if($employee->type == 'saudi')
                                            <span class="badge badge-light-success">{{ __('employees.saudi') }}</span>
                                        @else
                                            <span class="badge badge-light-primary">{{ __('employees.expat') }}</span>
                                        @endif
                                    </div>
                                    <!--end::Details item-->
                                    <!--begin::Details item-->
                                    <div class="fw-bold mt-5">{{ __('employees.nationality') }}</div>
                                    <div class="text-gray-600">{{ $employee->nationality }}</div>
                                    <!--end::Details item-->
                                    <!--begin::Details item-->
                                    <div class="fw-bold mt-5">{{ __('employees.job_title') }}</div>
                                    <div class="text-gray-600">{{ $employee->job_title }}</div>
                                    <!--end::Details item-->
                                    <!--begin::Details item-->
                                    <div class="fw-bold mt-5">{{ __('common.company') }}</div>
                                    <div class="text-gray-600">
                                        <a href="{{ route('admin.companies.show', $employee->company) }}" class="text-gray-600 text-hover-primary">{{ $employee->company->company_name_en }}</a>
                                    </div>
                                    <!--end::Details item-->
                                    <!--begin::Details item-->
                                    <div class="fw-bold mt-5">{{ __('employees.primary_mobile') }}</div>
                                    <div class="text-gray-600">{{ $employee->primary_mobile ?? __('common.na') }}</div>
                                    <!--end::Details item-->
                                    <!--begin::Details item-->
                                    <div class="fw-bold mt-5">{{ __('employees.email') }}</div>
                                    <div class="text-gray-600">
                                        @if($employee->email)
                                            <a href="mailto:{{ $employee->email }}" class="text-gray-600 text-hover-primary">{{ $employee->email }}</a>
                                        @else
                                            {{ __('common.na') }}
                                        @endif
                                    </div>
                                    <!--end::Details item-->
                                </div>
                            </div>
                            <!--end::Details content-->
                        </div>
                        <!--end::Card body-->
                    </div>
                    <!--end::Card-->
                </div>
                <!--end::Sidebar-->

                <!--begin::Content-->
                <div class="flex-lg-row-fluid ms-lg-15">
                    <!--begin:::Tabs-->
                    <ul class="nav nav-custom nav-tabs nav-line-tabs nav-line-tabs-2x border-0 fs-4 fw-semibold mb-8">
                        <!--begin:::Tab item-->
                        <li class="nav-item">
                            <a class="nav-link text-active-primary pb-4 active" data-bs-toggle="tab" href="#kt_employee_view_overview_tab">{{ __('employees.overview') }}</a>
                        </li>
                        <!--end:::Tab item-->
                        <!--begin:::Tab item-->
                        <li class="nav-item">
                            <a class="nav-link text-active-primary pb-4" data-bs-toggle="tab" href="#kt_employee_view_documents_tab">@lang('common.documents')</a>
                        </li>
                        <!--end:::Tab item-->
                        <!--begin:::Tab item-->
                        <li class="nav-item">
                            <a class="nav-link text-active-primary pb-4" data-bs-toggle="tab" href="#kt_employee_view_employment_tab">{{ __('employees.employment') }}</a>
                        </li>
                        <!--end:::Tab item-->
                    </ul>
                    <!--end:::Tabs-->

                    <!--begin:::Tab content-->
                    <div class="tab-content" id="myTabContent">
                        <!--begin:::Tab pane-->
                        <div class="tab-pane fade show active" id="kt_employee_view_overview_tab" role="tabpanel">
                            <!--begin::Card-->
                            <div class="card pt-4 mb-6 mb-xl-9">
                                <!--begin::Card header-->
                                <div class="card-header border-0">
                                    <!--begin::Card title-->
                                    <div class="card-title">
                                        <h2>{{ __('employees.personal_information') }}</h2>
                                    </div>
                                    <!--end::Card title-->
                                </div>
                                <!--end::Card header-->
                                <!--begin::Card body-->
                                <div class="card-body pt-0 pb-5">
                                    <!--begin::Table wrapper-->
                                    <div class="table-responsive">
                                        <!--begin::Table-->
                                        <table class="table align-middle table-row-dashed gy-5">
                                            <tbody class="fs-6 fw-semibold text-gray-600">
                                                <tr>
                                                    <td class="text-muted">{{ __('employees.full_name_ar') }}</td>
                                                    <td class="fw-bold text-end">{{ $employee->full_name_ar }}</td>
                                                </tr>
                                                <tr>
                                                    <td class="text-muted">{{ __('employees.full_name_en') }}</td>
                                                    <td class="fw-bold text-end">{{ $employee->full_name_en }}</td>
                                                </tr>
                                                <tr>
                                                    <td class="text-muted">{{ __('employees.type') }}</td>
                                                    <td class="fw-bold text-end">
                                                        @if($employee->type == 'saudi')
                                                            <span class="badge badge-light-success">{{ __('employees.saudi') }}</span>
                                                        @else
                                                            <span class="badge badge-light-primary">{{ __('employees.expat') }}</span>
                                                        @endif
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td class="text-muted">{{ __('employees.nationality') }}</td>
                                                    <td class="fw-bold text-end">{{ $employee->nationality }}</td>
                                                </tr>
                                                <tr>
                                                    <td class="text-muted">{{ __('employees.dob_greg') }}</td>
                                                    <td class="fw-bold text-end">{{ $employee->dob_greg?->format('Y-m-d') ?? __('common.na') }}</td>
                                                </tr>
                                                <tr>
                                                    <td class="text-muted">{{ __('employees.dob_hijri') }}</td>
                                                    <td class="fw-bold text-end">{{ $employee->dob_hijri ?? __('common.na') }}</td>
                                                </tr>
                                                <tr>
                                                    <td class="text-muted">{{ __('employees.pob') }}</td>
                                                    <td class="fw-bold text-end">{{ $employee->pob ?? __('common.na') }}</td>
                                                </tr>
                                                <tr>
                                                    <td class="text-muted">{{ __('employees.gender') }}</td>
                                                    <td class="fw-bold text-end">{{ $employee->gender ? ucfirst($employee->gender) : __('common.na') }}</td>
                                                </tr>
                                                <tr>
                                                    <td class="text-muted">{{ __('employees.marital_status') }}</td>
                                                    <td class="fw-bold text-end">{{ $employee->marital_status ? ucfirst($employee->marital_status) : __('common.na') }}</td>
                                                </tr>
                                                <tr>
                                                    <td class="text-muted">{{ __('employees.religion') }}</td>
                                                    <td class="fw-bold text-end">{{ $employee->religion ?? __('common.na') }}</td>
                                                </tr>
                                                <tr>
                                                    <td class="text-muted">{{ __('employees.education') }}</td>
                                                    <td class="fw-bold text-end">{{ $employee->education ?? __('common.na') }}</td>
                                                </tr>
                                                <tr>
                                                    <td class="text-muted">{{ __('employees.specialization') }}</td>
                                                    <td class="fw-bold text-end">{{ $employee->specialization ?? __('common.na') }}</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                        <!--end::Table-->
                                    </div>
                                    <!--end::Table wrapper-->
                                </div>
                                <!--end::Card body-->
                            </div>
                            <!--end::Card-->

                            <!--begin::Identity Card-->
                            <div class="card pt-4 mb-6 mb-xl-9">
                                <!--begin::Card header-->
                                <div class="card-header border-0">
                                    <!--begin::Card title-->
                                    <div class="card-title">
                                        <h2>{{ __('employees.identity_information') }}</h2>
                                    </div>
                                    <!--end::Card title-->
                                </div>
                                <!--end::Card header-->
                                <!--begin::Card body-->
                                <div class="card-body pt-0 pb-5">
                                    <!--begin::Table wrapper-->
                                    <div class="table-responsive">
                                        <!--begin::Table-->
                                        <table class="table align-middle table-row-dashed gy-5">
                                            <tbody class="fs-6 fw-semibold text-gray-600">
                                                @if($employee->type == 'saudi')
                                                    <tr>
                                                        <td class="text-muted">{{ __('employees.national_id') }}</td>
                                                        <td class="fw-bold text-end">{{ $employee->national_id ?? __('common.na') }}</td>
                                                    </tr>
                                                    <tr>
                                                        <td class="text-muted">{{ __('employees.national_id_issue_date') }}</td>
                                                        <td class="fw-bold text-end">{{ $employee->national_id_issue_date?->format('Y-m-d') ?? __('N/A') }}</td>
                                                    </tr>
                                                    <tr>
                                                        <td class="text-muted">{{ __('employees.national_id_expiry_date') }}</td>
                                                        <td class="fw-bold text-end">{{ $employee->national_id_expiry_date?->format('Y-m-d') ?? __('N/A') }}</td>
                                                    </tr>
                                                @else
                                                    <tr>
                                                        <td class="text-muted">{{ __('employees.iqama_number') }}</td>
                                                        <td class="fw-bold text-end">{{ $employee->iqama_number ?? __('common.na') }}</td>
                                                    </tr>
                                                    <tr>
                                                        <td class="text-muted">{{ __('employees.iqama_issue_date') }}</td>
                                                        <td class="fw-bold text-end">{{ $employee->iqama_issue_date?->format('Y-m-d') ?? __('common.na') }}</td>
                                                    </tr>
                                                    <tr>
                                                        <td class="text-muted">{{ __('employees.iqama_expiry_date') }}</td>
                                                        <td class="fw-bold text-end">{{ $employee->iqama_expiry_date?->format('Y-m-d') ?? __('common.na') }}</td>
                                                    </tr>
                                                    <tr>
                                                        <td class="text-muted">{{ __('employees.border_number') }}</td>
                                                        <td class="fw-bold text-end">{{ $employee->border_number ?? __('common.na') }}</td>
                                                    </tr>
                                                    <tr>
                                                        <td class="text-muted">{{ __('employees.passport_number') }}</td>
                                                        <td class="fw-bold text-end">{{ $employee->passport_number ?? __('common.na') }}</td>
                                                    </tr>
                                                    <tr>
                                                        <td class="text-muted">{{ __('employees.passport_issue_date') }}</td>
                                                        <td class="fw-bold text-end">{{ $employee->passport_issue_date?->format('Y-m-d') ?? __('common.na') }}</td>
                                                    </tr>
                                                    <tr>
                                                        <td class="text-muted">{{ __('employees.passport_expiry_date') }}</td>
                                                        <td class="fw-bold text-end">{{ $employee->passport_expiry_date?->format('Y-m-d') ?? __('common.na') }}</td>
                                                    </tr>
                                                @endif
                                            </tbody>
                                        </table>
                                        <!--end::Table-->
                                    </div>
                                    <!--end::Table wrapper-->
                                </div>
                                <!--end::Card body-->
                            </div>
                            <!--end::Identity Card-->

                            <!--begin::Contact Card-->
                            <div class="card pt-4 mb-6 mb-xl-9">
                                <!--begin::Card header-->
                                <div class="card-header border-0">
                                    <!--begin::Card title-->
                                    <div class="card-title">
                                        <h2>{{ __('employees.contact_address') }}</h2>
                                    </div>
                                    <!--end::Card title-->
                                </div>
                                <!--end::Card header-->
                                <!--begin::Card body-->
                                <div class="card-body pt-0 pb-5">
                                    <!--begin::Table wrapper-->
                                    <div class="table-responsive">
                                        <!--begin::Table-->
                                        <table class="table align-middle table-row-dashed gy-5">
                                            <tbody class="fs-6 fw-semibold text-gray-600">
                                                <tr>
                                                    <td class="text-muted">{{ __('employees.primary_mobile') }}</td>
                                                    <td class="fw-bold text-end">{{ $employee->primary_mobile ?? __('common.na') }}</td>
                                                </tr>
                                                <tr>
                                                    <td class="text-muted">{{ __('employees.secondary_mobile') }}</td>
                                                    <td class="fw-bold text-end">{{ $employee->secondary_mobile ?? __('common.na') }}</td>
                                                </tr>
                                                <tr>
                                                    <td class="text-muted">{{ __('employees.email') }}</td>
                                                    <td class="fw-bold text-end">{{ $employee->email ?? __('common.na') }}</td>
                                                </tr>
                                                <tr>
                                                    <td class="text-muted">{{ __('employees.address') }}</td>
                                                    <td class="fw-bold text-end">
                                                        @if($employee->street || $employee->district || $employee->city || $employee->region)
                                                            {{ $employee->street }}, {{ $employee->district }}, {{ $employee->city }}, {{ $employee->region }}
                                                        @else
                                                            {{ __('common.na') }}
                                                        @endif
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td class="text-muted">{{ __('employees.pobox') }}</td>
                                                    <td class="fw-bold text-end">{{ $employee->pobox ?? __('N/A') }}</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                        <!--end::Table-->
                                    </div>
                                    <!--end::Table wrapper-->
                                </div>
                                <!--end::Card body-->
                            </div>
                            <!--end::Contact Card-->
                        </div>
                        <!--end:::Tab pane-->

                        <!--begin:::Tab pane-->
                        <div class="tab-pane fade" id="kt_employee_view_employment_tab" role="tabpanel">
                            <!--begin::Employment Card-->
                            <div class="card pt-4 mb-6 mb-xl-9">
                                <!--begin::Card header-->
                                <div class="card-header border-0">
                                    <!--begin::Card title-->
                                    <div class="card-title">
                                        <h2>{{ __('employees.employment_information') }}</h2>
                                    </div>
                                    <!--end::Card title-->
                                </div>
                                <!--end::Card header-->
                                <!--begin::Card body-->
                                <div class="card-body pt-0 pb-5">
                                    <!--begin::Table wrapper-->
                                    <div class="table-responsive">
                                        <!--begin::Table-->
                                        <table class="table align-middle table-row-dashed gy-5">
                                            <tbody class="fs-6 fw-semibold text-gray-600">
                                                <tr>
                                                    <td class="text-muted">{{ __('employees.job_title') }}</td>
                                                    <td class="fw-bold text-end">{{ $employee->job_title }}</td>
                                                </tr>
                                                <tr>
                                                    <td class="text-muted">{{ __('employees.hire_date') }}</td>
                                                    <td class="fw-bold text-end">{{ $employee->hire_date?->format('Y-m-d') ?? __('common.na') }}</td>
                                                </tr>
                                                <tr>
                                                    <td class="text-muted">{{ __('employees.contract_type') }}</td>
                                                    <td class="fw-bold text-end">{{ $employee->contract_type ? ucfirst($employee->contract_type) : __('common.na') }}</td>
                                                </tr>
                                                <tr>
                                                    <td class="text-muted">{{ __('employees.basic_salary') }}</td>
                                                    <td class="fw-bold text-end">{{ $employee->basic_salary ? number_format($employee->basic_salary, 2) . ' SAR' : __('common.na') }}</td>
                                                </tr>
                                                <tr>
                                                    <td class="text-muted">{{ __('employees.housing_allowance') }}</td>
                                                    <td class="fw-bold text-end">{{ $employee->housing_allowance ? number_format($employee->housing_allowance, 2) . ' SAR' : __('common.na') }}</td>
                                                </tr>
                                                <tr>
                                                    <td class="text-muted">{{ __('employees.transportation_allowance') }}</td>
                                                    <td class="fw-bold text-end">{{ $employee->transportation_allowance ? number_format($employee->transportation_allowance, 2) . ' SAR' : __('common.na') }}</td>
                                                </tr>
                                                <tr>
                                                    <td class="text-muted">{{ __('employees.food_allowance') }}</td>
                                                    <td class="fw-bold text-end">{{ $employee->food_allowance ? number_format($employee->food_allowance, 2) . ' SAR' : __('common.na') }}</td>
                                                </tr>
                                                <tr>
                                                    <td class="text-muted">{{ __('employees.other_allowances') }}</td>
                                                    <td class="fw-bold text-end">{{ $employee->other_allowances ? number_format($employee->other_allowances, 2) . ' SAR' : __('common.na') }}</td>
                                                </tr>
                                                <tr class="border-top">
                                                    <td class="text-muted fw-bold">{{ __('employees.total_monthly_salary') }}</td>
                                                    <td class="fw-bold text-end text-primary fs-5">
                                                        {{ number_format($employee->totalSalary, 2) }} SAR
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                        <!--end::Table-->
                                    </div>
                                    <!--end::Table wrapper-->
                                </div>
                                <!--end::Card body-->
                            </div>
                            <!--end::Employment Card-->

                            <!--begin::Insurance Card-->
                            <div class="card pt-4 mb-6 mb-xl-9">
                                <!--begin::Card header-->
                                <div class="card-header border-0">
                                    <!--begin::Card title-->
                                    <div class="card-title">
                                        <h2>{{ __('employees.insurance_information') }}</h2>
                                    </div>
                                    <!--end::Card title-->
                                </div>
                                <!--end::Card header-->
                                <!--begin::Card body-->
                                <div class="card-body pt-0 pb-5">
                                    <!--begin::Table wrapper-->
                                    <div class="table-responsive">
                                        <!--begin::Table-->
                                        <table class="table align-middle table-row-dashed gy-5">
                                            <tbody class="fs-6 fw-semibold text-gray-600">
                                                <tr>
                                                    <td class="text-muted">{{ __('employees.gosi_number') }}</td>
                                                    <td class="fw-bold text-end">{{ $employee->gosi_number ?? __('common.na') }}</td>
                                                </tr>
                                                <tr>
                                                    <td class="text-muted">{{ __('employees.medical_insurance_number') }}</td>
                                                    <td class="fw-bold text-end">{{ $employee->medical_insurance_number ?? __('common.na') }}</td>
                                                </tr>
                                                <tr>
                                                    <td class="text-muted">{{ __('employees.saned_number') }}</td>
                                                    <td class="fw-bold text-end">{{ $employee->saned_number ?? __('common.na') }}</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                        <!--end::Table-->
                                    </div>
                                    <!--end::Table wrapper-->
                                </div>
                                <!--end::Card body-->
                            </div>
                            <!--end::Insurance Card-->
                        </div>
                        <!--end:::Tab pane-->

                        <!--begin:::Tab pane-->
                        <div class="tab-pane fade" id="kt_employee_view_documents_tab" role="tabpanel">
                            <!--begin::Card-->
                            <div class="card pt-4 mb-6 mb-xl-9">
                                <!--begin::Card header-->
                                <div class="card-header border-0">
                                    <!--begin::Card title-->
                                    <div class="card-title">
                                        <h2>{{ __('employees.employee_documents') }}</h2>
                                    </div>
                                    <!--end::Card title-->
                                    <!--begin::Card toolbar-->
                                    <div class="card-toolbar">
                                        <a href="{{ route('admin.employees.documents.create', $employee) }}" class="btn btn-sm btn-primary">{{ __('employees.add_document') }}</a>
                                    </div>
                                    <!--end::Card toolbar-->
                                </div>
                                <!--end::Card header-->
                                <!--begin::Card body-->
                                <div class="card-body pt-0">
                                    @forelse($employee->documents as $document)
                                        <div class="card card-flush mb-3">
                                            <div class="card-body d-flex align-items-center justify-content-between py-5">
                                                <div class="d-flex align-items-center">
                                                    <div class="symbol symbol-50px">
                                                        <div class="symbol-label fs-6 fw-bold bg-light-info text-info">
                                                            <i class="ki-duotone ki-document fs-2">
                                                                <span class="path1"></span>
                                                                <span class="path2"></span>
                                                            </i>
                                                        </div>
                                                    </div>
                                                    <div class="ms-5">
                                                        <div class="fw-bold text-gray-800">
                                                            {{ app()->getLocale() === 'ar' ? $document->documentType->name_ar : $document->documentType->name_en }}
                                                        </div>
                                                        @php
                                                            $documentNumber = $document->getCustomFieldValue('document_number');
                                                            $expiryDate = $document->getCustomFieldValue('expiry_date');
                                                        @endphp
                                                        @if($documentNumber)
                                                            <div class="text-muted">{{ __('employees.number') }}: {{ $documentNumber }}</div>
                                                        @endif
                                                        @if($expiryDate)
                                                            <div class="text-muted">
                                                                {{ __('employees.expires') }}: {{ \Carbon\Carbon::parse($expiryDate)->format('Y-m-d') }}
                                                                @if($document->isExpiringSoon)
                                                                    <span class="badge badge-light-warning ms-2">{{ __('employees.expiring_soon') }}</span>
                                                                @elseif($document->isExpired)
                                                                    <span class="badge badge-light-danger ms-2">{{ __('employees.expired') }}</span>
                                                                @endif
                                                            </div>
                                                        @endif
                                                    </div>
                                                </div>
                                                <div class="d-flex">
                                                    @switch($document->status)
                                                        @case('active')
                                                            <span class="badge badge-light-success">{{ __('common.active') }}</span>
                                                            @break
                                                        @case('expired')
                                                            <span class="badge badge-light-danger">{{ __('employees.expired') }}</span>
                                                            @break
                                                        @case('cancelled')
                                                            <span class="badge badge-light-secondary">{{ __('employees.cancelled') }}</span>
                                                            @break
                                                        @case('pending')
                                                            <span class="badge badge-light-warning">{{ __('employees.pending') }}</span>
                                                            @break
                                                    @endswitch
                                                    <a href="{{ route('admin.employees.documents.show', [$employee, $document]) }}" class="btn btn-sm btn-light me-2 ms-3">{{ __('employees.view') }}</a>
                                                    <a href="{{ route('admin.employees.documents.edit', [$employee, $document]) }}" class="btn btn-sm btn-primary">{{ __('employees.edit') }}</a>
                                                </div>
                                            </div>
                                        </div>
                                    @empty
                                        <div class="notice d-flex bg-light-primary rounded border-primary border border-dashed p-6">
                                            <div class="d-flex flex-stack flex-grow-1">
                                                <div class="fw-semibold">
                                                    <div class="fs-6 text-gray-700">{{ __('employees.no_documents_found') }}</div>
                                                </div>
                                            </div>
                                        </div>
                                    @endforelse
                                </div>
                                <!--end::Card body-->
                            </div>
                            <!--end::Card-->
                        </div>
                        <!--end:::Tab pane-->
                    </div>
                    <!--end:::Tab content-->
                </div>
                <!--end::Content-->
            </div>
            <!--end::Layout-->
        </div>
        <!--end::Content container-->
    </div>
    <!--end::Content-->
</div>
<!--end::Content wrapper-->
@endsection
