@extends('admin.layouts.master')

@section('title', __('tasks.tasks_management'))

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
                    {{ __('tasks.tasks') }}
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
                    <li class="breadcrumb-item text-muted">{{ __('common.client_management') }}</li>
                    <li class="breadcrumb-item">
                        <span class="bullet bg-gray-400 w-5px h-2px"></span>
                    </li>
                    <li class="breadcrumb-item text-muted">{{ __('tasks.tasks') }}</li>
                </ul>
                <!--end::Breadcrumb-->
            </div>
            <!--end::Page title-->
            <!--begin::Actions-->
            <div class="d-flex align-items-center gap-2 gap-lg-3">
                @if(auth()->user()->can(\App\Enums\PermissionEnum::CREATE_TASKS->value))
                <a href="{{ route('admin.tasks.create') }}" class="btn btn-sm fw-bold btn-primary">
                    <i class="fas fa-plus fs-2"></i>{{ __('tasks.create_task') }}
                </a>
                @endif
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
                <div class="card-header border-0 pt-6">
                    <!--begin::Card title-->
                    <div class="card-title">
                        <!--begin::Search-->
                        <div class="d-flex align-items-center position-relative my-1">
                            <i class="fas fa-search fs-3 position-absolute ms-5"></i>
                            <input type="text" data-kt-tasks-table-filter="search" class="form-control form-control-solid w-250px ps-13" placeholder="{{ __('tasks.search_tasks') }}" />
                        </div>
                        <!--end::Search-->
                    </div>
                    <!--begin::Card title-->
                    <!--begin::Card toolbar-->
                    <div class="card-toolbar">
                        <!--begin::Toolbar-->
                        <div class="d-flex justify-content-end" data-kt-tasks-table-toolbar="base">
                            <!--begin::Filter-->
                            <button type="button" class="btn btn-light-primary me-3" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">
                                <i class="fas fa-filter fs-2"></i>{{ __('common.filter') }}
                            </button>
                            <!--begin::Menu 1-->
                            <div class="menu menu-sub menu-sub-dropdown w-300px w-md-325px" data-kt-menu="true">
                                <!--begin::Header-->
                                <div class="px-7 py-5">
                                    <div class="fs-5 text-gray-900 fw-bold">{{ __('common.filter_options') }}</div>
                                </div>
                                <!--end::Header-->
                                <!--begin::Separator-->
                                <div class="separator border-gray-200"></div>
                                <!--end::Separator-->
                                <!--begin::Content-->
                                <div class="px-7 py-5" data-kt-tasks-table-filter="form">
                                    <!--begin::Input group-->
                                    <div class="mb-10">
                                        <label class="form-label fs-6 fw-semibold">{{ __('tasks.filter_by_status') }}:</label>
                                        <select class="form-select form-select-solid fw-bold" data-kt-select2="true" data-placeholder="{{ __('tasks.select_status') }}" data-allow-clear="true" data-kt-tasks-table-filter="status" data-hide-search="true">
                                            <option></option>
                                            @foreach($statuses as $key => $status)
                                            <option value="{{ $key }}">{{ $status }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <!--end::Input group-->
                                    <!--end::Input group-->
                                    <!--begin::Input group-->
                                    <div class="mb-10">
                                        <label class="form-label fs-6 fw-semibold">{{ __('tasks.filter_by_assigned_to') }}:</label>
                                        <select class="form-select form-select-solid fw-bold" data-kt-select2="true" data-placeholder="{{ __('tasks.select_assigned_user') }}" data-allow-clear="true" data-kt-tasks-table-filter="assigned_to" data-hide-search="true">
                                            <option></option>
                                            @foreach($users as $user)
                                            <option value="{{ $user->id }}">{{ $user->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <!--end::Input group-->
                                    <!--begin::Actions-->
                                    <div class="d-flex justify-content-end">
                                        <button type="reset" class="btn btn-light btn-active-light-primary fw-semibold me-2 px-6" data-kt-menu-dismiss="true" data-kt-tasks-table-filter="reset">{{ __('common.reset') }}</button>
                                        <button type="submit" class="btn btn-primary fw-semibold px-6" data-kt-menu-dismiss="true" data-kt-tasks-table-filter="filter">{{ __('common.apply') }}</button>
                                    </div>
                                    <!--end::Actions-->
                                </div>
                                <!--end::Content-->
                            </div>
                            <!--end::Menu 1-->
                            <!--end::Filter-->
                        </div>
                        <!--end::Toolbar-->
                    </div>
                    <!--end::Card toolbar-->
                </div>
                <!--end::Card header-->
                <!--begin::Card body-->
                <div class="card-body py-4">
                    <!--begin::Table-->
                    <div class="table-responsive">
                    <table class="table align-middle table-row-dashed fs-6 gy-5" id="kt_tasks_table">
                        <thead>
                            <tr class="text-start text-muted fw-bold fs-7 text-uppercase gs-0">
                                <th class="min-w-125px">{{ __('tasks.title') }}</th>
                                <th class="min-w-150px">{{ __('tasks.document') }}</th>
                                <th class="min-w-125px">{{ __('tasks.client') }}</th>
                                <th class="min-w-125px">{{ __('tasks.assigned_to') }}</th>
                                <th class="min-w-100px">{{ __('tasks.status') }}</th>
                                <th class="min-w-100px">{{ __('tasks.due_date') }}</th>
                                <th class="min-w-100px">{{ __('tasks.created_at') }}</th>
                                <th class="text-end min-w-100px">{{ __('common.actions') }}</th>
                            </tr>
                        </thead>
                        <tbody class="text-gray-600 fw-semibold">
                            @forelse($tasks as $task)
                            <tr>
                                <td>
                                    <div class="d-flex flex-column">
                                        <a href="{{ route('admin.tasks.show', $task) }}" class="text-gray-800 text-hover-primary mb-1 fs-6 fw-bold">{{ $task->title }}</a>
                                        @if($task->description)
                                        <span class="text-muted fs-7">{{ Str::limit($task->description, 50) }}</span>
                                        @endif
                                    </div>
                                </td>
                                <td>
                                    <div class="d-flex flex-column">
                                        @php
                                            $docSummary = $task->getDocumentTypesSummary();
                                        @endphp
                                        
                                        @php
                                            $documentTypes = [];
                                            if ($docSummary['company'] > 0) $documentTypes[] = 'company';
                                            if ($docSummary['employee'] > 0) $documentTypes[] = 'employee';
                                            if ($docSummary['civil_defense'] > 0) $documentTypes[] = 'civil_defense';
                                            if ($docSummary['municipality'] > 0) $documentTypes[] = 'municipality';
                                            if ($docSummary['branch_registration'] > 0) $documentTypes[] = 'branch_registration';
                                        @endphp
                                        
                                        @if(count($documentTypes) > 1)
                                            <span class="badge badge-light-warning mb-1">
                                                <i class="fas fa-layer-group me-1"></i>
                                                {{ __('tasks.mixed_documents') }}
                                            </span>
                                        @elseif($docSummary['company'] > 0)
                                            <span class="badge badge-light-primary mb-1">
                                                <i class="fas fa-building me-1"></i>
                                                {{ __('tasks.company_document') }}
                                            </span>
                                        @elseif($docSummary['employee'] > 0)
                                            <span class="badge badge-light-info mb-1">
                                                <i class="fas fa-user me-1"></i>
                                                {{ __('tasks.employee_document') }}
                                            </span>
                                        @elseif($docSummary['civil_defense'] > 0)
                                            <span class="badge badge-light-success mb-1">
                                                <i class="fas fa-shield-alt me-1"></i>
                                                {{ __('tasks.civil_defense_license') }}
                                            </span>
                                        @elseif($docSummary['municipality'] > 0)
                                            <span class="badge badge-light-warning mb-1">
                                                <i class="fas fa-city me-1"></i>
                                                {{ __('tasks.municipality_license') }}
                                            </span>
                                        @elseif($docSummary['branch_registration'] > 0)
                                            <span class="badge badge-light-secondary mb-1">
                                                <i class="fas fa-file-alt me-1"></i>
                                                {{ __('tasks.branch_registration') }}
                                            </span>
                                        @endif
                                        
                                        <span class="text-gray-600 fs-7">
                                            {{ trans_choice('tasks.documents_count', $docSummary['total'], ['count' => $docSummary['total']]) }}
                                        </span>
                                    </div>
                                </td>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <div class="d-flex flex-column">
                                            <span class="text-gray-800 fw-bold">{{ $task->getClientName() }}</span>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <div class="d-flex flex-column">
                                            <span class="text-gray-800 fw-bold">{{ $task->assignedUser->name }}</span>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    @php
                                        $statusConfig = [
                                            'new' => ['class' => 'badge-light-primary', 'icon' => 'fas fa-info-circle'],
                                            'in_progress' => ['class' => 'badge-light-warning', 'icon' => 'fas fa-clock'],
                                            'completed' => ['class' => 'badge-light-success', 'icon' => 'fas fa-check-circle'],
                                            'pending' => ['class' => 'badge-light-info', 'icon' => 'fas fa-pause-circle'],
                                        ];
                                        $config = $statusConfig[$task->status] ?? $statusConfig['new'];
                                    @endphp
                                    <span class="badge {{ $config['class'] }} fs-7 fw-bold">
                                        <i class="{{ $config['icon'] }} fs-6 me-1"></i>
                                        {{ $task->getStatuses()[$task->status] }}
                                    </span>
                                </td>
                                <td>
                                    @if($task->due_date)
                                        @php
                                            $isOverdue = $task->due_date->isPast() && !$task->isCompleted();
                                            $isDueSoon = $task->due_date->isFuture() && $task->due_date->diffInDays(now()) <= 7;
                                        @endphp
                                        <div class="d-flex flex-column">
                                            <span class="text-gray-800 fw-bold">{{ $task->due_date->format('Y-m-d') }}</span>
                                            @if($isOverdue)
                                                <span class="text-danger fs-7">{{ __('tasks.is_overdue') }}</span>
                                            @elseif($isDueSoon)
                                                <span class="text-warning fs-7">{{ __('tasks.is_due_soon') }}</span>
                                            @endif
                                        </div>
                                    @else
                                        <span class="text-muted">{{ __('tasks.no_due_date') }}</span>
                                    @endif
                                </td>
                                <td>
                                    <span class="text-gray-800 fw-bold">{{ $task->created_at->format('Y-m-d H:i') }}</span>
                                </td>
                                <td class="text-end">
                                    <a href="#" class="btn btn-light btn-active-light-primary btn-sm" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">
                                        {{ __('common.actions') }}
                                        <i class="fas fa-chevron-down fs-5 ms-1"></i>
                                    </a>
                                    <!--begin::Menu-->
                                    <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-600 menu-state-bg-light-primary fw-semibold fs-7 w-125px py-4" data-kt-menu="true">
                                        <!--begin::Menu item-->
                                        <div class="menu-item px-3">
                                            <a href="{{ route('admin.tasks.show', $task) }}" class="menu-link px-3">{{ __('common.view') }}</a>
                                        </div>
                                        <!--end::Menu item-->
                                        @can('update_tasks')
                                        <!--begin::Menu item-->
                                        <div class="menu-item px-3">
                                            <a href="{{ route('admin.tasks.edit', $task) }}" class="menu-link px-3">{{ __('common.edit') }}</a>
                                        </div>
                                        <!--end::Menu item-->
                                        @endcan
                                        @can('delete_tasks')
                                        <!--begin::Menu item-->
                                        <div class="menu-item px-3">
                                            <a href="#" class="menu-link px-3 text-danger" data-kt-tasks-table-filter="delete_row" data-task-id="{{ $task->id }}">{{ __('common.delete') }}</a>
                                        </div>
                                        <!--end::Menu item-->
                                        @endcan
                                    </div>
                                    <!--end::Menu-->
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="7" class="text-center py-10">
                                    <div class="d-flex flex-column align-items-center">
                                        <i class="fas fa-info-circle fs-3x text-muted mb-5"></i>
                                        <span class="text-muted fs-6">{{ __('tasks.no_tasks_found') }}</span>
                                    </div>
                                </td>
                            </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                    <!--end::Table-->
                    
                    <!--begin::Pagination-->
                    @if($tasks->hasPages())
                    <div class="d-flex flex-stack flex-wrap pt-10">
                        <div class="fs-6 fw-semibold text-gray-700">
                            {{ __('common.showing') }} {{ $tasks->firstItem() }} {{ __('common.to') }} {{ $tasks->lastItem() }} {{ __('common.of') }} {{ $tasks->total() }} {{ __('common.entries') }}
                        </div>
                        <ul class="pagination">
                            @if($tasks->onFirstPage())
                                <li class="page-item previous disabled">
                                    <a href="#" class="page-link">
                                        <i class="previous"></i>
                                    </a>
                                </li>
                            @else
                                <li class="page-item previous">
                                    <a href="{{ $tasks->previousPageUrl() }}" class="page-link">
                                        <i class="previous"></i>
                                    </a>
                                </li>
                            @endif

                            @foreach($tasks->getUrlRange(1, $tasks->lastPage()) as $page => $url)
                                @if($page == $tasks->currentPage())
                                    <li class="page-item active">
                                        <a href="#" class="page-link">{{ $page }}</a>
                                    </li>
                                @else
                                    <li class="page-item">
                                        <a href="{{ $url }}" class="page-link">{{ $page }}</a>
                                    </li>
                                @endif
                            @endforeach

                            @if($tasks->hasMorePages())
                                <li class="page-item next">
                                    <a href="{{ $tasks->nextPageUrl() }}" class="page-link">
                                        <i class="next"></i>
                                    </a>
                                </li>
                            @else
                                <li class="page-item next disabled">
                                    <a href="#" class="page-link">
                                        <i class="next"></i>
                                    </a>
                                </li>
                            @endif
                        </ul>
                    </div>
                    @endif
                    <!--end::Pagination-->
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

<!--begin::Delete Modal-->
<div class="modal fade" id="kt_modal_delete_task" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered mw-650px">
        <div class="modal-content">
            <div class="modal-header" id="kt_modal_delete_task_header">
                <h2 class="fw-bold">{{ __('tasks.delete_task') }}</h2>
                <div id="kt_modal_delete_task_close" class="btn btn-icon btn-sm btn-active-icon-primary">
                    <i class="fas fa-times fs-1"></i>
                </div>
            </div>
            <div class="modal-body mx-5 mx-xl-15 my-7">
                <div class="text-center">
                    <i class="fas fa-exclamation-triangle fs-7x text-warning mb-5"></i>
                    <div class="text-gray-500 fw-semibold fs-6">{{ __('tasks.confirm_delete_task') }}</div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-light" data-bs-dismiss="modal">{{ __('common.cancel') }}</button>
                <form id="kt_modal_delete_task_form" method="POST" style="display: inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">{{ __('common.delete') }}</button>
                </form>
            </div>
        </div>
    </div>
</div>
<!--end::Delete Modal-->
@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Delete task functionality
    document.querySelectorAll('[data-kt-tasks-table-filter="delete_row"]').forEach(function(element) {
        element.addEventListener('click', function(e) {
            e.preventDefault();
            const taskId = this.getAttribute('data-task-id');
            const modal = document.getElementById('kt_modal_delete_task');
            const form = document.getElementById('kt_modal_delete_task_form');
            
            form.action = `/admin/tasks/${taskId}`;
            
            const modalInstance = new bootstrap.Modal(modal);
            modalInstance.show();
        });
    });

    // Filter functionality
    const filterForm = document.querySelector('[data-kt-tasks-table-filter="form"]');
    const filterButton = document.querySelector('[data-kt-tasks-table-filter="filter"]');
    const resetButton = document.querySelector('[data-kt-tasks-table-filter="reset"]');
    const searchInput = document.querySelector('[data-kt-tasks-table-filter="search"]');

    // Apply filters
    if (filterButton) {
        filterButton.addEventListener('click', function(e) {
            e.preventDefault();
            applyFilters();
        });
    }

    // Reset filters
    if (resetButton) {
        resetButton.addEventListener('click', function(e) {
            e.preventDefault();
            resetFilters();
        });
    }

    // Search functionality with AJAX
    if (searchInput) {
        let searchTimeout;
        searchInput.addEventListener('input', function() {
            clearTimeout(searchTimeout);
            searchTimeout = setTimeout(function() {
                applyFilters();
            }, 300); // Debounce search by 300ms
        });
    }

    // Apply filters function with AJAX
    function applyFilters() {
        const params = new URLSearchParams();

        // Get filter values - handle Select2 components properly
        const statusFilter = $('[data-kt-tasks-table-filter="status"]');
        const assignedToFilter = $('[data-kt-tasks-table-filter="assigned_to"]');
        const searchValue = searchInput ? searchInput.value.trim() : '';

        // Add filters to params - get Select2 values properly
        if (statusFilter.length && statusFilter.val()) {
            params.set('status', statusFilter.val());
        }
        if (assignedToFilter.length && assignedToFilter.val()) {
            params.set('assigned_to', assignedToFilter.val());
        }
        if (searchValue) {
            params.set('search', searchValue);
        }

        // Show loading state
        showTableLoading();

        // Make AJAX request
        fetch('{{ route("admin.tasks.index") }}?' + params.toString(), {
            method: 'GET',
            headers: {
                'X-Requested-With': 'XMLHttpRequest',
                'Accept': 'text/html',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            }
        })
        .then(response => {
            if (!response.ok) {
                throw new Error('Network response was not ok');
            }
            return response.text();
        })
        .then(html => {
            // Extract table content from response
            const parser = new DOMParser();
            const doc = parser.parseFromString(html, 'text/html');
            const newTableBody = doc.querySelector('#kt_tasks_table tbody');
            const newPagination = doc.querySelector('.pagination');
            
            // Update table body
            const currentTableBody = document.querySelector('#kt_tasks_table tbody');
            if (currentTableBody && newTableBody) {
                currentTableBody.innerHTML = newTableBody.innerHTML;
            }
            
            // Update pagination
            const currentPagination = document.querySelector('.pagination');
            if (currentPagination && newPagination) {
                currentPagination.innerHTML = newPagination.innerHTML;
            } else if (currentPagination && !newPagination) {
                currentPagination.innerHTML = '';
            }
            
            // Update URL without page reload
            const newUrl = window.location.pathname + (params.toString() ? '?' + params.toString() : '');
            window.history.pushState({}, '', newUrl);
            
            hideTableLoading();
        })
        .catch(error => {
            console.error('Error:', error);
            hideTableLoading();
            
            // Show error message
            const tableBody = document.querySelector('#kt_tasks_table tbody');
            if (tableBody) {
                tableBody.innerHTML = `
                    <tr>
                        <td colspan="6" class="text-center py-10">
                            <div class="alert alert-danger">
                                <i class="fas fa-exclamation-triangle me-2"></i>
                                {{ __('common.error_loading_data') }}
                            </div>
                        </td>
                    </tr>
                `;
            }
        });
    }

    // Reset filters function
    function resetFilters() {
        // Clear all filter values
        if (searchInput) searchInput.value = '';
        $('[data-kt-tasks-table-filter="status"]').val(null).trigger('change');
        $('[data-kt-tasks-table-filter="assigned_to"]').val(null).trigger('change');
        
        // Apply filters (which will clear them)
        applyFilters();
    }

    // Show loading state
    function showTableLoading() {
        const tableBody = document.querySelector('#kt_tasks_table tbody');
        if (tableBody) {
            tableBody.innerHTML = `
                <tr>
                    <td colspan="6" class="text-center py-10">
                        <div class="d-flex justify-content-center">
                            <div class="spinner-border text-primary" role="status">
                                <span class="visually-hidden">Loading...</span>
                            </div>
                        </div>
                    </td>
                </tr>
            `;
        }
    }

    // Hide loading state
    function hideTableLoading() {
        // Loading state will be replaced by actual data
    }

    // Initialize filter values from URL params
    const urlParams = new URLSearchParams(window.location.search);
    
    // Wait for Select2 to be initialized
    setTimeout(function() {
        if (urlParams.get('status')) {
            const statusFilter = $('[data-kt-tasks-table-filter="status"]');
            if (statusFilter.length) {
                statusFilter.val(urlParams.get('status')).trigger('change');
            }
        }
        
        
        if (urlParams.get('assigned_to')) {
            const assignedToFilter = $('[data-kt-tasks-table-filter="assigned_to"]');
            if (assignedToFilter.length) {
                assignedToFilter.val(urlParams.get('assigned_to')).trigger('change');
            }
        }
        
        if (urlParams.get('search')) {
            if (searchInput) {
                searchInput.value = urlParams.get('search');
            }
        }
    }, 200); // Small delay to ensure Select2 is initialized
});
</script>
@endpush
