@extends('admin.layouts.master')

@section('title', __('client_packages.change_package') . ' - ' . $company->company_name_en)

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
                    {{ __('client_packages.change_package') }}
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
                    <li class="breadcrumb-item text-muted">{{ __('client_packages.change_package') }}</li>
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
            <form id="kt_change_package_form" class="form" action="{{ route('admin.companies.packages.change.store', [$company, $clientPackage]) }}" method="POST">
                @csrf
                <!--begin::Card-->
                <div class="card card-flush py-4">
                    <!--begin::Card header-->
                    <div class="card-header">
                        <div class="card-title">
                            <h2>{{ __('client_packages.change_package') }} - {{ $company->company_name_en }}</h2>
                        </div>
                    </div>
                    <!--end::Card header-->
                    <!--begin::Card body-->
                    <div class="card-body pt-0">
                        <!--begin::Current Package Info-->
                        <div class="row mb-10">
                            <div class="col-12">
                                <h4 class="fw-bold mb-5">{{ __('client_packages.current_package') }}</h4>
                                <div class="card bg-light-warning">
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-md-4">
                                                <div class="mb-3">
                                                    <span class="fw-semibold">{{ __('packages.name') }}:</span>
                                                    <span class="text-warning fw-bold">{{ $clientPackage->package->name }}</span>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="mb-3">
                                                    <span class="fw-semibold">{{ __('client_packages.start_date') }}:</span>
                                                    <span>{{ $clientPackage->start_date->format('M d, Y') }}</span>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="mb-3">
                                                    <span class="fw-semibold">{{ __('client_packages.end_date') }}:</span>
                                                    <span>{{ $clientPackage->end_date->format('M d, Y') }}</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!--end::Current Package Info-->

                        <div class="row">
                            <!--begin::Input group-->
                            <div class="col-md-6 mb-10 fv-row">
                                <label class="required form-label">{{ __('client_packages.select_package') }}</label>
                                <select name="package_id" class="form-select mb-2" data-control="select2" data-placeholder="{{ __('client_packages.select_package') }}">
                                    <option></option>
                                    @foreach($packages as $package)
                                        @if($package->id !== $clientPackage->package_id)
                                            <option value="{{ $package->id }}" data-price="{{ $package->price }}" data-duration="{{ $package->duration }}" data-max-employees="{{ $package->max_employees }}" data-max-documents="{{ $package->max_documents }}">
                                                {{ $package->name }} - {{ number_format($package->price, 2) }} {{ __('common.currency') }}
                                            </option>
                                        @endif
                                    @endforeach
                                </select>
                                <div class="form-text">{{ __('client_packages.help.change_info') }}</div>
                                @error('package_id')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <!--end::Input group-->

                            <!--begin::Package Details-->
                            <div class="col-md-6 mb-10" id="package-details" style="display: none;">
                                <label class="form-label fw-bold">{{ __('client_packages.package_details') }}</label>
                                <div class="card bg-light-success">
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-6">
                                                <div class="mb-3">
                                                    <span class="fw-semibold">{{ __('packages.price') }}:</span>
                                                    <span id="package-price" class="text-success fw-bold"></span>
                                                </div>
                                                <div class="mb-3">
                                                    <span class="fw-semibold">{{ __('packages.duration') }}:</span>
                                                    <span id="package-duration"></span>
                                                </div>
                                            </div>
                                            <div class="col-6">
                                                <div class="mb-3">
                                                    <span class="fw-semibold">{{ __('packages.max_employees') }}:</span>
                                                    <span id="package-max-employees"></span>
                                                </div>
                                                <div class="mb-3">
                                                    <span class="fw-semibold">{{ __('packages.max_documents') }}:</span>
                                                    <span id="package-max-documents"></span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!--end::Package Details-->
                        </div>

                        <!--begin::Warning-->
                        <div class="alert alert-danger d-flex align-items-center p-5 mb-10">
                            <i class="fas fa-exclamation-triangle fs-2hx text-danger me-4"></i>
                            <div class="d-flex flex-column">
                                <h4 class="mb-1 text-danger">{{ __('client_packages.help.change_info') }}</h4>
                                <span>{{ __('client_packages.messages.package_expires_on') }} {{ $clientPackage->end_date->format('M d, Y') }}</span>
                            </div>
                        </div>
                        <!--end::Warning-->
                    </div>
                    <!--end::Card body-->
                    <!--begin::Card footer-->
                    <div class="card-footer">
                        <div class="d-flex justify-content-end">
                            <a href="{{ route('admin.companies.show', $company) }}" class="btn btn-light me-5">{{ __('common.cancel') }}</a>
                            <button id="kt_change_package_submit" type="submit" class="btn btn-primary">
                                <span class="indicator-label">{{ __('client_packages.change') }}</span>
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
    var KTChangePackage = function () {
        // Private functions
        var initPackageSelection = function () {
            const packageSelect = document.querySelector('select[name="package_id"]');
            const packageDetails = document.getElementById('package-details');
            
            packageSelect.addEventListener('change', function() {
                const selectedOption = this.options[this.selectedIndex];
                
                if (selectedOption.value) {
                    // Show package details
                    packageDetails.style.display = 'block';
                    
                    // Update package details
                    document.getElementById('package-price').textContent = 
                        parseFloat(selectedOption.dataset.price).toFixed(2) + ' {{ __('common.currency') }}';
                    document.getElementById('package-duration').textContent = 
                        selectedOption.dataset.duration + ' {{ __('common.months') }}';
                    document.getElementById('package-max-employees').textContent = 
                        selectedOption.dataset.maxEmployees || '{{ __('common.unlimited') }}';
                    document.getElementById('package-max-documents').textContent = 
                        selectedOption.dataset.maxDocuments || '{{ __('common.unlimited') }}';
                } else {
                    // Hide package details
                    packageDetails.style.display = 'none';
                }
            });
        }

        var handleSubmit = function () {
            const submitButton = document.getElementById('kt_change_package_submit');
            const form = document.getElementById('kt_change_package_form');
            
            submitButton.addEventListener('click', function (e) {
                e.preventDefault();

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
                initPackageSelection();
                handleSubmit();
            }
        };
    }();

    // On document ready
    KTUtil.onDOMContentLoaded(function () {
        KTChangePackage.init();
    });
</script>
@endpush
