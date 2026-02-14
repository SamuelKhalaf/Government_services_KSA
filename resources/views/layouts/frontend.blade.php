<!DOCTYPE html>
<html data-wf-domain="omidic.webflow.io" data-wf-page="@yield('page-id', '66fe2653492e7505da575a52')" data-wf-site="66faa9e8ff11833f7081087e" data-wf-status="1" lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8"/>
        <title>@yield('title', 'Tebra')</title>
        <meta content="@yield('description', 'Government transaction management services in Saudi Arabia')" name="description"/>
        <meta content="@yield('og-title', 'Tebra')" property="og:title"/>
        <meta content="@yield('og-description', 'Government transaction management services in Saudi Arabia')" property="og:description"/>
        <meta content="@yield('og-image', '/assets/media/images/6893a1ee63458c918744d13f_open_20graph_20image_20_1200x630_.webp')" property="og:image"/>
        <meta content="@yield('twitter-title', 'Tebra')" property="twitter:title"/>
        <meta content="@yield('twitter-description', 'Government transaction management services in Saudi Arabia')" property="twitter:description"/>
        <meta content="@yield('twitter-image', '/assets/media/images/6893a1ee63458c918744d13f_open_20graph_20image_20_1200x630_.webp')" property="twitter:image"/>
        <meta property="og:type" content="website"/>
        <meta content="summary_large_image" name="twitter:card"/>
        <meta content="width=device-width, initial-scale=1" name="viewport"/>
        <meta content="Webflow" name="generator"/>
        <link href="/assets/css/webflow_omidic.webflow.shared.7d7ba27fe.css" rel="stylesheet" type="text/css"/>
        <!--begin::FontAwesome Icons-->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
        <!--end::FontAwesome Icons-->
        @yield('head-styles')
        <script type="text/javascript">
            !function(o, c) {
                var n = c.documentElement
                  , t = " w-mod-";
                n.className += t + "js",
                ("ontouchstart"in o || o.DocumentTouch && c instanceof DocumentTouch) && (n.className += t + "touch")
            }(window, document);
        </script>
        <!-- Favicon Configuration for Search Engines -->
        <link rel="icon" type="image/x-icon" href="/favicon.ico"/>
        <link rel="icon" type="image/x-icon" sizes="16x16" href="/assets/media/logos/favicon.ico"/>
        <link rel="icon" type="image/x-icon" sizes="32x32" href="/assets/media/logos/favicon.ico"/>
        <link rel="icon" type="image/png" sizes="192x192" href="/assets/media/logos/logo-sm.png"/>
        <link rel="icon" type="image/png" sizes="512x512" href="/assets/media/logos/logo.png"/>
        <link rel="apple-touch-icon" sizes="180x180" href="/assets/media/logos/logo-sm.png"/>
        <link rel="shortcut icon" href="/favicon.ico" type="image/x-icon"/>
    </head>
    <body>
        <div class="page-wrapper">
            <div class="page-box-container">
                @include('partials.navbar')
                
                <div class="main" style="padding-top: 100px;">
                    @yield('content')
                </div>
                
                @include('partials.footer')
            </div>
        </div>
        
        <!-- Floating Social Media Icons -->
        @include('partials.floating-social-icons')
        
        <!-- JavaScript Files -->
        <script src="/assets/js/jquery-3.5.1.min.dc5e7f18c8.js" type="text/javascript"></script>
        <script src="/assets/js/webflow.schunk.778b1a6248836936.js" type="text/javascript"></script>
        <script src="/assets/js/webflow.schunk.82f44582d86d1ea9.js" type="text/javascript"></script>
        <script src="/assets/js/webflow.schunk.a0715550659cfcce.js" type="text/javascript"></script>
        <script src="/assets/js/webflow.5f1ec855.56bcd3da5f56e4f8.js" type="text/javascript"></script>
        
        <!-- Remove Webflow badge script -->
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                // Remove any existing Webflow badges
                const badges = document.querySelectorAll('.w-webflow-badge');
                badges.forEach(badge => badge.remove());
                
                // Monitor for dynamically added badges
                const observer = new MutationObserver(function(mutations) {
                    mutations.forEach(function(mutation) {
                        mutation.addedNodes.forEach(function(node) {
                            if (node.nodeType === 1) { // Element node
                                if (node.classList && node.classList.contains('w-webflow-badge')) {
                                    node.remove();
                                }
                                // Check child nodes
                                const childBadges = node.querySelectorAll && node.querySelectorAll('.w-webflow-badge');
                                if (childBadges) {
                                    childBadges.forEach(badge => badge.remove());
                                }
                            }
                        });
                    });
                });
                
                observer.observe(document.body, {
                    childList: true,
                    subtree: true
                });
            });
        </script>
        
        <!-- Additional Scripts -->
        <script src="/assets/js/gsap.min.js" type="text/javascript"></script>
        <script src="/assets/js/SplitText.min.js" type="text/javascript"></script>
        <script src="/assets/js/ScrollTrigger.min.js" type="text/javascript"></script>
        
        @yield('scripts')
    </body>
</html>
