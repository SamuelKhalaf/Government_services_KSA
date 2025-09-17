<!-- Notifications Dropdown -->
<div class="app-navbar-item ms-1 ms-md-3">
    <div class="dropdown">
        <button class="btn btn-icon btn-custom btn-icon-muted btn-active-light btn-active-color-primary w-30px h-30px w-md-40px h-md-40px position-relative" type="button" id="notificationDropdown" data-bs-toggle="dropdown" aria-expanded="false">
            <i class="fas fa-bell" style='font-size: 1.5rem;'></i>
            <span class="position-absolute top-25 start-90 translate-middle badge rounded-pill bg-danger fs-8 fw-bold" id="notificationBadge" style="display: none; min-width: 18px; height: 18px; line-height: 1; padding: 2px 6px;">
                0
            </span>
        </button>
    
    <div class="dropdown-menu dropdown-menu-end notification-dropdown" aria-labelledby="notificationDropdown">
        <div class="dropdown-header d-flex justify-content-between align-items-center">
            <h6 class="mb-0">{{ __('notifications.notifications') }}</h6>
            <small class="text-muted" id="notificationCount">0 {{ __('notifications.notifications') }}</small>
        </div>
        <div class="dropdown-divider"></div>
        
        <div id="notificationList" class="notification-list">
            <div class="text-center py-3">
                <div class="spinner-border spinner-border-sm text-primary" role="status">
                    <span class="visually-hidden">{{ __('common.loading') }}...</span>
                </div>
                <div class="mt-2 text-muted">{{ __('common.loading') }}...</div>
            </div>
        </div>
        
        <div class="dropdown-divider"></div>
        <div class="text-center">
            <a href="{{ route('admin.notifications.all') }}" class="btn btn-sm btn-outline-primary">
                {{ __('notifications.view_all') }}
            </a>
        </div>
    </div>
    </div>
</div>
