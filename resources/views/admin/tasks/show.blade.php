@extends('admin.layouts.master')

@section('title', __('tasks.task_details'))

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
                    {{ $task->title }}
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
                    <li class="breadcrumb-item text-muted">
                        <a href="{{ route('admin.tasks.index') }}" class="text-muted text-hover-primary">{{ __('tasks.tasks') }}</a>
                    </li>
                    <li class="breadcrumb-item">
                        <span class="bullet bg-gray-400 w-5px h-2px"></span>
                    </li>
                    <li class="breadcrumb-item text-muted">{{ __('tasks.task_details') }}</li>
                </ul>
                <!--end::Breadcrumb-->
            </div>
            <!--end::Page title-->
            <!--begin::Actions-->
            <div class="d-flex align-items-center gap-2 gap-lg-3">
                @can('update_tasks')
                <a href="{{ route('admin.tasks.edit', $task) }}" class="btn btn-sm fw-bold btn-primary">
                    <i class="fas fa-edit fs-2"></i>{{ __('common.edit') }}
                </a>
                @endcan
                <a href="{{ route('admin.tasks.index') }}" class="btn btn-sm fw-bold btn-secondary">
                    <i class="fas fa-arrow-left fs-2"></i>{{ __('common.back') }}
                </a>
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
            <!--begin::Layout-->
            <div class="d-flex flex-column flex-lg-row">
                <!--begin::Content-->
                <div class="flex-lg-row-fluid mb-10 mb-lg-0 me-lg-7 me-xl-10">
                    <!--begin::Card-->
                    <div class="card">
                        <!--begin::Card header-->
                        <div class="card-header">
                            <div class="card-title">
                                <h2>{{ __('tasks.task_details') }}</h2>
                            </div>
                        </div>
                        <!--end::Card header-->
                        <!--begin::Card body-->
                        <div class="card-body">
                            <!--begin::Description-->
                            <div class="mb-10">
                                <h4 class="fw-bold text-gray-900 mb-3">{{ __('tasks.description') }}</h4>
                                <div class="text-gray-600 fs-6">
                                    @if($task->description)
                                        {{ $task->description }}
                                    @else
                                        <span class="text-muted">{{ __('common.n_a') }}</span>
                                    @endif
                                </div>
                            </div>
                            <!--end::Description-->
                            
                            <!--begin::Documents Info-->
                            <div class="mb-10">
                                <h4 class="fw-bold text-gray-900 mb-3">{{ __('tasks.selected_documents') }}</h4>
                                
                                @if($task->taskDocuments->count() > 0)
                                    <div class="row">
                                        @foreach($task->taskDocuments as $taskDoc)
                                            @php
                                                $document = $taskDoc->getDocumentInstance();
                                                $documentName = $taskDoc->getDocumentTitle();
                                                $isCompany = $taskDoc->isCompanyDocument();
                                                
                                                // Get specific document type info
                                                $docTypeInfo = [
                                                    'company_document' => ['icon' => 'building', 'color' => 'primary', 'label' => __('tasks.company_document')],
                                                    'employee_document' => ['icon' => 'user', 'color' => 'info', 'label' => __('tasks.employee_document')],
                                                    'civil_defense' => ['icon' => 'shield-alt', 'color' => 'success', 'label' => __('tasks.civil_defense_license')],
                                                    'municipality' => ['icon' => 'city', 'color' => 'warning', 'label' => __('tasks.municipality_license')],
                                                    'branch_registration' => ['icon' => 'briefcase', 'color' => 'secondary', 'label' => __('tasks.branch_registration')],
                                                ];
                                                
                                                $currentType = $docTypeInfo[$taskDoc->document_type] ?? $docTypeInfo['company_document'];
                                            @endphp
                                            
                                            <div class="col-md-6 mb-4">
                                                <div class="card card-custom border">
                                                    <div class="card-body p-4">
                                                        <div class="d-flex align-items-center mb-3">
                                                            <div class="symbol symbol-40px me-3">
                                                                <div class="symbol-label bg-light-{{ $currentType['color'] }}">
                                                                    <i class="fas fa-{{ $currentType['icon'] }} fs-4 text-{{ $currentType['color'] }}"></i>
                                                                </div>
                                                            </div>
                                                            <div class="d-flex flex-column">
                                                                <span class="fw-bold text-gray-800 fs-6">{{ $documentName }}</span>
                                                                <span class="badge badge-light-{{ $currentType['color'] }} fs-8 align-self-start">
                                                                    {{ $currentType['label'] }}
                                                                </span>
                                                            </div>
                                                        </div>
                                                        
                                                        @if($document)
                                                            <div class="d-flex gap-2">
                                                                @php
                                                                    $showRoute = null;
                                                                    $editRoute = null;
                                                                    $canUpdate = false;
                                                                    
                                                                    switch($taskDoc->document_type) {
                                                                        case 'company_document':
                                                                            $showRoute = route('admin.companies.documents.show', [$document->company_id, $document]);
                                                                            $editRoute = route('admin.companies.documents.edit', [$document->company_id, $document]);
                                                                            $canUpdate = auth()->user()->can(\App\Enums\PermissionEnum::UPDATE_COMPANY_DOCUMENTS->value);
                                                                            break;
                                                                        case 'employee_document':
                                                                            $showRoute = route('admin.employees.documents.show', [$document->employee_id, $document]);
                                                                            $editRoute = route('admin.employees.documents.edit', [$document->employee_id, $document]);
                                                                            $canUpdate = auth()->user()->can(\App\Enums\PermissionEnum::UPDATE_CLIENT_EMPLOYEES->value);
                                                                            break;
                                                                        case 'branch_registration':
                                                                            $showRoute = route('admin.companies.branch-registrations.show', [$document->company_id, $document]);
                                                                            $editRoute = route('admin.companies.branch-registrations.edit', [$document->company_id, $document]);
                                                                            $canUpdate = auth()->user()->can(\App\Enums\PermissionEnum::UPDATE_COMPANY_DOCUMENTS->value);
                                                                            break;
                                                                        case 'civil_defense':
                                                                            $showRoute = route('admin.companies.civil-defense-licenses.show', [$document->company_id, $document]);
                                                                            $editRoute = route('admin.companies.civil-defense-licenses.edit', [$document->company_id, $document]);
                                                                            $canUpdate = auth()->user()->can(\App\Enums\PermissionEnum::UPDATE_COMPANY_DOCUMENTS->value);
                                                                            break;
                                                                        case 'municipality':
                                                                            $showRoute = route('admin.companies.municipality-licenses.show', [$document->company_id, $document]);
                                                                            $editRoute = route('admin.companies.municipality-licenses.edit', [$document->company_id, $document]);
                                                                            $canUpdate = auth()->user()->can(\App\Enums\PermissionEnum::UPDATE_COMPANY_DOCUMENTS->value);
                                                                            break;
                                                                    }
                                                                @endphp
                                                                
                                                                @if($showRoute)
                                                                    <a href="{{ $showRoute }}" class="btn btn-sm btn-light-info">
                                                                        <i class="fas fa-eye me-1"></i>{{ __('common.view') }}
                                                                    </a>
                                                                @endif
                                                                
                                                                @if($editRoute && $canUpdate)
                                                                    <a href="{{ $editRoute }}" class="btn btn-sm btn-light-primary">
                                                                        <i class="fas fa-edit me-1"></i>{{ __('common.edit') }}
                                                                    </a>
                                                                @endif
                                                            </div>
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                    
                                    <!-- Summary -->
                                    <div class="alert alert-secondary d-flex align-items-center p-5 mt-5">
                                        <i class="fas fa-info-circle fs-2hx text-secondary me-4"></i>
                                        <div class="d-flex flex-column">
                                            <h4 class="mb-1 text-secondary">{{ __('tasks.document_summary') }}</h4>
                                            @php
                                                $docSummary = $task->getDocumentTypesSummary();
                                            @endphp
                                            <span>
                                                {{ trans_choice('tasks.total_documents_assigned', $docSummary['total'], ['count' => $docSummary['total']]) }}
                                                @if($docSummary['company'] > 0 && $docSummary['employee'] > 0)
                                                    - {{ $docSummary['company'] }} {{ __('tasks.company_documents') }}, {{ $docSummary['employee'] }} {{ __('tasks.employee_documents') }}
                                                @elseif($docSummary['company'] > 0)
                                                    - {{ __('tasks.all_company_documents') }}
                                                @elseif($docSummary['employee'] > 0)
                                                    - {{ __('tasks.all_employee_documents') }}
                                                @endif
                                            </span>
                                        </div>
                                    </div>
                                @else
                                    <div class="alert alert-warning d-flex align-items-center p-5">
                                        <i class="fas fa-exclamation-triangle fs-2hx text-warning me-4"></i>
                                        <div class="d-flex flex-column">
                                            <h4 class="mb-1 text-warning">{{ __('tasks.no_documents_assigned') }}</h4>
                                            <span>{{ __('tasks.no_documents_assigned_message') }}</span>
                                        </div>
                                    </div>
                                @endif
                            </div>
                            <!--end::Documents Info-->
                            
                            <!--begin::Details-->
                            <div class="row mb-10">
                                <div class="col-md-6">
                                    <div class="d-flex flex-column gap-1">
                                        <div class="fw-semibold text-gray-500">{{ __('tasks.client') }}</div>
                                        <div class="fw-bold text-gray-800">{{ $task->getClientName() }}</div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="d-flex flex-column gap-1">
                                        <div class="fw-semibold text-gray-500">{{ __('tasks.assigned_to') }}</div>
                                        <div class="fw-bold text-gray-800">{{ $task->assignedUser->name }}</div>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="row mb-10">
                                <div class="col-md-6">
                                    <div class="d-flex flex-column gap-1">
                                        <div class="fw-semibold text-gray-500">{{ __('tasks.created_by') }}</div>
                                        <div class="fw-bold text-gray-800">{{ $task->creator->name }}</div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="d-flex flex-column gap-1">
                                        <div class="fw-semibold text-gray-500">{{ __('tasks.due_date') }}</div>
                                        <div class="fw-bold text-gray-800">
                                            @if($task->due_date)
                                                @php
                                                    $isOverdue = $task->due_date->isPast() && !$task->isCompleted();
                                                    $isDueSoon = $task->due_date->isFuture() && $task->due_date->diffInDays(now()) <= 7;
                                                @endphp
                                                <span class="{{ $isOverdue ? 'text-danger' : ($isDueSoon ? 'text-warning' : '') }}">
                                                    {{ $task->due_date->format('Y-m-d') }}
                                                </span>
                                                @if($isOverdue)
                                                    <span class="badge badge-light-danger ms-2">{{ __('tasks.is_overdue') }}</span>
                                                @elseif($isDueSoon)
                                                    <span class="badge badge-light-warning ms-2">{{ __('tasks.is_due_soon') }}</span>
                                                @endif
                                            @else
                                                <span class="text-muted">{{ __('tasks.no_due_date') }}</span>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="row mb-10">
                                <div class="col-md-6">
                                    <div class="d-flex flex-column gap-1">
                                        <div class="fw-semibold text-gray-500">{{ __('tasks.created_at') }}</div>
                                        <div class="fw-bold text-gray-800">{{ $task->created_at->format('Y-m-d H:i') }}</div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="d-flex flex-column gap-1">
                                        <div class="fw-semibold text-gray-500">{{ __('tasks.updated_at') }}</div>
                                        <div class="fw-bold text-gray-800">{{ $task->updated_at->format('Y-m-d H:i') }}</div>
                                    </div>
                                </div>
                            </div>
                            <!--end::Details-->
                        </div>
                        <!--end::Card body-->
                    </div>
                    <!--end::Card-->
                </div>
                <!--end::Content-->
                
                <!--begin::Sidebar-->
                <div class="flex-lg-auto min-w-lg-300px">
                    <!--begin::Card-->
                    <div class="card">
                        <!--begin::Card header-->
                        <div class="card-header">
                            <div class="card-title">
                                <h2>{{ __('tasks.status') }}</h2>
                            </div>
                        </div>
                        <!--end::Card header-->
                        <!--begin::Card body-->
                        <div class="card-body">
                            @php
                                $statusConfig = [
                                    'new' => ['class' => 'badge-light-primary', 'icon' => 'fas fa-info-circle'],
                                    'in_progress' => ['class' => 'badge-light-warning', 'icon' => 'fas fa-clock'],
                                    'completed' => ['class' => 'badge-light-success', 'icon' => 'fas fa-check-circle'],
                                    'pending' => ['class' => 'badge-light-info', 'icon' => 'fas fa-pause-circle'],
                                ];
                                $config = $statusConfig[$task->status] ?? $statusConfig['new'];
                            @endphp
                            <div class="d-flex align-items-center mb-5">
                                <span class="badge {{ $config['class'] }} fs-6 fw-bold me-3">
                                    <i class="{{ $config['icon'] }} fs-6 me-1"></i>
                                    {{ $task->getStatuses()[$task->status] }}
                                </span>
                            </div>
                            
                            @if(auth()->user()->can(\App\Enums\PermissionEnum::UPDATE_TASKS->value))
                            <!--begin::Status Actions-->
                            <div class="d-flex flex-column gap-3">
                                @if($task->isNew())
                                <a href="#" class="btn btn-warning btn-sm" onclick="updateStatus('in_progress')">
                                    <i class="fas fa-play fs-4 me-1"></i>
                                    {{ __('tasks.start_work') }}
                                </a>
                                @endif
                                
                                @if($task->isInProgress())
                                <a href="#" class="btn btn-success btn-sm" onclick="updateStatus('completed')">
                                    <i class="fas fa-check fs-4 me-1"></i>
                                    {{ __('tasks.mark_complete') }}
                                </a>
                                <a href="#" class="btn btn-info btn-sm" onclick="updateStatus('pending')">
                                    <i class="fas fa-pause fs-4 me-1"></i>
                                    {{ __('tasks.mark_pending') }}
                                </a>
                                @endif
                                
                                @if($task->isCompleted() || $task->isPending())
                                <a href="#" class="btn btn-primary btn-sm" onclick="updateStatus('in_progress')">
                                    <i class="fas fa-redo fs-4 me-1"></i>
                                    {{ __('tasks.reopen_task') }}
                                </a>
                                @endif
                            </div>
                            <!--end::Status Actions-->
                            @endif
                        </div>
                        <!--end::Card body-->
                    </div>
                    <!--end::Card-->
                    
                    @if(auth()->user()->can(\App\Enums\PermissionEnum::DELETE_TASKS->value))
                    <!--begin::Card-->
                    <div class="card mt-5">
                        <!--begin::Card header-->
                        <div class="card-header">
                            <div class="card-title">
                                <h2>{{ __('common.actions') }}</h2>
                            </div>
                        </div>
                        <!--end::Card header-->
                        <!--begin::Card body-->
                        <div class="card-body">
                            <a href="#" class="btn btn-danger btn-sm w-100" data-bs-toggle="modal" data-bs-target="#kt_modal_delete_task">
                                <i class="fas fa-trash fs-4 me-1"></i>
                                {{ __('common.delete') }}
                            </a>
                        </div>
                        <!--end::Card body-->
                    </div>
                    <!--end::Card-->
                    @endif
                </div>
                <!--end::Sidebar-->
            </div>
            <!--end::Layout-->
            
            <!--begin::Task History-->
            <div class="row mt-10">
                <div class="col-12">
                    <!--begin::Card-->
                    <div class="card">
                        <!--begin::Card header-->
                        <div class="card-header">
                            <div class="card-title">
                                <h2>{{ __('tasks.task_history') }}</h2>
                            </div>
                        </div>
                        <!--end::Card header-->
                        <!--begin::Card body-->
                        <div class="card-body">
                            @if($histories->count() > 0)
                            <!--begin::Timeline-->
                            <div class="timeline">
                                @foreach($histories as $history)
                                <div class="timeline-item">
                                    <div class="timeline-line w-40px"></div>
                                    <div class="timeline-icon symbol symbol-circle symbol-40px">
                                        <div class="symbol-label bg-light-{{ $history->getActionColor() }}">
                                            <i class="{{ $history->getActionIcon() }} fs-2 text-{{ $history->getActionColor() }}"></i>
                                        </div>
                                    </div>
                                    <div class="timeline-content m-0">
                                        <div class="overflow-auto pb-5">
                                            <div class="d-flex align-items-center justify-content-between mb-3">
                                                <div class="d-flex align-items-center">
                                                    <div class="fs-6 fw-semibold text-gray-800 me-3">{{ $history->getActions()[$history->action] }}</div>
                                                    <div class="badge badge-light-{{ $history->getActionColor() }} fs-8">{{ $history->created_at->format('Y-m-d H:i') }}</div>
                                                </div>
                                            </div>
                                            <div class="fs-7 text-gray-600 mb-3">
                                                <i class="fas fa-user me-1"></i>
                                                {{ __('tasks.changed_by') }}: <span class="fw-bold text-primary">{{ $history->changedBy->name }}</span>
                                            </div>
                                            @if($history->old_value || $history->new_value)
                                            <div class="fs-7 text-gray-600">
                                                @if($history->old_value)
                                                <div class="mb-2">
                                                    <div class="d-flex align-items-start">
                                                        <span class="badge badge-light-danger me-2">{{ __('tasks.old_value') }}</span>
                                                        <div class="flex-grow-1">
                                                            <div class="p-3 bg-light-danger rounded">
                                                                {!! $history->getFormattedOldValue() !!}
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                @endif
                                                @if($history->new_value)
                                                <div class="mb-1">
                                                    <div class="d-flex align-items-start">
                                                        <span class="badge badge-light-success me-2">{{ __('tasks.new_value') }}</span>
                                                        <div class="flex-grow-1">
                                                            <div class="p-3 bg-light-success rounded">
                                                                {!! $history->getFormattedNewValue() !!}
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                @endif
                                            </div>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                            <!--end::Timeline-->
                            @else
                            <div class="text-center py-10">
                                <div class="d-flex flex-column align-items-center">
                                    <i class="fas fa-info-circle fs-3x text-muted mb-5"></i>
                                    <span class="text-muted fs-6">{{ __('tasks.no_history_found') }}</span>
                                </div>
                            </div>
                            @endif
                        </div>
                        <!--end::Card body-->
                    </div>
                    <!--end::Card-->
                </div>
            </div>
            <!--end::Task History-->
        </div>
        <!--end::Content container-->
    </div>
    <!--end::Content-->
</div>
<!--end::Content wrapper-->

@can('delete_tasks')
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
                <form action="{{ route('admin.tasks.destroy', $task) }}" method="POST" style="display: inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">{{ __('common.delete') }}</button>
                </form>
            </div>
        </div>
    </div>
</div>
<!--end::Delete Modal-->
@endcan
@endsection

@push('scripts')
<script>
function updateStatus(newStatus) {
    if (confirm('{{ __("tasks.confirm_status_change") }}')) {
        // Create a form to submit the status update
        const form = document.createElement('form');
        form.method = 'POST';
        form.action = '{{ route("admin.tasks.update", $task) }}';
        
        // Add CSRF token
        const csrfToken = document.createElement('input');
        csrfToken.type = 'hidden';
        csrfToken.name = '_token';
        csrfToken.value = '{{ csrf_token() }}';
        form.appendChild(csrfToken);
        
        // Add method override
        const methodField = document.createElement('input');
        methodField.type = 'hidden';
        methodField.name = '_method';
        methodField.value = 'PUT';
        form.appendChild(methodField);
        
        // Add status field
        const statusField = document.createElement('input');
        statusField.type = 'hidden';
        statusField.name = 'status';
        statusField.value = newStatus;
        form.appendChild(statusField);
        
        // Submit form
        document.body.appendChild(form);
        form.submit();
    }
}
</script>
@endpush
