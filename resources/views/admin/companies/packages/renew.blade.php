@extends('admin.layouts.master')

@section('title', __('client_packages.renew_package') . ' - ' . $company->company_name_en)

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
                    {{ __('client_packages.renew_package') }}
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
                    <li class="breadcrumb-item text-muted">{{ __('client_packages.renew_package') }}</li>
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
            <form id="kt_renew_package_form" class="form" action="{{ route('admin.companies.packages.renew.store', [$company, $clientPackage]) }}" method="POST">
                @csrf
                @method('PUT')
                <!--begin::Card-->
                <div class="card card-flush py-4">
                    <!--begin::Card header-->
                    <div class="card-header">
                        <div class="card-title">
                            <h2>{{ __('client_packages.renew_package') }} - {{ $company->company_name_en }}</h2>
                        </div>
                    </div>
                    <!--end::Card header-->
                    <!--begin::Card body-->
                    <div class="card-body pt-0">
                        <!--begin::Current Package Info-->
                        <div class="row mb-10">
                            <div class="col-12">
                                <h4 class="fw-bold mb-5">{{ __('client_packages.current_package') }}</h4>
                                <div class="card bg-light-info">
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-md-3">
                                                <div class="mb-3">
                                                    <span class="fw-semibold">{{ __('packages.name') }}:</span>
                                                    <span class="text-primary fw-bold">{{ $clientPackage->package->name }}</span>
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="mb-3">
                                                    <span class="fw-semibold">{{ __('client_packages.start_date') }}:</span>
                                                    <span>{{ $clientPackage->start_date->format('M d, Y') }}</span>
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="mb-3">
                                                    <span class="fw-semibold">{{ __('client_packages.end_date') }}:</span>
                                                    <span>{{ $clientPackage->end_date->format('M d, Y') }}</span>
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="mb-3">
                                                    <span class="fw-semibold">{{ __('client_packages.new_end_date') }}:</span>
                                                    <span class="text-success fw-bold">{{ $clientPackage->end_date->addMonths($clientPackage->package->duration)->format('M d, Y') }}</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!--end::Current Package Info-->

                        <!--begin::Renewal Info-->
                        <div class="alert alert-info d-flex align-items-center p-5 mb-10">
                            <i class="fas fa-info-circle fs-2hx text-info me-4"></i>
                            <div class="d-flex flex-column">
                                <h4 class="mb-1 text-info">{{ __('client_packages.help.renewal_info') }}</h4>
                                <span>{{ __('client_packages.messages.package_renewed_until') }} {{ $clientPackage->end_date->addMonths($clientPackage->package->duration)->format('M d, Y') }}</span>
                            </div>
                        </div>
                        <!--end::Renewal Info-->

                        <!--begin::Confirmation-->
                        <div class="mb-10">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="confirm_renewal" id="confirm_renewal" value="1" required>
                                <label class="form-check-label fw-semibold" for="confirm_renewal">
                                    {{ __('client_packages.confirm_renewal') }}
                                </label>
                            </div>
                            @error('confirm_renewal')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <!--end::Confirmation-->
                    </div>
                    <!--end::Card body-->
                    <!--begin::Card footer-->
                    <div class="card-footer">
                        <div class="d-flex justify-content-end">
                            <a href="{{ route('admin.companies.show', $company) }}" class="btn btn-light me-5">{{ __('common.cancel') }}</a>
                            <button id="kt_renew_package_submit" type="submit" class="btn btn-primary">
                                <span class="indicator-label">{{ __('client_packages.renew') }}</span>
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
    var KTRenewPackage = function () {
        // Private functions
        var handleSubmit = function () {
            const submitButton = document.getElementById('kt_renew_package_submit');
            const form = document.getElementById('kt_renew_package_form');
            const confirmCheckbox = document.getElementById('confirm_renewal');
            
            submitButton.addEventListener('click', function (e) {
                e.preventDefault();

                if (!confirmCheckbox.checked) {
                    alert('{{ __('client_packages.validation.confirm_renewal_required') }}');
                    return;
                }

                // Show loading indication
                submitButton.setAttribute('data-kt-indicator', 'on');
                
                // Disable button to avoid multiple clicks
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
                handleSubmit();
            }
        };
    }();

    // On document ready
    KTUtil.onDOMContentLoaded(function () {
        KTRenewPackage.init();
    });
</script>
@endpush
