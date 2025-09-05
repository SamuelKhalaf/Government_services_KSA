@extends('admin.layouts.master')

@section('title', $company->company_name_en)

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
                    {{ $company->company_name_en }}
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
                </ul>
                <!--end::Breadcrumb-->
            </div>
            <!--end::Page title-->
            <!--begin::Actions-->
            <div class="d-flex align-items-center gap-2 gap-lg-3">
                <a href="{{ route('admin.companies.workflow', $company) }}" class="btn btn-sm fw-bold btn-primary">
                    <i class="ki-duotone ki-setting-3 fs-2"></i>{{ __('companies.workflow') }}
                </a>
                <a href="{{ route('admin.companies.edit', $company) }}" class="btn btn-sm fw-bold btn-light">
                    <i class="ki-duotone ki-pencil fs-2"></i>{{ __('companies.edit_company') }}
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
                                    <div class="symbol-label fs-3 bg-light-primary text-primary">
                                        {{ substr($company->company_name_en, 0, 2) }}
                                    </div>
                                </div>
                                <!--end::Avatar-->
                                <!--begin::Name-->
                                <a href="#" class="fs-3 text-gray-800 text-hover-primary fw-bold mb-1">{{ $company->company_name_en }}</a>
                                <!--end::Name-->
                                <!--begin::Position-->
                                <div class="fs-5 fw-semibold text-muted mb-6">{{ $company->company_name_ar }}</div>
                                <!--end::Position-->
                                <!--begin::Info-->
                                <div class="d-flex flex-wrap flex-center">
                                    <!--begin::Stats-->
                                    <div class="border border-gray-300 border-dashed rounded py-3 px-3 mb-3">
                                        <div class="fs-4 fw-bold text-gray-700">
                                            <span class="w-75px">{{ $documentStats['active_employees'] }}</span>
                                            <i class="ki-duotone ki-arrow-up fs-3 text-success">
                                                <span class="path1"></span>
                                                <span class="path2"></span>
                                            </i>
                                        </div>
                                        <div class="fw-semibold text-muted">{{ __('companies.active_employees') }}</div>
                                    </div>
                                    <!--end::Stats-->
                                </div>
                                <!--end::Info-->
                            </div>
                            <!--end::Summary-->
                            <!--begin::Details toggle-->
                            <div class="d-flex flex-stack fs-4 py-3">
                                <div class="fw-bold rotate collapsible" data-bs-toggle="collapse" href="#kt_customer_view_details" role="button" aria-expanded="false" aria-controls="kt_customer_view_details">{{ __('companies.details') }}
                                    <span class="ms-2 rotate-180">
                                        <i class="ki-duotone ki-down fs-3"></i>
                                    </span>
                                </div>
                            </div>
                            <!--end::Details toggle-->
                            <div class="separator separator-dashed my-3"></div>
                            <!--begin::Details content-->
                            <div id="kt_customer_view_details" class="collapse show">
                                <div class="py-5 fs-6">
                                    <!--begin::Details item-->
                                    <div class="fw-bold mt-5">{{ __('companies.commercial_registration') }}</div>
                                    <div class="text-gray-600">{{ $company->cr_number }}</div>
                                    <!--begin::Details item-->
                                    <!--begin::Details item-->
                                    <div class="fw-bold mt-5">{{ __('companies.tax_number') }}</div>
                                    <div class="text-gray-600">{{ $company->tax_number ?? __('N/A') }}</div>
                                    <!--begin::Details item-->
                                    <!--begin::Details item-->
                                    <div class="fw-bold mt-5">{{ __('companies.company_type') }}</div>
                                    <div class="text-gray-600">{{ $company->company_type }}</div>
                                    <!--begin::Details item-->
                                    <!--begin::Details item-->
                                    <div class="fw-bold mt-5">{{ __('companies.phone') }}</div>
                                    <div class="text-gray-600">{{ $company->phone ?? __('N/A') }}</div>
                                    <!--begin::Details item-->
                                    <!--begin::Details item-->
                                    <div class="fw-bold mt-5">{{ __('companies.email') }}</div>
                                    <div class="text-gray-600">
                                        @if($company->email)
                                            <a href="mailto:{{ $company->email }}" class="text-gray-600 text-hover-primary">{{ $company->email }}</a>
                                        @else
                                            {{ __('companies.na') }}
                                        @endif
                                    </div>
                                    <!--begin::Details item-->
                                    <!--begin::Details item-->
                                    <div class="fw-bold mt-5">{{ __('companies.location') }}</div>
                                    <div class="text-gray-600">{{ $company->city }}, {{ $company->region }}</div>
                                    <!--begin::Details item-->
                                    <!--begin::Details item-->
                                    <div class="fw-bold mt-5">{{ __('common.status') }}</div>
                                    <div class="text-gray-600">
                                        @switch($company->status)
                                            @case('active')
                                                <span class="badge badge-light-success">{{ __('common.active') }}</span>
                                                @break
                                            @case('inactive')
                                                <span class="badge badge-light-secondary">{{ __('common.inactive') }}</span>
                                                @break
                                            @case('suspended')
                                                <span class="badge badge-light-danger">{{ __('companies.suspended') }}</span>
                                                @break
                                        @endswitch
                                    </div>
                                    <!--begin::Details item-->
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
                            <a class="nav-link text-active-primary pb-4 active" data-bs-toggle="tab" href="#kt_customer_view_overview_tab">{{ __('companies.overview') }}</a>
                        </li>
                        <!--end:::Tab item-->
                        <!--begin:::Tab item-->
                        <li class="nav-item">
                            <a class="nav-link text-active-primary pb-4" data-bs-toggle="tab" href="#kt_customer_view_documents_tab">{{ __('common.documents') }}</a>
                        </li>
                        <!--end:::Tab item-->
                        <!--begin:::Tab item-->
                        <li class="nav-item">
                            <a class="nav-link text-active-primary pb-4" data-bs-toggle="tab" href="#kt_customer_view_employees_tab">{{ __('common.employees') }}</a>
                        </li>
                        <!--end:::Tab item-->
                    </ul>
                    <!--end:::Tabs-->

                    <!--begin:::Tab content-->
                    <div class="tab-content" id="myTabContent">
                        <!--begin:::Tab pane-->
                        <div class="tab-pane fade show active" id="kt_customer_view_overview_tab" role="tabpanel">
                            <!--begin::Card-->
                            <div class="card pt-4 mb-6 mb-xl-9">
                                <!--begin::Card header-->
                                <div class="card-header border-0">
                                    <!--begin::Card title-->
                                    <div class="card-title">
                                        <h2>{{ __('companies.company_information') }}</h2>
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
                                                    <td class="text-muted">{{ __('companies.company_name_ar') }}</td>
                                                    <td class="fw-bold text-end">{{ $company->company_name_ar }}</td>
                                                </tr>
                                                <tr>
                                                    <td class="text-muted">{{ __('companies.company_name_en') }}</td>
                                                    <td class="fw-bold text-end">{{ $company->company_name_en }}</td>
                                                </tr>
                                                <tr>
                                                    <td class="text-muted">{{ __('companies.commercial_registration') }}</td>
                                                    <td class="fw-bold text-end">{{ $company->cr_number }}</td>
                                                </tr>
                                                <tr>
                                                    <td class="text-muted">{{ __('companies.tax_number') }}</td>
                                                    <td class="fw-bold text-end">{{ $company->tax_number ?? __('N/A') }}</td>
                                                </tr>
                                                <tr>
                                                    <td class="text-muted">{{ __('companies.owner_name') }}</td>
                                                    <td class="fw-bold text-end">{{ $company->owner_name }}</td>
                                                </tr>
                                                <tr>
                                                    <td class="text-muted">{{ __('companies.owner_nationality') }}</td>
                                                    <td class="fw-bold text-end">{{ $company->owner_nationality }}</td>
                                                </tr>
                                                <tr>
                                                    <td class="text-muted">{{ __('companies.establishment_date') }}</td>
                                                    <td class="fw-bold text-end">{{ $company->establishment_date->format('Y-m-d') }}</td>
                                                </tr>
                                                <tr>
                                                    <td class="text-muted">{{ __('companies.capital_amount') }}</td>
                                                    <td class="fw-bold text-end">{{ $company->capital_amount ? number_format($company->capital_amount, 2) . ' SAR' : __('N/A') }}</td>
                                                </tr>
                                                <tr>
                                                    <td class="text-muted">{{ __('companies.address') }}</td>
                                                    <td class="fw-bold text-end">{{ $company->street }}, {{ $company->district }}, {{ $company->city }}, {{ $company->region }}</td>
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
                        </div>
                        <!--end:::Tab pane-->

                        <!--begin:::Tab pane-->
                        <div class="tab-pane fade" id="kt_customer_view_documents_tab" role="tabpanel">
                            <!--begin::Card-->
                            <div class="card pt-4 mb-6 mb-xl-9">
                                <!--begin::Card header-->
                                <div class="card-header border-0">
                                    <!--begin::Card title-->
                                    <div class="card-title">
                                        <h2>{{ __('companies.company_documents') }}</h2>
                                    </div>
                                    <!--end::Card title-->
                                </div>
                                <!--end::Card header-->
                                <!--begin::Card body-->
                                <div class="card-body pt-0">
                                    <!--begin::Civil Defense Licenses-->
                                    <div class="mb-10">
                                        <h4 class="text-gray-800 mb-5">
                                            <i class="ki-duotone ki-shield-tick fs-2 text-success me-2">
                                                <span class="path1"></span>
                                                <span class="path2"></span>
                                            </i>{{ __('companies.civil_defense_licenses') }}
                                            <a href="{{ route('admin.companies.civil-defense-licenses.create', $company) }}" class="btn btn-sm btn-light-primary ms-3">{{ __('companies.add_license') }}</a>
                                        </h4>
                                        @forelse($company->civilDefenseLicenses as $license)
                                            <div class="card card-flush mb-3">
                                                <div class="card-body d-flex align-items-center justify-content-between py-5">
                                                    <div class="d-flex align-items-center">
                                                        <div class="ms-5">
                                                            <div class="fw-bold text-gray-800">{{ __('companies.license_number') }}{{ $license->license_number }}</div>
                                                            <div class="text-muted">{{ __('companies.expires') }}: {{ $license->expiry_date->format('Y-m-d') }}</div>
                                                            <div class="text-muted">{{ __('companies.authority') }}: {{ $license->authority }}</div>
                                                        </div>
                                                    </div>
                                                    <div class="d-flex">
                                                        <a href="{{ route('admin.companies.civil-defense-licenses.show', [$company, $license]) }}" class="btn btn-sm btn-light me-2">{{ __('companies.view') }}</a>
                                                        <a href="{{ route('admin.companies.civil-defense-licenses.edit', [$company, $license]) }}" class="btn btn-sm btn-primary">{{ __('companies.edit') }}</a>
                                                    </div>
                                                </div>
                                            </div>
                                        @empty
                                            <div class="notice d-flex bg-light-primary rounded border-primary border border-dashed p-6">
                                                <div class="d-flex flex-stack flex-grow-1">
                                                    <div class="fw-semibold">
                                                        <div class="fs-6 text-gray-700">{{ __('companies.no_civil_defense_licenses') }}</div>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforelse
                                    </div>
                                    <!--end::Civil Defense Licenses-->

                                    <!--begin::Municipality Licenses-->
                                    <div class="mb-10">
                                        <h4 class="text-gray-800 mb-5">
                                            <i class="ki-duotone ki-building fs-2 text-info me-2">
                                                <span class="path1"></span>
                                                <span class="path2"></span>
                                            </i>{{ __('companies.municipality_licenses') }}
                                            <a href="{{ route('admin.companies.municipality-licenses.create', $company) }}" class="btn btn-sm btn-light-primary ms-3">{{ __('companies.add_license') }}</a>
                                        </h4>
                                        @forelse($company->municipalityLicenses as $license)
                                            <div class="card card-flush mb-3">
                                                <div class="card-body d-flex align-items-center justify-content-between py-5">
                                                    <div class="d-flex align-items-center">
                                                        <div class="ms-5">
                                                            <div class="fw-bold text-gray-800">{{ __('companies.license_number') }}{{ $license->license_number }}</div>
                                                            <div class="text-muted">{{ __('companies.expires') }}: {{ $license->expiry_date->format('Y-m-d') }}</div>
                                                            <div class="text-muted">{{ __('companies.municipality') }}: {{ $license->municipality_name }}</div>
                                                        </div>
                                                    </div>
                                                    <div class="d-flex">
                                                        <a href="{{ route('admin.companies.municipality-licenses.show', [$company, $license]) }}" class="btn btn-sm btn-light me-2">{{ __('companies.view') }}</a>
                                                        <a href="{{ route('admin.companies.municipality-licenses.edit', [$company, $license]) }}" class="btn btn-sm btn-primary">{{ __('companies.edit') }}</a>
                                                    </div>
                                                </div>
                                            </div>
                                        @empty
                                            <div class="notice d-flex bg-light-info rounded border-info border border-dashed p-6">
                                                <div class="d-flex flex-stack flex-grow-1">
                                                    <div class="fw-semibold">
                                                        <div class="fs-6 text-gray-700">{{ __('companies.no_municipality_licenses') }}</div>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforelse
                                    </div>
                                    <!--end::Municipality Licenses-->

                                    <!--begin::Branch Registrations-->
                                    <div class="mb-10">
                                        <h4 class="text-gray-800 mb-5">
                                            <i class="ki-duotone ki-file-text fs-2 text-warning me-2">
                                                <span class="path1"></span>
                                                <span class="path2"></span>
                                            </i>{{ __('companies.branch_commercial_registrations') }}
                                            <a href="{{ route('admin.companies.branch-registrations.create', $company) }}" class="btn btn-sm btn-light-primary ms-3">{{ __('companies.add_registration') }}</a>
                                        </h4>
                                        @forelse($company->branchCommercialRegistrations as $registration)
                                            <div class="card card-flush mb-3">
                                                <div class="card-body d-flex align-items-center justify-content-between py-5">
                                                    <div class="d-flex align-items-center">
                                                        <div class="ms-5">
                                                            <div class="fw-bold text-gray-800">{{ __('companies.registration_number') }}{{ $registration->branch_reg_number }}</div>
                                                            <div class="text-muted">{{ __('companies.expires') }}: {{ $registration->expiry_date->format('Y-m-d') }}</div>
                                                            <div class="text-muted">{{ __('companies.manager') }}: {{ $registration->manager_name }}</div>
                                                        </div>
                                                    </div>
                                                    <div class="d-flex">
                                                        <a href="{{ route('admin.companies.branch-registrations.show', [$company, $registration]) }}" class="btn btn-sm btn-light me-2">{{ __('companies.view') }}</a>
                                                        <a href="{{ route('admin.companies.branch-registrations.edit', [$company, $registration]) }}" class="btn btn-sm btn-primary">{{ __('companies.edit') }}</a>
                                                    </div>
                                                </div>
                                            </div>
                                        @empty
                                            <div class="notice d-flex bg-light-warning rounded border-warning border border-dashed p-6">
                                                <div class="d-flex flex-stack flex-grow-1">
                                                    <div class="fw-semibold">
                                                        <div class="fs-6 text-gray-700">{{ __('companies.no_branch_registrations') }}</div>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforelse
                                    </div>
                                    <!--end::Branch Registrations-->
                                </div>
                                <!--end::Card body-->
                            </div>
                            <!--end::Card-->
                        </div>
                        <!--end:::Tab pane-->

                        <!--begin:::Tab pane-->
                        <div class="tab-pane fade" id="kt_customer_view_employees_tab" role="tabpanel">
                            <!--begin::Card-->
                            <div class="card pt-4 mb-6 mb-xl-9">
                                <!--begin::Card header-->
                                <div class="card-header border-0">
                                    <!--begin::Card title-->
                                    <div class="card-title">
                                        <h2>{{ __('companies.company_employees') }}</h2>
                                    </div>
                                    <!--end::Card title-->
                                    <!--begin::Card toolbar-->
                                    <div class="card-toolbar">
                                        <a href="{{ route('admin.companies.employees.create', $company) }}" class="btn btn-sm btn-primary">{{ __('common.add_employee') }}</a>
                                    </div>
                                    <!--end::Card toolbar-->
                                </div>
                                <!--end::Card header-->
                                <!--begin::Card body-->
                                <div class="card-body pt-0">
                                    @forelse($company->employees as $employee)
                                        <div class="card card-flush mb-3">
                                            <div class="card-body d-flex align-items-center justify-content-between py-5">
                                                <div class="d-flex align-items-center">
                                                    <div class="symbol symbol-50px">
                                                        <div class="symbol-label fs-6 fw-bold bg-light-primary text-primary">
                                                            {{ substr($employee->full_name_en, 0, 2) }}
                                                        </div>
                                                    </div>
                                                    <div class="ms-5">
                                                        <div class="fw-bold text-gray-800">{{ $employee->full_name_en }}</div>
                                                        <div class="text-muted">{{ $employee->full_name_ar }}</div>
                                                        <div class="text-muted">{{ $employee->job_title }} - {{ ucfirst($employee->type) }}</div>
                                                    </div>
                                                </div>
                                                <div class="d-flex">
                                                    <span class="badge badge-light-primary me-3">{{ $employee->documents->count() }} {{ __('common.documents') }}</span>
                                                    <a href="{{ route('admin.employees.show', $employee) }}" class="btn btn-sm btn-light me-2">{{ __('companies.view') }}</a>
                                                    <a href="{{ route('admin.employees.edit', $employee) }}" class="btn btn-sm btn-primary">{{ __('companies.edit') }}</a>
                                                </div>
                                            </div>
                                        </div>
                                    @empty
                                        <div class="notice d-flex bg-light-primary rounded border-primary border border-dashed p-6">
                                            <div class="d-flex flex-stack flex-grow-1">
                                                <div class="fw-semibold">
                                                    <div class="fs-6 text-gray-700">{{ __('companies.no_employees_found') }}</div>
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
