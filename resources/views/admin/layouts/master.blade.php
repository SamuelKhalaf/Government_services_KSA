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
<!--end::Javascript-->
@yield('scripts')
</body>
<!--end::Body-->
</html>
