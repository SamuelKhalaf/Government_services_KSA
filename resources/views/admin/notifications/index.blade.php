@extends('admin.layouts.master')

@section('title', __('notifications.notification_center'))

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
                    {{ __('notifications.notification_center') }}
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
                    <li class="breadcrumb-item text-muted">{{ __('notifications.notifications') }}</li>
                </ul>
                <!--end::Breadcrumb-->
            </div>
            <!--end::Page title-->
            <!--begin::Actions-->
            @if(auth()->user()->can(\App\Enums\PermissionEnum::MARK_NOTIFICATIONS_READ->value))
            <div class="d-flex align-items-center gap-2 gap-lg-3">
                <button type="button" class="btn btn-sm fw-bold btn-primary" id="mark-all-read-btn">
                    <i class="fas fa-check-double fs-2"></i>{{ __('notifications.mark_all_read') }}
                </button>
            </div>
            @endif
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
                <div class="card-header">
                    <div class="card-title">
                        <h2>{{ __('notifications.all_notifications') }}</h2>
                    </div>
                    <div class="card-toolbar">
                        <!--begin::Filter-->
                        <div class="d-flex align-items-center position-relative my-1">
                            <select class="form-select form-select-solid w-250px ps-14" id="notification-filter">
                                <option value="all" {{ ($current_filter ?? 'all') === 'all' ? 'selected' : '' }}>{{ __('notifications.all_notifications') }}</option>
                                <option value="unread" {{ ($current_filter ?? 'all') === 'unread' ? 'selected' : '' }}>{{ __('notifications.unread_notifications') }}</option>
                                <option value="read" {{ ($current_filter ?? 'all') === 'read' ? 'selected' : '' }}>{{ __('notifications.read_notifications') }}</option>
                            </select>
                        </div>
                        <!--end::Filter-->
                    </div>
                </div>
                <!--end::Card header-->
                <!--begin::Card body-->
                <div class="card-body pt-0">
                    @if($notifications->count() > 0)
                    <!--begin::Timeline-->
                    <div class="timeline">
                        @foreach($notifications as $notification)
                        <div class="timeline-item">
                            <div class="timeline-line w-40px"></div>
                            <div class="timeline-icon symbol symbol-circle symbol-40px">
                                <div class="symbol-label bg-light-{{ $notification->getColor() }}">
                                    <i class="{{ $notification->getIcon() }} fs-2 text-{{ $notification->getColor() }}"></i>
                                </div>
                            </div>
                            <div class="timeline-content m-0">
                                <div class="pb-5">
                                    <div class="d-flex align-items-center justify-content-between mb-3">
                                        <div class="d-flex align-items-center">
                                            <div class="fs-6 fw-semibold text-gray-800 me-3">{{ $notification->title }}</div>
                                            @if(!$notification->is_read)
                                            <span class="badge badge-light-danger fs-8">{{ __('notifications.unread_notifications') }}</span>
                                            @endif
                                        </div>
                                        <div class="d-flex align-items-center">
                                            <div class="badge badge-light-{{ $notification->getColor() }} fs-8 me-2">{{ $notification->created_at->format('Y-m-d H:i') }}</div>
                                            @if(auth()->user()->can(\App\Enums\PermissionEnum::MARK_NOTIFICATIONS_READ->value) || auth()->user()->can(\App\Enums\PermissionEnum::DELETE_NOTIFICATIONS->value))
                                            <div class="dropdown">
                                                <button class="btn btn-sm btn-icon btn-color-gray-400 btn-active-color-primary" data-bs-toggle="dropdown">
                                                    <i class="fas fa-ellipsis-v fs-6"></i>
                                                </button>
                                                <div class="dropdown-menu notification-actions-dropdown">
                                                    @if(auth()->user()->can(\App\Enums\PermissionEnum::MARK_NOTIFICATIONS_READ->value))
                                                        @if($notification->is_read)
                                                        <a class="dropdown-item mark-as-unread" data-id="{{ $notification->id }}" href="#">
                                                            <i class="fas fa-envelope me-2"></i>{{ __('notifications.mark_as_unread') }}
                                                        </a>
                                                        @else
                                                        <a class="dropdown-item mark-as-read" data-id="{{ $notification->id }}" href="#">
                                                            <i class="fas fa-envelope-open me-2"></i>{{ __('notifications.mark_as_read') }}
                                                        </a>
                                                        @endif
                                                    @endif
                                                    @if(auth()->user()->can(\App\Enums\PermissionEnum::DELETE_NOTIFICATIONS->value))
                                                    <a class="dropdown-item delete-notification text-danger" data-id="{{ $notification->id }}" href="#">
                                                        <i class="fas fa-trash me-2"></i>{{ __('notifications.delete_notification') }}
                                                    </a>
                                                    @endif
                                                </div>
                                            </div>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="fs-7 text-gray-600 mb-3">
                                        {{ $notification->message }}
                                    </div>
                                    @if($notification->creator)
                                    <div class="fs-7 text-gray-500">
                                        <i class="fas fa-user me-1"></i>
                                        {{ __('notifications.changed_by') }}: <span class="fw-bold">{{ $notification->creator->name }}</span>
                                    </div>
                                    @endif
                                    @if($notification->task())
                                    <div class="mt-3">
                                        <a href="{{ route('admin.tasks.show', $notification->task()) }}" class="btn btn-sm btn-light-primary">
                                            <i class="fas fa-eye me-1"></i>{{ __('common.view_task') }}
                                        </a>
                                    </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                    <!--end::Timeline-->
                    
                    <!--begin::Pagination-->
                    <div class="d-flex flex-stack flex-wrap pt-10">
                        <div class="fs-6 fw-semibold text-gray-700">
                            {{ __('common.showing') }} {{ $notifications->firstItem() }} {{ __('common.to') }} {{ $notifications->lastItem() }} {{ __('common.of') }} {{ $notifications->total() }} {{ __('common.entries') }}
                        </div>
                        <ul class="pagination">
                            {{ $notifications->links() }}
                        </ul>
                    </div>
                    <!--end::Pagination-->
                    @else
                    <div class="text-center py-10">
                        <div class="d-flex flex-column align-items-center">
                            <i class="fas fa-bell-slash fs-3x text-muted mb-5"></i>
                            <span class="text-muted fs-6">{{ __('notifications.no_notifications') }}</span>
                        </div>
                    </div>
                    @endif
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
@endsection

@push('styles')
<style>
/* Fix notification actions dropdown scrolling */
.notification-actions-dropdown {
    min-width: 180px;
    max-height: 200px;
    overflow-y: auto;
    border: 1px solid #e9ecef;
    box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.15);
    border-radius: 0.375rem;
}

.notification-actions-dropdown .dropdown-item {
    padding: 0.5rem 1rem;
    font-size: 0.875rem;
    white-space: nowrap;
    display: flex;
    align-items: center;
}

.notification-actions-dropdown .dropdown-item:hover {
    background-color: #f8f9fa;
    color: inherit;
}

.notification-actions-dropdown .dropdown-item.text-danger:hover {
    background-color: #f8d7da;
    color: #721c24;
}

/* Ensure consistent dropdown behavior */
.dropdown-menu {
    z-index: 1050;
}

/* Fix timeline item overflow */
.timeline-content {
    overflow: visible !important;
}

.timeline-item {
    overflow: visible !important;
}
</style>
@endpush

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Mark all as read - only if user has permission
    @if(auth()->user()->can(\App\Enums\PermissionEnum::MARK_NOTIFICATIONS_READ->value))
    const markAllReadBtn = document.getElementById('mark-all-read-btn');
    if (markAllReadBtn) {
        markAllReadBtn.addEventListener('click', function() {
            if (confirm('{{ __("notifications.confirm_mark_all_read") }}')) {
                fetch('{{ route("admin.notifications.mark_all_read") }}', {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                        'Content-Type': 'application/json',
                    }
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        location.reload();
                    }
                });
            }
        });
    }
    @endif

    // Mark as read
    document.querySelectorAll('.mark-as-read').forEach(button => {
        button.addEventListener('click', function(e) {
            e.preventDefault();
            const notificationId = this.getAttribute('data-id');
            const url = '{{ route("admin.notifications.read", ["id" => ":id"]) }}'.replace(':id', notificationId);
            
            fetch(url, {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                    'Content-Type': 'application/json',
                }
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    location.reload();
                }
            })
            .catch(error => {
                console.error('Error marking notification as read:', error);
            });
        });
    });

    // Mark as unread
    document.querySelectorAll('.mark-as-unread').forEach(button => {
        button.addEventListener('click', function(e) {
            e.preventDefault();
            const notificationId = this.getAttribute('data-id');
            const url = '{{ route("admin.notifications.unread", ["id" => ":id"]) }}'.replace(':id', notificationId);
            
            fetch(url, {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                    'Content-Type': 'application/json',
                }
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    location.reload();
                }
            })
            .catch(error => {
                console.error('Error marking notification as unread:', error);
            });
        });
    });

    // Delete notification
    document.querySelectorAll('.delete-notification').forEach(button => {
        button.addEventListener('click', function(e) {
            e.preventDefault();
            const notificationId = this.getAttribute('data-id');
            
            if (confirm('{{ __("notifications.confirm_delete") }}')) {
                const url = '{{ route("admin.notifications.destroy", ["id" => ":id"]) }}'.replace(':id', notificationId);
                
                fetch(url, {
                    method: 'DELETE',
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                        'Content-Type': 'application/json',
                    }
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        location.reload();
                    }
                })
                .catch(error => {
                    console.error('Error deleting notification:', error);
                });
            }
        });
    });

    // Filter notifications
    const filterSelect = document.getElementById('notification-filter');
    if (filterSelect) {
        filterSelect.addEventListener('change', function() {
            const filterValue = this.value;
            const currentUrl = new URL(window.location);
            
            if (filterValue === 'all') {
                currentUrl.searchParams.delete('filter');
            } else {
                currentUrl.searchParams.set('filter', filterValue);
            }
            
            window.location.href = currentUrl.toString();
        });
    }
});
</script>
@endpush
