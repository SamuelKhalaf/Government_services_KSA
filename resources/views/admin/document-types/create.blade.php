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
                                <i class="ki-duotone ki-arrow-left fs-2"></i>
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
                                    <h4 class="fw-bold mb-4">{{ __('document-types.basic_information') }}</h4>
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
                                    <input type="text" class="form-control @error('code') is-invalid @enderror" 
                                           name="code" value="{{ old('code') }}" required>
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
                                    <label class="form-label">{{ __('document-types.sort_order') }}</label>
                                    <input type="number" class="form-control @error('sort_order') is-invalid @enderror" 
                                           name="sort_order" value="{{ old('sort_order', 0) }}" min="0">
                                    @error('sort_order')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                
                                <!-- Requirements -->
                                <div class="col-12">
                                    <h4 class="fw-bold mb-4">{{ __('document-types.document_requirements') }}</h4>
                                </div>
                                
                                <div class="col-md-4">
                                    <div class="form-check form-switch">
                                        <input class="form-check-input" type="checkbox" name="requires_expiry_date" 
                                               id="requires_expiry_date" value="1" {{ old('requires_expiry_date') ? 'checked' : '' }}>
                                        <label class="form-check-label" for="requires_expiry_date">
                                            {{ __('document-types.requires_expiry_date') }}
                                        </label>
                                    </div>
                                </div>
                                
                                <div class="col-md-4">
                                    <div class="form-check form-switch">
                                        <input class="form-check-input" type="checkbox" name="requires_file_upload" 
                                               id="requires_file_upload" value="1" {{ old('requires_file_upload') ? 'checked' : '' }}>
                                        <label class="form-check-label" for="requires_file_upload">
                                            {{ __('document-types.requires_file_upload') }}
                                        </label>
                                    </div>
                                </div>
                                
                                <div class="col-md-4">
                                    <div class="form-check form-switch">
                                        <input class="form-check-input" type="checkbox" name="has_auto_reminder" 
                                               id="has_auto_reminder" value="1" {{ old('has_auto_reminder') ? 'checked' : '' }}>
                                        <label class="form-check-label" for="has_auto_reminder">
                                            {{ __('document-types.has_auto_reminder') }}
                                        </label>
                                    </div>
                                </div>
                                
                                <div class="col-md-6">
                                    <label class="form-label">{{ __('document-types.reminder_days_before') }}
                                    <input type="number" class="form-control @error('reminder_days_before') is-invalid @enderror" 
                                           name="reminder_days_before" value="{{ old('reminder_days_before', 30) }}" 
                                           min="1" max="365">
                                    @error('reminder_days_before')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                
                                <!-- Visual Elements -->
                                <div class="col-12">
                                    <h4 class="fw-bold mb-4">{{ __('document-types.visual_elements') }}</h4>
                                </div>
                                
                                <div class="col-md-6">
                                    <label class="form-label">{{ __('document-types.icon_class') }}</label>
                                    <input type="text" class="form-control @error('icon') is-invalid @enderror" 
                                           name="icon" value="{{ old('icon') }}" 
                                           placeholder="ki-duotone ki-document">
                                    @error('icon')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                
                                <div class="col-md-6">
                                    <label class="form-label">{{ __('document-types.color') }}</label>
                                    <input type="color" class="form-control form-control-color @error('color') is-invalid @enderror" 
                                           name="color" value="{{ old('color', '#5E6278') }}">
                                    @error('color')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                
                                <!-- Descriptions -->
                                <div class="col-12">
                                    <h4 class="fw-bold mb-4">{{ __('document-types.descriptions') }}</h4>
                                </div>
                                
                                <div class="col-md-6">
                                    <label class="form-label">{{ __('document-types.description_en') }}</label>
                                    <textarea class="form-control @error('description_en') is-invalid @enderror" 
                                              name="description_en" rows="3">{{ old('description_en') }}</textarea>
                                    @error('description_en')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                
                                <div class="col-md-6">
                                    <label class="form-label">{{ __('document-types.description_ar') }}</label>
                                    <textarea class="form-control @error('description_ar') is-invalid @enderror" 
                                              name="description_ar" rows="3">{{ old('description_ar') }}</textarea>
                                    @error('description_ar')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                
                                <!-- Status -->
                                <div class="col-12">
                                    <h4 class="fw-bold mb-4">{{ __('document-types.status') }}</h4>
                                </div>
                                
                                <div class="col-md-6">
                                    <div class="form-check form-switch">
                                        <input class="form-check-input" type="checkbox" name="is_active" 
                                               id="is_active" value="1" {{ old('is_active', true) ? 'checked' : '' }}>
                                        <label class="form-check-label" for="is_active">
                                            {{ __('document-types.is_active') }}
                                        </label>
                                    </div>
                                </div>
                            </div>
                            
                            <!-- Form Actions -->
                            <div class="d-flex justify-content-end mt-8">
                                <a href="{{ route('admin.document-types.index') }}" class="btn btn-secondary me-3">
                                    {{ __('document-types.cancel') }}
                                </a>
                                <button type="submit" class="btn btn-primary">
                                    <i class="ki-duotone ki-check fs-2"></i>
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
        const reminderDaysInput = document.querySelector('input[name="reminder_days_before"]');
        const autoReminderCheckbox = document.getElementById('has_auto_reminder');
        
        // Handle auto reminder checkbox change
        autoReminderCheckbox.addEventListener('change', function() {
            if (this.checked) {
                reminderDaysInput.required = true;
                reminderDaysInput.disabled = false;
            } else {
                reminderDaysInput.required = false;
                reminderDaysInput.disabled = true;
            }
        });
        
        // Initialize state
        if (autoReminderCheckbox.checked) {
            reminderDaysInput.required = true;
            reminderDaysInput.disabled = false;
        } else {
            reminderDaysInput.required = false;
            reminderDaysInput.disabled = true;
        }
    });
</script>
@endpush
@endsection
