@extends('layouts.frontend')

@section('title', 'SolarVerse - Government Transaction Management')
@section('description', 'Complete solutions for all your government transaction needs in Saudi Arabia')
@section('page-id', '66fe2653492e7505da575a52')

@section('head-styles')
<style>
    @media (min-width: 992px) {
        html.w-mod-js:not(.w-mod-ix) [data-w-id="1550f09e-1ea6-42de-f9f1-9999aa7bd0b6"] {
            -webkit-transform:translate3d(0, 0%, 0) scale3d(1, 1, 1) rotateX(0) rotateY(0) rotateZ(0) skew(0, 0);
            -moz-transform: translate3d(0, 0%, 0) scale3d(1, 1, 1) rotateX(0) rotateY(0) rotateZ(0) skew(0, 0);
            -ms-transform: translate3d(0, 0%, 0) scale3d(1, 1, 1) rotateX(0) rotateY(0) rotateZ(0) skew(0, 0);
            transform: translate3d(0, 0%, 0) scale3d(1, 1, 1) rotateX(0) rotateY(0) rotateZ(0) skew(0, 0);
        }

        html.w-mod-js:not(.w-mod-ix) [data-w-id="e3815ea7-0f1e-5ca1-edd9-ab7ccc578481"] {
            -webkit-transform: translate3d(0, -50%, 0) scale3d(1, 1, 1) rotateX(0) rotateY(0) rotateZ(0) skew(0, 0);
            -moz-transform: translate3d(0, -50%, 0) scale3d(1, 1, 1) rotateX(0) rotateY(0) rotateZ(0) skew(0, 0);
            -ms-transform: translate3d(0, -50%, 0) scale3d(1, 1, 1) rotateX(0) rotateY(0) rotateZ(0) skew(0, 0);
            transform: translate3d(0, -50%, 0) scale3d(1, 1, 1) rotateX(0) rotateY(0) rotateZ(0) skew(0, 0);
        }
    }
</style>
@endsection

@section('content')
<div data-w-id="fccf2bde-48d8-46e6-800a-34dcbb5ffacb" style="-webkit-transform:translate3d(0, 10%, 0) scale3d(1, 1, 1) rotateX(0) rotateY(0) rotateZ(0) skew(0, 0);-moz-transform:translate3d(0, 10%, 0) scale3d(1, 1, 1) rotateX(0) rotateY(0) rotateZ(0) skew(0, 0);-ms-transform:translate3d(0, 10%, 0) scale3d(1, 1, 1) rotateX(0) rotateY(0) rotateZ(0) skew(0, 0);transform:translate3d(0, 10%, 0) scale3d(1, 1, 1) rotateX(0) rotateY(0) rotateZ(0) skew(0, 0)" class="hero-v2">
    <div class="hero-v2-bg-block">
        <div data-w-id="64919ba9-ce60-1a68-8591-0ac7fe81f59d" data-is-ix2-target="1" class="hero-v2-bg-animate" data-animation-type="lottie" data-src="/assets/media/animations/68826711c3e4163567cee83e_Vector_20447_20_2_.json" data-loop="0" data-direction="1" data-autoplay="0" data-renderer="svg" data-default-duration="0" data-duration="0"></div>
    </div>
    <div class="main-container no-right-side-space">
        <div class="hero-v2-flex">
            <div class="hero-v2-content-wrap">
                <div class="hero-v2-header-wrap">
                    <div class="hero-v2-header-block">
                        <h1 data-w-id="360f05cf-10a7-9dac-ccc6-a5c3b08b325e" class="large-title">{{ __('home.hero.title') }} SolarVerse</h1>
                    </div>
                    <div class="hero-v2-sub-header-block">
                        <div class="body-text-medium">{{ __('home.hero.subtitle') }}</div>
                    </div>
                    <div class="hero-v2-sub-header-block">
                        <div class="body-text-medium">{{ __('home.hero.description') }}</div>
                    </div>
                </div>
                <div class="buttons-wrap top-margine-32">
                    @auth
                    <a data-w-id="dc549264-5c01-009c-fe4f-d070d798ffc1" href="{{ route('home') }}" class="secondary-button w-inline-block">
                        <div style="-webkit-transform:translate3d(100%, 0, 0) scale3d(0, 0, 1) rotateX(0) rotateY(0) rotateZ(0) skew(0, 0);-moz-transform:translate3d(100%, 0, 0) scale3d(0, 0, 1) rotateX(0) rotateY(0) rotateZ(0) skew(0, 0);-ms-transform:translate3d(100%, 0, 0) scale3d(0, 0, 1) rotateX(0) rotateY(0) rotateZ(0) skew(0, 0);transform:translate3d(100%, 0, 0) scale3d(0, 0, 1) rotateX(0) rotateY(0) rotateZ(0) skew(0, 0);background-color:rgb(102,205,204)" class="secondary-button-arrow-wrap left">
                            <div class="div-hide">
                                <img src="/assets/media/images/66fbecf34525bb47677cb157_arrow.svg" loading="lazy" alt="right wing arrow" class="arrow-icon"/>
                                <img src="/assets/media/images/670679847af3f88df02e599d_Arrow_20Whit.svg" loading="lazy" alt="right wing arrow" class="arrow-icon-ab"/>
                            </div>
                        </div>
                        <div style="background-color:rgb(102,205,204)" class="secondary-button-content">
                            <div class="button-text">{{ __('home.hero.dashboard') }}</div>
                        </div>
                        <div style="-webkit-transform:translate3d(0%, 0, 0) scale3d(1, 1, 1) rotateX(0) rotateY(0) rotateZ(0) skew(0, 0);-moz-transform:translate3d(0%, 0, 0) scale3d(1, 1, 1) rotateX(0) rotateY(0) rotateZ(0) skew(0, 0);-ms-transform:translate3d(0%, 0, 0) scale3d(1, 1, 1) rotateX(0) rotateY(0) rotateZ(0) skew(0, 0);transform:translate3d(0%, 0, 0) scale3d(1, 1, 1) rotateX(0) rotateY(0) rotateZ(0) skew(0, 0)" class="secondary-button-arrow-wrap right">
                            <div class="div-hide">
                                <img src="/assets/media/images/66fbecf34525bb47677cb157_arrow.svg" loading="lazy" alt="right wing arrow" class="arrow-icon"/>
                                <img src="/assets/media/images/670679847af3f88df02e599d_Arrow_20Whit.svg" loading="lazy" alt="right wing arrow" class="arrow-icon-ab"/>
                            </div>
                        </div>
                    </a>
                    @else
                    <a data-w-id="dc549264-5c01-009c-fe4f-d070d798ffc1" href="{{ route('about') }}" class="secondary-button w-inline-block">
                        <div style="-webkit-transform:translate3d(100%, 0, 0) scale3d(0, 0, 1) rotateX(0) rotateY(0) rotateZ(0) skew(0, 0);-moz-transform:translate3d(100%, 0, 0) scale3d(0, 0, 1) rotateX(0) rotateY(0) rotateZ(0) skew(0, 0);-ms-transform:translate3d(100%, 0, 0) scale3d(0, 0, 1) rotateX(0) rotateY(0) rotateZ(0) skew(0, 0);transform:translate3d(100%, 0, 0) scale3d(0, 0, 1) rotateX(0) rotateY(0) rotateZ(0) skew(0, 0);background-color:rgb(102,205,204)" class="secondary-button-arrow-wrap left">
                            <div class="div-hide">
                                <img src="/assets/media/images/66fbecf34525bb47677cb157_arrow.svg" loading="lazy" alt="right wing arrow" class="arrow-icon"/>
                                <img src="/assets/media/images/670679847af3f88df02e599d_Arrow_20Whit.svg" loading="lazy" alt="right wing arrow" class="arrow-icon-ab"/>
                            </div>
                        </div>
                        <div style="background-color:rgb(102,205,204)" class="secondary-button-content">
                            <div class="button-text">{{ __('home.hero.learn_more') }}</div>
                        </div>
                        <div style="-webkit-transform:translate3d(0%, 0, 0) scale3d(1, 1, 1) rotateX(0) rotateY(0) rotateZ(0) skew(0, 0);-moz-transform:translate3d(0%, 0, 0) scale3d(1, 1, 1) rotateX(0) rotateY(0) rotateZ(0) skew(0, 0);-ms-transform:translate3d(0%, 0, 0) scale3d(1, 1, 1) rotateX(0) rotateY(0) rotateZ(0) skew(0, 0);transform:translate3d(0%, 0, 0) scale3d(1, 1, 1) rotateX(0) rotateY(0) rotateZ(0) skew(0, 0)" class="secondary-button-arrow-wrap right">
                            <div class="div-hide">
                                <img src="/assets/media/images/66fbecf34525bb47677cb157_arrow.svg" loading="lazy" alt="right wing arrow" class="arrow-icon"/>
                                <img src="/assets/media/images/670679847af3f88df02e599d_Arrow_20Whit.svg" loading="lazy" alt="right wing arrow" class="arrow-icon-ab"/>
                            </div>
                        </div>
                    </a>
                    @endauth
                </div>
                <div class="hero-v2-bottom-icon-wrap">
                </div>
            </div>
            <div data-w-id="4e75e2b4-56a4-36b3-004b-1a48d16061a8" style="filter:blur(10px)" class="hero-v2-slider-loop-wrap">
                <div class="hero-v2-slider-loop">
                    <div class="slider-loop-1st">
                        <div data-w-id="1550f09e-1ea6-42de-f9f1-9999aa7bd0b6" class="hero-v2-image-loop-slide is-1">
                            <div class="hero-v2-loop-image-wrap">
                                <img src="/assets/media/images/670ed70db89fe0dfb7b52fdd_Doctor_20Check_20Patient_203.jpeg" loading="lazy" alt="Doctor Checking up patient " class="hero-v2-loop-image"/>
                                <img src="/assets/media/images/670ed763236b26455dc8db12_Doctor_204.jpeg" loading="lazy" alt="Doctor Smiling Image" class="hero-v2-loop-image"/>
                                <img src="/assets/media/images/66fe82557d91ae100957af3f_Young_20Patient_20Laughing.jpeg" loading="lazy" alt="Patient smiling image" class="hero-v2-loop-image"/>
                            </div>
                            <div class="hero-v2-loop-image-wrap">
                                <img src="/assets/media/images/670ed70db89fe0dfb7b52fdd_Doctor_20Check_20Patient_203.jpeg" loading="lazy" alt="Doctor Checking up patient " class="hero-v2-loop-image"/>
                                <img src="/assets/media/images/670ed763236b26455dc8db12_Doctor_204.jpeg" loading="lazy" alt="Doctor Smiling Image" class="hero-v2-loop-image"/>
                                <img src="/assets/media/images/66fe82557d91ae100957af3f_Young_20Patient_20Laughing.jpeg" loading="lazy" alt="Patient smiling image" class="hero-v2-loop-image"/>
                            </div>
                            <div class="hero-v2-loop-image-wrap">
                                <img src="/assets/media/images/670ed70db89fe0dfb7b52fdd_Doctor_20Check_20Patient_203.jpeg" loading="lazy" alt="Doctor Checking up patient " class="hero-v2-loop-image"/>
                                <img src="/assets/media/images/670ed763236b26455dc8db12_Doctor_204.jpeg" loading="lazy" alt="Doctor Smiling Image" class="hero-v2-loop-image"/>
                                <img src="/assets/media/images/66fe82557d91ae100957af3f_Young_20Patient_20Laughing.jpeg" loading="lazy" alt="Patient smiling image" class="hero-v2-loop-image"/>
                            </div>
                            <div class="hero-v2-loop-image-wrap">
                                <img src="/assets/media/images/670ed70db89fe0dfb7b52fdd_Doctor_20Check_20Patient_203.jpeg" loading="lazy" alt="Doctor Checking up patient " class="hero-v2-loop-image"/>
                                <img src="/assets/media/images/670ed763236b26455dc8db12_Doctor_204.jpeg" loading="lazy" alt="Doctor Smiling Image" class="hero-v2-loop-image"/>
                                <img src="/assets/media/images/66fe82557d91ae100957af3f_Young_20Patient_20Laughing.jpeg" loading="lazy" alt="Patient smiling image" class="hero-v2-loop-image"/>
                            </div>
                        </div>
                    </div>
                    <div class="slidr-loop-2nd">
                        <div data-w-id="e3815ea7-0f1e-5ca1-edd9-ab7ccc578481" class="hero-v2-image-loop-slide is-2">
                            <div class="hero-v2-loop-image-wrap">
                                <img src="/assets/media/images/670ed8113a8a24581ad4d7e7_Patient.png" loading="lazy" alt="Patient Image" class="hero-v2-loop-image"/>
                                <img src="/assets/media/images/67610095a38eb9ce413850e4_young-medics-talking-door_20_1_.png" loading="lazy" alt="Loop Image" class="hero-v2-loop-image"/>
                                <img src="/assets/media/images/670ed70db89fe0dfb7b52fdd_Doctor_20Check_20Patient_203.jpeg" loading="lazy" alt="Doctor Checking up patient " class="hero-v2-loop-image hero-v2-image-wrap"/>
                            </div>
                            <div class="hero-v2-loop-image-wrap">
                                <img src="/assets/media/images/670ed8113a8a24581ad4d7e7_Patient.png" loading="lazy" alt="Patient Image" class="hero-v2-loop-image"/>
                                <img src="/assets/media/images/67610095a38eb9ce413850e4_young-medics-talking-door_20_1_.png" loading="lazy" alt="Loop Image" class="hero-v2-loop-image"/>
                                <img src="/assets/media/images/670ed70db89fe0dfb7b52fdd_Doctor_20Check_20Patient_203.jpeg" loading="lazy" alt="Doctor Checking up patient " class="hero-v2-loop-image hero-v2-image-wrap"/>
                            </div>
                            <div class="hero-v2-loop-image-wrap">
                                <img src="/assets/media/images/670ed8113a8a24581ad4d7e7_Patient.png" loading="lazy" alt="Patient Image" class="hero-v2-loop-image"/>
                                <img src="/assets/media/images/67610095a38eb9ce413850e4_young-medics-talking-door_20_1_.png" loading="lazy" alt="Loop Image" class="hero-v2-loop-image"/>
                                <img src="/assets/media/images/670ed70db89fe0dfb7b52fdd_Doctor_20Check_20Patient_203.jpeg" loading="lazy" alt="Doctor Checking up patient " class="hero-v2-loop-image hero-v2-image-wrap"/>
                            </div>
                            <div class="hero-v2-loop-image-wrap">
                                <img src="/assets/media/images/670ed8113a8a24581ad4d7e7_Patient.png" loading="lazy" alt="Patient Image" class="hero-v2-loop-image"/>
                                <img src="/assets/media/images/67610095a38eb9ce413850e4_young-medics-talking-door_20_1_.png" loading="lazy" alt="Loop Image" class="hero-v2-loop-image"/>
                                <img src="/assets/media/images/670ed70db89fe0dfb7b52fdd_Doctor_20Check_20Patient_203.jpeg" loading="lazy" alt="Doctor Checking up patient " class="hero-v2-loop-image hero-v2-image-wrap"/>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
