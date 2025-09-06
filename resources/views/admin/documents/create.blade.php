@extends('admin.layouts.master')

@section('title', __('documents.add_document') . ' - ' . $employee->full_name_en)

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
                        {{ __('documents.add_document') }}
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
                            <a href="{{ route('admin.employees.show', $employee) }}" class="text-muted text-hover-primary">{{ $employee->full_name_en }}</a>
                        </li>
                        <li class="breadcrumb-item">
                            <span class="bullet bg-gray-400 w-5px h-2px"></span>
                        </li>
                        <li class="breadcrumb-item text-muted">{{ __('documents.add_document') }}</li>
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
                        <div class="card-title fs-3 fw-bold d-flex align-items-center">
                            {{ __('documents.add_document_for') }} {{ $employee->full_name_en }}
                            <span class="badge badge-{{ $employee->type === 'saudi' ? 'light-primary' : 'light-info' }} ms-3">
                                {{ $employee->type === 'saudi' ? __('employees.saudi') : __('employees.expat') }}
                            </span>
                        </div>
                        <!--end::Card title-->
                    </div>
                    <!--end::Card header-->

                    <!--begin::Form-->
                    <form id="kt_document_form" class="form" action="{{ route('admin.employees.documents.store', $employee) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <!--begin::Card body-->
                        <div class="card-body p-9">
                            <!--begin::Row-->
                            <div class="row mb-8">
                                <!--begin::Col-->
                                <div class="col-xl-3">
                                    <div class="fs-6 fw-semibold mt-2 mb-3">{{ __('documents.document_information') }}</div>
                                </div>
                                <!--end::Col-->
                                <!--begin::Col-->
                                <div class="col-xl-9 fv-row">
                                    <!--begin::Row-->
                                    <div class="row g-9 mb-8">
                                        <!--begin::Col-->
                                        <div class="col-md-6 fv-row">
                                            <label class="required fs-6 fw-semibold mb-2">{{ __('documents.document_type') }}</label>
                                            <select class="form-select form-select-solid @error('document_type_id') is-invalid @enderror"
                                                    name="document_type_id" id="document_type_id" required>
                                                <option value="">{{ __('documents.select_document_type') }}</option>
                                                @foreach($documentTypes as $type)
                                                    <option value="{{ $type->id }}"
                                                            data-custom-fields="{{ json_encode($type->custom_fields ?? []) }}"
                                                            data-reminder-days="{{ $type->reminder_days_before ?? 30 }}"
                                                        @selected(old('document_type_id') == $type->id)>
                                                        {{ app()->getLocale() === 'ar' ? $type->name_ar : $type->name_en }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            @error('document_type_id')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <!--end::Col-->
                                        <!--begin::Col-->
                                        <div class="col-md-6 fv-row">
                                            <label class="required fs-6 fw-semibold mb-2">{{ __('documents.status') }}</label>
                                            <select class="form-select form-select-solid @error('status') is-invalid @enderror" name="status" required>
                                                <option value="active" @selected(old('status', 'active') == 'active')>{{ __('documents.active') }}</option>
                                                <option value="expired" @selected(old('status') == 'expired')>{{ __('documents.expired') }}</option>
                                                <option value="cancelled" @selected(old('status') == 'cancelled')>{{ __('documents.cancelled') }}</option>
                                                <option value="pending" @selected(old('status') == 'pending')>{{ __('documents.pending') }}</option>
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

                            <!--begin::Dynamic Fields Section-->
                            <div id="dynamic_fields_section" style="display: none;">
                                <div class="row mb-8">
                                    <!--begin::Col-->
                                    <div class="col-xl-3">
                                        <div class="fs-6 fw-semibold mt-2 mb-3">{{ __('documents.document_fields') }}</div>
                                    </div>
                                    <!--end::Col-->
                                    <!--begin::Col-->
                                    <div class="col-xl-9 fv-row">
                                        <div id="dynamic_fields_container">
                                            <!-- Dynamic fields will be populated here -->
                                        </div>
                                    </div>
                                    <!--end::Col-->
                                </div>
                            </div>
                            <!--end::Dynamic Fields Section-->

                            <!--begin::Reminder Section-->
                            <div class="row mb-8" id="reminder_section" style="display: none;">
                                <!--begin::Col-->
                                <div class="col-xl-3">
                                    <div class="fs-6 fw-semibold mt-2 mb-3">{{ __('documents.reminder_settings') }}</div>
                                </div>
                                <!--end::Col-->
                                <!--begin::Col-->
                                <div class="col-xl-9 fv-row">
                                    <!--begin::Row-->
                                    <div class="row g-9">
                                        <!--begin::Col-->
                                        <div class="col-md-6 fv-row">
                                            <div class="form-check form-switch form-check-custom form-check-solid">
                                                <input class="form-check-input" type="checkbox" name="enable_reminder"
                                                       id="enable_reminder" value="1" @checked(old('enable_reminder', true)) />
                                                <label class="form-check-label fw-semibold text-gray-400 ms-3" for="enable_reminder">
                                                    {{ __('documents.enable_expiry_reminder') }}
                                                </label>
                                            </div>
                                        </div>
                                        <!--end::Col-->
                                        <!--begin::Col-->
                                        <div class="col-md-6 fv-row" id="reminder_days_field">
                                            <label class="fs-6 fw-semibold mb-2">{{ __('documents.remind_before_days') }}</label>
                                            <input type="number" min="1" max="365" class="form-control form-control-solid @error('reminder_days') is-invalid @enderror"
                                                   name="reminder_days" value="{{ old('reminder_days', 30) }}" />
                                            <div class="form-text">{{ __('documents.reminder_help_text') }}</div>
                                            @error('reminder_days')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <!--end::Col-->
                                    </div>
                                    <!--end::Row-->
                                </div>
                                <!--end::Col-->
                            </div>
                            <!--end::Reminder Section-->
                        </div>
                        <!--end::Card body-->

                        <!--begin::Card footer-->
                        <div class="card-footer d-flex justify-content-end py-6 px-9">
                            <a href="{{ route('admin.employees.show', $employee) }}" class="btn btn-light btn-active-light-primary me-2">
                                @lang('common.cancel')
                            </a>
                            <button type="submit" class="btn btn-primary" id="kt_document_submit">
                                <span class="indicator-label">{{ __('documents.add_document') }}</span>
                                <span class="indicator-progress">{{ __('documents.please_wait') }}
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
        var KTDocumentCreate = function () {
            // Elements
            var form;
            var submitButton;
            var documentTypeSelect;
            var dynamicFieldsSection;
            var dynamicFieldsContainer;
            var reminderSection;
            var enableReminderCheckbox;
            var reminderDaysField;

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

            var handleDocumentTypeChange = function () {
                documentTypeSelect.addEventListener('change', function () {
                    var selectedOption = this.options[this.selectedIndex];
                    var customFieldsData = selectedOption.getAttribute('data-custom-fields') || '[]';
                    var reminderDays = selectedOption.getAttribute('data-reminder-days');
                    
                    // Clear previous fields
                    dynamicFieldsContainer.innerHTML = '';
                    
                    try {
                        var customFields = JSON.parse(customFieldsData);
                        
                        // Convert customFields object to array if needed
                        if (!Array.isArray(customFields)) {
                            if (typeof customFields === 'object' && customFields !== null) {
                                customFields = Object.values(customFields);
                    } else {
                                customFields = [];
                            }
                        }
                        
                        if (customFields.length === 0) {
                            dynamicFieldsSection.style.display = 'none';
                            reminderSection.style.display = 'none';
                            return;
                        }

                        // Show dynamic fields section
                        dynamicFieldsSection.style.display = 'block';
                        
                        // Generate fields based on custom fields
                        generateDynamicFields(customFields);
                        
                        // Handle reminder settings
                        handleReminderSettings(customFields, reminderDays);
                    } catch (error) {
                        console.error('Error parsing custom fields:', error);
                        dynamicFieldsSection.style.display = 'none';
                        reminderSection.style.display = 'none';
                    }
                });
            }

            var generateDynamicFields = function (customFields) {
                // Convert customFields object to array if needed
                if (!Array.isArray(customFields)) {
                    if (typeof customFields === 'object' && customFields !== null) {
                        customFields = Object.values(customFields);
                    } else {
                        customFields = [];
                    }
                }
                
                customFields.forEach(function(field, index) {
                    var isEven = index % 2 === 0;

                    if (isEven) {
                        var row = document.createElement('div');
                        row.className = 'row g-9 mb-8';
                        dynamicFieldsContainer.appendChild(row);
                    }

                    var currentRow = dynamicFieldsContainer.lastElementChild;
                    var col = document.createElement('div');
                    col.className = 'col-md-6 fv-row';

                    var label = document.createElement('label');
                    label.className = 'fs-6 fw-semibold mb-2' + (field.required ? ' required' : '');
                    label.textContent = '{{ app()->getLocale() }}' === 'ar' ? (field.name_ar || field.name_en || field.key) : (field.name_en || field.name_ar || field.key);

                    var input = createInputForField(field);
                    input.name = field.key;
                    if (field.required) {
                        input.setAttribute('required', 'required');
                    }

                    // Set old input values if they exist (for validation errors)
                    var oldValues = @json(old());
                    if (oldValues && oldValues[field.key]) {
                        if (field.type === 'file') {
                            // For file inputs, show the old filename if available
                            var fileInfo = document.createElement('div');
                            fileInfo.className = 'form-text text-muted mb-2';
                            fileInfo.innerHTML = '{{ __("documents.previously_selected") }}: <span class="text-primary">' + oldValues[field.key] + '</span>';
                            col.appendChild(fileInfo);
                        } else {
                            input.value = oldValues[field.key];
                        }
                    }

                    col.appendChild(label);
                    col.appendChild(input);
                    currentRow.appendChild(col);
                });
            }

            var createInputForField = function (field) {
                    var input;
                var fieldType = field.type || 'text';
                
                switch (fieldType) {
                        case 'select':
                            input = document.createElement('select');
                            input.className = 'form-select form-select-solid';
                            var defaultOption = document.createElement('option');
                            defaultOption.value = '';
                        defaultOption.textContent = '{{ __("documents.select") }} ' + ('{{ app()->getLocale() }}' === 'ar' ? (field.name_ar || field.name_en || field.key) : (field.name_en || field.name_ar || field.key));
                            input.appendChild(defaultOption);

                        if (field.options && Array.isArray(field.options)) {
                                field.options.forEach(function(option) {
                                    var opt = document.createElement('option');
                                    opt.value = option.value || option;
                                opt.textContent = '{{ app()->getLocale() }}' === 'ar' ? 
                                    (option.label_ar || option.label_en || option.value || option) : 
                                    (option.label_en || option.label_ar || option.value || option);
                                    input.appendChild(opt);
                                });
                            }
                            break;
                        
                        case 'textarea':
                            input = document.createElement('textarea');
                            input.className = 'form-control form-control-solid';
                            input.rows = 3;
                            break;
                        
                        case 'date':
                            input = document.createElement('input');
                            input.type = 'date';
                            input.className = 'form-control form-control-solid';
                            break;
                        
                        case 'number':
                            input = document.createElement('input');
                            input.type = 'number';
                            input.className = 'form-control form-control-solid';
                            if (field.min !== undefined) input.min = field.min;
                            if (field.max !== undefined) input.max = field.max;
                            if (field.step !== undefined) input.step = field.step;
                            break;
                        
                    case 'file':
                        input = document.createElement('input');
                        input.type = 'file';
                        input.className = 'form-control form-control-solid';
                        input.accept = '.pdf,.jpg,.jpeg,.png,.doc,.docx';
                        break;
                        
                    case 'email':
                        input = document.createElement('input');
                        input.type = 'email';
                        input.className = 'form-control form-control-solid';
                        break;
                        
                        default:
                            input = document.createElement('input');
                            input.type = 'text';
                            input.className = 'form-control form-control-solid';
                    }

                // Set placeholder based on locale
                if (field.placeholder_en || field.placeholder_ar) {
                    input.placeholder = '{{ app()->getLocale() }}' === 'ar' ? 
                        (field.placeholder_ar || field.placeholder_en) : 
                        (field.placeholder_en || field.placeholder_ar);
                }

                return input;
            }

            var handleReminderSettings = function (customFields, reminderDays) {
                // Convert customFields object to array if needed
                if (!Array.isArray(customFields)) {
                    if (typeof customFields === 'object' && customFields !== null) {
                        customFields = Object.values(customFields);
                    } else {
                        customFields = [];
                    }
                }
                
                // Check if any field is expiry_date and required
                var hasExpiryDate = customFields.some(field => field && field.key === 'expiry_date' && field.required);
                
                if (hasExpiryDate) {
                    reminderSection.style.display = 'block';
                    if (reminderDays && reminderDaysField && reminderDaysField.querySelector('input')) {
                        reminderDaysField.querySelector('input').value = reminderDays;
                    }
                } else {
                    reminderSection.style.display = 'none';
                }
            }

            var handleReminderToggle = function () {
                enableReminderCheckbox.addEventListener('change', function () {
                    if (this.checked) {
                        reminderDaysField.style.display = 'block';
                        reminderDaysField.querySelector('input').setAttribute('required', 'required');
                    } else {
                        reminderDaysField.style.display = 'none';
                        reminderDaysField.querySelector('input').removeAttribute('required');
                    }
                });

                // Initial state
                if (!enableReminderCheckbox.checked) {
                    reminderDaysField.style.display = 'none';
                }
            }

            // Public methods
            return {
                init: function () {
                    form = document.querySelector('#kt_document_form');
                    submitButton = document.querySelector('#kt_document_submit');
                    documentTypeSelect = document.querySelector('#document_type_id');
                    dynamicFieldsSection = document.querySelector('#dynamic_fields_section');
                    dynamicFieldsContainer = document.querySelector('#dynamic_fields_container');
                    reminderSection = document.querySelector('#reminder_section');
                    enableReminderCheckbox = document.querySelector('#enable_reminder');
                    reminderDaysField = document.querySelector('#reminder_days_field');

                    if (!form) {
                        return;
                    }

                    handleSubmit();

                    if (documentTypeSelect) {
                        handleDocumentTypeChange();
                    }

                    if (enableReminderCheckbox) {
                        handleReminderToggle();
                    }
                }
            }
        }();

        // On document ready
        KTUtil.onDOMContentLoaded(function () {
            KTDocumentCreate.init();
            
            // If there are validation errors and a document type is selected, populate fields
            var documentTypeSelect = document.querySelector('#document_type_id');
            if (documentTypeSelect && documentTypeSelect.value && document.querySelector('#dynamic_fields_section')) {
                // Trigger change event to populate dynamic fields
                documentTypeSelect.dispatchEvent(new Event('change'));
            }
        });
    </script>
@endpush