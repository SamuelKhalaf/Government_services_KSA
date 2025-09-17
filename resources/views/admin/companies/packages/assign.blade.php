@extends('admin.layouts.master')

@section('title', __('client_packages.assign_package') . ' - ' . $company->company_name_en)

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
                    {{ __('client_packages.assign_package') }}
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
                    <li class="breadcrumb-item text-muted">{{ __('client_packages.assign_package') }}</li>
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
            <form id="kt_assign_package_form" class="form" action="{{ route('admin.companies.packages.store', $company) }}" method="POST">
                @csrf
                <!--begin::Card-->
                <div class="card card-flush py-4">
                    <!--begin::Card header-->
                    <div class="card-header">
                        <div class="card-title">
                            <h2>{{ __('client_packages.assign_package') }} - {{ $company->company_name_en }}</h2>
                        </div>
                    </div>
                    <!--end::Card header-->
                    <!--begin::Card body-->
                    <div class="card-body pt-0">
                        <div class="row">
                            <!--begin::Input group-->
                            <div class="col-md-6 mb-10 fv-row">
                                <label class="required form-label">{{ __('client_packages.select_package') }}</label>
                                <select name="package_id" class="form-select mb-2" data-control="select2" data-placeholder="{{ __('client_packages.select_package') }}">
                                    <option></option>
                                    @foreach($packages as $package)
                                        <option value="{{ $package->id }}" data-price="{{ $package->price }}" data-duration="{{ $package->duration }}" data-max-employees="{{ $package->max_employees }}" data-max-employee-documents="{{ $package->max_employee_documents }}" data-max-company-documents="{{ $package->max_company_documents }}">
                                            {{ $package->name }} - {{ number_format($package->price, 2) }} {{ __('common.currency') }}
                                        </option>
                                    @endforeach
                                </select>
                                <div class="form-text">{{ __('client_packages.help.select_package') }}</div>
                                @error('package_id')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <!--end::Input group-->

                            <!--begin::Package Details-->
                            <div class="col-md-6 mb-10" id="package-details" style="display: none;">
                                <label class="form-label fw-bold">{{ __('client_packages.package_details') }}</label>
                                <div class="card bg-light-primary">
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-6">
                                                <div class="mb-3">
                                                    <span class="fw-semibold">{{ __('packages.price') }}:</span>
                                                    <span id="package-price" class="text-primary fw-bold"></span>
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
                                                    <span class="fw-semibold">{{ __('packages.max_employee_documents') }}:</span>
                                                    <span id="package-max-employee-documents"></span>
                                                </div>
                                                <div class="mb-3">
                                                    <span class="fw-semibold">{{ __('packages.max_company_documents') }}:</span>
                                                    <span id="package-max-company-documents"></span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!--end::Package Details-->
                        </div>

                        @if($activePackage)
                        <!--begin::Warning-->
                        <div class="alert alert-warning d-flex align-items-center p-5 mb-10">
                            <i class="fas fa-exclamation-triangle fs-2hx text-warning me-4"></i>
                            <div class="d-flex flex-column">
                                <h4 class="mb-1 text-warning">{{ __('client_packages.messages.client_has_active_package') }}</h4>
                                <span>{{ __('client_packages.messages.package_expires_on') }} {{ $activePackage->end_date->format('M d, Y') }}</span>
                            </div>
                        </div>
                        <!--end::Warning-->
                        @endif
                    </div>
                    <!--end::Card body-->
                    <!--begin::Card footer-->
                    <div class="card-footer">
                        <div class="d-flex justify-content-end">
                            <a href="{{ route('admin.companies.show', $company) }}" class="btn btn-light me-5">{{ __('common.cancel') }}</a>
                            <button id="kt_assign_package_submit" type="submit" class="btn btn-primary">
                                <span class="indicator-label">{{ __('client_packages.assign') }}</span>
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
    var KTAssignPackage = function () {
        // Private functions
        var initPackageSelection = function () {
            const packageSelect = document.querySelector('select[name="package_id"]');
            const packageDetails = document.getElementById('package-details');
            
            if (!packageSelect || !packageDetails) {
                return;
            }
            
            // Handle both regular change and Select2 change events
            packageSelect.addEventListener('change', function() {
                handlePackageSelection(this);
            });
            
            // Also handle Select2 change event if Select2 is initialized
            if (typeof $ !== 'undefined') {
                $(packageSelect).on('change', function() {
                    handlePackageSelection(this);
                });
            }
            
            function handlePackageSelection(selectElement) {
                const selectedOption = selectElement.options[selectElement.selectedIndex];
                
                if (selectedOption.value) {
                    // Show package details
                    packageDetails.style.display = 'block';
                    
                    // Update package details
                    const price = selectedOption.dataset.price;
                    const duration = selectedOption.dataset.duration;
                    
                    if (price) {
                        document.getElementById('package-price').textContent = 
                            parseFloat(price).toFixed(2) + ' {{ __('common.currency') }}';
                    }
                    
                    if (duration) {
                        document.getElementById('package-duration').textContent = 
                            duration + ' {{ __('common.months') }}';
                    }
                    
                    // Handle max employees and documents with proper null checking
                    const maxEmployees = selectedOption.getAttribute('data-max-employees');
                    const maxEmployeeDocuments = selectedOption.getAttribute('data-max-employee-documents');
                    const maxCompanyDocuments = selectedOption.getAttribute('data-max-company-documents');
                    
                    document.getElementById('package-max-employees').textContent = 
                        (maxEmployees && maxEmployees !== 'null' && maxEmployees !== '') ? maxEmployees : '{{ __('common.unlimited') }}';
                    document.getElementById('package-max-employee-documents').textContent = 
                        (maxEmployeeDocuments && maxEmployeeDocuments !== 'null' && maxEmployeeDocuments !== '') ? maxEmployeeDocuments : '{{ __('common.unlimited') }}';
                    document.getElementById('package-max-company-documents').textContent = 
                        (maxCompanyDocuments && maxCompanyDocuments !== 'null' && maxCompanyDocuments !== '') ? maxCompanyDocuments : '{{ __('common.unlimited') }}';
                } else {
                    // Hide package details
                    packageDetails.style.display = 'none';
                }
            }
        }

        var handleSubmit = function () {
            const submitButton = document.getElementById('kt_assign_package_submit');
            const form = document.getElementById('kt_assign_package_form');
            
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
        // Wait for Select2 to be initialized if it exists
        if (typeof $ !== 'undefined') {
            $(document).ready(function() {
                // Initialize after a short delay to ensure Select2 is ready
                setTimeout(function() {
                    KTAssignPackage.init();
                }, 200);
            });
        } else {
            KTAssignPackage.init();
        }
    });
    
    // Alternative initialization for Select2
    if (typeof $ !== 'undefined') {
        $(document).ready(function() {
            // Handle Select2 change event specifically
            $('select[name="package_id"]').on('select2:select', function (e) {
                const data = e.params.data;
                const selectedOption = $(this).find('option[value="' + data.id + '"]')[0];
                
                if (selectedOption) {
                    const packageDetails = document.getElementById('package-details');
                    if (packageDetails) {
                        packageDetails.style.display = 'block';
                        
                        // Update package details
                        const price = selectedOption.getAttribute('data-price');
                        const duration = selectedOption.getAttribute('data-duration');
                        const maxEmployees = selectedOption.getAttribute('data-max-employees');
                        const maxEmployeeDocuments = selectedOption.getAttribute('data-max-employee-documents');
                        const maxCompanyDocuments = selectedOption.getAttribute('data-max-company-documents');
                        
                        if (price) {
                            document.getElementById('package-price').textContent = 
                                parseFloat(price).toFixed(2) + ' {{ __('common.currency') }}';
                        }
                        
                        if (duration) {
                            document.getElementById('package-duration').textContent = 
                                duration + ' {{ __('common.months') }}';
                        }
                        
                        document.getElementById('package-max-employees').textContent = 
                            (maxEmployees && maxEmployees !== 'null' && maxEmployees !== '') ? maxEmployees : '{{ __('common.unlimited') }}';
                        document.getElementById('package-max-employee-documents').textContent = 
                            (maxEmployeeDocuments && maxEmployeeDocuments !== 'null' && maxEmployeeDocuments !== '') ? maxEmployeeDocuments : '{{ __('common.unlimited') }}';
                        document.getElementById('package-max-company-documents').textContent = 
                            (maxCompanyDocuments && maxCompanyDocuments !== 'null' && maxCompanyDocuments !== '') ? maxCompanyDocuments : '{{ __('common.unlimited') }}';
                    }
                }
            });
        });
    }
</script>
@endpush
