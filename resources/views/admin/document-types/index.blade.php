@extends('admin.layouts.master')

@section('title', __('document-types.management'))

@section('content')
<div class="d-flex flex-column flex-root app-root" id="kt_app_root">
    <div class="d-flex flex-column flex-column-fluid" id="kt_app_content">
        <div class="d-flex flex-column-fluid" id="kt_app_content_container">
            <div class="container-fluid">
                <!-- Page Header -->
                <div class="card mb-5 mb-xl-10">
                    <div class="card-header border-0">
                        <div class="card-title m-0">
                            <h3 class="fw-bold m-0">{{ __('document-types.management') }}</h3>
                        </div>
                        <div class="card-toolbar">
                            <a href="{{ route('admin.document-types.create') }}" class="btn btn-primary">
                                <i class="fa fa-plus"></i>
                                {{ __('document-types.add_document_type') }}
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Filters -->
                <div class="card mb-5 mb-xl-10">
                    <div class="card-body">
                        <form id="kt_document_types_table_filter_form" class="row g-3">
                            <div class="col-md-3">
                                <label class="form-label">{{ __('document-types.category') }}</label>
                                <select class="form-select" data-kt-document-types-table-filter="category">
                                    <option value="">{{ __('document-types.all_categories') }}</option>
                                    <option value="employee">{{ __('document-types.employee') }}</option>
                                    <option value="company">{{ __('document-types.company') }}</option>
                                </select>
                            </div>
                            <div class="col-md-3">
                                <label class="form-label">{{ __('document-types.entity_type') }}</label>
                                <select class="form-select" data-kt-document-types-table-filter="entity_type">
                                    <option value="">{{ __('document-types.all_types') }}</option>
                                    <option value="saudi">{{ __('document-types.saudi') }}</option>
                                    <option value="expat">{{ __('document-types.expat') }}</option>
                                    <option value="both">{{ __('document-types.both') }}</option>
                                </select>
                            </div>
                            <div class="col-md-3">
                                <label class="form-label">{{ __('document-types.status') }}</label>
                                <select class="form-select" data-kt-document-types-table-filter="status">
                                    <option value="">{{ __('document-types.all_status') }}</option>
                                    <option value="1">{{ __('document-types.active') }}</option>
                                    <option value="0">{{ __('document-types.inactive') }}</option>
                                </select>
                            </div>
                            <div class="col-md-3 d-flex align-items-end">
                                <button type="submit" class="btn btn-primary me-2 d-flex align-items-center">
                                    <i class="fa fa-search me-2"></i>
                                    <span>{{ __('document-types.filter') }}</span>
                                </button>
                                <button type="reset" class="btn btn-secondary d-flex align-items-center" id="kt_document_types_table_filter_reset">
                                    <i class="fa fa-refresh me-2"></i>
                                    <span>{{ __('document-types.reset') }}</span>
                                </button>
                            </div>
                        </form>
                    </div>
                </div>

                <!-- Document Types Table -->
                <div class="card">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-row-bordered table-row-gray-100 align-middle gs-0 gy-3">
                                <thead>
                                    <tr class="fw-bold text-muted">
                                        <th class="min-w-125px">{{ __('document-types.name') }}</th>
                                        <th class="min-w-125px">{{ __('document-types.code') }}</th>
                                        <th class="min-w-125px">{{ __('document-types.category') }}</th>
                                        <th class="min-w-125px">{{ __('document-types.entity_type') }}</th>
                                        <th class="min-w-125px">{{ __('document-types.custom_fields') }}</th>
                                        <th class="min-w-125px">{{ __('document-types.reminder_days') }}</th>
                                        <th class="min-w-125px">{{ __('document-types.status') }}</th>
                                        <th class="min-w-125px">{{ __('document-types.actions') }}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($documentTypes as $type)
                                    <tr>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                <div>
                                                    <div class="fw-bold text-gray-800">{{ $type->name_en }}</div>
                                                    <div class="text-muted">{{ $type->name_ar }}</div>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <span class="badge badge-light-primary">{{ $type->code }}</span>
                                        </td>
                                        <td>
                                            <span class="badge badge-light-{{ $type->category === 'employee' ? 'info' : 'warning' }}">
                                                {{ __('document-types.' . $type->category) }}
                                            </span>
                                        </td>
                                        <td>
                                            <span class="badge badge-{{ $type->entity_type === 'both' ? 'light-success' : ($type->entity_type === 'saudi' ? 'light-primary' : 'secondary') }}">
                                                {{ __('document-types.' . $type->entity_type) }}
                                            </span>
                                        </td>
                                        <td>
                                            @if($type->custom_fields && count($type->custom_fields) > 0)
                                                <div class="d-flex flex-column gap-1">
                                                    <span class="badge badge-light-primary">
                                                        {{ __('document-types.custom_fields_count', ['count' => count($type->custom_fields)]) }}
                                                    </span>
                                                </div>
                                            @else
                                                <span class="text-muted">{{ __('document-types.no_custom_fields') }}</span>
                                            @endif
                                        </td>
                                        <td>
                                            @if($type->reminder_days_before)
                                                <div class="d-flex align-items-center">
                                                    <i class="fa fa-bell text-warning me-1"></i>
                                                    <span class="text-muted me-1">{{ __('document-types.before') }}</span>
                                                    <span class="fw-bold">{{ $type->reminder_days_before }}</span>
                                                    <span class="text-muted ms-1">{{ __('document-types.days') }}</span>
                                                </div>
                                            @else
                                                <span class="text-muted">{{ __('document-types.no_reminder') }}</span>
                                            @endif
                                        </td>
                                        <td>
                                            <span class="badge badge-light-{{ $type->is_active ? 'success' : 'danger' }}">
                                                {{ $type->is_active ? __('document-types.active') : __('document-types.inactive') }}
                                            </span>
                                        </td>
                                        <td>
                                            <div class="d-flex gap-2">
                                                <form action="{{ route('admin.document-types.destroy', $type) }}" method="POST" class="d-inline" onsubmit="return confirm('{{ __('document-types.confirm_delete_document_type') }}')">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-sm btn-light-danger">
                                                        <i class="fa fa-trash"></i>
                                                    </button>
                                                </form>
                                                <a href="{{ route('admin.document-types.edit', $type) }}" class="btn btn-sm btn-light-primary">
                                                    <i class="fa fa-edit"></i>
                                                </a>
                                            </div>
                                        </td>
                                    </tr>
                                    @empty
                                    <tr>
                                        <td colspan="8" class="text-center py-5">
                                            <div class="d-flex flex-column align-items-center justify-content-center py-5">
                                                <i class="fa fa-file-text fa-3x text-muted mb-4"></i>
                                                <h4 class="text-muted mb-2">{{ __('document-types.no_document_types_found') }}</h4>
                                                <p class="text-muted mb-0">{{ __('document-types.try_adjusting_filters') }}</p>
                                            </div>
                                        </td>
                                    </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>

                        <!-- Pagination -->
                        @if($documentTypes->hasPages())
                            <div class="d-flex justify-content-center mt-5">
                                {{ $documentTypes->links() }}
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
    // Filter functionality
    const filterForm = document.getElementById('kt_document_types_table_filter_form');
    const resetButton = document.getElementById('kt_document_types_table_filter_reset');

    // Initialize filters from URL parameters on page load
    function initializeFilters() {
        const urlParams = new URLSearchParams(window.location.search);
        
        const categorySelect = filterForm.querySelector('[data-kt-document-types-table-filter="category"]');
        const entityTypeSelect = filterForm.querySelector('[data-kt-document-types-table-filter="entity_type"]');
        const statusSelect = filterForm.querySelector('[data-kt-document-types-table-filter="status"]');
        
        // Set category filter
        if (urlParams.has('category') && categorySelect) {
            const categoryValue = urlParams.get('category');
            if (categorySelect.querySelector(`option[value="${categoryValue}"]`)) {
                categorySelect.value = categoryValue;
            }
        }
        
        // Set entity type filter
        if (urlParams.has('entity_type') && entityTypeSelect) {
            const entityTypeValue = urlParams.get('entity_type');
            if (entityTypeSelect.querySelector(`option[value="${entityTypeValue}"]`)) {
                entityTypeSelect.value = entityTypeValue;
            }
        }
        
        // Set status filter
        if (urlParams.has('status') && statusSelect) {
            const statusValue = urlParams.get('status');
            if (statusSelect.querySelector(`option[value="${statusValue}"]`)) {
                statusSelect.value = statusValue;
            }
        }
    }

    filterForm.addEventListener('submit', function(e) {
        e.preventDefault();
        applyFilters();
    });

    resetButton.addEventListener('click', function() {
        filterForm.reset();
        applyFilters();
    });

    function applyFilters() {
        const category = filterForm.querySelector('[data-kt-document-types-table-filter="category"]').value;
        const entityType = filterForm.querySelector('[data-kt-document-types-table-filter="entity_type"]').value;
        const status = filterForm.querySelector('[data-kt-document-types-table-filter="status"]').value;

        const url = new URL(window.location);
        
        if (category) {
            url.searchParams.set('category', category);
        } else {
            url.searchParams.delete('category');
        }
        
        if (entityType) {
            url.searchParams.set('entity_type', entityType);
        } else {
            url.searchParams.delete('entity_type');
        }
        
        if (status) {
            url.searchParams.set('status', status);
        } else {
            url.searchParams.delete('status');
        }

        window.location.href = url.toString();
    }

    // Initialize filters when page loads
    document.addEventListener('DOMContentLoaded', function() {
        initializeFilters();
        updateFilterIndicators();
    });

    // Update visual indicators for active filters
    function updateFilterIndicators() {
        const categorySelect = filterForm.querySelector('[data-kt-document-types-table-filter="category"]');
        const entityTypeSelect = filterForm.querySelector('[data-kt-document-types-table-filter="entity_type"]');
        const statusSelect = filterForm.querySelector('[data-kt-document-types-table-filter="status"]');
        
        // Add visual indicators for active filters
        [categorySelect, entityTypeSelect, statusSelect].forEach(select => {
            if (select && select.value) {
                select.classList.add('border-primary');
            } else {
                select.classList.remove('border-primary');
            }
        });
    }

    // Update indicators when filters change
    filterForm.addEventListener('change', function() {
        updateFilterIndicators();
    });
</script>
@endpush
@endsection
