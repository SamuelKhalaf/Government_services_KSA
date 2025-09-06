@use(App\Enums\PermissionEnum)
<div id="kt_app_sidebar" class="app-sidebar flex-column" data-kt-drawer="true" data-kt-drawer-name="app-sidebar"
     data-kt-drawer-activate="{default: true, lg: false}" data-kt-drawer-overlay="true" data-kt-drawer-width="225px"
     data-kt-drawer-direction="start" data-kt-drawer-toggle="#kt_app_sidebar_mobile_toggle">
    <!--begin::Logo-->
    <div class="app-sidebar-logo px-6" id="kt_app_sidebar_logo">
        <!--begin::Logo image-->
        <a href="">
            <img alt="Logo" src="{{asset('assets/media/logos/solar_verse.png')}}"
                 class="app-sidebar-logo-default" style="width: 230px !important;"/>
            <img alt="Logo" src="{{asset('assets/media/logos/solar_verse_small.png')}}"
                 class="h-50px app-sidebar-logo-minimize"/>
        </a>
        <!--end::Logo image-->
        <!--begin::Sidebar toggle-->
        <div id="kt_app_sidebar_toggle"
             class="app-sidebar-toggle btn btn-icon btn-shadow btn-sm btn-color-muted btn-active-color-primary body-bg h-30px w-30px position-absolute top-50 start-100 translate-middle rotate"
             data-kt-toggle="true" data-kt-toggle-state="active" data-kt-toggle-target="body"
             data-kt-toggle-name="app-sidebar-minimize">
            <!--begin::Svg Icon | path: icons/duotune/arrows/arr079.svg-->
            <span class="svg-icon svg-icon-2 rotate-180">
                <i class="fa-solid fa-angles-left"></i>
            </span>
            <!--end::Svg Icon-->
        </div>
        <!--end::Sidebar toggle-->
    </div>
    <!--end::Logo-->
    <!--begin::sidebar menu-->
    <div class="app-sidebar-menu overflow-hidden flex-column-fluid">
        <!--begin::Menu wrapper-->
        <div id="kt_app_sidebar_menu_wrapper" class="app-sidebar-wrapper hover-scroll-overlay-y my-5"
             data-kt-scroll="true" data-kt-scroll-activate="true" data-kt-scroll-height="auto"
             data-kt-scroll-dependencies="#kt_app_sidebar_logo, #kt_app_sidebar_footer"
             data-kt-scroll-wrappers="#kt_app_sidebar_menu" data-kt-scroll-offset="5px"
             data-kt-scroll-save-state="true">
            <!--begin::Menu-->
            <div class="menu menu-column menu-rounded menu-sub-indention px-3" id="#kt_app_sidebar_menu"
                 data-kt-menu="true" data-kt-menu-expand="false">
                @if(auth()->user()->hasPermissionTo(PermissionEnum::VIEW_DASHBOARD))
                    <!--begin:Menu item-->
                    <div class="menu-item {{setMenuOpenClass(['admin.dashboard'])}}">
                        <!--begin:Menu link-->
                        <a class="menu-link {{setActiveClass('admin.dashboard')}}" href="{{route('admin.dashboard')}}">
                        <span class="menu-icon">
                            <span class="svg-icon svg-icon-2">
                                <i class="fa-solid fa-gauge-high"></i>
                            </span>
                        </span>
                            <span class="menu-title">@lang('navigation.dashboard')</span>
                        </a>
                        <!--end:Menu link-->
                    </div>
                    <!--end:Menu item-->
                @endif
                @if(auth()->user()->hasAnyPermission([PermissionEnum::VIEW_USERS, PermissionEnum::CREATE_USERS, PermissionEnum::UPDATE_USERS, PermissionEnum::DELETE_USERS]))
                    <!--begin:Menu item-->
                    <div class="menu-item {{setMenuOpenClass(['admin.users.index'])}}">
                        <!--begin:Menu link-->
                        <a class="menu-link {{setActiveClass('admin.users.index')}}"
                           href="{{route('admin.users.index')}}">
                        <span class="menu-icon">
                            <!--begin::Svg Icon | path: icons/duotune/communication/com013.svg-->
                            <span class="svg-icon svg-icon-2">
                                <i class="fa-solid fa-users"></i>
                            </span>
                            <!--end::Svg Icon-->
                        </span>
                        <span class="menu-title">@lang('navigation.users')</span>
                        </a>
                        <!--end:Menu link-->
                    </div>
                    <!--end:Menu item-->
                @endif

                {{-- CLIENT MANAGEMENT MODULE --}}
                @if(auth()->user()->hasAnyPermission([PermissionEnum::VIEW_ALL_CLIENTS, PermissionEnum::VIEW_ASSIGNED_CLIENTS, PermissionEnum::CREATE_CLIENTS, PermissionEnum::UPDATE_CLIENTS, PermissionEnum::DELETE_CLIENTS, PermissionEnum::VIEW_CLIENT_EMPLOYEES, PermissionEnum::CREATE_CLIENT_EMPLOYEES, PermissionEnum::UPDATE_CLIENT_EMPLOYEES, PermissionEnum::DELETE_CLIENT_EMPLOYEES, PermissionEnum::VIEW_ALL_DOCUMENTS, PermissionEnum::VIEW_ASSIGNED_DOCUMENTS, PermissionEnum::VIEW_DOCUMENT_DASHBOARD,PermissionEnum::VIEW_DOCUMENT_TYPES, PermissionEnum::CREATE_DOCUMENT_TYPES, PermissionEnum::UPDATE_DOCUMENT_TYPES, PermissionEnum::DELETE_DOCUMENT_TYPES]))
                    <!--begin:Menu item-->
                    <div data-kt-menu-trigger="click"
                         class="menu-item menu-accordion {{setMenuOpenClass(['admin.companies.*','admin.employees.*','admin.documents.*','admin.document-dashboard','admin.document-types.*','admin.company-documents.*'])}}">
                        <!--begin:Menu link-->
                        <span class="menu-link">
                            <span class="menu-icon">
                                <span class="svg-icon svg-icon-2">
                                    <i class="fa-solid fa-building"></i>
                                </span>
                            </span>
                            <span class="menu-title">@lang('navigation.client_management')</span>
                            <span class="menu-arrow"></span>
                        </span>
                        <!--end:Menu link-->
                        <!--begin:Menu sub-->
                        <div class="menu-sub menu-sub-accordion">
                            @if(auth()->user()->hasAnyPermission([PermissionEnum::VIEW_ALL_CLIENTS, PermissionEnum::VIEW_ASSIGNED_CLIENTS, PermissionEnum::CREATE_CLIENTS, PermissionEnum::UPDATE_CLIENTS, PermissionEnum::DELETE_CLIENTS]))
                                <!--begin:Menu item-->
                                <div class="menu-item">
                                    <!--begin:Menu link-->
                                    <a class="menu-link {{setActiveClass('admin.companies.*')}}"
                                       href="{{route('admin.companies.index')}}">
                                        <span class="menu-bullet">
                                            <span class="bullet bullet-dot"></span>
                                        </span>
                                        <span class="menu-title">@lang('navigation.companies')</span>
                                    </a>
                                    <!--end:Menu link-->
                                </div>
                                <!--end:Menu item-->
                            @endif

                            @if(auth()->user()->hasAnyPermission([PermissionEnum::VIEW_ALL_DOCUMENTS, PermissionEnum::VIEW_ASSIGNED_DOCUMENTS]))
                                <!--begin:Menu item-->
                                <div class="menu-item">
                                    <!--begin:Menu link-->
                                    <a class="menu-link {{setActiveClass('admin.company-documents.*')}}"
                                       href="{{route('admin.company-documents.index')}}">
                                    <span class="menu-bullet">
                                        <span class="bullet bullet-dot"></span>
                                    </span>
                                        <span class="menu-title">@lang('navigation.company_documents')</span>
                                    </a>
                                    <!--end:Menu link-->
                                </div>
                                <!--end:Menu item-->
                            @endif

                            @if(auth()->user()->hasAnyPermission([PermissionEnum::VIEW_CLIENT_EMPLOYEES, PermissionEnum::CREATE_CLIENT_EMPLOYEES, PermissionEnum::UPDATE_CLIENT_EMPLOYEES, PermissionEnum::DELETE_CLIENT_EMPLOYEES]))
                                <!--begin:Menu item-->
                                <div class="menu-item">
                                    <!--begin:Menu link-->
                                    <a class="menu-link {{setActiveClass('admin.employees.*')}}"
                                       href="{{route('admin.employees.index')}}">
                                        <span class="menu-bullet">
                                            <span class="bullet bullet-dot"></span>
                                        </span>
                                        <span class="menu-title">@lang('navigation.employees')</span>
                                    </a>
                                    <!--end:Menu link-->
                                </div>
                                <!--end:Menu item-->
                            @endif

                            @if(auth()->user()->hasAnyPermission([PermissionEnum::VIEW_ALL_DOCUMENTS, PermissionEnum::VIEW_ASSIGNED_DOCUMENTS, PermissionEnum::UPLOAD_DOCUMENTS, PermissionEnum::UPDATE_DOCUMENTS, PermissionEnum::DELETE_DOCUMENTS]))
                                <!--begin:Menu item-->
                                <div class="menu-item">
                                    <!--begin:Menu link-->
                                    <a class="menu-link {{setActiveClass('admin.documents.*')}}"
                                       href="{{route('admin.documents.index')}}">
                                        <span class="menu-bullet">
                                            <span class="bullet bullet-dot"></span>
                                        </span>
                                        <span class="menu-title">@lang('navigation.employee_documents')</span>
                                    </a>
                                    <!--end:Menu link-->
                                </div>
                                <!--end:Menu item-->
                            @endif

                            @if(auth()->user()->hasAnyPermission([PermissionEnum::VIEW_DOCUMENT_TYPES, PermissionEnum::CREATE_DOCUMENT_TYPES, PermissionEnum::UPDATE_DOCUMENT_TYPES, PermissionEnum::DELETE_DOCUMENT_TYPES]))
                                <!--begin:Menu item-->
                                <div class="menu-item">
                                    <!--begin:Menu link-->
                                    <a class="menu-link {{setActiveClass('admin.document-types.*')}}"
                                       href="{{route('admin.document-types.index')}}">
                                        <span class="menu-bullet">
                                            <span class="bullet bullet-dot"></span>
                                        </span>
                                        <span class="menu-title">@lang('navigation.document_types')</span>
                                    </a>
                                    <!--end:Menu link-->
                                </div>
                                <!--end:Menu item-->
                            @endif

                            @if(auth()->user()->hasPermissionTo(PermissionEnum::VIEW_DOCUMENT_DASHBOARD))
                                <!--begin:Menu item-->
{{--                                <div class="menu-item">--}}
{{--                                    <!--begin:Menu link-->--}}
{{--                                    <a class="menu-link {{setActiveClass('admin.document-dashboard')}}"--}}
{{--                                       href="{{route('admin.document-dashboard')}}">--}}
{{--                                        <span class="menu-bullet">--}}
{{--                                            <span class="bullet bullet-dot"></span>--}}
{{--                                        </span>--}}
{{--                                        <span class="menu-title">@lang('navigation.document_dashboard')</span>--}}
{{--                                    </a>--}}
{{--                                    <!--end:Menu link-->--}}
{{--                                </div>--}}
                                <!--end:Menu item-->
                            @endif
                        </div>
                        <!--end:Menu sub-->
                    </div>
                    <!--end:Menu item-->
                @endif

                @if(auth()->user()->hasAnyPermission([PermissionEnum::VIEW_PERMISSIONS, PermissionEnum::CREATE_PERMISSIONS, PermissionEnum::DELETE_PERMISSIONS, PermissionEnum::ASSIGN_PERMISSIONS]) || auth()->user()->hasAnyPermission([PermissionEnum::VIEW_ROLES, PermissionEnum::CREATE_ROLES, PermissionEnum::UPDATE_ROLES, PermissionEnum::DELETE_ROLES]))
                    <!--begin:Menu item-->
                    <div data-kt-menu-trigger="click"
                         class="menu-item menu-accordion {{setMenuOpenClass(['admin.roles.index','admin.roles.show','admin.permissions.index'])}}">
                        <!--begin:Menu link-->
                        <span class="menu-link">
                        <span class="menu-icon">
                            <!--begin::Svg Icon | path: icons/duotune/abstract/abs014.svg-->
                            <span class="svg-icon svg-icon-2">
                                <i class="fa-solid fa-gear"></i>
                            </span>
                            <!--end::Svg Icon-->
                        </span>
                        <span class="menu-title">@lang('navigation.system_setting')</span>
                        <span class="menu-arrow"></span>
                    </span>
                        <!--end:Menu link-->
                        <!--begin:Menu sub-->
                        <div class="menu-sub menu-sub-accordion">
                            @if(auth()->user()->hasAnyPermission([PermissionEnum::VIEW_ROLES, PermissionEnum::CREATE_ROLES, PermissionEnum::UPDATE_ROLES, PermissionEnum::DELETE_ROLES]))
                                <!--begin:Menu item-->
                                <div class="menu-item">
                                    <!--begin:Menu link-->
                                    <a class="menu-link {{setActiveClass('admin.roles.index')}}"
                                       href="{{route('admin.roles.index')}}">
                                <span class="menu-bullet">
                                    <span class="bullet bullet-dot"></span>
                                </span>
                                        <span class="menu-title">@lang('navigation.roles')</span>
                                    </a>
                                    <!--end:Menu link-->
                                </div>
                                <!--end:Menu item-->
                            @endif
                            @if(auth()->user()->hasAnyPermission([PermissionEnum::VIEW_PERMISSIONS, PermissionEnum::CREATE_PERMISSIONS, PermissionEnum::DELETE_PERMISSIONS, PermissionEnum::ASSIGN_PERMISSIONS]))
                                <!--begin:Menu item-->
                                <div class="menu-item">
                                    <!--begin:Menu link-->
                                    <a class="menu-link {{setActiveClass('admin.permissions.index')}}"
                                       href="{{route('admin.permissions.index')}}">
                                        <span class="menu-bullet">
                                            <span class="bullet bullet-dot"></span>
                                        </span>
                                        <span class="menu-title">@lang('navigation.permissions')</span>
                                    </a>
                                    <!--end:Menu link-->
                                </div>
                                <!--end:Menu item-->
                            @endif

                        </div>
                        <!--end:Menu sub-->
                    </div>
                    <!--end:Menu item-->
                @endif

            </div>
            <!--end::Menu-->
        </div>
        <!--end::Menu wrapper-->
    </div>
    <!--end::sidebar menu-->
</div>
