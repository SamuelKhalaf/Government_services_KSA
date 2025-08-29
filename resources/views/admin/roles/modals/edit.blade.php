<!--begin::Modal - Update role-->
<div class="modal fade" id="kt_modal_update_role" tabindex="-1" aria-hidden="true">
    <!--begin::Modal dialog-->
    <div class="modal-dialog modal-dialog-centered mw-750px">
        <!--begin::Modal content-->
        <div class="modal-content">
            <!--begin::Modal header-->
            <div class="modal-header">
                <!--begin::Modal title-->
                <h2 class="fw-bold">{{ __('roles.edit_role') }}</h2>
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
            <div class="modal-body scroll-y mx-5 my-7">
                <!--begin::Form-->
                <form id="kt_modal_update_role_form" class="form" action="#">
                    <!--begin::Scroll-->
                    <div class="d-flex flex-column scroll-y me-n7 pe-7" id="kt_modal_update_role_scroll" data-kt-scroll="true" data-kt-scroll-activate="{default: false, lg: true}" data-kt-scroll-max-height="auto" data-kt-scroll-dependencies="#kt_modal_update_role_header" data-kt-scroll-wrappers="#kt_modal_update_role_scroll" data-kt-scroll-offset="300px">
                        <!--begin::Input group-->
                        <div class="fv-row mb-10">
                            <!--begin::Label-->
                            <label class="fs-5 fw-bold form-label mb-2">
                                <span class="required">{{ __('roles.role_name') }}</span>
                            </label>
                            <!--end::Label-->
                            <!--begin::Input-->
                            <input class="form-control form-control-solid" id="role_name" placeholder="{{ __('roles.role_name') }}" name="role_name" value="" >
                            <!--end::Input-->
                        </div>
                        <!--end::Input group-->

                        <input type="hidden" id="role_id" name="role_id" value="">

                        <!--begin::Permissions-->
                        <div class="fv-row">
                            <!--begin::Label-->
                            <label class="fs-5 fw-bold form-label mb-4">{{ __('roles.permissions') }}</label>
                            <!--end::Label-->
                            
                            <!--begin::Permissions Container-->
                            <div id="permissions_container">
                                <!--begin::Select All Section-->
                                <div class="bg-light-primary rounded p-4 mb-6" id="select_all_section" style="display: none;">
                                    <div class="d-flex align-items-center">
                                        <i class="fas fa-crown text-primary fs-2 {{ app()->getLocale() == 'ar' ? 'ms-3' : 'me-3' }}"></i>
                                        <div class="flex-grow-1">
                                            <h6 class="text-gray-800 fw-bold mb-1">{{ __('roles.administrator_access') }}</h6>
                                            <div class="text-muted fs-7">{{ __('roles.administrator_access_help') }}</div>
                                        </div>
                                        <label class="form-check form-check-custom form-check-solid">
                                            <input class="form-check-input" type="checkbox" value="" id="kt_roles_select_all" />
                                            <span class="form-check-label fw-semibold">{{ __('roles.select_all') }}</span>
                                        </label>
                                    </div>
                                </div>
                                <!--end::Select All Section-->

                                <!--begin::Permissions Grid-->
                                <div class="permissions-grid" id="permissions_grid">
                                    <!-- Dynamic content will be loaded here -->
                                </div>
                                <!--end::Permissions Grid-->
                            </div>
                            <!--end::Permissions Container-->
                        </div>
                        <!--end::Permissions-->
                    </div>
                    <!--end::Scroll-->
                    <!--begin::Actions-->
                    <div class="text-center pt-15">
                        <button type="reset" class="btn btn-light me-3" data-kt-roles-modal-action="cancel">{{ __('common.discard') }}</button>
                        <button type="submit" class="btn btn-primary" data-kt-roles-modal-action="submit">
                            <span class="indicator-label">{{ __('roles.submit') }}</span>
                            <span class="indicator-progress">{{ __('roles.please_wait') }}
																<span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
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
<!--end::Modal - Update role-->
