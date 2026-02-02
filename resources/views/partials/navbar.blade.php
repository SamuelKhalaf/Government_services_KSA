<div class="navbar-wrapper" style="position: fixed; top: 0; left: 0; right: 0; z-index: 1000; background-color: #fff; box-shadow: 0 2px 10px rgba(0,0,0,0.1);">
    <div data-animation="default" data-collapse="medium" data-duration="500" data-easing="ease" data-easing2="ease" role="banner" class="nav w-nav">
        <div class="nav-content-wrap">
            <div class="navbar-logo-link-wrap">
                <a href="/" class="navbar-brand-logo-wrap w-inline-block">
                    <img src="/assets/media/logos/logo.png" loading="lazy" alt="Tebra Company" class="nav-brand-logo"/>
                </a>
                <nav role="navigation" class="nav-menu w-nav-menu">
                    <div class="nav-link-wrap" @if(app()->getLocale() == 'ar') style="direction: rtl;" @endif>
                        <a href="{{ route('home') }}" class="nav-link w-inline-block">
                            <div class="nav-text">{{ __('home.nav.home') }}</div>
                        </a>
                        <a href="{{ route('about') }}" class="nav-link w-inline-block">
                            <div class="nav-text">{{ __('home.nav.about') }}</div>
                        </a>
                        <a href="{{ route('services') }}" class="nav-link w-inline-block">
                            <div class="nav-text">{{ __('home.nav.services') }}</div>
                        </a>
                        
                        @auth
                        <a href="{{ route('admin.dashboard') }}" class="nav-link w-inline-block">
                            <div class="nav-text">{{ __('home.nav.dashboard') }}</div>
                        </a>
                        @else
                        <a href="{{ route('login') }}" class="nav-link w-inline-block">
                            <div class="nav-text">{{ __('home.nav.login') }}</div>
                        </a>
                        @endauth
                        <!-- Language Switcher -->
                        @if(app()->getLocale() == 'ar')
                            <a href="{{ route('language.switch', 'en') }}" class="nav-link w-inline-block" title="Switch to English">
                                <div class="nav-text" style="display: flex; align-items: center; gap: 8px;">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                        <circle cx="12" cy="12" r="10"></circle>
                                        <line x1="2" y1="12" x2="22" y2="12"></line>
                                        <path d="M12 2a15.3 15.3 0 0 1 4 10 15.3 15.3 0 0 1-4 10 15.3 15.3 0 0 1-4-10 15.3 15.3 0 0 1 4-10z"></path>
                                    </svg>
                                    <span>EN</span>
                                </div>
                            </a>
                        @else
                            <a href="{{ route('language.switch', 'ar') }}" class="nav-link w-inline-block" title="التبديل إلى العربية">
                                <div class="nav-text" style="display: flex; align-items: center; gap: 8px;">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                        <circle cx="12" cy="12" r="10"></circle>
                                        <line x1="2" y1="12" x2="22" y2="12"></line>
                                        <path d="M12 2a15.3 15.3 0 0 1 4 10 15.3 15.3 0 0 1-4 10 15.3 15.3 0 0 1-4-10 15.3 15.3 0 0 1 4-10z"></path>
                                    </svg>
                                    <span>AR</span>
                                </div>
                            </a>
                        @endif
                    </div>
                </nav>
                <div class="menu-button w-nav-button">
                    <img src="/assets/media/images/67025c8a6644b5d89d2b18cd_Menu_20Bar.svg" loading="lazy" alt="menu logo" class="icon"/>
                </div>
            </div>
        </div>
    </div>
</div>
