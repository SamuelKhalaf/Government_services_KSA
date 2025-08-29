@extends('layouts.app')

@section('bg_image')
    <style>body { background-image: url('{{asset('assets/media/auth/bg4.jpg')}}'); } [data-bs-theme="dark"] body { background-image: url('{{asset('assets/media/auth/bg4-dark.jpg')}}'); }</style>
@endsection

@section('content')
    <!--begin::Authentication - Sign-up -->
    <div class="d-flex flex-column flex-column-fluid flex-lg-row">
        <!--begin::Aside-->
        <div class="d-flex flex-center w-lg-50 pt-15 pt-lg-0 px-10">
            <!--begin::Aside-->
            <div class="d-flex flex-center flex-lg-start flex-column">
                <!--begin::Logo-->
                <a class="mb-7">
                    <img alt="Logo" src="{{asset('assets/media/logos/custom-3.svg')}}" />
                </a>
                <!--end::Logo-->
                <!--begin::Title-->
                <h2 class="text-white fw-normal m-0">Branding tools designed for your business</h2>
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
                        <form class="form w-100" novalidate="novalidate" id="kt_sign_up_form" data-kt-redirect-url="{{route('admin.dashboard')}}" action="{{ route('register') }}" method="POST">
                            <!--begin::Heading-->
                            <div class="text-center mb-11">
                                <!--begin::Title-->
                                <h1 class="text-dark fw-bolder mb-3">Sign Up</h1>
                                <!--end::Title-->
                            </div>
                            <!--begin::Heading-->
                            @csrf
                            <!--begin::Input group=-->
                            <div class="fv-row mb-8">
                                <!--begin::Full Name-->
                                <input type="text" placeholder="Full Name" name="name" autocomplete="off" class="form-control bg-transparent" />
                                <!--end::Full Name-->
                            </div>
                            <!--begin::Input group-->
                            <!--begin::Input group=-->
                            <div class="fv-row mb-8">
                                <!--begin::Email-->
                                <input type="email" placeholder="Email" name="email" autocomplete="off" class="form-control bg-transparent" />
                                <!--end::Email-->
                            </div>
                            <!--begin::Input group-->
                            <!--begin::Input group=-->
                            <div class="fv-row mb-8">
                                <!--begin::Email-->
                                <input type="text" placeholder="Phone Number" name="phone_number" autocomplete="off" class="form-control bg-transparent" />
                                <!--end::Email-->
                            </div>
                            <!--begin::Input group-->
                            <div class="fv-row mb-8" data-kt-password-meter="true">
                                <!--begin::Wrapper-->
                                <div class="mb-1">
                                    <!--begin::Input wrapper-->
                                    <div class="position-relative mb-3">
                                        <input class="form-control bg-transparent" type="password" placeholder="Password" name="password" autocomplete="off" />
                                        <span class="btn btn-sm btn-icon position-absolute translate-middle top-50 end-0 me-n2" data-kt-password-meter-control="visibility">
                                            <i class="bi bi-eye-slash fs-2"></i>
                                            <i class="bi bi-eye fs-2 d-none"></i>
                                        </span>
                                    </div>
                                    <!--end::Input wrapper-->
                                    <!--begin::Meter-->
{{--                                    <div class="d-flex align-items-center mb-3" data-kt-password-meter-control="highlight">--}}
{{--                                        <div class="flex-grow-1 bg-secondary bg-active-success rounded h-5px me-2"></div>--}}
{{--                                        <div class="flex-grow-1 bg-secondary bg-active-success rounded h-5px me-2"></div>--}}
{{--                                        <div class="flex-grow-1 bg-secondary bg-active-success rounded h-5px me-2"></div>--}}
{{--                                        <div class="flex-grow-1 bg-secondary bg-active-success rounded h-5px"></div>--}}
{{--                                    </div>--}}
                                    <!--end::Meter-->
                                </div>
                                <!--end::Wrapper-->
                                <!--begin::Hint-->
                                <div class="text-muted">Use 8 or more characters with a mix of letters, numbers & symbols.</div>
                                <!--end::Hint-->
                            </div>
                            <!--end::Input group=-->
                            <!--end::Input group=-->
                            <div class="fv-row mb-8">
                                <!--begin::Repeat Password-->
                                <input placeholder="Repeat Password" name="password_confirmation" type="password" autocomplete="off" class="form-control bg-transparent" />
                                <!--end::Repeat Password-->
                            </div>
                            <!--end::Input group=-->
                            <!--begin::Accept-->
                            <div class="fv-row mb-8">
                                <label class="form-check form-check-inline">
                                    <input class="form-check-input" type="checkbox" name="remember" value="1" />
                                    <span class="form-check-label fw-semibold text-gray-700 fs-base ms-1">Remember Me</span>
                                </label>
                            </div>
                            <!--end::Accept-->
                            <!--begin::Submit button-->
                            <div class="d-grid mb-10">
                                <button type="submit" id="kt_sign_up_submit" class="btn btn-primary">
                                    <!--begin::Indicator label-->
                                    <span class="indicator-label">Sign up</span>
                                    <!--end::Indicator label-->
                                    <!--begin::Indicator progress-->
                                    <span class="indicator-progress">Please wait...
											<span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                                    <!--end::Indicator progress-->
                                </button>
                            </div>
                            <!--end::Submit button-->
                            <!--begin::Sign up-->
                            <div class="text-gray-500 text-center fw-semibold fs-6">Already have an Account?
                                <a href="{{route('login')}}" class="link-primary fw-semibold">Sign in</a></div>
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
    <!--end::Authentication - Sign-up-->
@endsection
@section('scripts')
{{--    <script src="{{asset('assets/js/custom/authentication/sign-up/general.js')}}"></script>--}}
    <script>
        "use strict";

        // Class definition
        var KTSignupGeneral = function() {
            // Elements
            var form;
            var submitButton;
            var validator;
            // var passwordMeter;

            // Handle form
            var handleForm  = function(e) {
                // Init form validation rules. For more info check the FormValidation plugin's official documentation:https://formvalidation.io/
                validator = FormValidation.formValidation(
                    form,
                    {
                        fields: {
                            'name': {
                                validators: {
                                    notEmpty: {
                                        message: 'Full Name is required'
                                    }
                                }
                            },
                            'phone_number': {
                                validators: {
                                    notEmpty: {
                                        message: 'Phone Number is required'
                                    }
                                }
                            },
                            'email': {
                                validators: {
                                    regexp: {
                                        regexp: /^[^\s@]+@[^\s@]+\.[^\s@]+$/,
                                        message: 'The value is not a valid email address',
                                    },
                                    notEmpty: {
                                        message: 'Email address is required'
                                    }
                                }
                            },
                            'password': {
                                validators: {
                                    notEmpty: {
                                        message: 'The password is required'
                                    },
                                    callback: {
                                        message: 'Please enter valid password',
                                        // callback: function(input) {
                                        //     if (input.value.length > 0) {
                                        //         return validatePassword();
                                        //     }
                                        // }
                                    }
                                }
                            },
                            'password_confirmation': {
                                validators: {
                                    notEmpty: {
                                        message: 'The password confirmation is required'
                                    },
                                    // identical: {
                                    //     compare: function() {
                                    //         return form.querySelector('[name="password"]').value;
                                    //     },
                                    //     message: 'The password and its confirm are not the same'
                                    // }
                                }
                            },
                        },
                        plugins: {
                            trigger: new FormValidation.plugins.Trigger({
                                event: {
                                    password: false
                                }
                            }),
                            bootstrap: new FormValidation.plugins.Bootstrap5({
                                rowSelector: '.fv-row',
                                eleInvalidClass: '',  // comment to enable invalid state icons
                                eleValidClass: '' // comment to enable valid state icons
                            })
                        }
                    }
                );

                // Handle form submit
                submitButton.addEventListener('click', function (e) {
                    e.preventDefault();

                    validator.revalidateField('password');

                    validator.validate().then(function(status) {
                        if (status === 'Valid') {
                            // Show loading indicator
                            submitButton.setAttribute('data-kt-indicator', 'on');
                            submitButton.disabled = true;

                            // Prepare form data
                            let formData = new FormData(form);

                            // Send data via AJAX
                            $.ajax({
                                url: form.getAttribute('action'),
                                type: "POST",
                                data: formData,
                                processData: false,
                                contentType: false,
                                success: function(response) {
                                    // Hide loading indicator
                                    submitButton.removeAttribute('data-kt-indicator');
                                    submitButton.disabled = false;

                                    // Show success message
                                    Swal.fire({
                                        text: response.message || "User registered successfully, Redirecting...",
                                        icon: "success",
                                        buttonsStyling: false,
                                        confirmButtonText: "Ok, got it!",
                                        customClass: {
                                            confirmButton: "btn btn-primary"
                                        }
                                    }).then(function (result) {
                                        if (result.isConfirmed) {
                                            form.reset();
                                            // passwordMeter.reset();
                                            let redirectUrl = response.redirect_url || form.getAttribute('data-kt-redirect-url');
                                            if (redirectUrl) {
                                                location.href = redirectUrl;
                                            }
                                        }
                                    });
                                },
                                error: function(xhr) {
                                    submitButton.removeAttribute('data-kt-indicator');
                                    submitButton.disabled = false;

                                    let errorMessage = "Something went wrong. Please try again.";

                                    if (xhr.responseJSON && xhr.responseJSON.errors) {
                                        errorMessage = Object.values(xhr.responseJSON.errors).flat().join('<br>');
                                    }

                                    Swal.fire({
                                        html: errorMessage,
                                        icon: "error",
                                        buttonsStyling: false,
                                        confirmButtonText: "Ok, got it!",
                                        customClass: {
                                            confirmButton: "btn btn-primary"
                                        }
                                    });
                                }
                            });

                        } else {
                            Swal.fire({
                                text: "Sorry, looks like there are some errors detected. Please try again.",
                                icon: "error",
                                buttonsStyling: false,
                                confirmButtonText: "Ok, got it!",
                                customClass: {
                                    confirmButton: "btn btn-primary"
                                }
                            });
                        }
                    });
                });

                // Handle password input
                form.querySelector('input[name="password"]').addEventListener('input', function() {
                    if (this.value.length > 0) {
                        validator.updateFieldStatus('password', 'NotValidated');
                    }
                });
            }

            // Password input validation
            var validatePassword = function() {
                return (passwordMeter.getScore() === 100);
            }

            // Public functions
            return {
                // Initialization
                init: function() {
                    // Elements
                    form = document.querySelector('#kt_sign_up_form');
                    submitButton = document.querySelector('#kt_sign_up_submit');
                    // passwordMeter = KTPasswordMeter.getInstance(form.querySelector('[data-kt-password-meter="true"]'));

                    handleForm ();
                }
            };
        }();

        // On document ready
        KTUtil.onDOMContentLoaded(function() {
            KTSignupGeneral.init();
        });
    </script>
@endsection
