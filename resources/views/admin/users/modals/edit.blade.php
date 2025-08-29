<div class="modal fade" id="kt_modal_update_details" tabindex="-1" aria-hidden="true">
<!--begin::Modal dialog-->
    <div class="modal-dialog modal-dialog-centered mw-650px">
        <!--begin::Modal content-->
        <div class="modal-content">
            <!--begin::Form-->
            <form class="form" action="#" id="kt_modal_update_user_form" data-user-id="">
                <!--begin::Modal header-->
                <div class="modal-header" id="kt_modal_update_user_header">
                    <!--begin::Modal title-->
                    <h2 class="fw-bold">@lang('users.update_user')</h2>
                    <!--end::Modal title-->

                    <!--begin::Close-->
                    <div class="btn btn-icon btn-sm btn-active-icon-primary" data-kt-users-modal-action="close">
                        <span class="svg-icon svg-icon-1">
                            <i class="fa-solid fa-xmark " style="font-size: 2rem !important;"></i>
                        </span>
                    </div>
                    <!--end::Close-->
                </div>
                <!--end::Modal header-->

                <!--begin::Modal body-->
                <div class="modal-body py-10 px-lg-17">
                    <!--begin::Scroll-->
                    <div class="d-flex flex-column scroll-y me-n7 pe-7" id="kt_modal_update_user_scroll" data-kt-scroll="true" data-kt-scroll-activate="{default: false, lg: true}" data-kt-scroll-max-height="auto" data-kt-scroll-dependencies="#kt_modal_update_user_header" data-kt-scroll-wrappers="#kt_modal_update_user_scroll" data-kt-scroll-offset="300px" style="max-height: 121px;">

                        <!--begin::User form-->
                        <div id="kt_modal_update_user_user_info" class="collapse show">
                            @csrf
                            @method('PUT')
                            
                            <!--begin::Row-->
                            <div class="row mb-7">
                                <!--begin::Col-->
                                <div class="col-md-6">
                                    <div class="fv-row">
                                        <!--begin::Label-->
                                        <label class="required fw-semibold fs-6 mb-2">@lang('users.full_name')</label>
                                        <!--end::Label-->
                                        <!--begin::Input-->
                                        <input type="text" name="name" class="form-control form-control-solid" placeholder="@lang('users.full_name_placeholder')" />
                                        <!--end::Input-->
                                    </div>
                                </div>
                                <!--end::Col-->
                                <!--begin::Col-->
                                <div class="col-md-6">
                                    <div class="fv-row">
                                <!--begin::Label-->
                                        <label class="required fw-semibold fs-6 mb-2">@lang('users.email')</label>
                                <!--end::Label-->
                                <!--begin::Input-->
                                        <input type="email" name="email" class="form-control form-control-solid" placeholder="@lang('users.email_placeholder')" />
                                <!--end::Input-->
                                    </div>
                                </div>
                                <!--end::Col-->
                            </div>
                            <!--end::Row-->
                            
                            <!--begin::Row-->
                            <div class="row mb-7">
                                <!--begin::Col-->
                                <div class="col-md-6">
                                    <div class="fv-row">
                                <!--begin::Label-->
                                        <label class="required fw-semibold fs-6 mb-2">@lang('users.phone_number')</label>
                                <!--end::Label-->
                                <!--begin::Input-->
                                        <input type="text" name="phone_number" class="form-control form-control-solid" placeholder="@lang('users.phone_placeholder')" />
                                <!--end::Input-->
                            </div>
                                </div>
                                <!--end::Col-->
                                <!--begin::Col-->
                                <div class="col-md-6">
                                    <div class="fv-row">
                                <!--begin::Label-->
                                        <label class="fw-semibold fs-6 mb-2">@lang('users.national_id')</label>
                                <!--end::Label-->
                                <!--begin::Input-->
                                        <input type="text" name="national_id" class="form-control form-control-solid" placeholder="@lang('users.national_id_placeholder')"/>
                                <!--end::Input-->
                                    </div>
                                </div>
                                <!--end::Col-->
                            </div>
                            <!--end::Row-->
                            
                            <!--begin::Row-->
                            <div class="row mb-7">
                                <!--begin::Col-->
                                <div class="col-md-6">
                                    <div class="fv-row">
                                        <!--begin::Label-->
                                        <label class="required fw-semibold fs-6 mb-2">@lang('users.status')</label>
                                        <!--end::Label-->
                                        <!--begin::Select-->
                                        <select name="status" class="form-select form-control-solid">
                                            <option value="active">@lang('users.active')</option>
                                            <option value="inactive">@lang('users.inactive')</option>
                                        </select>
                                        <!--end::Select-->
                                    </div>
                                </div>
                                <!--end::Col-->
                                <!--begin::Col-->
                                <div class="col-md-6">
                                    <div class="fv-row">
                                        <!--begin::Label-->
                                        <label class="required fw-semibold fs-6 mb-2">@lang('users.preferred_language')</label>
                                        <!--end::Label-->
                                        <!--begin::Select-->
                                        <select name="preferred_language" class="form-select form-control-solid">
                                            <option value="ar">@lang('languages.arabic')</option>
                                            <option value="en">@lang('languages.english')</option>
                                        </select>
                                        <!--end::Select-->
                                    </div>
                                </div>
                                <!--end::Col-->
                            </div>
                            <!--end::Row-->
                            
                            <!--begin::Row-->
                            <div class="row mb-7">
                                <!--begin::Col-->
                                <div class="col-md-6">
                                    <div class="fv-row">
                                <!--begin::Label-->
                                        <label class="required fw-semibold fs-6 mb-2">@lang('users.role')</label>
                                <!--end::Label-->
                                <!--begin::Select-->
                                <select name="role" class="form-select form-control-solid">
                                    @if($roles->isNotEmpty())
                                        @foreach($roles as $role)
                                                    <option value="{{ $role->name }}">@lang('roles.' . $role->name)</option>
                                        @endforeach
                                    @endif
                                </select>
                                <!--end::Select-->
                            </div>
                                </div>
                                <!--end::Col-->
                                <!--begin::Col-->
                                <div class="col-md-6">
                                    <div class="fv-row">
                                        <!--begin::Label-->
                                        <label class="fw-semibold fs-6 mb-2">@lang('users.address')</label>
                                        <!--end::Label-->
                                        <!--begin::Input-->
                                        <textarea name="address" class="form-control form-control-solid" rows="2" placeholder="@lang('users.address_placeholder')"></textarea>
                                        <!--end::Input-->
                                    </div>
                                </div>
                                <!--end::Col-->
                            </div>
                            <!--end::Row-->
                            
                            <!--begin::Row-->
                            <div class="row mb-7">
                                <!--begin::Col-->
                                <div class="col-md-6">
                                    <div class="fv-row">
                                        <!--begin::Label-->
                                        <label class="fw-semibold fs-6 mb-2">@lang('users.new_password')</label>
                                        <!--end::Label-->
                                        <!--begin::Input-->
                                        <input type="password" name="password" class="form-control form-control-solid" placeholder="@lang('users.new_password_placeholder')"/>
                                        <!--end::Input-->
                                    </div>
                                </div>
                                <!--end::Col-->
                                <!--begin::Col-->
                                <div class="col-md-6">
                                    <div class="fv-row">
                                        <!--begin::Label-->
                                        <label class="fw-semibold fs-6 mb-2">@lang('users.confirm_new_password')</label>
                                        <!--end::Label-->
                                        <!--begin::Input-->
                                        <input type="password" name="password_confirmation" class="form-control form-control-solid" placeholder="@lang('users.confirm_new_password_placeholder')"/>
                                        <!--end::Input-->
                                    </div>
                                </div>
                                <!--end::Col-->
                            </div>
                            <!--end::Row-->
                        </div>
                        <!--end::User form-->
                    </div>
                    <!--end::Scroll-->
                </div>
                <!--end::Modal body-->

                <!--begin::Modal footer-->
                <div class="modal-footer flex-center">
                    <!--begin::Button-->
                    <button type="reset" class="btn btn-light me-3" data-kt-users-modal-action="cancel">
                        @lang('common.discard')
                    </button>
                    <!--end::Button-->

                    <!--begin::Button-->
                    <button type="submit" class="btn btn-primary" data-kt-users-modal-action="submit">
                        <span class="indicator-label">
                            @lang('common.update')
                        </span>
                        <span class="indicator-progress">
                            @lang('common.please_wait')... <span class="spinner-border spinner-border-sm align-middle ms-2"></span>
                        </span>
                    </button>
                    <!--end::Button-->
                </div>
                <!--end::Modal footer-->
            </form>
            <!--end::Form-->
        </div>
    </div>
</div>
