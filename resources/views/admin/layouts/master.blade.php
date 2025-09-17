<!DOCTYPE html>
@php
    $currentLang = app()->getLocale();
    $isRTL = $currentLang === 'ar';
@endphp
<html lang="{{ $currentLang }}" @if($isRTL) dir="rtl" @endif>
<!--begin::Head-->
@include('admin.layouts.includes.head')
<!--end::Head-->
<!--begin::Body-->
<body id="kt_app_body" data-kt-app-layout="dark-sidebar" data-kt-app-header-fixed="true"
      data-kt-app-sidebar-enabled="true" data-kt-app-sidebar-fixed="true" data-kt-app-sidebar-hoverable="true"
      data-kt-app-sidebar-push-header="true" data-kt-app-sidebar-push-toolbar="true"
      data-kt-app-sidebar-push-footer="true" data-kt-app-toolbar-enabled="true" class="app-default{{ $isRTL ? ' app-rtl' : '' }}">
<!--begin::Theme mode setup on page load-->
<script>var defaultThemeMode = "light";
    var themeMode;
    if (document.documentElement) {
        if (document.documentElement.hasAttribute("data-bs-theme-mode")) {
            themeMode = document.documentElement.getAttribute("data-bs-theme-mode");
        } else {
            if (localStorage.getItem("data-bs-theme") !== null) {
                themeMode = localStorage.getItem("data-bs-theme");
            } else {
                themeMode = defaultThemeMode;
            }
        }
        if (themeMode === "system") {
            themeMode = window.matchMedia("(prefers-color-scheme: dark)").matches ? "dark" : "light";
        }
        document.documentElement.setAttribute("data-bs-theme", themeMode);
    }</script>
<!--end::Theme mode setup on page load-->
<!--begin::App-->
<div class="d-flex flex-column flex-root app-root" id="kt_app_root">
    <!--begin::Page-->
    <div class="app-page flex-column flex-column-fluid" id="kt_app_page">
        <!--begin::Header-->
        @include('admin.layouts.includes.header')
        <!--end::Header-->
        <!--begin::Wrapper-->
        <div class="app-wrapper flex-column flex-row-fluid" id="kt_app_wrapper">
            <!--begin::Sidebar-->
            @include('admin.layouts.includes.sidebar')
            <!--end::Sidebar-->
            <!--begin::Main-->
            <div class="app-main flex-column flex-row-fluid" id="kt_app_main">
                <!--begin::Content wrapper-->
                @yield('content')
                <!--end::Content wrapper-->
                <!--begin::Footer-->
                @include('admin.layouts.includes.footer')
                <!--end::Footer-->
            </div>
            <!--end:::Main-->
        </div>
        <!--end::Wrapper-->
    </div>
    <!--end::Page-->
</div>
<!--end::App-->
<!--begin::Scrolltop-->
<div id="kt_scrolltop" class="scrolltop" data-kt-scrolltop="true">
    <!--begin::Svg Icon | path: icons/duotune/arrows/arr066.svg-->
    <span class="svg-icon">
        <i class="fa-solid fa-arrow-up" style="opacity: 1 !important; color: #fff"></i>
    </span>
    <!--end::Svg Icon-->
</div>
<!--end::Scrolltop-->
<!--begin::Modals-->
@include('admin.layouts.includes.modals')
<!--end::Modals-->
<!--begin::Javascript-->
<script>var hostUrl = "assets/";</script>
<!--begin::Global Javascript Bundle(mandatory for all pages)-->
<script src="{{asset('assets/plugins/global/plugins.bundle.js')}}"></script>
<script src="{{asset('assets/js/scripts.bundle.js')}}"></script>
<!--end::Global Javascript Bundle-->
<!--begin::Translation Helper-->
<script src="{{asset('assets/js/translations.js')}}"></script>
<!--end::Translation Helper-->
<!--begin::Vendors Javascript(used for this page only)-->
<script src="{{asset('assets/plugins/custom/fullcalendar/fullcalendar.bundle.js')}}"></script>
<script src="https://cdn.amcharts.com/lib/5/index.js"></script>
<script src="https://cdn.amcharts.com/lib/5/xy.js"></script>
<script src="https://cdn.amcharts.com/lib/5/percent.js"></script>
<script src="https://cdn.amcharts.com/lib/5/radar.js"></script>
<script src="https://cdn.amcharts.com/lib/5/themes/Animated.js"></script>
<script src="https://cdn.amcharts.com/lib/5/map.js"></script>
<script src="https://cdn.amcharts.com/lib/5/geodata/worldLow.js"></script>
<script src="https://cdn.amcharts.com/lib/5/geodata/continentsLow.js"></script>
<script src="https://cdn.amcharts.com/lib/5/geodata/usaLow.js"></script>
<script src="https://cdn.amcharts.com/lib/5/geodata/worldTimeZonesLow.js"></script>
<script src="https://cdn.amcharts.com/lib/5/geodata/worldTimeZoneAreasLow.js"></script>
<script src="{{asset('assets/plugins/custom/datatables/datatables.bundle.js')}}"></script>
<!--end::Vendors Javascript-->
<!--begin::Custom Javascript(used for this page only)-->
<script src="{{asset('assets/js/widgets.bundle.js')}}"></script>
<script src="{{asset('assets/js/custom/widgets.js')}}"></script>
<script src="{{asset('assets/js/custom/apps/chat/chat.js')}}"></script>
<script src="{{asset('assets/js/custom/utilities/modals/upgrade-plan.js')}}"></script>
<script src="{{asset('assets/js/custom/utilities/modals/new-target.js')}}"></script>
<script src="{{asset('assets/js/custom/utilities/modals/users-search.js')}}"></script>
<script>
    document.querySelectorAll('[aria-hidden="true"] input:focus').forEach(input => {
        input.closest('[aria-hidden="true"]').setAttribute('aria-hidden', 'false');
    });
</script>
<!--end::Custom Javascript-->
<!--begin::Language Switching Script-->
<script>
// Language switching functionality
document.addEventListener('DOMContentLoaded', function() {
    // Initialize RTL if Arabic
    const isRTL = document.documentElement.dir === 'rtl';
    if (isRTL) {
        document.body.classList.add('app-rtl');
    }

    // Handle language switching
    document.querySelectorAll('a[href*="language/switch"]').forEach(function(link) {
        link.addEventListener('click', function(e) {
            e.preventDefault();

            const url = this.href;
            const language = url.split('/').pop();

            // Show loading state
            this.innerHTML = '<i class="fas fa-spinner fa-spin"></i> ' + (language === 'ar' ? 'جاري التحميل...' : 'Loading...');

            // Make AJAX request to switch language
            fetch(url, {
                method: 'GET',
                headers: {
                    'X-Requested-With': 'XMLHttpRequest',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                }
            })
            .then(response => response.json())
            .then(data => {
                if (data.status === 'success') {
                    // Show success message
                    // if (typeof Swal !== 'undefined') {
                    //     Swal.fire({
                    //         icon: 'success',
                    //         title: data.message,
                    //         showConfirmButton: false,
                    //         timer: 1500
                    //     }).then(() => {
                        // Reload page to apply language and RTL changes
                        window.location.reload();
                //     });
                // } else {
                    // Fallback if SweetAlert is not available
                    // alert(data.message);
                    window.location.reload();
                // }
                } else {
                    throw new Error(data.message || 'Language switch failed');
                }
            })
            .catch(error => {
                console.error('Language switch error:', error);
                if (typeof Swal !== 'undefined') {
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: 'Failed to change language. Please try again.'
                    });
                } else {
                    alert('Failed to change language. Please try again.');
                }

                // Restore original link text
                this.innerHTML = this.querySelector('.menu-title').textContent;
            });
        });
    });
});
</script>
<!--end::Language Switching Script-->

<!--begin::Notifications-->
@include('admin.layouts.includes.notifications')
<!--end::Notifications-->

<!--end::Javascript-->
@yield('scripts')
@stack('scripts')

<!-- Simple Notification Styles -->
<style>
.notification-dropdown {
    width: 350px;
    max-height: 400px;
    border: 1px solid #e9ecef;
    box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.15);
}

.notification-list {
    max-height: 300px;
    overflow-y: auto;
}

.notification-item {
    padding: 12px 16px;
    border-bottom: 1px solid #f8f9fa;
    cursor: pointer;
    transition: background-color 0.2s ease;
}

.notification-item:hover {
    background-color: #f8f9fa;
}

.notification-item:last-child {
    border-bottom: none;
}

.notification-item.unread {
    background-color: #e3f2fd;
    border-left: 3px solid #2196f3;
}

.notification-content {
    display: flex;
    align-items: flex-start;
    gap: 12px;
}

.notification-icon {
    width: 32px;
    height: 32px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 14px;
    flex-shrink: 0;
}

.notification-details {
    flex: 1;
    min-width: 0;
}

.notification-title {
    font-weight: 600;
    font-size: 14px;
    margin-bottom: 4px;
    color: #212529;
}

.notification-message {
    font-size: 13px;
    color: #6c757d;
    margin-bottom: 4px;
    line-height: 1.4;
}

.notification-time {
    font-size: 12px;
    color: #adb5bd;
}

.notification-badge {
    font-size: 10px;
    min-width: 18px;
    height: 18px;
    display: flex;
    align-items: center;
    justify-content: center;
    z-index: 10;
    border: 2px solid #fff;
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.2);
}

/* Ensure notification icon displays properly */
#notificationDropdown {
    display: flex;
    align-items: center;
    justify-content: center;
}

#notificationDropdown i {
    color: #7e8299;
    transition: color 0.2s ease;
}

#notificationDropdown:hover i {
    color: #009ef7;
}

#notificationDropdown:focus i {
    color: #009ef7;
}

/* Sidebar notification badge */
#sidebar-notification-count {
    font-size: 10px;
    min-width: 20px;
    height: 20px;
    display: flex;
    align-items: center;
    justify-content: center;
    border-radius: 10px;
    background-color: #f1416c !important;
    color: #fff !important;
    font-weight: bold;
    line-height: 1;
    padding: 2px 6px;
}

/* RTL Support */
.app-rtl .notification-dropdown {
    right: auto;
    left: 0;
}

.app-rtl .notification-item.unread {
    border-left: none;
    border-right: 3px solid #2196f3;
}
</style>

<!-- Simple Notification JavaScript -->
<script>
document.addEventListener('DOMContentLoaded', function() {
    const notificationDropdown = document.getElementById('notificationDropdown');
    const notificationList = document.getElementById('notificationList');
    const notificationBadge = document.getElementById('notificationBadge');
    const notificationCount = document.getElementById('notificationCount');
    
    let notifications = [];
    let unreadCount = 0;
    
    // Load notifications when dropdown is shown
    notificationDropdown.addEventListener('show.bs.dropdown', function() {
        loadNotifications();
    });
    
    // Load notifications
    function loadNotifications() {
        fetch('{{ route("admin.notifications.index") }}', {
            method: 'GET',
            headers: {
                'X-Requested-With': 'XMLHttpRequest',
                'Accept': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.getAttribute('content') || ''
            }
        })
        .then(response => {
            if (!response.ok) {
                throw new Error(`HTTP error! status: ${response.status}`);
            }
            return response.json();
        })
        .then(data => {
            notifications = data.notifications || [];
            unreadCount = data.unread_count || 0;
            updateNotificationUI();
        })
        .catch(error => {
            console.error('Error loading notifications:', error);
            showErrorState();
        });
    }
    
    // Update notification UI
    function updateNotificationUI() {
        // Update header badge
        if (unreadCount > 0) {
            notificationBadge.style.display = 'flex';
            notificationBadge.textContent = unreadCount;
        } else {
            notificationBadge.style.display = 'none';
        }
        
        // Update sidebar badge
        const sidebarBadge = document.getElementById('sidebar-notification-count');
        sidebarBadge.textContent = unreadCount;
        if (unreadCount > 0) {
            sidebarBadge.style.display = 'flex';
        } else {
            sidebarBadge.style.display = 'none';
        }
        
        // Update count
        notificationCount.textContent = `${unreadCount} {{ __('notifications.notifications') }}`;
        
        // Update list
        if (notifications.length === 0) {
            showEmptyState();
        } else {
            showNotifications();
        }
    }
    
    // Show notifications
    function showNotifications() {
            let html = '';
            notifications.forEach(notification => {
            const timeAgo = getTimeAgo(notification.created_at);
                const isUnread = !notification.is_read;
                
                html += `
                <div class="notification-item ${isUnread ? 'unread' : ''}" onclick="markAsRead(${notification.id})">
                    <div class="notification-content">
                        <div class="notification-icon bg-${notification.color || 'primary'} text-white">
                            <i class="${notification.icon || 'fas fa-bell'}"></i>
                        </div>
                        <div class="notification-details">
                            <div class="notification-title">${notification.title}</div>
                            <div class="notification-message">${notification.message}</div>
                            <div class="notification-time">${timeAgo}</div>
                        </div>
                        </div>
                    </div>
                `;
            });
            notificationList.innerHTML = html;
    }
    
    // Show empty state
    function showEmptyState() {
        notificationList.innerHTML = `
            <div class="text-center py-4">
                <i class="fas fa-bell-slash text-muted fs-1 mb-3"></i>
                <div class="text-muted">{{ __('notifications.no_notifications') }}</div>
            </div>
        `;
    }
    
    // Show error state
    function showErrorState() {
        notificationList.innerHTML = `
            <div class="text-center py-4">
                <i class="fas fa-exclamation-triangle text-danger fs-1 mb-3"></i>
                <div class="text-danger">{{ __('common.error_loading_notifications') }}</div>
            </div>
        `;
    }
    
    // Get time ago
    function getTimeAgo(dateString) {
        const date = new Date(dateString);
        const now = new Date();
        const diffInSeconds = Math.floor((now - date) / 1000);
        
        if (diffInSeconds < 60) return '{{ __('common.just_now') }}';
        if (diffInSeconds < 3600) return Math.floor(diffInSeconds / 60) + ' {{ __('common.minutes_ago') }}';
        if (diffInSeconds < 86400) return Math.floor(diffInSeconds / 3600) + ' {{ __('common.hours_ago') }}';
        return Math.floor(diffInSeconds / 86400) + ' {{ __('common.days_ago') }}';
    }
    
    // Mark as read
    window.markAsRead = function(notificationId) {
        fetch(`{{ route('admin.notifications.read', '') }}/${notificationId}`, {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                'Content-Type': 'application/json',
            }
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                loadNotifications();
            }
        });
    };
    
    // Load notifications on page load for badge
    loadNotifications();
    
    // Refresh every 30 seconds
    // setInterval(loadNotifications, 30000);
});
</script>

<!--begin::Employee Monitoring Script-->
@if(auth()->user()->isEmployee())
<script src="{{asset('assets/js/employee-monitoring.js')}}"></script>
<meta name="user-role" content="employee">
@endif
<!--end::Employee Monitoring Script-->

</body>
<!--end::Body-->
</html>
