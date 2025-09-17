@extends('admin.layouts.master')

@section('title', __('packages.package_details'))

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
                    {{ $package->name }}
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
                    <li class="breadcrumb-item text-muted">{{ __('packages.package_details') }}</li>
                </ul>
                <!--end::Breadcrumb-->
            </div>
            <!--end::Page title-->
            <!--begin::Actions-->
            <div class="d-flex align-items-center gap-2 gap-lg-3">
                @can('update_financial_packages')
                <a href="{{ route('admin.packages.edit', $package) }}" class="btn btn-sm fw-bold btn-primary">
                    <i class="fas fa-edit fs-2"></i>{{ __('packages.edit') }}
                </a>
                @endcan
                <a href="{{ route('admin.packages.index') }}" class="btn btn-sm fw-bold btn-secondary">
                    <i class="fas fa-arrow-left fs-2"></i>{{ __('packages.back') }}
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
            <!--begin::Card-->
            <div class="card">
                <!--begin::Card header-->
                <div class="card-header">
                    <div class="card-title">
                        <h2>{{ __('common.package_information') }}</h2>
                    </div>
                </div>
                <!--end::Card header-->
                <!--begin::Card body-->
                <div class="card-body pt-0">
                    <div class="row">
                        <div class="col-md-3">
                            <!--begin::Input group-->
                            <div class="mb-5">
                                <label class="form-label fw-bold">{{ __('packages.name') }}</label>
                                <div class="form-control-plaintext">{{ $package->name }}</div>
                            </div>
                            <!--end::Input group-->

                            <!--begin::Input group-->
                            <div class="mb-5">
                                <label class="form-label fw-bold">{{ __('packages.price') }}</label>
                                <div class="form-control-plaintext">
                                    <span class="text-primary fw-bold fs-4">{{ number_format($package->price, 2) }} {{ __('common.currency') }}</span>
                                </div>
                            </div>
                            <!--end::Input group-->
                        </div>
                        <div class="col-md-3">
                            <!--begin::Input group-->
                            <div class="mb-5">
                                <label class="form-label fw-bold">{{ __('packages.duration') }}</label>
                                <div class="form-control-plaintext">
                                    <span class="badge badge-light-primary fs-6">{{ $package->duration }} {{ __('common.months') }}</span>
                                </div>
                            </div>
                            <!--end::Input group-->

                            <!--begin::Input group-->
                            <div class="mb-5">
                                <label class="form-label fw-bold">{{ __('packages.max_employees') }}</label>
                                <div class="form-control-plaintext">
                                    <span class="text-gray-800">{{ $package->max_employees ?? __('common.unlimited') }}</span>
                                </div>
                            </div>
                            <!--end::Input group-->
                        </div>
                        <div class="col-md-3">
                            <!--begin::Input group-->
                            <div class="mb-5">
                                <label class="form-label fw-bold">{{ __('packages.max_employee_documents') }}</label>
                                <div class="form-control-plaintext">
                                    <span class="text-gray-800">{{ $package->max_employee_documents ?? __('common.unlimited') }}</span>
                                </div>
                            </div>
                            <!--end::Input group-->

                            <!--begin::Input group-->
                            <div class="mb-5">
                                <label class="form-label fw-bold">{{ __('packages.max_company_documents') }}</label>
                                <div class="form-control-plaintext">
                                    <span class="text-gray-800">{{ $package->max_company_documents ?? __('common.unlimited') }}</span>
                                </div>
                            </div>
                            <!--end::Input group-->
                            
                            <!--begin::Input group-->
                            <div class="mb-5">
                                <label class="form-label fw-bold">{{ __('common.created_at') }}</label>
                                <div class="form-control-plaintext">{{ $package->created_at->format('M d, Y H:i') }}</div>
                            </div>
                            <!--end::Input group-->
                            
                        </div>
                        <div class="col-md-3">
                            <!--begin::Input group-->
                            <div class="mb-5">
                                <label class="form-label fw-bold">{{ __('common.total_invoices') }}</label>
                                <div class="form-control-plaintext">
                                    <span class="text-gray-800 fw-bold">{{ $package->invoices->count() }}</span>
                                </div>
                            </div>
                            <!--end::Input group-->

                            <!--begin::Input group-->
                            <div class="mb-5">
                                <label class="form-label fw-bold">{{ __('common.assigned_clients') }}</label>
                                <div class="form-control-plaintext">
                                    <span class="text-gray-800 fw-bold">{{ $package->clientPackages->count() }}</span>
                                </div>
                            </div>
                            <!--end::Input group-->
                        </div>
                    </div>

                    @if($package->description)
                    <!--begin::Input group-->
                    <div class="mb-5">
                        <label class="form-label fw-bold">{{ __('packages.description') }}</label>
                        <div class="form-control-plaintext">{{ $package->description }}</div>
                    </div>
                    <!--end::Input group-->
                    @endif
                </div>
                <!--end::Card body-->
            </div>
            <!--end::Card-->

            <!--begin::Card-->
            <div class="card mt-7">
                <!--begin::Card header-->
                <div class="card-header">
                    <div class="card-title">
                        <h2>{{ __('common.assigned_clients') }}</h2>
                    </div>
                </div>
                <!--end::Card header-->
                <!--begin::Card body-->
                <div class="card-body pt-0">
                    @if($package->clientPackages->count() > 0)
                    <div class="table-responsive">
                        <table class="table table-row-dashed table-row-gray-300 align-middle gs-0 gy-4">
                            <thead>
                                <tr class="fw-bold text-muted">
                                    <th class="min-w-150px">{{ __('common.client_name') }}</th>
                                    <th class="min-w-100px">{{ __('common.start_date') }}</th>
                                    <th class="min-w-100px">{{ __('common.end_date') }}</th>
                                    <th class="min-w-100px">{{ __('common.status') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($package->clientPackages as $clientPackage)
                                <tr>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <div class="d-flex justify-content-start flex-column">
                                                <a href="{{ route('admin.companies.show', $clientPackage->company) }}" class="text-gray-800 fw-bold text-hover-primary mb-1 fs-6">
                                                    {{ $clientPackage->company->company_name_ar ?? $clientPackage->company->company_name_en }}
                                                </a>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <span class="text-gray-800 fw-bold">{{ $clientPackage->start_date->format('M d, Y') }}</span>
                                    </td>
                                    <td>
                                        <span class="text-gray-800 fw-bold">{{ $clientPackage->end_date->format('M d, Y') }}</span>
                                    </td>
                                    <td>
                                        @if($clientPackage->isActive())
                                            <span class="badge badge-light-success">{{ __('common.active') }}</span>
                                        @elseif($clientPackage->isExpired())
                                            <span class="badge badge-light-danger">{{ __('common.expired') }}</span>
                                        @else
                                            <span class="badge badge-light-warning">{{ ucfirst($clientPackage->status) }}</span>
                                        @endif
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    @else
                    <div class="text-center py-10">
                        <div class="text-gray-600 fs-6">{{ __('common.no_clients_assigned') }}</div>
                    </div>
                    @endif
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
