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
                        <div class="card-title fs-3 fw-bold">{{ __('documents.add_document_for') }} {{ $employee->full_name_en }}</div>
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
                                                    name="document_type_id" id="document_type_id">
                                                <option value="">{{ __('documents.select_document_type') }}</option>
                                                @foreach($documentTypes as $type)
                                                    <option value="{{ $type->id }}"
                                                            data-requires-expiry="{{ $type->requires_expiry_date ? 'true' : 'false' }}"
                                                            data-requires-file="{{ $type->requires_file_upload ? 'true' : 'false' }}"
                                                            data-required-fields="{{ json_encode($type->required_fields ?? []) }}"
                                                            data-optional-fields="{{ json_encode($type->optional_fields ?? []) }}"
                                                            data-has-reminder="{{ $type->has_auto_reminder ? 'true' : 'false' }}"
                                                            data-reminder-days="{{ $type->reminder_days_before ?? 30 }}"
                                                        @selected(old('document_type_id') == $type->id)>
                                                        {{ $type->name_en }} ({{ $type->name_ar }})
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
                                            <label class="required fs-6 fw-semibold mb-2">{{ __('documents.document_number') }}</label>
                                            <input type="text" class="form-control form-control-solid @error('document_number') is-invalid @enderror"
                                                   name="document_number" value="{{ old('document_number') }}" />
                                            @error('document_number')
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
                                            <label class="required fs-6 fw-semibold mb-2">{{ __('documents.issue_date') }}</label>
                                            <input type="date" class="form-control form-control-solid @error('issue_date') is-invalid @enderror"
                                                   name="issue_date" value="{{ old('issue_date') }}" />
                                            @error('issue_date')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <!--end::Col-->
                                        <!--begin::Col-->
                                        <div class="col-md-6 fv-row" id="expiry_date_field">
                                            <label class="fs-6 fw-semibold mb-2" id="expiry_date_label">{{ __('documents.expiry_date') }}</label>
                                            <input type="date" class="form-control form-control-solid @error('expiry_date') is-invalid @enderror"
                                                   name="expiry_date" value="{{ old('expiry_date') }}" />
                                            @error('expiry_date')
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
                                            <label class="fs-6 fw-semibold mb-2">{{ __('documents.issuing_authority') }}</label>
                                            <input type="text" class="form-control form-control-solid @error('issuing_authority') is-invalid @enderror"
                                                   name="issuing_authority" value="{{ old('issuing_authority') }}" />
                                            @error('issuing_authority')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <!--end::Col-->
                                        <!--begin::Col-->
                                        <div class="col-md-6 fv-row">
                                            <label class="fs-6 fw-semibold mb-2">{{ __('documents.place_of_issue') }}</label>
                                            <input type="text" class="form-control form-control-solid @error('issue_place') is-invalid @enderror"
                                                   name="issue_place" value="{{ old('issue_place') }}" />
                                            @error('issue_place')
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
                                            <label class="fs-6 fw-semibold mb-2">{{ __('documents.status') }}</label>
                                            <select class="form-select form-select-solid @error('status') is-invalid @enderror" name="status">
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
                                        <!--begin::Col-->
                                        <div class="col-md-6 fv-row">
                                            <label class="fs-6 fw-semibold mb-2">{{ __('documents.reference_number') }}</label>
                                            <input type="text" class="form-control form-control-solid @error('reference_number') is-invalid @enderror"
                                                   name="reference_number" value="{{ old('reference_number') }}" />
                                            @error('reference_number')
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
                                            <label class="fs-6 fw-semibold mb-2">{{ __('documents.fees_amount') }}</label>
                                            <input type="number" min="0" step="0.01" class="form-control form-control-solid @error('fees_amount') is-invalid @enderror"
                                                   name="fees_amount" value="{{ old('fees_amount') }}" />
                                            @error('fees_amount')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <!--end::Col-->
                                        <!--begin::Col-->
                                        <div class="col-md-6 fv-row" id="file_upload_field">
                                            <label class="fs-6 fw-semibold mb-2" id="file_upload_label">{{ __('documents.file_path') }}</label>
                                            <input type="file" class="form-control form-control-solid @error('document_file') is-invalid @enderror"
                                                   name="document_file" accept=".pdf,.jpg,.jpeg,.png" />
                                            <div class="form-text">{{ __('documents.file_upload_instructions') }}</div>
                                            @error('document_file')
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
                                            <label class="fs-6 fw-semibold mb-2">{{ __('documents.notes') }}</label>
                                            <textarea class="form-control form-control-solid @error('notes') is-invalid @enderror"
                                                      name="notes" rows="4">{{ old('notes') }}</textarea>
                                            @error('notes')
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
                                        <div class="fs-6 fw-semibold mt-2 mb-3">{{ __('documents.additional_information') }}</div>
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
                            <div class="row mb-8">
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
            var expiryDateField;
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
                    var requiresExpiry = selectedOption.getAttribute('data-requires-expiry') === 'true';
                    var requiresFile = selectedOption.getAttribute('data-requires-file') === 'true';
                    var requiredFields = JSON.parse(selectedOption.getAttribute('data-required-fields') || '[]');
                    var optionalFields = JSON.parse(selectedOption.getAttribute('data-optional-fields') || '[]');

                    // Handle expiry date field
                    var expiryLabel = document.getElementById('expiry_date_label');
                    var expiryInput = document.querySelector('input[name="expiry_date"]');

                    if (requiresExpiry) {
                        expiryLabel.textContent = '{{ __("documents.expiry_date") }} *';
                        expiryLabel.classList.add('required');
                        expiryInput.setAttribute('required', 'required');
                        expiryDateField.style.display = 'block';
                    } else {
                        expiryLabel.textContent = '{{ __("documents.expiry_date") }}';
                        expiryLabel.classList.remove('required');
                        expiryInput.removeAttribute('required');
                        expiryDateField.style.display = 'none';
                    }

                    // Handle file upload field
                    var fileLabel = document.getElementById('file_upload_label');
                    var fileInput = document.querySelector('input[name="document_file"]');
                    var fileField = document.getElementById('file_upload_field');

                    if (requiresFile) {
                        fileLabel.textContent = '{{ __("documents.file_path") }} *';
                        fileLabel.classList.add('required');
                        fileInput.setAttribute('required', 'required');
                        fileField.style.display = 'block';
                    } else {
                        fileLabel.textContent = '{{ __("documents.file_path") }}';
                        fileLabel.classList.remove('required');
                        fileInput.removeAttribute('required');
                        fileField.style.display = 'block'; // Always show but not required
                    }

                    // Handle dynamic fields
                    generateDynamicFields(requiredFields, optionalFields);

                    // Handle reminder settings based on document type
                    handleReminderSettings(selectedOption);
                });
            }

            var generateDynamicFields = function (requiredFields, optionalFields) {
                var container = document.getElementById('dynamic_fields_container');
                var section = document.getElementById('dynamic_fields_section');

                container.innerHTML = '';

                if (requiredFields.length === 0 && optionalFields.length === 0) {
                    section.style.display = 'none';
                    return;
                }

                section.style.display = 'block';

                var allFields = [...requiredFields.map(f => ({...f, required: true})), ...optionalFields.map(f => ({...f, required: false}))];

                allFields.forEach(function(field, index) {
                    var isEven = index % 2 === 0;

                    if (isEven) {
                        var row = document.createElement('div');
                        row.className = 'row g-9 mb-8';
                        container.appendChild(row);
                    }

                    var currentRow = container.lastElementChild;
                    var col = document.createElement('div');
                    col.className = 'col-md-6 fv-row';

                    var label = document.createElement('label');
                    label.className = 'fs-6 fw-semibold mb-2' + (field.required ? ' required' : '');
                    label.textContent = field.label || field.name;

                    var input;
                    switch (field.type) {
                        case 'select':
                            input = document.createElement('select');
                            input.className = 'form-select form-select-solid';
                            var defaultOption = document.createElement('option');
                            defaultOption.value = '';
                            defaultOption.textContent = '{{ __("documents.select") }} ' + (field.label || field.name);
                            input.appendChild(defaultOption);

                            if (field.options) {
                                field.options.forEach(function(option) {
                                    var opt = document.createElement('option');
                                    opt.value = option.value || option;
                                    opt.textContent = option.label || option;
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
                        default:
                            input = document.createElement('input');
                            input.type = 'text';
                            input.className = 'form-control form-control-solid';
                    }

                    input.name = 'dynamic_fields[' + field.name + ']';
                    if (field.required) {
                        input.setAttribute('required', 'required');
                    }
                    if (field.placeholder) {
                        input.placeholder = field.placeholder;
                    }

                    col.appendChild(label);
                    col.appendChild(input);
                    currentRow.appendChild(col);
                });
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

            var handleReminderSettings = function (selectedOption) {
                var hasReminder = selectedOption.getAttribute('data-has-reminder') === 'true';
                var reminderDays = selectedOption.getAttribute('data-reminder-days');
                var requiresExpiry = selectedOption.getAttribute('data-requires-expiry') === 'true';

                if (hasReminder && requiresExpiry) {
                    enableReminderCheckbox.checked = true;
                    enableReminderCheckbox.disabled = false;
                    reminderDaysField.style.display = 'block';
                    reminderDaysField.querySelector('input').setAttribute('required', 'required');
                    
                    if (reminderDays) {
                        reminderDaysField.querySelector('input').value = reminderDays;
                    }
                } else {
                    enableReminderCheckbox.checked = false;
                    enableReminderCheckbox.disabled = true;
                    reminderDaysField.style.display = 'none';
                    reminderDaysField.querySelector('input').removeAttribute('required');
                }
            }

            // Public methods
            return {
                init: function () {
                    form = document.querySelector('#kt_document_form');
                    submitButton = document.querySelector('#kt_document_submit');
                    documentTypeSelect = document.querySelector('#document_type_id');
                    expiryDateField = document.querySelector('#expiry_date_field');
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
        });
    </script>
@endpush
