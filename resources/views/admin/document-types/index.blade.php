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
                                <i class="ki-duotone ki-plus fs-2"></i>
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
                                <button type="submit" class="btn btn-primary me-2">
                                    <i class="ki-duotone ki-magnifier fs-2"></i>
                                    {{ __('document-types.filter') }}
                                </button>
                                <button type="reset" class="btn btn-secondary" id="kt_document_types_table_filter_reset">
                                    <i class="ki-duotone ki-arrows-rotate fs-2"></i>
                                    {{ __('document-types.reset') }}
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
                                        <th class="min-w-125px">{{ __('document-types.requirements') }}</th>
                                        <th class="min-w-125px">{{ __('document-types.status') }}</th>
                                        <th class="min-w-125px">{{ __('document-types.actions') }}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($documentTypes as $type)
                                    <tr>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                @if($type->icon)
                                                    <i class="{{ $type->icon }} fs-2 me-3" style="color: {{ $type->color ?? '#5E6278' }}"></i>
                                                @endif
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
                                            <span class="badge badge-light-{{ $type->entity_type === 'both' ? 'success' : ($type->entity_type === 'saudi' ? 'primary' : 'secondary') }}">
                                                {{ __('document-types.' . $type->entity_type) }}
                                            </span>
                                        </td>
                                        <td>
                                            <div class="d-flex flex-column gap-1">
                                                @if($type->requires_expiry_date)
                                                    <span class="badge badge-light-success">{{ __('document-types.expiry_date') }}</span>
                                                @endif
                                                @if($type->requires_file_upload)
                                                    <span class="badge badge-light-info">{{ __('document-types.file_upload') }}</span>
                                                @endif
                                                @if($type->has_auto_reminder)
                                                    <span class="badge badge-light-warning">{{ __('document-types.auto_reminder') }}</span>
                                                @endif
                                            </div>
                                        </td>
                                        <td>
                                            <span class="badge badge-light-{{ $type->is_active ? 'success' : 'danger' }}">
                                                {{ $type->is_active ? __('document-types.active') : __('document-types.inactive') }}
                                            </span>
                                        </td>
                                        <td>
                                            <div class="d-flex gap-2">
                                                <a href="{{ route('admin.document-types.edit', $type) }}" class="btn btn-sm btn-light-primary">
                                                    <i class="ki-duotone ki-pencil fs-2"></i>
                                                </a>
                                                <form action="{{ route('admin.document-types.destroy', $type) }}" method="POST" class="d-inline" onsubmit="return confirm('{{ __('document-types.confirm_delete_document_type') }}')">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-sm btn-light-danger">
                                                        <i class="ki-duotone ki-trash fs-2"></i>
                                                    </button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                    @empty
                                    <tr>
                                        <td colspan="7" class="text-center text-muted py-5">
                                            <i class="ki-duotone ki-document fs-3x text-muted mb-3"></i>
                                            <div>{{ __('document-types.no_document_types_found') }}</div>
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
</script>
@endpush
@endsection
