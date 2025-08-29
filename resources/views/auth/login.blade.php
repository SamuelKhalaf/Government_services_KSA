@extends('layouts.app')

@section('bg_image')
    <style>body { background-image: url('{{asset('assets/media/auth/bg6.jpg')}}'); } [data-bs-theme="dark"] body { background-image: url('{{asset('assets/media/auth/bg4-dark.jpg')}}'); }</style>
@endsection

@section('content')
    <!--begin::Authentication - Sign-in -->
    <div class="d-flex flex-column flex-column-fluid flex-lg-row">
        <!--begin::Aside-->
        <div class="d-flex flex-center w-lg-50 pt-15 pt-lg-0 px-10">
            <!--begin::Aside-->
            <div class="d-flex flex-center flex-lg-start flex-column">
                <!--begin::Logo-->
                <a class="mb-7">
                    <img alt="Logo" src="{{asset('assets/media/logos/solar_verse.png')}}" style="width: 400px" />
                </a>
                <!--end::Logo-->
                <!--begin::Title-->
                <h2 class="text-white fw-normal m-0">{{ __('auth.branding_tools') }}</h2>
                <!--end::Title-->
            </div>
            <!--begin::Aside-->
        </div>
        <!--begin::Aside-->
        <!--begin::Body-->
        <div class="d-flex flex-center w-lg-50 p-10">
            <!--begin::Card-->
            <div class="card rounded-3 w-md-550px">
                <!--begin::Card body-->
                <div class="card-body d-flex flex-column p-10 p-lg-20 pb-lg-10">
                    <!--begin::Wrapper-->
                    <div class="d-flex flex-center flex-column-fluid pb-15 pb-lg-20">
                        <!--begin::Form-->
                        <form class="form w-100" novalidate="novalidate" id="kt_sign_in_form" data-kt-redirect-url="{{route('admin.dashboard')}}" action="{{route('login')}}" method="POST">
                            <!--begin::Heading-->
                            <div class="text-center mb-11">
                                <!--begin::Title-->
                                <h1 class="text-dark fw-bolder mb-3">{{ __('auth.sign_in') }}</h1>
                                <!--end::Title-->
                                
                                <!--begin::Language Switcher-->
                                <div class="d-flex justify-content-center mb-3">
                                    <div class="dropdown">
                                        <button class="btn btn-sm btn-light-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                            <i class="fas fa-globe me-2"></i>
                                            {{ app()->getLocale() === 'ar' ? 'العربية' : 'English' }}
                                        </button>
                                        <ul class="dropdown-menu">
                                            <li><a class="dropdown-item" href="{{ route('language.switch', 'en') }}">English</a></li>
                                            <li><a class="dropdown-item" href="{{ route('language.switch', 'ar') }}">العربية</a></li>
                                        </ul>
                                    </div>
                                </div>
                                <!--end::Language Switcher-->
                                
                                <!--begin::Success/Error Messages-->
                                <!-- @if(session('success'))
                                    <div class="alert alert-success mb-3">
                                        {{ session('success') }}
                                    </div>
                                @endif
                                @if(session('error'))
                                    <div class="alert alert-danger mb-3">
                                        {{ session('error') }}
                                    </div>
                                @endif -->
                                <!--end::Success/Error Messages-->
                            </div>
                            <!--end::Heading-->
                            <!--begin::Input group=-->
                            <div class="fv-row mb-8">
                                <!--begin::Email-->
                                <input type="text" placeholder="{{ __('auth.email') }}" name="email" autocomplete="off" class="form-control bg-transparent" />
                                <!--end::Email-->
                            </div>
                            <!--end::Input group=-->
                            <div class="fv-row mb-3">
                                <!--begin::Password-->
                                <input type="password" placeholder="{{ __('auth.password') }}" name="password" autocomplete="off" class="form-control bg-transparent" />
                                <!--end::Password-->
                            </div>
                            <!--end::Input group=-->

                            <!--begin::Wrapper-->
                            <div class="d-flex flex-stack flex-wrap gap-3 fs-base fw-semibold mb-8">
                                <!--begin::Accept-->
                                <div class="fv-row">
                                    <label class="form-check form-check-inline">
                                        <input class="form-check-input" type="checkbox" name="remember" value="1" />
                                        <span class="form-check-label fw-semibold text-gray-700 fs-base ms-1">{{ __('auth.remember_me') }}</span>
                                    </label>
                                </div>
                                <!--end::Accept-->
                                <!--begin::Link-->
                                <!-- <a href="{{ route('password.request') }}" class="link-primary">{{ __('auth.forgot_password') }}</a> -->
                                <!--end::Link-->
                            </div>
                            <!--end::Wrapper-->
                            <!--begin::Submit button-->
                            <div class="d-grid mb-10">
                                <button type="submit" id="kt_sign_in_submit" class="btn btn-primary">
                                    <!--begin::Indicator label-->
                                    <span class="indicator-label">{{ __('auth.sign_in') }}</span>
                                    <!--end::Indicator label-->
                                    <!--begin::Indicator progress-->
                                    <span class="indicator-progress">{{ __('auth.please_wait') }}
                                                <span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                                    <!--end::Indicator progress-->
                                </button>
                            </div>
                            <!--end::Submit button-->
                            <!--begin::Sign up-->
                            {{-- Registration is disabled --}}
                            {{-- <div class="text-gray-500 text-center fw-semibold fs-6">{{ __('auth.not_member_yet') }}
                                <a href="{{route('register')}}" class="link-primary">{{ __('auth.sign_up') }}</a></div> --}}
                            <!--end::Sign up-->
                        </form>
                        <!--end::Form-->
                    </div>
                    <!--end::Wrapper-->
                </div>
                <!--end::Card body-->
            </div>
            <!--end::Card-->
        </div>
        <!--end::Body-->
    </div>
    <!--end::Authentication - Sign-in-->
@endsection

@section('scripts')
    <script>
        "use strict";

        // Class definition
        var KTSigninGeneral = function() {
            // Elements
            var form;
            var submitButton;
            var validator;

            // Handle form
            var handleValidation = function(e) {
                // Init form validation rules. For more info check the FormValidation plugin's official documentation:https://formvalidation.io/
                validator = FormValidation.formValidation(
                    form,
                    {
                        fields: {
                            'email': {
                                validators: {
                                    regexp: {
                                        regexp: /^[^\s@]+@[^\s@]+\.[^\s@]+$/,
                                        message: '{{ __("auth.invalid_email") }}',
                                    },
                                    notEmpty: {
                                        message: '{{ __("auth.email_required") }}'
                                    }
                                }
                            },
                            'password': {
                                validators: {
                                    notEmpty: {
                                        message: '{{ __("auth.password_required") }}'
                                    }
                                }
                            }
                        },
                        plugins: {
                            trigger: new FormValidation.plugins.Trigger(),
                            bootstrap: new FormValidation.plugins.Bootstrap5({
                                rowSelector: '.fv-row',
                                eleInvalidClass: '',  // comment to enable invalid state icons
                                eleValidClass: '' // comment to enable valid state icons
                            })
                        }
                    }
                );
            }

            var handleSubmitDemo = function(e) {
                // Handle form submit
                submitButton.addEventListener('click', function (e) {
                    // Prevent button default action
                    e.preventDefault();

                    // Validate form
                    validator.validate().then(function (status) {
                        if (status === 'Valid') {
                            // Show loading indication
                            submitButton.setAttribute('data-kt-indicator', 'on');

                            // Disable button to avoid multiple click
                            submitButton.disabled = true;


                            // Simulate ajax request
                            setTimeout(function() {
                                // Hide loading indication
                                submitButton.removeAttribute('data-kt-indicator');

                                // Enable button
                                submitButton.disabled = false;

                                // Show message popup. For more info check the plugin's official documentation: https://sweetalert2.github.io/
                                Swal.fire({
                                    text: "{{ __('auth.login_successful') }}",
                                    icon: "success",
                                    buttonsStyling: false,
                                    confirmButtonText: "{{ __('common.ok_got_it') }}",
                                    customClass: {
                                        confirmButton: "btn btn-primary"
                                    }
                                }).then(function (result) {
                                    if (result.isConfirmed) {
                                        form.querySelector('[name="email"]').value= "";
                                        form.querySelector('[name="password"]').value= "";

                                        //form.submit(); // submit form
                                        var redirectUrl = form.getAttribute('data-kt-redirect-url');
                                        if (redirectUrl) {
                                            location.href = redirectUrl;
                                        }
                                    }
                                });
                            }, 2000);
                        } else {
                            // Show error popup. For more info check the plugin's official documentation: https://sweetalert2.github.io/
                            Swal.fire({
                                text: "{{ __('auth.validation_errors') }}",
                                icon: "error",
                                buttonsStyling: false,
                                confirmButtonText: "{{ __('common.ok_got_it') }}",
                                customClass: {
                                    confirmButton: "btn btn-primary"
                                }
                            });
                        }
                    });
                });
            }

            var handleSubmitAjax = function(e) {
                submitButton.addEventListener('click', function (e) {
                    e.preventDefault(); // Prevent default form submission

                    validator.validate().then(function (status) {
                        if (status === 'Valid') {
                            // Show loading indication
                            submitButton.setAttribute('data-kt-indicator', 'on');
                            submitButton.disabled = true; // Disable button to prevent multiple clicks

                            $.ajax({
                                url: form.getAttribute('action'),
                                type: 'POST',
                                data: {
                                    email: form.querySelector('[name="email"]').value,
                                    password: form.querySelector('[name="password"]').value,
                                    remember: form.querySelector('[name="remember"]')?.checked ? 'on' : '',
                                    _token: $('meta[name="csrf-token"]').attr('content')
                                },
                                dataType: 'json',
                                success: function(response) {
                                    submitButton.removeAttribute('data-kt-indicator');
                                    submitButton.disabled = false;

                                    // Swal.fire({
                                    //     text: response.message || "{{ __('auth.login_successful') }}",
                                    //     icon: "success",
                                    //     buttonsStyling: false,
                                    //     confirmButtonText: "{{ __('common.ok_got_it') }}",
                                    //     customClass: {
                                    //         confirmButton: "btn btn-primary"
                                    //     }
                                    // }).then(function (result) {
                                    //     if (result.isConfirmed) {
                                            form.reset();
                                            let redirectUrl = response.redirect_url || form.getAttribute('data-kt-redirect-url');
                                            if (redirectUrl) {
                                                location.href = redirectUrl;
                                            }
                                        // }
                                    // });
                                },
                                error: function(xhr) {
                                    let errorMessage = "{{ __('auth.invalid_credentials') }}";

                                    if (xhr.responseJSON && xhr.responseJSON.errors) {
                                        errorMessage = Object.values(xhr.responseJSON.errors).map(err => err[0]).join("\n");
                                    }

                                    Swal.fire({
                                        text: errorMessage,
                                        icon: "error",
                                        confirmButtonText: "{{ __('common.ok_got_it') }}",
                                        customClass: { confirmButton: "btn btn-primary" }
                                    });

                                    submitButton.removeAttribute('data-kt-indicator');
                                    submitButton.disabled = false;
                                }
                            });
                        } else {
                            Swal.fire({
                                text: "{{ __('auth.check_form_errors') }}",
                                icon: "error",
                                confirmButtonText: "{{ __('common.ok_got_it') }}",
                                customClass: { confirmButton: "btn btn-primary" }
                            });
                        }
                    });
                });
            }

            // Public functions
            return {
                // Initialization
                init: function() {
                    form = document.querySelector('#kt_sign_in_form');
                    submitButton = document.querySelector('#kt_sign_in_submit');

                    handleValidation();
                    // handleSubmitDemo(); // used for demo purposes only, if you use the below ajax version you can uncomment this one
                    handleSubmitAjax(); // use for ajax submit
                }
            };
        }();

        // On document ready
        KTUtil.onDOMContentLoaded(function() {
            KTSigninGeneral.init();
        });
    </script>
@endsection
