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
                                                    <img src="/assets/media/images/6890a23106deff26baa4d66a_Doctors_20Image_20_2__20_1_-p-500.jpeg" loading="lazy" alt="Saudi Professional Woman" class="hero-v2-loop-image"/>
                                                    <img src="/assets/media/images/saudi_professional_man.jpeg" loading="lazy" alt="Saudi Professional Man" class="hero-v2-loop-image"/>
                                                    <img src="/assets/media/images/670ed70db89fe0dfb7b52fdd_Doctor_20Check_20Patient_203.jpeg" loading="lazy" alt="Doctor Checking up patient " class="hero-v2-loop-image hero-v2-image-wrap"/>
                                                </div>
                                                <div class="hero-v2-loop-image-wrap">
                                                    <img src="/assets/media/images/6890a23106deff26baa4d66a_Doctors_20Image_20_2__20_1_-p-500.jpeg" loading="lazy" alt="Saudi Professional Woman" class="hero-v2-loop-image"/>
                                                    <img src="/assets/media/images/saudi_professional_man.jpeg" loading="lazy" alt="Saudi Professional Man" class="hero-v2-loop-image"/>
                                                    <img src="/assets/media/images/670ed70db89fe0dfb7b52fdd_Doctor_20Check_20Patient_203.jpeg" loading="lazy" alt="Doctor Checking up patient " class="hero-v2-loop-image hero-v2-image-wrap"/>
                                                </div>
                                                <div class="hero-v2-loop-image-wrap">
                                                    <img src="/assets/media/images/6890a23106deff26baa4d66a_Doctors_20Image_20_2__20_1_-p-500.jpeg" loading="lazy" alt="Saudi Professional Woman" class="hero-v2-loop-image"/>
                                                    <img src="/assets/media/images/saudi_professional_man.jpeg" loading="lazy" alt="Saudi Professional Man" class="hero-v2-loop-image"/>
                                                    <img src="/assets/media/images/670ed70db89fe0dfb7b52fdd_Doctor_20Check_20Patient_203.jpeg" loading="lazy" alt="Doctor Checking up patient " class="hero-v2-loop-image hero-v2-image-wrap"/>
                                                </div>
                                                <div class="hero-v2-loop-image-wrap">
                                                    <img src="/assets/media/images/6890a23106deff26baa4d66a_Doctors_20Image_20_2__20_1_-p-500.jpeg" loading="lazy" alt="Saudi Professional Woman" class="hero-v2-loop-image"/>
                                                    <img src="/assets/media/images/saudi_professional_man.jpeg" loading="lazy" alt="Saudi Professional Man" class="hero-v2-loop-image"/>
                                                    <img src="/assets/media/images/670ed70db89fe0dfb7b52fdd_Doctor_20Check_20Patient_203.jpeg" loading="lazy" alt="Doctor Checking up patient " class="hero-v2-loop-image hero-v2-image-wrap"/>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div data-w-id="28e7ec42-1698-786a-492c-fbb852f99beb" class="marquee-section">
                        <div data-w-id="965c9a4b-5a92-921b-0d61-a5a314796ac9" class="marquee-wrapper">
                            <div class="marquee-content">
                                <div class="marquee-item">
                                    <img src="/assets/media/bar/image1.jpeg" loading="lazy" alt="Bar Image 1" class="marquee-logo"/>
                                </div>
                                <div class="marquee-item">
                                    <img src="/assets/media/bar/image2.jpeg" loading="lazy" alt="Bar Image 2" class="marquee-logo"/>
                                </div>
                                <div class="marquee-item">
                                    <img src="/assets/media/bar/image3.jpeg" loading="lazy" alt="Bar Image 3" class="marquee-logo"/>
                                </div>
                                <div class="marquee-item">
                                    <img src="/assets/media/bar/image4.jpeg" loading="lazy" alt="Bar Image 4" class="marquee-logo"/>
                                </div>
                                <div class="marquee-item">
                                    <img src="/assets/media/bar/image5.jpeg" loading="lazy" alt="Bar Image 5" class="marquee-logo"/>
                                </div>
                                <div class="marquee-item">
                                    <img src="/assets/media/bar/image6.jpeg" loading="lazy" alt="Bar Image 6" class="marquee-logo"/>
                                </div>
                                <div class="marquee-item">
                                    <img src="/assets/media/bar/image7.jpeg" loading="lazy" alt="Bar Image 7" class="marquee-logo"/>
                                </div>
                                <div class="marquee-item">
                                    <img src="/assets/media/bar/image8.jpeg" loading="lazy" alt="Bar Image 8" class="marquee-logo"/>
                                </div>
                                <div class="marquee-item">
                                    <img src="/assets/media/bar/image9.jpeg" loading="lazy" alt="Bar Image 9" class="marquee-logo"/>
                                </div>
                                <div class="marquee-item">
                                    <img src="/assets/media/bar/image10.jpeg" loading="lazy" alt="Bar Image 10" class="marquee-logo"/>
                                </div>
                                <div class="marquee-item">
                                    <img src="/assets/media/bar/image11.jpeg" loading="lazy" alt="Bar Image 11" class="marquee-logo"/>
                                </div>
                                <div class="marquee-item">
                                    <img src="/assets/media/bar/image12.jpeg" loading="lazy" alt="Bar Image 12" class="marquee-logo"/>
                                </div>
                                <!-- Duplicate the images for seamless marquee effect -->
                                <div class="marquee-item">
                                    <img src="/assets/media/bar/image1.jpeg" loading="lazy" alt="Bar Image 1" class="marquee-logo"/>
                                </div>
                                <div class="marquee-item">
                                    <img src="/assets/media/bar/image2.jpeg" loading="lazy" alt="Bar Image 2" class="marquee-logo"/>
                                </div>
                                <div class="marquee-item">
                                    <img src="/assets/media/bar/image3.jpeg" loading="lazy" alt="Bar Image 3" class="marquee-logo"/>
                                </div>
                                <div class="marquee-item">
                                    <img src="/assets/media/bar/image4.jpeg" loading="lazy" alt="Bar Image 4" class="marquee-logo"/>
                                </div>
                                <div class="marquee-item">
                                    <img src="/assets/media/bar/image5.jpeg" loading="lazy" alt="Bar Image 5" class="marquee-logo"/>
                                </div>
                                <div class="marquee-item">
                                    <img src="/assets/media/bar/image6.jpeg" loading="lazy" alt="Bar Image 6" class="marquee-logo"/>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div id="packages" class="service-card-section">
                        <div data-w-id="3fe64741-6e89-67e2-04ed-97241c609e0f" class="service-cards-wrap">
                            <a data-w-id="3fe64741-6e89-67e2-04ed-97241c609e10" href="{{ route('services') }}" class="service-card is-1 w-inline-block">
                                <div class="card-header-wrap width-465">
                                    <div class="header-block">
                                        <div class="div-hide">
                                            <h3 class="heading-text-large">{{ __('home.packages.small_company.title') }}</h3>
                                        </div>
                                    </div>
                                    <div class="sub-header-wrap top-margine-meidum">
                                        <p class="body-text-medium">{{ __('home.packages.small_company.subtitle') }}</p>
                                    </div>
                                    <div class="sub-header-wrap top-margine-meidum">
                                        <p class="body-text-medium"><strong>{{ __('home.packages.small_company.basic_package') }}:</strong> {{ __('home.packages.small_company.basic_price') }} {{ __('common.currency') }}</p>
                                        <p class="body-text-medium"><strong>{{ __('home.packages.small_company.advanced_package') }}:</strong> {{ __('home.packages.small_company.advanced_price') }} {{ __('common.currency') }}</p>
                                        <p class="body-text-medium"><strong>{{ __('home.packages.small_company.comprehensive_package') }}:</strong> {{ __('home.packages.small_company.comprehensive_price') }} {{ __('common.currency') }}</p>
                                    </div>
                                </div>
                                <div class="service-card-bottom-content">
                                    <div class="service-card-link-wrap">
                                        <div class="button-link no-underline">
                                            <div class="link-text">{{ __('common.show_more') }}</div>
                                            <div class="link-button-liner"></div>
                                        </div>
                                    </div>
                                    <div class="service-card-button">
                                        <div class="div-hide">
                                            <img src="/assets/media/images/66fbecf34525bb47677cb157_arrow.svg" loading="lazy" alt="right wing arrow" class="arrow-icon"/>
                                            <img src="/assets/media/images/670e3f11a92efe0818fac2bf_Orange_20Arrow.svg" loading="lazy" alt="Orange Arrow" class="arrow-icon-ab"/>
                                        </div>
                                    </div>
                                </div>
                            </a>
                            <a data-w-id="3fe64741-6e89-67e2-04ed-97241c609e1f" href="{{ route('services') }}" class="service-card is-2 w-inline-block">
                                <div class="card-header-wrap width-465">
                                    <div class="header-block">
                                        <div class="div-hide">
                                            <h3 class="heading-text-large">{{ __('home.packages.medium_company.title') }}</h3>
                                        </div>
                                    </div>
                                    <div class="sub-header-wrap top-margine-meidum">
                                        <p class="body-text-medium">{{ __('home.packages.medium_company.subtitle') }}</p>
                                    </div>
                                    <div class="sub-header-wrap top-margine-meidum">
                                        <p class="body-text-medium"><strong>{{ __('home.packages.medium_company.basic_package') }}:</strong> {{ __('home.packages.medium_company.basic_price') }} {{ __('common.currency') }}</p>
                                        <p class="body-text-medium"><strong>{{ __('home.packages.medium_company.advanced_package') }}:</strong> {{ __('home.packages.medium_company.advanced_price') }} {{ __('common.currency') }}</p>
                                        <p class="body-text-medium"><strong>{{ __('home.packages.medium_company.comprehensive_package') }}:</strong> {{ __('home.packages.medium_company.comprehensive_price') }} {{ __('common.currency') }}</p>
                                    </div>
                                </div>
                                <div class="service-card-bottom-content">
                                    <div class="service-card-link-wrap">
                                        <div class="button-link no-underline">
                                            <div class="link-text">{{ __('common.show_more') }}</div>
                                            <div class="link-button-liner"></div>
                                        </div>
                                    </div>
                                    <div class="service-card-button">
                                        <div class="div-hide">
                                            <img src="/assets/media/images/66fbecf34525bb47677cb157_arrow.svg" loading="lazy" alt="right wing arrow" class="arrow-icon"/>
                                            <img src="/assets/media/images/670e3f0026a4d429b1c41f2f_Blue_20Arrow.svg" loading="lazy" alt="Cyan Arrow" class="arrow-icon-ab"/>
                                        </div>
                                    </div>
                                </div>
                            </a>
                            <a id="w-node-_3fe64741-6e89-67e2-04ed-97241c609e2e-1c609e0f" data-w-id="3fe64741-6e89-67e2-04ed-97241c609e2e" href="{{ route('services') }}" class="service-card is-3 w-inline-block">
                                <div class="card-header-wrap width-465">
                                    <div class="header-block">
                                        <div class="div-hide">
                                            <h3 class="heading-text-large">{{ __('home.packages.large_company.title') }}</h3>
                                        </div>
                                    </div>
                                    <div class="sub-header-wrap top-margine-meidum">
                                        <p class="body-text-medium">{{ __('home.packages.large_company.subtitle') }}</p>
                                    </div>
                                    <div class="sub-header-wrap top-margine-meidum">
                                        <p class="body-text-medium">{{ __('home.packages.large_company.contact_description') }}</p>
                                        <p class="body-text-medium"><strong>{{ __('home.packages.large_company.phone_label') }}:</strong> {{ __('home.packages.large_company.phone_number') }}</p>
                                        <p class="body-text-medium"><strong>{{ __('home.packages.large_company.email_label') }}:</strong> {{ __('home.packages.large_company.email_address') }}</p>
                                    </div>
                                </div>
                                <div class="service-card-bottom-content">
                                    <div class="service-card-link-wrap">
                                        <div class="button-link no-underline">
                                            <div class="link-text">{{ __('common.show_more') }}</div>
                                            <div class="link-button-liner"></div>
                                        </div>
                                    </div>
                                    <div class="service-card-button">
                                        <div class="div-hide">
                                            <img src="/assets/media/images/66fbecf34525bb47677cb157_arrow.svg" loading="lazy" alt="right wing arrow" class="arrow-icon"/>
                                            <img src="/assets/media/images/670e3f11a92efe0818fac2bf_Orange_20Arrow.svg" loading="lazy" alt="Orange Arrow" class="arrow-icon-ab"/>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </div>
                    </div>
                    <div id="services" data-w-id="a4c21207-3c39-03e4-51dc-128ef1846620" style="-webkit-transform:translate3d(0, 10%, 0) scale3d(1, 1, 1) rotateX(0) rotateY(0) rotateZ(0) skew(0, 0);-moz-transform:translate3d(0, 10%, 0) scale3d(1, 1, 1) rotateX(0) rotateY(0) rotateZ(0) skew(0, 0);-ms-transform:translate3d(0, 10%, 0) scale3d(1, 1, 1) rotateX(0) rotateY(0) rotateZ(0) skew(0, 0);transform:translate3d(0, 10%, 0) scale3d(1, 1, 1) rotateX(0) rotateY(0) rotateZ(0) skew(0, 0)" class="about-us-v2 section-padding-medium">
                        <div class="main-container">
                            <div class="about-v2-content-wrap">
                                <div class="section-header-wrap center">
                                    <div class="section-header-block center header-width-large">
                                        <div class="section-name-tag-block more-space">
                                            <div class="section-tag-text">{{ __('home.services.badge') }}</div>
                                        </div>
                                        <div class="header-block">
                                            <div class="div-hide">
                                                <h2 class="mid-title">{{ __('home.services.title') }}</h2>
                                            </div>
                                        </div>
                                        <div class="sub-header-wrap top-margine-meidum">
                                            <div class="body-text-medium">{{ __('home.services.description') }}</div>
                                        </div>
                                        <div class="buttons-wrap top-margine-32">
                                            <a data-w-id="0d2ca965-9550-4d98-c3bb-8adfdd5e756d" href="{{ route('services') }}" class="secondary-button w-inline-block">
                                                <div style="-webkit-transform:translate3d(100%, 0, 0) scale3d(0, 0, 1) rotateX(0) rotateY(0) rotateZ(0) skew(0, 0);-moz-transform:translate3d(100%, 0, 0) scale3d(0, 0, 1) rotateX(0) rotateY(0) rotateZ(0) skew(0, 0);-ms-transform:translate3d(100%, 0, 0) scale3d(0, 0, 1) rotateX(0) rotateY(0) rotateZ(0) skew(0, 0);transform:translate3d(100%, 0, 0) scale3d(0, 0, 1) rotateX(0) rotateY(0) rotateZ(0) skew(0, 0);background-color:rgb(102,205,204)" class="secondary-button-arrow-wrap left">
                                                    <div class="div-hide">
                                                        <img src="/assets/media/images/66fbecf34525bb47677cb157_arrow.svg" loading="lazy" alt="right wing arrow" class="arrow-icon"/>
                                                        <img src="/assets/media/images/670679847af3f88df02e599d_Arrow_20Whit.svg" loading="lazy" alt="right wing arrow" class="arrow-icon-ab"/>
                                                    </div>
                                                </div>
                                                <div style="background-color:rgb(102,205,204)" class="secondary-button-content">
                                                    <div class="button-text">{{ __('services.hero.button') }}</div>
                                                </div>
                                                <div style="-webkit-transform:translate3d(0%, 0, 0) scale3d(1, 1, 1) rotateX(0) rotateY(0) rotateZ(0) skew(0, 0);-moz-transform:translate3d(0%, 0, 0) scale3d(1, 1, 1) rotateX(0) rotateY(0) rotateZ(0) skew(0, 0);-ms-transform:translate3d(0%, 0, 0) scale3d(1, 1, 1) rotateX(0) rotateY(0) rotateZ(0) skew(0, 0);transform:translate3d(0%, 0, 0) scale3d(1, 1, 1) rotateX(0) rotateY(0) rotateZ(0) skew(0, 0)" class="secondary-button-arrow-wrap right">
                                                    <div class="div-hide">
                                                        <img src="/assets/media/images/66fbecf34525bb47677cb157_arrow.svg" loading="lazy" alt="right wing arrow" class="arrow-icon"/>
                                                        <img src="/assets/media/images/670679847af3f88df02e599d_Arrow_20Whit.svg" loading="lazy" alt="right wing arrow" class="arrow-icon-ab"/>
                                                    </div>
                                                </div>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                                <div class="about-v2-grid">
                                    <div data-w-id="6e3e4522-003b-081f-ca93-eaea6ca689f1" class="about-us-image-card-box">
                                        <svg xmlns="http://www.w3.org/2000/svg" viewbox="0 0 608 265" fill="none" class="about-v2-card-bg-image">
                                            <path opacity="0.15" d="M55.8585 29.5741L39.5422 43.4409C23.9542 56.6887 0 45.6102 0 25.1532V-135C0 -148.255 10.7452 -159 24 -159H945.112C960.772 -159 972.237 -144.244 968.368 -129.07L867.501 266.483C866.618 269.942 864.976 273.161 862.692 275.905L783.855 370.635C767.256 390.58 735.21 373.652 742.329 348.699L819.753 77.2895C827.374 50.5747 791.088 34.4215 776.337 57.9625L621.839 304.528C607.02 328.179 570.581 311.757 578.484 284.989L658.286 14.6766C665.585 -10.0442 634.093 -27.3183 617.168 -7.87827L374.656 270.667C355.91 292.199 321.963 268.85 335.364 243.642L416.352 91.2961C429.255 67.0242 397.846 43.638 378.292 62.9584L169.846 268.92C149.833 288.694 117.991 263.828 132.327 239.619L199.915 125.48C214.322 101.151 182.145 76.2765 162.229 96.346L95.8556 163.23C76.9425 182.288 45.7769 160.645 57.0293 136.267L93.1916 57.9197C103.968 34.5726 75.4524 12.9219 55.8585 29.5741Z" stroke="#fff6ed" stroke-width="15" class="svg-path"></path>
                                        </svg>
                                        <img src="/assets/media/images/6890a23106deff26baa4d66a_Doctors_20Image_20_2__20_1_.jpeg" loading="lazy" width="639" style="-webkit-transform:translate3d(0, 0, 0) scale3d(1.3, 1.3, 1) rotateX(0) rotateY(0) rotateZ(0) skew(0, 0);-moz-transform:translate3d(0, 0, 0) scale3d(1.3, 1.3, 1) rotateX(0) rotateY(0) rotateZ(0) skew(0, 0);-ms-transform:translate3d(0, 0, 0) scale3d(1.3, 1.3, 1) rotateX(0) rotateY(0) rotateZ(0) skew(0, 0);transform:translate3d(0, 0, 0) scale3d(1.3, 1.3, 1) rotateX(0) rotateY(0) rotateZ(0) skew(0, 0)" alt="Doctors Image " srcset="/assets/media/images/6890a23106deff26baa4d66a_Doctors_20Image_20_2__20_1_-p-500.jpeg 500w, /assets/media/images/6890a23106deff26baa4d66a_Doctors_20Image_20_2__20_1_-p-800.jpeg 800w, /assets/media/images/6890a23106deff26baa4d66a_Doctors_20Image_20_2__20_1_-p-1080.jpeg 1080w, /assets/media/images/6890a23106deff26baa4d66a_Doctors_20Image_20_2__20_1_.jpeg 1536w" sizes="(max-width: 767px) 100vw, 639px" class="about-us-v2-image"/>
                                    </div>
                                    <div data-w-id="9279b5a9-f191-e482-8c06-a441a2ea0897" class="experience-card-box-wrap">
                                        <div class="stats-card is-1">
                                            <div class="statistic-wrap">
                                                <div class="stats-counter">
                                                    <div class="counter">
                                                        <div style="-webkit-transform:translate3d(0, -400%, 0) scale3d(1, 1, 1) rotateX(0) rotateY(0) rotateZ(0) skew(0, 0);-moz-transform:translate3d(0, -400%, 0) scale3d(1, 1, 1) rotateX(0) rotateY(0) rotateZ(0) skew(0, 0);-ms-transform:translate3d(0, -400%, 0) scale3d(1, 1, 1) rotateX(0) rotateY(0) rotateZ(0) skew(0, 0);transform:translate3d(0, -400%, 0) scale3d(1, 1, 1) rotateX(0) rotateY(0) rotateZ(0) skew(0, 0)" class="counter-train upper">
                                                            <h2 class="large-title">5</h2>
                                                            <h2 class="large-title">6</h2>
                                                            <h2 class="large-title">7</h2>
                                                            <h2 class="large-title">4</h2>
                                                            <h2 class="large-title">9</h2>
                                                            <h2 class="large-title">5</h2>
                                                        </div>
                                                        <div style="-webkit-transform:translate3d(0, 400%, 0) scale3d(1, 1, 1) rotateX(0) rotateY(0) rotateZ(0) skew(0, 0);-moz-transform:translate3d(0, 400%, 0) scale3d(1, 1, 1) rotateX(0) rotateY(0) rotateZ(0) skew(0, 0);-ms-transform:translate3d(0, 400%, 0) scale3d(1, 1, 1) rotateX(0) rotateY(0) rotateZ(0) skew(0, 0);transform:translate3d(0, 400%, 0) scale3d(1, 1, 1) rotateX(0) rotateY(0) rotateZ(0) skew(0, 0)" class="counter-train lower">
                                                            <h2 class="large-title">0</h2>
                                                            <h2 class="large-title">2</h2>
                                                            <h2 class="large-title">2</h2>
                                                            <h2 class="large-title">8</h2>
                                                            <h2 class="large-title">4</h2>
                                                            <h2 class="large-title">0</h2>
                                                        </div>
                                                        <div style="-webkit-transform:translate3d(0, -400%, 0) scale3d(1, 1, 1) rotateX(0) rotateY(0) rotateZ(0) skew(0, 0);-moz-transform:translate3d(0, -400%, 0) scale3d(1, 1, 1) rotateX(0) rotateY(0) rotateZ(0) skew(0, 0);-ms-transform:translate3d(0, -400%, 0) scale3d(1, 1, 1) rotateX(0) rotateY(0) rotateZ(0) skew(0, 0);transform:translate3d(0, -400%, 0) scale3d(1, 1, 1) rotateX(0) rotateY(0) rotateZ(0) skew(0, 0)" class="counter-train upper">
                                                            <h2 class="large-title">0</h2>
                                                            <h2 class="large-title">1</h2>
                                                            <h2 class="large-title">6</h2>
                                                            <h2 class="large-title">3</h2>
                                                            <h2 class="large-title">8</h2>
                                                            <h2 class="large-title">5</h2>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="stats-plus-wrap">
                                                    <h2 class="large-title">+</h2>
                                                </div>
                                            </div>
                                            <div class="statistic-text-wrap">
                                                <div class="body-text-medium opacity-100">{{ __('home.hero.stats.clients') }}</div>
                                            </div>
                                        </div>
                                        <div class="stats-card is-2">
                                            <div class="statistic-wrap">
                                                <div class="stats-counter">
                                                    <div class="counter">
                                                        <div style="-webkit-transform:translate3d(0, -400%, 0) scale3d(1, 1, 1) rotateX(0) rotateY(0) rotateZ(0) skew(0, 0);-moz-transform:translate3d(0, -400%, 0) scale3d(1, 1, 1) rotateX(0) rotateY(0) rotateZ(0) skew(0, 0);-ms-transform:translate3d(0, -400%, 0) scale3d(1, 1, 1) rotateX(0) rotateY(0) rotateZ(0) skew(0, 0);transform:translate3d(0, -400%, 0) scale3d(1, 1, 1) rotateX(0) rotateY(0) rotateZ(0) skew(0, 0)" class="counter-train upper">
                                                            <h2 class="large-title c-white">1</h2>
                                                            <h2 class="large-title c-white">6</h2>
                                                            <h2 class="large-title c-white">7</h2>
                                                            <h2 class="large-title c-white">4</h2>
                                                            <h2 class="large-title c-white">9</h2>
                                                            <h2 class="large-title c-white">5</h2>
                                                        </div>
                                                        <div style="-webkit-transform:translate3d(0, 400%, 0) scale3d(1, 1, 1) rotateX(0) rotateY(0) rotateZ(0) skew(0, 0);-moz-transform:translate3d(0, 400%, 0) scale3d(1, 1, 1) rotateX(0) rotateY(0) rotateZ(0) skew(0, 0);-ms-transform:translate3d(0, 400%, 0) scale3d(1, 1, 1) rotateX(0) rotateY(0) rotateZ(0) skew(0, 0);transform:translate3d(0, 400%, 0) scale3d(1, 1, 1) rotateX(0) rotateY(0) rotateZ(0) skew(0, 0)" class="counter-train lower">
                                                            <h2 class="large-title c-white">0</h2>
                                                            <h2 class="large-title c-white">2</h2>
                                                            <h2 class="large-title c-white">2</h2>
                                                            <h2 class="large-title c-white">8</h2>
                                                            <h2 class="large-title c-white">4</h2>
                                                            <h2 class="large-title c-white">0</h2>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="stats-plus-wrap">
                                                    <h2 class="large-title c-white">+</h2>
                                                </div>
                                            </div>
                                            <div class="statistic-text-wrap">
                                                <div class="body-text-medium color-white">{{ __('home.hero.stats.experience') }}</div>
                                            </div>
                                        </div>
                                        <div class="stats-card is-3">
                                            <div class="statistic-wrap">
                                                <div class="stats-counter">
                                                    <div class="counter">
                                                        <div style="-webkit-transform:translate3d(0, -400%, 0) scale3d(1, 1, 1) rotateX(0) rotateY(0) rotateZ(0) skew(0, 0);-moz-transform:translate3d(0, -400%, 0) scale3d(1, 1, 1) rotateX(0) rotateY(0) rotateZ(0) skew(0, 0);-ms-transform:translate3d(0, -400%, 0) scale3d(1, 1, 1) rotateX(0) rotateY(0) rotateZ(0) skew(0, 0);transform:translate3d(0, -400%, 0) scale3d(1, 1, 1) rotateX(0) rotateY(0) rotateZ(0) skew(0, 0)" class="counter-train upper">
                                                            <h2 class="large-title c-white">2</h2>
                                                            <h2 class="large-title c-white">6</h2>
                                                            <h2 class="large-title c-white">7</h2>
                                                            <h2 class="large-title c-white">4</h2>
                                                            <h2 class="large-title c-white">9</h2>
                                                            <h2 class="large-title c-white">5</h2>
                                                        </div>
                                                        <div style="-webkit-transform:translate3d(0, 400%, 0) scale3d(1, 1, 1) rotateX(0) rotateY(0) rotateZ(0) skew(0, 0);-moz-transform:translate3d(0, 400%, 0) scale3d(1, 1, 1) rotateX(0) rotateY(0) rotateZ(0) skew(0, 0);-ms-transform:translate3d(0, 400%, 0) scale3d(1, 1, 1) rotateX(0) rotateY(0) rotateZ(0) skew(0, 0);transform:translate3d(0, 400%, 0) scale3d(1, 1, 1) rotateX(0) rotateY(0) rotateZ(0) skew(0, 0)" class="counter-train lower">
                                                            <h2 class="large-title c-white">4</h2>
                                                            <h2 class="large-title c-white">2</h2>
                                                            <h2 class="large-title c-white">2</h2>
                                                            <h2 class="large-title c-white">8</h2>
                                                            <h2 class="large-title c-white">4</h2>
                                                            <h2 class="large-title c-white">0</h2>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="stats-plus-wrap">
                                                    <h2 class="large-title c-white">+</h2>
                                                </div>
                                            </div>
                                            <div class="statistic-text-wrap">
                                                <div class="body-text-medium color-white">{{ __('home.hero.stats.support') }}</div>
                                            </div>
                                        </div>
                                        <div class="stats-card is-4">
                                            <div class="statistic-wrap">
                                                <div class="stats-counter">
                                                    <div class="counter">
                                                        <div style="-webkit-transform:translate3d(0, -400%, 0) scale3d(1, 1, 1) rotateX(0) rotateY(0) rotateZ(0) skew(0, 0);-moz-transform:translate3d(0, -400%, 0) scale3d(1, 1, 1) rotateX(0) rotateY(0) rotateZ(0) skew(0, 0);-ms-transform:translate3d(0, -400%, 0) scale3d(1, 1, 1) rotateX(0) rotateY(0) rotateZ(0) skew(0, 0);transform:translate3d(0, -400%, 0) scale3d(1, 1, 1) rotateX(0) rotateY(0) rotateZ(0) skew(0, 0)" class="counter-train upper">
                                                            <h2 class="large-title">9</h2>
                                                            <h2 class="large-title">2</h2>
                                                            <h2 class="large-title">2</h2>
                                                            <h2 class="large-title">8</h2>
                                                            <h2 class="large-title">4</h2>
                                                            <h2 class="large-title">0</h2>
                                                        </div>
                                                        
                                                        <div style="-webkit-transform:translate3d(0, 400%, 0) scale3d(1, 1, 1) rotateX(0) rotateY(0) rotateZ(0) skew(0, 0);-moz-transform:translate3d(0, 400%, 0) scale3d(1, 1, 1) rotateX(0) rotateY(0) rotateZ(0) skew(0, 0);-ms-transform:translate3d(0, 400%, 0) scale3d(1, 1, 1) rotateX(0) rotateY(0) rotateZ(0) skew(0, 0);transform:translate3d(0, 400%, 0) scale3d(1, 1, 1) rotateX(0) rotateY(0) rotateZ(0) skew(0, 0)" class="counter-train lower">
                                                            <h2 class="large-title">9</h2>
                                                            <h2 class="large-title">1</h2>
                                                            <h2 class="large-title">6</h2>
                                                            <h2 class="large-title">3</h2>
                                                            <h2 class="large-title">8</h2>
                                                            <h2 class="large-title">9</h2>
                                                        </div>
                                                        <div class="stats-point-wrap">
                                                            <h2 class="large-title">%</h2>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="body-text-medium opacity-100">{{ __('home.hero.stats.satisfaction') }}</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div id="features" data-w-id="50a8937b-0245-80c2-ab7a-e9ce38951ca4" style="-webkit-transform:translate3d(0, 10%, 0) scale3d(1, 1, 1) rotateX(0) rotateY(0) rotateZ(0) skew(0, 0);-moz-transform:translate3d(0, 10%, 0) scale3d(1, 1, 1) rotateX(0) rotateY(0) rotateZ(0) skew(0, 0);-ms-transform:translate3d(0, 10%, 0) scale3d(1, 1, 1) rotateX(0) rotateY(0) rotateZ(0) skew(0, 0);transform:translate3d(0, 10%, 0) scale3d(1, 1, 1) rotateX(0) rotateY(0) rotateZ(0) skew(0, 0)" class="features-section section-padding-extra-large">
                        <div class="main-container">
                            <div class="feature-content-block">
                                <div class="feature-header-content">
                                    <div class="section-header-wrap">
                                        <div class="section-header-block">
                                            <div class="header-block">
                                                <div class="div-hide">
                                                    <h2 class="mid-title color-white">{{ __('home.features.title') }}</h2>
                                                </div>
                                            </div>
                                            <div class="sub-header-wrap top-margin-large">
                                                <div class="body-text-medium color-white">{{ __('home.features.description') }}</div>
                                            </div>
                                            <div class="buttons-wrap top-margine-32">
                                                <a data-w-id="6a1881c3-8466-f090-31b5-25e0136b6c00" href="#contact" class="secondary-button w-inline-block">
                                                    <div style="-webkit-transform:translate3d(100%, 0, 0) scale3d(0, 0, 1) rotateX(0) rotateY(0) rotateZ(0) skew(0, 0);-moz-transform:translate3d(100%, 0, 0) scale3d(0, 0, 1) rotateX(0) rotateY(0) rotateZ(0) skew(0, 0);-ms-transform:translate3d(100%, 0, 0) scale3d(0, 0, 1) rotateX(0) rotateY(0) rotateZ(0) skew(0, 0);transform:translate3d(100%, 0, 0) scale3d(0, 0, 1) rotateX(0) rotateY(0) rotateZ(0) skew(0, 0);background-color:rgb(102,205,204)" class="secondary-button-arrow-wrap left">
                                                        <div class="div-hide">
                                                            <img src="/assets/media/images/66fbecf34525bb47677cb157_arrow.svg" loading="lazy" alt="right wing arrow" class="arrow-icon"/>
                                                            <img src="/assets/media/images/670679847af3f88df02e599d_Arrow_20Whit.svg" loading="lazy" alt="right wing arrow" class="arrow-icon-ab"/>
                                                        </div>
                                                    </div>
                                                    <div style="background-color:rgb(102,205,204)" class="secondary-button-content">
                                                        <div class="button-text">{{ __('home.contact.contact_now') }}</div>
                                                    </div>
                                                    <div style="-webkit-transform:translate3d(0%, 0, 0) scale3d(1, 1, 1) rotateX(0) rotateY(0) rotateZ(0) skew(0, 0);-moz-transform:translate3d(0%, 0, 0) scale3d(1, 1, 1) rotateX(0) rotateY(0) rotateZ(0) skew(0, 0);-ms-transform:translate3d(0%, 0, 0) scale3d(1, 1, 1) rotateX(0) rotateY(0) rotateZ(0) skew(0, 0);transform:translate3d(0%, 0, 0) scale3d(1, 1, 1) rotateX(0) rotateY(0) rotateZ(0) skew(0, 0)" class="secondary-button-arrow-wrap right">
                                                        <div class="div-hide">
                                                            <img src="/assets/media/images/66fbecf34525bb47677cb157_arrow.svg" loading="lazy" alt="right wing arrow" class="arrow-icon"/>
                                                            <img src="/assets/media/images/670679847af3f88df02e599d_Arrow_20Whit.svg" loading="lazy" alt="right wing arrow" class="arrow-icon-ab"/>
                                                        </div>
                                                    </div>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="feature-card-wrap">
                                    <div data-w-id="e4334e0c-de37-0111-615a-721aae98ec14" class="feature-card is-1">
                                        <div class="feature-card-content-wrap">
                                            <div class="feature-card-icon-wrap is-1">
                                                <img src="/assets/media/images/66fbf0c9e306d8897986f342_user-group.svg" loading="lazy" alt="User Group Icon" class="icon"/>
                                            </div>
                                            <div class="feature-card-text-wrap">
                                                <div class="header-block">
                                                    <div class="card-header caps c-black">{{ __('home.features.peace_of_mind.title') }}</div>
                                                </div>
                                                <div class="sub-header-wrap top-margine-meidum summery-small">
                                                    <div class="body-text-medium">{{ __('home.features.peace_of_mind.description') }}</div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="feature-card is-2">
                                        <div class="feature-card-content-wrap">
                                            <div class="feature-card-icon-wrap is-2">
                                                <img src="/assets/media/images/66fbf0c93518093890bd3c1b_HealthCare.svg" loading="lazy" alt="Healthcare Icon" class="icon"/>
                                            </div>
                                            <div class="feature-card-text-wrap">
                                                <div class="header-block">
                                                    <div class="card-header caps c-black">{{ __('home.features.fast_execution.title') }}</div>
                                                </div>
                                                <div class="sub-header-wrap top-margine-meidum summery-small">
                                                    <div class="body-text-medium">{{ __('home.features.fast_execution.description') }}</div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="feature-card is-3">
                                        <div class="feature-card-content-wrap">
                                            <div class="feature-card-icon-wrap is-3">
                                                <img src="/assets/media/images/66fbf0c980f6fe3814239dfa_Cube.svg" loading="lazy" alt="Cube Icon" class="icon"/>
                                            </div>
                                            <div class="feature-card-text-wrap">
                                                <div class="header-block">
                                                    <div class="card-header caps c-black">{{ __('home.features.cost_savings.title') }}</div>
                                                </div>
                                                <div class="sub-header-wrap top-margine-meidum summery-small">
                                                    <div class="body-text-medium">{{ __('home.features.cost_savings.description') }}</div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="feature-card is-4">
                                        <div class="feature-card-content-wrap">
                                            <div class="feature-card-icon-wrap is-4">
                                                <img src="/assets/media/images/66fbf0c9995bcc84f384ee3b_Right_20Double.svg" loading="lazy" alt="Checkmark Icon" class="icon"/>
                                            </div>
                                            <div class="feature-card-text-wrap">
                                                <div class="header-block">
                                                    <div class="card-header caps c-black">{{ __('home.features.proactive_follow_up.title') }}</div>
                                                </div>
                                                <div class="sub-header-wrap top-margine-meidum summery-small">
                                                    <div class="body-text-medium">{{ __('home.features.proactive_follow_up.description') }}</div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div style="display:none;" data-w-id="223ddfcf-ed68-054b-4794-ac524587ef44" class="our-specialist-doctors-section-v2 section-padding-large">
                        <div class="main-container">
                            <div class="our-specialist-section-content-wrap-v2">
                                <div class="our-specialist-section-header-v2">
                                    <div class="section-header-wrap">
                                        <div class="header-block width-medium">
                                            <div class="div-hide">
                                                <h2 class="mid-title">{{ __('home.features.cta.title') }}</h2>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="specialist-sub-head-and-button-wrap">
                                        <div class="sub-header-wrap">
                                            <div class="body-text-medium">{{ __('home.features.cta.description') }}</div>
                                        </div>
                                        <a data-w-id="27e51bab-4d7e-2355-645a-e56595785639" href="#contact" class="secondary-button w-inline-block">
                                            <div style="-webkit-transform:translate3d(100%, 0, 0) scale3d(0, 0, 1) rotateX(0) rotateY(0) rotateZ(0) skew(0, 0);-moz-transform:translate3d(100%, 0, 0) scale3d(0, 0, 1) rotateX(0) rotateY(0) rotateZ(0) skew(0, 0);-ms-transform:translate3d(100%, 0, 0) scale3d(0, 0, 1) rotateX(0) rotateY(0) rotateZ(0) skew(0, 0);transform:translate3d(100%, 0, 0) scale3d(0, 0, 1) rotateX(0) rotateY(0) rotateZ(0) skew(0, 0);background-color:rgb(102,205,204)" class="secondary-button-arrow-wrap left">
                                                <div class="div-hide">
                                                    <img src="/assets/media/images/66fbecf34525bb47677cb157_arrow.svg" loading="lazy" alt="right wing arrow" class="arrow-icon"/>
                                                    <img src="/assets/media/images/670679847af3f88df02e599d_Arrow_20Whit.svg" loading="lazy" alt="right wing arrow" class="arrow-icon-ab"/>
                                                </div>
                                            </div>
                                            <div style="background-color:rgb(102,205,204)" class="secondary-button-content">
                                                <div class="button-text">{{ __('home.contact.contact_now') }}</div>
                                            </div>
                                            <div style="-webkit-transform:translate3d(0%, 0, 0) scale3d(1, 1, 1) rotateX(0) rotateY(0) rotateZ(0) skew(0, 0);-moz-transform:translate3d(0%, 0, 0) scale3d(1, 1, 1) rotateX(0) rotateY(0) rotateZ(0) skew(0, 0);-ms-transform:translate3d(0%, 0, 0) scale3d(1, 1, 1) rotateX(0) rotateY(0) rotateZ(0) skew(0, 0);transform:translate3d(0%, 0, 0) scale3d(1, 1, 1) rotateX(0) rotateY(0) rotateZ(0) skew(0, 0)" class="secondary-button-arrow-wrap right">
                                                <div class="div-hide">
                                                    <img src="/assets/media/images/66fbecf34525bb47677cb157_arrow.svg" loading="lazy" alt="right wing arrow" class="arrow-icon"/>
                                                    <img src="/assets/media/images/670679847af3f88df02e599d_Arrow_20Whit.svg" loading="lazy" alt="right wing arrow" class="arrow-icon-ab"/>
                                                </div>
                                            </div>
                                        </a>
                                    </div>
                                </div>
                                <!-- <div class="our-specialiest-doctor-v2-cms-wrap">
                                    <div class="doctor-collection-list-wrap w-dyn-list">
                                        <div role="list" class="doctor-cms-list w-dyn-items">
                                            <div role="listitem" class="doctor-card-cms-item-v2 w-dyn-item">
                                                <div data-w-id="fcccbe69-ed75-6d73-3999-48b91fb83edf" class="doctors-card large">
                                                    <div class="doctors-card-content-wrap">
                                                        <a href="/doctors/dr-david-wilson" class="doctors-card-image-wrap w-inline-block">
                                                            <img src="/assets/media/images/68908f60bafc5197465e6260_Doctor_20Image_209.webp" loading="lazy" alt="" sizes="100vw" srcset="/assets/media/responsive/68908f60bafc5197465e6260_Doctor_20Image_209-p-500.webp 500w, /assets/media/responsive/68908f60bafc5197465e6260_Doctor_20Image_209-p-800.webp 800w, /assets/media/responsive/68908f60bafc5197465e6260_Doctor_20Image_209-p-1080.webp 1080w, /assets/media/images/68908f60bafc5197465e6260_Doctor_20Image_209.webp 1114w" class="doctors-card-image"/>
                                                        </a>
                                                        <div class="doctor-card-text-box">
                                                            <div class="doctor-info-wrap">
                                                                <div class="doctor-name-text-wrap">
                                                                    <h5 class="heading-text-small weight-semibold">Dr. David Wilson</h5>
                                                                </div>
                                                                <div class="doctor-profession-text-wrap">
                                                                    <div class="body-text-medium opacity-100">General Practitioner</div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="doctors-card-contact-slide">
                                                        <div class="doctors-social-media-button-wrap">
                                                            <a href="https://x.com" target="_blank" class="doctors-social-media-button w-inline-block">
                                                                <div aria-label="doctors-social-media-icon" class="doctors-social-media-icon w-embed">
                                                                    <svg xmlns="http://www.w3.org/2000/svg" width="" height="" viewBox="0 0 20 18" fill="none">
                                                                        <path d="M15.743 0H18.7952L12.1285 7.64L20 18H13.8153L8.99598 11.72L3.45382 18H0.401606L7.5502 9.84L0 0H6.34538L10.7229 5.76L15.743 0ZM14.6586 16.16H16.3454L5.42169 1.72H3.5743L14.6586 16.16Z" fill="currentColor"/>
                                                                    </svg>
                                                                </div>
                                                            </a>
                                                            <a href="https://facebook.com" target="_blank" class="doctors-social-media-button w-inline-block">
                                                                <div class="div-hide">
                                                                    <img src="/assets/media/images/67083b060468652a6e838a39_Facebook_20White.svg" loading="lazy" alt="facebook logo" class="social-media-icon-ab"/>
                                                                </div>
                                                                <div aria-label="doctors-social-media-icon" class="doctors-social-media-icon w-embed">
                                                                    <svg xmlns="http://www.w3.org/2000/svg" width="" height="" viewBox="0 0 11 21" fill="none">
                                                                        <path d="M10.2792 11.7233L10.8493 7.95146H7.28311V5.50376C7.28311 4.47185 7.78124 3.46602 9.37858 3.46602H11V0.254854C11 0.254854 9.52849 0 8.12167 0C5.18452 0 3.26484 1.80641 3.26484 5.0767V7.95146H0V11.7233H3.26484V20.8415C3.91949 20.9457 4.59047 21 5.27397 21C5.95748 21 6.62845 20.9457 7.28311 20.8415V11.7233H10.2792Z" fill="currentColor"/>
                                                                    </svg>
                                                                </div>
                                                            </a>
                                                            <a href="https://linkedin.com" target="_blank" class="doctors-social-media-button w-inline-block">
                                                                <div class="div-hide">
                                                                    <img src="/assets/media/images/67083b06c0ec449aa5cedab4_Linkdin_20White.png" loading="lazy" alt="linkedin log" class="social-media-icon-ab"/>
                                                                </div>
                                                                <div aria-label="doctors-social-media-icon" class="doctors-social-media-icon w-embed">
                                                                    <svg width="" height="" viewBox="0 0 19 17" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                                        <path d="M10.6393 10.4455V16.9999H6.98047V5.50731H10.4597V7.61728H10.5869C10.8413 6.91396 11.2752 6.36277 11.8888 5.96372C12.5023 5.55969 13.2331 5.35767 14.0811 5.35767C14.8891 5.35767 15.59 5.53973 16.1835 5.90386C16.7821 6.26301 17.246 6.76681 17.5752 7.41527C17.9094 8.05873 18.074 8.81194 18.0691 9.67488V16.9999H14.4103V10.3932C14.4153 9.75469 14.2531 9.25588 13.9239 8.89674C13.5997 8.53759 13.1483 8.35802 12.5697 8.35802C12.1856 8.35802 11.8464 8.44282 11.5521 8.61241C11.2628 8.77702 11.0383 9.01396 10.8787 9.32322C10.7241 9.63248 10.6442 10.0066 10.6393 10.4455Z" fill="currentColor"/>
                                                                        <path d="M0.994112 16.9999V5.50732H4.6529V16.9999H0.994112ZM2.82725 4.16801C2.31347 4.16801 1.87202 3.99841 1.5029 3.65922C1.13378 3.31504 0.949219 2.90102 0.949219 2.41718C0.949219 1.93832 1.13378 1.52929 1.5029 1.1901C1.87202 0.845918 2.31347 0.673828 2.82725 0.673828C3.34601 0.673828 3.78746 0.845918 4.15159 1.1901C4.52071 1.52929 4.70527 1.93832 4.70527 2.41718C4.70527 2.90102 4.52071 3.31504 4.15159 3.65922C3.78746 3.99841 3.34601 4.16801 2.82725 4.16801Z" fill="currentColor"/>
                                                                    </svg>
                                                                </div>
                                                            </a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div role="listitem" class="doctor-card-cms-item-v2 w-dyn-item">
                                                <div data-w-id="fcccbe69-ed75-6d73-3999-48b91fb83edf" class="doctors-card large">
                                                    <div class="doctors-card-content-wrap">
                                                        <a href="/doctors/dr-sarah-davis" class="doctors-card-image-wrap w-inline-block">
                                                            <img src="/assets/media/images/689094ff77aae2a0fd27ded7_Doctor_20Image_202.webp" loading="lazy" alt="" sizes="100vw" srcset="/assets/media/responsive/689094ff77aae2a0fd27ded7_Doctor_20Image_202-p-500.webp 500w, /assets/media/responsive/689094ff77aae2a0fd27ded7_Doctor_20Image_202-p-800.webp 800w, /assets/media/responsive/689094ff77aae2a0fd27ded7_Doctor_20Image_202-p-1080.webp 1080w, /assets/media/images/689094ff77aae2a0fd27ded7_Doctor_20Image_202.webp 1114w" class="doctors-card-image"/>
                                                        </a>
                                                        <div class="doctor-card-text-box">
                                                            <div class="doctor-info-wrap">
                                                                <div class="doctor-name-text-wrap">
                                                                    <h5 class="heading-text-small weight-semibold">Dr. Sergey</h5>
                                                                </div>
                                                                <div class="doctor-profession-text-wrap">
                                                                    <div class="body-text-medium opacity-100">Orthopedic Surgeon</div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="doctors-card-contact-slide">
                                                        <div class="doctors-social-media-button-wrap">
                                                            <a href="https://x.com" target="_blank" class="doctors-social-media-button w-inline-block">
                                                                <div aria-label="doctors-social-media-icon" class="doctors-social-media-icon w-embed">
                                                                    <svg xmlns="http://www.w3.org/2000/svg" width="" height="" viewBox="0 0 20 18" fill="none">
                                                                        <path d="M15.743 0H18.7952L12.1285 7.64L20 18H13.8153L8.99598 11.72L3.45382 18H0.401606L7.5502 9.84L0 0H6.34538L10.7229 5.76L15.743 0ZM14.6586 16.16H16.3454L5.42169 1.72H3.5743L14.6586 16.16Z" fill="currentColor"/>
                                                                    </svg>
                                                                </div>
                                                            </a>
                                                            <a href="https://facebook.com" target="_blank" class="doctors-social-media-button w-inline-block">
                                                                <div class="div-hide">
                                                                    <img src="/assets/media/images/67083b060468652a6e838a39_Facebook_20White.svg" loading="lazy" alt="facebook logo" class="social-media-icon-ab"/>
                                                                </div>
                                                                <div aria-label="doctors-social-media-icon" class="doctors-social-media-icon w-embed">
                                                                    <svg xmlns="http://www.w3.org/2000/svg" width="" height="" viewBox="0 0 11 21" fill="none">
                                                                        <path d="M10.2792 11.7233L10.8493 7.95146H7.28311V5.50376C7.28311 4.47185 7.78124 3.46602 9.37858 3.46602H11V0.254854C11 0.254854 9.52849 0 8.12167 0C5.18452 0 3.26484 1.80641 3.26484 5.0767V7.95146H0V11.7233H3.26484V20.8415C3.91949 20.9457 4.59047 21 5.27397 21C5.95748 21 6.62845 20.9457 7.28311 20.8415V11.7233H10.2792Z" fill="currentColor"/>
                                                                    </svg>
                                                                </div>
                                                            </a>
                                                            <a href="https://linkedin.com" target="_blank" class="doctors-social-media-button w-inline-block">
                                                                <div class="div-hide">
                                                                    <img src="/assets/media/images/67083b06c0ec449aa5cedab4_Linkdin_20White.png" loading="lazy" alt="linkedin log" class="social-media-icon-ab"/>
                                                                </div>
                                                                <div aria-label="doctors-social-media-icon" class="doctors-social-media-icon w-embed">
                                                                    <svg width="" height="" viewBox="0 0 19 17" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                                        <path d="M10.6393 10.4455V16.9999H6.98047V5.50731H10.4597V7.61728H10.5869C10.8413 6.91396 11.2752 6.36277 11.8888 5.96372C12.5023 5.55969 13.2331 5.35767 14.0811 5.35767C14.8891 5.35767 15.59 5.53973 16.1835 5.90386C16.7821 6.26301 17.246 6.76681 17.5752 7.41527C17.9094 8.05873 18.074 8.81194 18.0691 9.67488V16.9999H14.4103V10.3932C14.4153 9.75469 14.2531 9.25588 13.9239 8.89674C13.5997 8.53759 13.1483 8.35802 12.5697 8.35802C12.1856 8.35802 11.8464 8.44282 11.5521 8.61241C11.2628 8.77702 11.0383 9.01396 10.8787 9.32322C10.7241 9.63248 10.6442 10.0066 10.6393 10.4455Z" fill="currentColor"/>
                                                                        <path d="M0.994112 16.9999V5.50732H4.6529V16.9999H0.994112ZM2.82725 4.16801C2.31347 4.16801 1.87202 3.99841 1.5029 3.65922C1.13378 3.31504 0.949219 2.90102 0.949219 2.41718C0.949219 1.93832 1.13378 1.52929 1.5029 1.1901C1.87202 0.845918 2.31347 0.673828 2.82725 0.673828C3.34601 0.673828 3.78746 0.845918 4.15159 1.1901C4.52071 1.52929 4.70527 1.93832 4.70527 2.41718C4.70527 2.90102 4.52071 3.31504 4.15159 3.65922C3.78746 3.99841 3.34601 4.16801 2.82725 4.16801Z" fill="currentColor"/>
                                                                    </svg>
                                                                </div>
                                                            </a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div role="listitem" class="doctor-card-cms-item-v2 w-dyn-item">
                                                <div data-w-id="fcccbe69-ed75-6d73-3999-48b91fb83edf" class="doctors-card large">
                                                    <div class="doctors-card-content-wrap">
                                                        <a href="/doctors/dr-michael-brown" class="doctors-card-image-wrap w-inline-block">
                                                            <img src="/assets/media/images/68908f4e7fc242f73e7aa08a_Doctor_20Image_208.webp" loading="lazy" alt="" sizes="100vw" srcset="/assets/media/responsive/68908f4e7fc242f73e7aa08a_Doctor_20Image_208-p-500.webp 500w, /assets/media/responsive/68908f4e7fc242f73e7aa08a_Doctor_20Image_208-p-800.webp 800w, /assets/media/responsive/68908f4e7fc242f73e7aa08a_Doctor_20Image_208-p-1080.webp 1080w, /assets/media/images/68908f4e7fc242f73e7aa08a_Doctor_20Image_208.webp 1114w" class="doctors-card-image"/>
                                                        </a>
                                                        <div class="doctor-card-text-box">
                                                            <div class="doctor-info-wrap">
                                                                <div class="doctor-name-text-wrap">
                                                                    <h5 class="heading-text-small weight-semibold">Dr. Michael Brown</h5>
                                                                </div>
                                                                <div class="doctor-profession-text-wrap">
                                                                    <div class="body-text-medium opacity-100">Dermatologist</div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="doctors-card-contact-slide">
                                                        <div class="doctors-social-media-button-wrap">
                                                            <a href="https://x.com" target="_blank" class="doctors-social-media-button w-inline-block">
                                                                <div aria-label="doctors-social-media-icon" class="doctors-social-media-icon w-embed">
                                                                    <svg xmlns="http://www.w3.org/2000/svg" width="" height="" viewBox="0 0 20 18" fill="none">
                                                                        <path d="M15.743 0H18.7952L12.1285 7.64L20 18H13.8153L8.99598 11.72L3.45382 18H0.401606L7.5502 9.84L0 0H6.34538L10.7229 5.76L15.743 0ZM14.6586 16.16H16.3454L5.42169 1.72H3.5743L14.6586 16.16Z" fill="currentColor"/>
                                                                    </svg>
                                                                </div>
                                                            </a>
                                                            <a href="https://facebook.com" target="_blank" class="doctors-social-media-button w-inline-block">
                                                                <div class="div-hide">
                                                                    <img src="/assets/media/images/67083b060468652a6e838a39_Facebook_20White.svg" loading="lazy" alt="facebook logo" class="social-media-icon-ab"/>
                                                                </div>
                                                                <div aria-label="doctors-social-media-icon" class="doctors-social-media-icon w-embed">
                                                                    <svg xmlns="http://www.w3.org/2000/svg" width="" height="" viewBox="0 0 11 21" fill="none">
                                                                        <path d="M10.2792 11.7233L10.8493 7.95146H7.28311V5.50376C7.28311 4.47185 7.78124 3.46602 9.37858 3.46602H11V0.254854C11 0.254854 9.52849 0 8.12167 0C5.18452 0 3.26484 1.80641 3.26484 5.0767V7.95146H0V11.7233H3.26484V20.8415C3.91949 20.9457 4.59047 21 5.27397 21C5.95748 21 6.62845 20.9457 7.28311 20.8415V11.7233H10.2792Z" fill="currentColor"/>
                                                                    </svg>
                                                                </div>
                                                            </a>
                                                            <a href="https://linkedin.com" target="_blank" class="doctors-social-media-button w-inline-block">
                                                                <div class="div-hide">
                                                                    <img src="/assets/media/images/67083b06c0ec449aa5cedab4_Linkdin_20White.png" loading="lazy" alt="linkedin log" class="social-media-icon-ab"/>
                                                                </div>
                                                                <div aria-label="doctors-social-media-icon" class="doctors-social-media-icon w-embed">
                                                                    <svg width="" height="" viewBox="0 0 19 17" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                                        <path d="M10.6393 10.4455V16.9999H6.98047V5.50731H10.4597V7.61728H10.5869C10.8413 6.91396 11.2752 6.36277 11.8888 5.96372C12.5023 5.55969 13.2331 5.35767 14.0811 5.35767C14.8891 5.35767 15.59 5.53973 16.1835 5.90386C16.7821 6.26301 17.246 6.76681 17.5752 7.41527C17.9094 8.05873 18.074 8.81194 18.0691 9.67488V16.9999H14.4103V10.3932C14.4153 9.75469 14.2531 9.25588 13.9239 8.89674C13.5997 8.53759 13.1483 8.35802 12.5697 8.35802C12.1856 8.35802 11.8464 8.44282 11.5521 8.61241C11.2628 8.77702 11.0383 9.01396 10.8787 9.32322C10.7241 9.63248 10.6442 10.0066 10.6393 10.4455Z" fill="currentColor"/>
                                                                        <path d="M0.994112 16.9999V5.50732H4.6529V16.9999H0.994112ZM2.82725 4.16801C2.31347 4.16801 1.87202 3.99841 1.5029 3.65922C1.13378 3.31504 0.949219 2.90102 0.949219 2.41718C0.949219 1.93832 1.13378 1.52929 1.5029 1.1901C1.87202 0.845918 2.31347 0.673828 2.82725 0.673828C3.34601 0.673828 3.78746 0.845918 4.15159 1.1901C4.52071 1.52929 4.70527 1.93832 4.70527 2.41718C4.70527 2.90102 4.52071 3.31504 4.15159 3.65922C3.78746 3.99841 3.34601 4.16801 2.82725 4.16801Z" fill="currentColor"/>
                                                                    </svg>
                                                                </div>
                                                            </a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div> -->
                            </div>
                        </div>
                    </div>
                    <div style="display:none;" data-w-id="ac225577-4fea-a349-9d4f-a9d0f88ac088" class="testeomonial-section-v2 section-padding-large">
                        <div class="main-container">
                            <div class="patient-opinion-v2-content-wrap">
                                <div class="section-header-wrap center">
                                    <div class="section-header-block center header-width-large">
                                        <div class="section-name-tag-block">
                                            <div class="section-tag-text c-white">{{ __('home.contact.badge') }}</div>
                                        </div>
                                        <div class="header-block header-width-medium">
                                            <div class="div-hide">
                                                <h2 class="mid-title color-white">{{ __('home.contact.title') }}</h2>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="patient-opinion-v2-loop-slide-wrap">
                            <div class="patient-opinion-v2-loop-slide">
                                <div data-w-id="334f82f7-9ee6-8e33-790b-d7ce2ddc6cf6" class="patient-opinion-v2-card-wrap">
                                    <div class="patient-opinion-v2-card">
                                        <div class="patient-opinion-v2-card-icon-wrap">
                                            <img src="/assets/media/images/66ff43ac392cad05d2a8382a_Quote_20Small_20Icon.svg" loading="lazy" alt="quote image" class="icon"/>
                                        </div>
                                        <div class="patient-opinion-v2-text-wrap">
                                            <h5 class="heading-text-small">&quot;The care I received at Omidic was exceptional. The staff made me feel comfortable and well-informed about my treatment options.&quot;</h5>
                                        </div>
                                        <div class="client-info-wrap">
                                            <div class="client-image-wrap">
                                                <img src="/assets/media/images/66fd3d356120327239a7994a_Ellipse_201190.svg" loading="lazy" alt="Testimonial Icon" class="client-profile-image"/>
                                            </div>
                                            <div class="client-text-wrap">
                                                <h5 class="heading-text-small">David smith</h5>
                                                <div class="body-text-medium">Businessman</div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="patient-opinion-v2-card">
                                        <div class="patient-opinion-v2-card-icon-wrap">
                                            <img src="/assets/media/images/66ff43ac392cad05d2a8382a_Quote_20Small_20Icon.svg" loading="lazy" alt="quote image" class="icon"/>
                                        </div>
                                        <div class="patient-opinion-v2-text-wrap">
                                            <h5 class="heading-text-small">&quot;The care I received at Omidic was exceptional. The staff made me feel comfortable and well-informed about my treatment options.&quot;</h5>
                                        </div>
                                        <div class="client-info-wrap">
                                            <div class="client-image-wrap">
                                                <img src="/assets/media/images/66fd3d356120327239a7994a_Ellipse_201190.svg" loading="lazy" alt="Testimonial Icon" class="client-profile-image"/>
                                            </div>
                                            <div class="client-text-wrap">
                                                <h5 class="heading-text-small">David smith</h5>
                                                <div class="body-text-medium">Businessman</div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="patient-opinion-v2-card">
                                        <div class="patient-opinion-v2-card-icon-wrap">
                                            <img src="/assets/media/images/66ff43ac392cad05d2a8382a_Quote_20Small_20Icon.svg" loading="lazy" alt="quote image" class="icon"/>
                                        </div>
                                        <div class="patient-opinion-v2-text-wrap">
                                            <h5 class="heading-text-small">&quot;The care I received at Omidic was exceptional. The staff made me feel comfortable and well-informed about my treatment options.&quot;</h5>
                                        </div>
                                        <div class="client-info-wrap">
                                            <div class="client-image-wrap">
                                                <img src="/assets/media/images/66fd3d356120327239a7994a_Ellipse_201190.svg" loading="lazy" alt="Testimonial Icon" class="client-profile-image"/>
                                            </div>
                                            <div class="client-text-wrap">
                                                <h5 class="heading-text-small">David smith</h5>
                                                <div class="body-text-medium">Businessman</div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="patient-opinion-v2-card">
                                        <div class="patient-opinion-v2-card-icon-wrap">
                                            <img src="/assets/media/images/66ff43ac392cad05d2a8382a_Quote_20Small_20Icon.svg" loading="lazy" alt="quote image" class="icon"/>
                                        </div>
                                        <div class="patient-opinion-v2-text-wrap">
                                            <h5 class="heading-text-small">&quot;The care I received at Omidic was exceptional. The staff made me feel comfortable and well-informed about my treatment options.&quot;</h5>
                                        </div>
                                        <div class="client-info-wrap">
                                            <div class="client-image-wrap">
                                                <img src="/assets/media/images/66fd3d356120327239a7994a_Ellipse_201190.svg" loading="lazy" alt="Testimonial Icon" class="client-profile-image"/>
                                            </div>
                                            <div class="client-text-wrap">
                                                <h5 class="heading-text-small">David smith</h5>
                                                <div class="body-text-medium">Businessman</div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="patient-opinion-v2-card">
                                        <div class="patient-opinion-v2-card-icon-wrap">
                                            <img src="/assets/media/images/66ff43ac392cad05d2a8382a_Quote_20Small_20Icon.svg" loading="lazy" alt="quote image" class="icon"/>
                                        </div>
                                        <div class="patient-opinion-v2-text-wrap">
                                            <h5 class="heading-text-small">&quot;The care I received at Omidic was exceptional. The staff made me feel comfortable and well-informed about my treatment options.&quot;</h5>
                                        </div>
                                        <div class="client-info-wrap">
                                            <div class="client-image-wrap">
                                                <img src="/assets/media/images/66fd3d356120327239a7994a_Ellipse_201190.svg" loading="lazy" alt="Testimonial Icon" class="client-profile-image"/>
                                            </div>
                                            <div class="client-text-wrap">
                                                <h5 class="heading-text-small">David smith</h5>
                                                <div class="body-text-medium">Businessman</div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="patient-opinion-v2-card">
                                        <div class="patient-opinion-v2-card-icon-wrap">
                                            <img src="/assets/media/images/66ff43ac392cad05d2a8382a_Quote_20Small_20Icon.svg" loading="lazy" alt="quote image" class="icon"/>
                                        </div>
                                        <div class="patient-opinion-v2-text-wrap">
                                            <h5 class="heading-text-small">&quot;The care I received at Omidic was exceptional. The staff made me feel comfortable and well-informed about my treatment options.&quot;</h5>
                                        </div>
                                        <div class="client-info-wrap">
                                            <div class="client-image-wrap">
                                                <img src="/assets/media/images/66fd3d356120327239a7994a_Ellipse_201190.svg" loading="lazy" alt="Testimonial Icon" class="client-profile-image"/>
                                            </div>
                                            <div class="client-text-wrap">
                                                <h5 class="heading-text-small">David smith</h5>
                                                <div class="body-text-medium">Businessman</div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="patient-opinion-v2-card">
                                        <div class="patient-opinion-v2-card-icon-wrap">
                                            <img src="/assets/media/images/66ff43ac392cad05d2a8382a_Quote_20Small_20Icon.svg" loading="lazy" alt="quote image" class="icon"/>
                                        </div>
                                        <div class="patient-opinion-v2-text-wrap">
                                            <h5 class="heading-text-small">&quot;The care I received at Omidic was exceptional. The staff made me feel comfortable and well-informed about my treatment options.&quot;</h5>
                                        </div>
                                        <div class="client-info-wrap">
                                            <div class="client-image-wrap">
                                                <img src="/assets/media/images/66fd3d356120327239a7994a_Ellipse_201190.svg" loading="lazy" alt="Testimonial Icon" class="client-profile-image"/>
                                            </div>
                                            <div class="client-text-wrap">
                                                <h5 class="heading-text-small">David smith</h5>
                                                <div class="body-text-medium">Businessman</div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="patient-opinion-v2-card">
                                        <div class="patient-opinion-v2-card-icon-wrap">
                                            <img src="/assets/media/images/66ff43ac392cad05d2a8382a_Quote_20Small_20Icon.svg" loading="lazy" alt="quote image" class="icon"/>
                                        </div>
                                        <div class="patient-opinion-v2-text-wrap">
                                            <h5 class="heading-text-small">&quot;The care I received at Omidic was exceptional. The staff made me feel comfortable and well-informed about my treatment options.&quot;</h5>
                                        </div>
                                        <div class="client-info-wrap">
                                            <div class="client-image-wrap">
                                                <img src="/assets/media/images/66fd3d356120327239a7994a_Ellipse_201190.svg" loading="lazy" alt="Testimonial Icon" class="client-profile-image"/>
                                            </div>
                                            <div class="client-text-wrap">
                                                <h5 class="heading-text-small">David smith</h5>
                                                <div class="body-text-medium">Businessman</div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div id="contact" class="faq-section section-padding-large">
                        <div class="main-container large-space">
                            <div class="faq-section-content-wrap">
                                <div class="section-header-wrap center">
                                    <div class="section-header-block center header-width-large">
                                        <div class="section-name-tag-block more-space">
                                            <div class="section-tag-text">{{ __('home.contact.badge') }}</div>
                                        </div>
                                        <div class="header-block">
                                            <div class="div-hide">
                                                <h2 class="mid-title">{{ __('home.contact.title') }}</h2>
                                            </div>
                                        </div>
                                        <div class="sub-header-wrap top-margine-meidum">
                                            <div class="body-text-medium">{{ __('home.contact.description') }}</div>
                                        </div>
                                        <div class="buttons-wrap top-margine-32" style="justify-content: center; gap: 20px; margin-top: 32px;">
                                            <div style="text-align: center;">
                                                <p class="body-text-medium"><strong>{{ __('home.contact.phone_label') }}:</strong></p>
                                                <p class="body-text-medium"><a href="tel:{{ __('home.contact.phone_number') }}" style="color: #66cdcc;">{{ __('home.contact.phone_number') }}</a></p>
                                            </div>
                                            <div style="text-align: center;">
                                                <p class="body-text-medium"><strong>{{ __('home.contact.email_label') }}:</strong></p>
                                                <p class="body-text-medium"><a href="mailto:{{ __('home.contact.email_address') }}" style="color: #66cdcc;">{{ __('home.contact.email_address') }}</a></p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
@endsection