@extends('admin.layouts.master')

@section('title', __('document-types.create'))

@section('content')
<div class="d-flex flex-column flex-root app-root" id="kt_app_root">
    <div class="d-flex flex-column flex-column-fluid" id="kt_app_content">
        <div class="d-flex flex-column-fluid" id="kt_app_content_container">
            <div class="container-fluid">
                <!-- Page Header -->
                <div class="card mb-5 mb-xl-10">
                    <div class="card-header border-0">
                        <div class="card-title m-0">
                            <h3 class="fw-bold m-0">{{ __('document-types.create') }}</h3>
                        </div>
                        <div class="card-toolbar">
                            <a href="{{ route('admin.document-types.index') }}" class="btn btn-secondary">
                                <i class="fa fa-arrow-left"></i>
                                {{ __('document-types.back_to_list') }}
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Create Form -->
                <div class="card">
                    <div class="card-body">
                        <form action="{{ route('admin.document-types.store') }}" method="POST" id="kt_document_type_form">
                            @csrf
                            
                            <div class="row g-5">
                                <!-- Basic Information -->
                                <div class="col-12">
                                    <div class="d-flex justify-content-between align-items-center mb-4">
                                        <h4 class="fw-bold m-0">{{ __('document-types.basic_information') }}</h4>
                                        <div class="form-check form-switch">
                                            <input type="hidden" name="is_active" value="0">
                                            <input class="form-check-input" type="checkbox" name="is_active" 
                                                   id="is_active" value="1" {{ old('is_active', true) ? 'checked' : '' }}>
                                            <label class="form-check-label" for="is_active">
                                                {{ __('document-types.is_active') }}
                                            </label>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="col-md-6">
                                    <label class="form-label required">{{ __('document-types.name_en') }}</label>
                                    <input type="text" class="form-control @error('name_en') is-invalid @enderror" 
                                           name="name_en" value="{{ old('name_en') }}" required>
                                    @error('name_en')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                
                                <div class="col-md-6">
                                    <label class="form-label required">{{ __('document-types.name_ar') }}</label>
                                    <input type="text" class="form-control @error('name_ar') is-invalid @enderror" 
                                           name="name_ar" value="{{ old('name_ar') }}" required>
                                    @error('name_ar')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                
                                <div class="col-md-6">
                                    <label class="form-label required">{{ __('document-types.code') }}</label>
                                    <div class="input-group">
                                    <input type="text" class="form-control @error('code') is-invalid @enderror" 
                                               name="code" id="document_type_code" value="{{ old('code') }}" required>
                                        <button type="button" class="btn btn-light-primary" onclick="generateDocumentTypeCode()" title="{{ __('document-types.generate_key') }}">
                                            <i class="fa fa-magic"></i>
                                        </button>
                                    </div>
                                    @error('code')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                
                                <div class="col-md-6">
                                    <label class="form-label required">{{ __('document-types.category') }}</label>
                                    <select class="form-select @error('category') is-invalid @enderror" name="category" required>
                                        <option value="">{{ __('document-types.select_category') }}</option>
                                        <option value="employee" {{ old('category') === 'employee' ? 'selected' : '' }}>{{ __('document-types.employee') }}</option>
                                        <option value="company" {{ old('category') === 'company' ? 'selected' : '' }}>{{ __('document-types.company') }}</option>
                                    </select>
                                    @error('category')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                
                                <div class="col-md-6">
                                    <label class="form-label required">{{ __('document-types.entity_type') }}</label>
                                    <select class="form-select @error('entity_type') is-invalid @enderror" name="entity_type" required>
                                        <option value="">{{ __('document-types.select_entity_type') }}</option>
                                        <option value="saudi" {{ old('entity_type') === 'saudi' ? 'selected' : '' }}>{{ __('document-types.saudi') }}</option>
                                        <option value="expat" {{ old('entity_type') === 'expat' ? 'selected' : '' }}>{{ __('document-types.expat') }}</option>
                                        <option value="both" {{ old('entity_type') === 'both' ? 'selected' : '' }}>{{ __('document-types.both') }}</option>
                                    </select>
                                    @error('entity_type')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                
                                <div class="col-md-6">
                                    <label class="form-label">{{ __('document-types.reminder_days_before') }}</label>
                                    <input type="number" class="form-control @error('reminder_days_before') is-invalid @enderror" 
                                           name="reminder_days_before" value="{{ old('reminder_days_before', 30) }}" 
                                           min="1" max="365" placeholder="30">
                                    @error('reminder_days_before')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                
                                <!-- Descriptions -->
                                <div class="col-md-6">
                                    <label class="form-label">{{ __('document-types.description_en') }}</label>
                                    <textarea class="form-control @error('description_en') is-invalid @enderror" 
                                              name="description_en" rows="2">{{ old('description_en') }}</textarea>
                                    @error('description_en')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                
                                <div class="col-md-6">
                                    <label class="form-label">{{ __('document-types.description_ar') }}</label>
                                    <textarea class="form-control @error('description_ar') is-invalid @enderror" 
                                              name="description_ar" rows="2">{{ old('description_ar') }}</textarea>
                                    @error('description_ar')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                
                                <!-- Quick Add Common Fields -->
                                <div class="col-12">
                                    <h4 class="fw-bold mb-4">{{ __('document-types.quick_add_common_fields') }}</h4>
                                    <div class="row g-3">
                                        <div class="col-md-4">
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" id="quick_document_number" onchange="toggleQuickField('document_number')">
                                                <label class="form-check-label" for="quick_document_number">
                                                    {{ __('document-types.document_number') }}
                                                </label>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" id="quick_issue_date" onchange="toggleQuickField('issue_date')">
                                                <label class="form-check-label" for="quick_issue_date">
                                                    {{ __('document-types.issue_date') }}
                                                </label>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" id="quick_expiry_date" onchange="toggleQuickField('expiry_date')">
                                                <label class="form-check-label" for="quick_expiry_date">
                                                    {{ __('document-types.expiry_date') }}
                                                </label>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" id="quick_place_of_issue" onchange="toggleQuickField('place_of_issue')">
                                                <label class="form-check-label" for="quick_place_of_issue">
                                                    {{ __('document-types.place_of_issue') }}
                                                </label>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" id="quick_notes" onchange="toggleQuickField('notes')">
                                                <label class="form-check-label" for="quick_notes">
                                                    {{ __('document-types.notes') }}
                                                </label>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" id="quick_renewal_notes" onchange="toggleQuickField('renewal_notes')">
                                                <label class="form-check-label" for="quick_renewal_notes">
                                                    {{ __('document-types.renewal_notes') }}
                                                </label>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" id="quick_document_file" onchange="toggleQuickField('document_file')">
                                                <label class="form-check-label" for="quick_document_file">
                                                    {{ __('document-types.document_file') }}
                                        </label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                
                                <!-- Custom Fields -->
                                <div class="col-12">
                                    <h4 class="fw-bold mb-4">{{ __('document-types.custom_fields') }}</h4>
                                    <p class="text-muted mb-4">{{ __('document-types.custom_fields_description') }}</p>
                                    
                                    <div id="custom-fields-container">
                                        <!-- Custom fields will be added here dynamically -->
                                    </div>
                                    
                                    <button type="button" class="btn btn-light-primary" id="add-custom-field">
                                        <i class="fa fa-plus"></i>
                                        {{ __('document-types.add_custom_field') }}
                                    </button>
                                </div>
                                
                            </div>
                            
                            <!-- Form Actions -->
                            <div class="d-flex justify-content-end mt-8">
                                <a href="{{ route('admin.document-types.index') }}" class="btn btn-secondary me-3">
                                    {{ __('document-types.cancel') }}
                                </a>
                                <button type="submit" class="btn btn-primary">
                                    <i class="fa fa-check"></i>
                                    {{ __('document-types.create_document_type') }}
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
    // Form validation and enhancement
    document.addEventListener('DOMContentLoaded', function() {
        const form = document.getElementById('kt_document_type_form');
        const customFieldsContainer = document.getElementById('custom-fields-container');
        const addCustomFieldBtn = document.getElementById('add-custom-field');
        
        let fieldCounter = 0;
        
        // Add custom field
        addCustomFieldBtn.addEventListener('click', function() {
            addCustomField();
        });
        
        function addCustomField(fieldData = null) {
            fieldCounter++;
            const fieldId = `custom_field_${fieldCounter}`;
            
            // Check if this is a quick field
            const isQuickField = fieldData && fieldData.key && quickFields[fieldData.key];
            const quickFieldKey = isQuickField ? fieldData.key : null;
            
            const fieldHtml = `
                <div class="card mb-4" id="${fieldId}" ${quickFieldKey ? `data-quick-field="${quickFieldKey}"` : ''}>
                    <div class="card-header">
                        <div class="card-title">
                            <h5 class="fw-bold m-0">{{ __('document-types.custom_field') }} #${fieldCounter}</h5>
                        </div>
                        <div class="card-toolbar d-flex align-items-center gap-2">
                            <div class="form-check form-switch">
                                <input class="form-check-input" type="checkbox" name="custom_fields[${fieldCounter}][required]" 
                                       value="1" ${fieldData && fieldData.required ? 'checked' : ''}>
                                <label class="form-check-label">
                                    {{ __('document-types.required_field') }}
                                </label>
                            </div>
                            <button type="button" class="btn btn-sm btn-light-danger" onclick="removeCustomField('${fieldId}')">
                                <i class="fa fa-trash"></i>
                            </button>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label class="form-label required">{{ __('document-types.field_name_en') }}</label>
                                <input type="text" class="form-control" name="custom_fields[${fieldCounter}][name_en]" 
                                       value="${fieldData ? fieldData.name_en : ''}" required>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label required">{{ __('document-types.field_name_ar') }}</label>
                                <input type="text" class="form-control" name="custom_fields[${fieldCounter}][name_ar]" 
                                       value="${fieldData ? fieldData.name_ar : ''}" required>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label required">{{ __('document-types.field_key') }}</label>
                                <div class="input-group">
                                    <input type="text" class="form-control" name="custom_fields[${fieldCounter}][key]" 
                                           id="custom_field_key_${fieldCounter}" value="${fieldData ? fieldData.key : ''}" required 
                                           placeholder="e.g., passport_number">
                                    <button type="button" class="btn btn-light-primary" onclick="generateCustomFieldKey(${fieldCounter})" title="{{ __('document-types.generate_key') }}">
                                        <i class="fa fa-magic"></i>
                                    </button>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label required">{{ __('document-types.field_type') }}</label>
                                <select class="form-select" name="custom_fields[${fieldCounter}][type]" required onchange="toggleFieldOptions('${fieldId}')">
                                    <option value="">{{ __('document-types.select_field_type') }}</option>
                                    <option value="text" ${fieldData && fieldData.type === 'text' ? 'selected' : ''}>{{ __('document-types.text') }}</option>
                                    <option value="number" ${fieldData && fieldData.type === 'number' ? 'selected' : ''}>{{ __('document-types.number') }}</option>
                                    <option value="email" ${fieldData && fieldData.type === 'email' ? 'selected' : ''}>{{ __('document-types.email') }}</option>
                                    <option value="date" ${fieldData && fieldData.type === 'date' ? 'selected' : ''}>{{ __('document-types.date') }}</option>
                                    <option value="file" ${fieldData && fieldData.type === 'file' ? 'selected' : ''}>{{ __('document-types.file') }}</option>
                                    <option value="select" ${fieldData && fieldData.type === 'select' ? 'selected' : ''}>{{ __('document-types.select') }}</option>
                                    <option value="textarea" ${fieldData && fieldData.type === 'textarea' ? 'selected' : ''}>{{ __('document-types.textarea') }}</option>
                                </select>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">{{ __('document-types.placeholder_en') }}</label>
                                <input type="text" class="form-control" name="custom_fields[${fieldCounter}][placeholder_en]" 
                                       value="${fieldData ? fieldData.placeholder_en : ''}">
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">{{ __('document-types.placeholder_ar') }}</label>
                                <input type="text" class="form-control" name="custom_fields[${fieldCounter}][placeholder_ar]" 
                                       value="${fieldData ? fieldData.placeholder_ar : ''}">
                            </div>
                            <div class="col-12" id="options_${fieldId}" style="display: none;">
                                <label class="form-label">{{ __('document-types.select_options') }}</label>
                                <div class="options-container">
                                    <div class="input-group mb-2">
                                        <input type="text" class="form-control" placeholder="{{ __('document-types.option_value') }}" name="custom_fields[${fieldCounter}][options][value][]">
                                        <input type="text" class="form-control" placeholder="{{ __('document-types.option_label_en') }}" name="custom_fields[${fieldCounter}][options][label_en][]">
                                        <input type="text" class="form-control" placeholder="{{ __('document-types.option_label_ar') }}" name="custom_fields[${fieldCounter}][options][label_ar][]">
                                        <button type="button" class="btn btn-light-danger" onclick="removeOption(this)">
                                            <i class="fa fa-trash"></i>
                                        </button>
                                    </div>
                                </div>
                                <button type="button" class="btn btn-light-primary btn-sm" onclick="addOption('${fieldId}')">
                                    <i class="fa fa-plus"></i>
                                    {{ __('document-types.add_option') }}
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            `;
            
            customFieldsContainer.insertAdjacentHTML('beforeend', fieldHtml);
            
            // If it's a quick field, trigger the field options toggle
            if (fieldData && fieldData.type === 'select') {
                toggleFieldOptions(fieldId);
            }
        }
        
        // Remove custom field
        window.removeCustomField = function(fieldId) {
            const fieldElement = document.getElementById(fieldId);
            if (fieldElement) {
                // Check if it's a quick field and uncheck the checkbox
                const quickFieldKey = fieldElement.getAttribute('data-quick-field');
                if (quickFieldKey) {
                    const checkbox = document.getElementById(`quick_${quickFieldKey}`);
                    if (checkbox) {
                        checkbox.checked = false;
                    }
                }
                fieldElement.remove();
            }
        };
        
        // Toggle field options based on type
        window.toggleFieldOptions = function(fieldId) {
            const fieldElement = document.getElementById(fieldId);
            const typeSelect = fieldElement.querySelector('select[name*="[type]"]');
            const optionsContainer = fieldElement.querySelector(`#options_${fieldId}`);
            
            if (typeSelect.value === 'select') {
                optionsContainer.style.display = 'block';
            } else {
                optionsContainer.style.display = 'none';
            }
        };
        
        // Add option for select fields
        window.addOption = function(fieldId) {
            const fieldElement = document.getElementById(fieldId);
            const optionsContainer = fieldElement.querySelector('.options-container');
            
            const optionHtml = `
                <div class="input-group mb-2">
                    <input type="text" class="form-control" placeholder="{{ __('document-types.option_value') }}" name="custom_fields[${fieldCounter}][options][value][]">
                    <input type="text" class="form-control" placeholder="{{ __('document-types.option_label_en') }}" name="custom_fields[${fieldCounter}][options][label_en][]">
                    <input type="text" class="form-control" placeholder="{{ __('document-types.option_label_ar') }}" name="custom_fields[${fieldCounter}][options][label_ar][]">
                    <button type="button" class="btn btn-light-danger" onclick="removeOption(this)">
                        <i class="fa fa-trash"></i>
                    </button>
                </div>
            `;
            
            optionsContainer.insertAdjacentHTML('beforeend', optionHtml);
        };
        
        // Remove option
        window.removeOption = function(button) {
            button.closest('.input-group').remove();
        };
        
        // Generate unique document type code
        window.generateDocumentTypeCode = function() {
            const nameEn = document.querySelector('input[name="name_en"]').value;
            const category = document.querySelector('select[name="category"]').value;
            
            if (!nameEn || !category) {
                alert('{{ __("document-types.please_fill_name_and_category") }}');
                return;
            }
            
            // Generate code based on name and category
            let code = nameEn
                .toUpperCase()
                .replace(/[^A-Z0-9\s]/g, '') // Remove special characters
                .replace(/\s+/g, '_') // Replace spaces with underscores
                .substring(0, 20); // Limit length
            
            // Add category prefix
            if (category === 'employee') {
                code = 'EMP_' + code;
            } else if (category === 'company') {
                code = 'COMP_' + code;
            }
            
            // Add timestamp to ensure uniqueness
            const timestamp = Date.now().toString().slice(-4);
            code = code + '_' + timestamp;
            
            document.getElementById('document_type_code').value = code;
        };
        
        // Generate unique custom field key
        window.generateCustomFieldKey = function(fieldCounter) {
            const nameEn = document.querySelector(`input[name="custom_fields[${fieldCounter}][name_en]"]`).value;
            const type = document.querySelector(`select[name="custom_fields[${fieldCounter}][type]"]`).value;
            
            if (!nameEn || !type) {
                alert('{{ __("document-types.please_fill_name_and_type") }}');
                return;
            }
            
            // Generate key based on name and type
            let key = nameEn
                .toLowerCase()
                .replace(/[^a-z0-9\s]/g, '') // Remove special characters
                .replace(/\s+/g, '_') // Replace spaces with underscores
                .substring(0, 15); // Limit length
            
            // Add type prefix
            key = type + '_' + key;
            
            // Add random suffix to ensure uniqueness
            const randomSuffix = Math.random().toString(36).substring(2, 6);
            key = key + '_' + randomSuffix;
            
            document.getElementById(`custom_field_key_${fieldCounter}`).value = key;
        };
        
        // Quick field definitions
        const quickFields = {
            'document_number': {
                name_en: 'Document Number',
                name_ar: 'رقم الوثيقة',
                key: 'document_number',
                type: 'text',
                required: true,
                placeholder_en: 'Enter document number',
                placeholder_ar: 'أدخل رقم الوثيقة'
            },
            'issue_date': {
                name_en: 'Issue Date',
                name_ar: 'تاريخ الإصدار',
                key: 'issue_date',
                type: 'date',
                required: true,
                placeholder_en: 'Select issue date',
                placeholder_ar: 'اختر تاريخ الإصدار'
            },
            'expiry_date': {
                name_en: 'Expiry Date',
                name_ar: 'تاريخ الانتهاء',
                key: 'expiry_date',
                type: 'date',
                required: true,
                placeholder_en: 'Select expiry date',
                placeholder_ar: 'اختر تاريخ الانتهاء'
            },
            'place_of_issue': {
                name_en: 'Place of Issue',
                name_ar: 'مكان الإصدار',
                key: 'place_of_issue',
                type: 'text',
                required: false,
                placeholder_en: 'Enter place of issue',
                placeholder_ar: 'أدخل مكان الإصدار'
            },
            'notes': {
                name_en: 'Notes',
                name_ar: 'ملاحظات',
                key: 'notes',
                type: 'textarea',
                required: false,
                placeholder_en: 'Enter notes',
                placeholder_ar: 'أدخل الملاحظات'
            },
            'renewal_notes': {
                name_en: 'Renewal Notes',
                name_ar: 'ملاحظات التجديد',
                key: 'renewal_notes',
                type: 'textarea',
                required: false,
                placeholder_en: 'Enter renewal notes',
                placeholder_ar: 'أدخل ملاحظات التجديد'
            },
            'document_file': {
                name_en: 'Document File',
                name_ar: 'ملف الوثيقة',
                key: 'document_file',
                type: 'file',
                required: false,
                placeholder_en: 'Upload document file',
                placeholder_ar: 'رفع ملف الوثيقة'
            }
        };
        
        // Toggle quick field
        window.toggleQuickField = function(fieldKey) {
            const checkbox = document.getElementById(`quick_${fieldKey}`);
            const fieldData = quickFields[fieldKey];
            
            if (checkbox.checked) {
                // Add hidden inputs for the quick field
                addQuickFieldInputs(fieldData);
        } else {
                // Remove the hidden inputs
                removeQuickFieldInputs(fieldKey);
            }
        };
        
        // Add quick field as hidden inputs
        window.addQuickFieldInputs = function(fieldData) {
            const form = document.getElementById('kt_document_type_form');
            const container = document.createElement('div');
            container.id = `quick_field_${fieldData.key}`;
            container.style.display = 'none';
            
            // Add hidden inputs for the quick field
            container.innerHTML = `
                <input type="hidden" name="quick_fields[${fieldData.key}][name_en]" value="${fieldData.name_en}">
                <input type="hidden" name="quick_fields[${fieldData.key}][name_ar]" value="${fieldData.name_ar}">
                <input type="hidden" name="quick_fields[${fieldData.key}][key]" value="${fieldData.key}">
                <input type="hidden" name="quick_fields[${fieldData.key}][type]" value="${fieldData.type}">
                <input type="hidden" name="quick_fields[${fieldData.key}][required]" value="${fieldData.required ? '1' : '0'}">
                <input type="hidden" name="quick_fields[${fieldData.key}][placeholder_en]" value="${fieldData.placeholder_en}">
                <input type="hidden" name="quick_fields[${fieldData.key}][placeholder_ar]" value="${fieldData.placeholder_ar}">
            `;
            
            form.appendChild(container);
        };
        
        // Remove quick field hidden inputs
        window.removeQuickFieldInputs = function(fieldKey) {
            const container = document.getElementById(`quick_field_${fieldKey}`);
            if (container) {
                container.remove();
            }
        };
    });
</script>
@endpush
@endsection
