<!--begin::Modal - Add role-->
<style>
/* Enhanced Permissions Modal Styles */
.permission-item {
    transition: all 0.2s ease;
    border: 1px solid #e1e3ea;
    /* background-color:rgb(66, 126, 185); */
}

.permission-item:hover {
    border-color: #009ef7;
    /* background-color: #e1f0ff; */
    transform: translateY(-2px);
    box-shadow: 0 4px 8px rgba(0, 158, 247, 0.15);
}

.permission-item .form-check-input:checked ~ .form-check-label {
    color: #009ef7;
}

.permission-item .form-check-input:checked ~ .form-check-label .fw-semibold {
    color: #009ef7;
}

.permissions-grid .permission-category {
    border-left: 3px solid #e1e3ea;
    padding-left: 1rem;
    margin-bottom: 2rem;
}

.permissions-grid .permission-category:hover {
    border-left-color: #009ef7;
}

/* RTL Support */
[dir="rtl"] .permissions-grid .permission-category {
    border-left: none;
    border-right: 3px solid #e1e3ea;
    padding-left: 0;
    padding-right: 1rem;
}

[dir="rtl"] .permissions-grid .permission-category:hover {
    border-right-color: #009ef7;
}

/* Responsive adjustments */
@media (max-width: 768px) {
    .permission-item {
        margin-bottom: 0.5rem;
    }
    
    .permissions-grid .permission-category {
        border-left: none;
        border-top: 3px solid #e1e3ea;
        padding-left: 0;
        padding-top: 1rem;
    }
    
    [dir="rtl"] .permissions-grid .permission-category {
        border-right: none;
        border-top: 3px solid #e1e3ea;
        padding-right: 0;
        padding-top: 1rem;
    }
}

/* Loading animation for permissions */
.permissions-loading {
    display: flex;
    align-items: center;
    justify-content: center;
    min-height: 200px;
}

.permissions-loading .spinner-border {
    width: 3rem;
    height: 3rem;
}
</style>
<div class="modal fade" id="kt_modal_add_role" tabindex="-1" aria-hidden="true">
    <!--begin::Modal dialog-->
    <div class="modal-dialog modal-dialog-centered mw-750px">
        <!--begin::Modal content-->
        <div class="modal-content">
            <!--begin::Modal header-->
            <div class="modal-header">
                <!--begin::Modal title-->
                <h2 class="fw-bold">@lang('roles.add_role')</h2>
                <!--end::Modal title-->
                <!--begin::Close-->
                <div class="btn btn-icon btn-sm btn-active-icon-primary" data-kt-roles-modal-action="close">
                    <!--begin::Svg Icon | path: icons/duotune/arrows/arr061.svg-->
                    <span class="svg-icon svg-icon-1">
                        <i class="fa-solid fa-xmark " style="font-size: 2rem !important;"></i>
                    </span>
                    <!--end::Svg Icon-->
                </div>
                <!--end::Close-->
            </div>
            <!--end::Modal header-->
            <!--begin::Modal body-->
            <div class="modal-body scroll-y mx-lg-5 my-7">
                <!--begin::Form-->
                <form id="kt_modal_add_role_form" class="form" action="{{route('admin.roles.store')}}">
                    <!--begin::Scroll-->
                    <div class="d-flex flex-column scroll-y me-n7 pe-7" id="kt_modal_add_role_scroll" data-kt-scroll="true" data-kt-scroll-activate="{default: false, lg: true}" data-kt-scroll-max-height="auto" data-kt-scroll-dependencies="#kt_modal_add_role_header" data-kt-scroll-wrappers="#kt_modal_add_role_scroll" data-kt-scroll-offset="300px">
                        <!--begin::Input group-->
                        <div class="fv-row mb-10">
                            <!--begin::Label-->
                            <label class="fs-5 fw-bold form-label mb-2">
                                <span class="required">@lang('roles.role_name')</span>
                            </label>
                            <!--end::Label-->
                            <!--begin::Input-->
                            <input class="form-control form-control-solid" placeholder="@lang('roles.role_name')" name="role_name" />
                            <!--end::Input-->
                        </div>
                        <!--end::Input group-->
                        <!--begin::Permissions-->
                        <div class="fv-row">
                            <!--begin::Label-->
                            <label class="fs-5 fw-bold form-label mb-4">@lang('roles.permissions')</label>
                            <!--end::Label-->
                            
                            <!--begin::Select All Section-->
                            <div class="bg-light-primary rounded p-4 mb-6">
                                <div class="d-flex align-items-center">
                                    <i class="fas fa-crown text-primary fs-2 {{ app()->getLocale() == 'ar' ? 'ms-3' : 'me-3' }}"></i>
                                    <div class="flex-grow-1">
                                        <h6 class="text-gray-800 fw-bold mb-1">@lang('roles.administrator_access')</h6>
                                        <div class="text-muted fs-7">@lang('roles.administrator_access_help')</div>
                                    </div>
                                    <label class="form-check form-check-custom form-check-solid">
                                        <input class="form-check-input" type="checkbox" value="" id="kt_roles_select_all" />
                                        <span class="form-check-label fw-semibold">@lang('roles.select_all')</span>
                                    </label>
                                </div>
                            </div>
                            <!--end::Select All Section-->

                            <!--begin::Permissions Grid-->
                            <div class="permissions-grid">
                                @foreach ($formattedPermissions as $category => $permissions)
                                    <!--begin::Permission Category-->
                                    <div class="permission-category mb-6">
                                        <!--begin::Category Header-->
                                        <div class="d-flex align-items-center mb-4">
                                            <div class="symbol symbol-40px {{ app()->getLocale() == 'ar' ? 'ms-3' : 'me-3' }}">
                                                <div class="symbol-label bg-light-info">
                                                    <i class="fas fa-shield-alt text-info fs-4"></i>
                                                </div>
                                            </div>
                                            <h6 class="text-gray-800 fw-bold mb-0">{{ $category }}</h6>
                                        </div>
                                        <!--end::Category Header-->
                                        
                                        <!--begin::Permissions Grid-->
                                        <div class="row g-3">
                                            @foreach ($permissions as $permission)
                                                <div class="col-md-6 col-lg-4">
                                                    <div class="permission-item p-3 border border-gray-300 rounded bg-light-active-primary hover-elevate-up">
                                                        <label class="form-check form-check-custom form-check-solid w-100 cursor-pointer">
                                                            <input class="form-check-input" type="checkbox" name="permissions[]" value="{{ $permission['id'] }}" />
                                                            <div class="form-check-label w-100">
                                                                <div class="fw-semibold text-gray-800">{{ $permission['name'] }}</div>
                                                            </div>
                                                        </label>
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                        <!--end::Permissions Grid-->
                                    </div>
                                    <!--end::Permission Category-->
                                @endforeach
                            </div>
                            <!--end::Permissions Grid-->
                        </div>
                        <!--end::Permissions-->
                    </div>
                    <!--end::Scroll-->
                    <!--begin::Actions-->
                    <div class="text-center pt-15">
                        <button type="reset" class="btn btn-light me-3" data-kt-roles-modal-action="cancel">@lang('common.discard')</button>
                        <button type="submit" class="btn btn-primary" data-kt-roles-modal-action="submit">
                            <span class="indicator-label">@lang('roles.submit')</span>
                            <span class="indicator-progress">
                                @lang('roles.please_wait')
                                <span class="spinner-border spinner-border-sm align-middle ms-2"></span>
                            </span>
                        </button>
                    </div>
                    <!--end::Actions-->
                </form>
                <!--end::Form-->
            </div>
            <!--end::Modal body-->
        </div>
        <!--end::Modal content-->
    </div>
    <!--end::Modal dialog-->
</div>
<!--end::Modal - Add role-->
