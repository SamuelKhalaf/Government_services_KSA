{{-- Success Notifications --}}
@if(session('success'))
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            toastr.success("{{ session('success') }}", "{{ __('Success') }}", {
                timeOut: 5000,
                positionClass: "toast-top-right",
                preventDuplicates: true,
                showDuration: 300,
                hideDuration: 1000,
                extendedTimeOut: 1000,
                showEasing: "swing",
                hideEasing: "linear",
                showMethod: "fadeIn",
                hideMethod: "fadeOut"
            });
        });
    </script>
@endif

{{-- Error Notifications --}}
@if(session('error'))
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            toastr.error("{{ session('error') }}", "{{ __('Error') }}", {
                timeOut: 8000,
                positionClass: "toast-top-right",
                preventDuplicates: true,
                showDuration: 300,
                hideDuration: 1000000000000,
                extendedTimeOut: 2000,
                showEasing: "swing",
                hideEasing: "linear",
                showMethod: "fadeIn",
                hideMethod: "fadeOut"
            });
        });
    </script>
@endif

{{-- Warning Notifications --}}
@if(session('warning'))
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            toastr.warning("{{ session('warning') }}", "{{ __('Warning') }}", {
                timeOut: 6000,
                positionClass: "toast-top-right",
                preventDuplicates: true,
                showDuration: 300,
                hideDuration: 1000,
                extendedTimeOut: 1500,
                showEasing: "swing",
                hideEasing: "linear",
                showMethod: "fadeIn",
                hideMethod: "fadeOut"
            });
        });
    </script>
@endif

{{-- Info Notifications --}}
@if(session('info'))
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            toastr.info("{{ session('info') }}", "{{ __('Information') }}", {
                timeOut: 5000,
                positionClass: "toast-top-right",
                preventDuplicates: true,
                showDuration: 300,
                hideDuration: 1000,
                extendedTimeOut: 1000,
                showEasing: "swing",
                hideEasing: "linear",
                showMethod: "fadeIn",
                hideMethod: "fadeOut"

            });
        });
    </script>
@endif

{{-- Validation Errors --}}
@if($errors->any())
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            @foreach($errors->all() as $error)
                toastr.error("{{ $error }}", "{{ __('Validation Error') }}", {
                    timeOut: 8000,
                    positionClass: "toast-top-right",
                    preventDuplicates: true,
                    showDuration: 300,
                    hideDuration: 1000,
                    extendedTimeOut: 2000,
                    showEasing: "swing",
                    hideEasing: "linear",
                    showMethod: "fadeIn",
                    hideMethod: "fadeOut"
                });
            @endforeach
        });
    </script>
@endif

{{-- Custom JavaScript for toastr options --}}
<script>
// Global toastr configuration
toastr.options = {
    closeButton: false,  // Hide the X close button
    debug: false,
    newestOnTop: true,
    progressBar: true,
    positionClass: "toast-top-right",
    preventDuplicates: true,
    showDuration: "300",
    hideDuration: "1000",
    timeOut: "5000",
    extendedTimeOut: "1000",
    showEasing: "swing",
    hideEasing: "linear",
    showMethod: "fadeIn",
    hideMethod: "fadeOut",
};

// Custom CSS for toastr positioning and opacity
const toastrStyle = document.createElement('style');
toastrStyle.textContent = `
    .toast-top-right {
        top: 25px !important;
        right: 15px !important;
    }
    
    #toast-container > div,
    #toast-container .toast,
    .toast-success,
    .toast-error,
    .toast-warning,
    .toast-info {
        opacity: 1 !important;
        transition: all 0.3s ease !important;
    }
    
    #toast-container > div:hover,
    #toast-container .toast:hover,
    .toast-success:hover,
    .toast-error:hover,
    .toast-warning:hover,
    .toast-info:hover {
        opacity: 1 !important;
        transform: scale(1.05) !important;
        box-shadow: 0 8px 25px rgba(0, 0, 0, 0.3) !important;
        z-index: 9999 !important;
        transition: all 0.3s ease !important;
    }
    
    .toast {
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15) !important;
        border-radius: 8px !important;
        cursor: pointer !important;
    }
    
    /* Hide close button completely */
    .toast-close-button,
    .toast .toast-close-button,
    #toast-container .toast-close-button {
        display: none !important;
        visibility: hidden !important;
    }
    
    /* Add subtle click indicator */
    .toast::after {
        content: "✕" !important;
        position: absolute !important;
        top: 8px !important;
        right: 8px !important;
        font-size: 12px !important;
        color: rgba(255, 255, 255, 0.7) !important;
        opacity: 0 !important;
        transition: opacity 0.3s ease !important;
    }
    
    .toast:hover::after {
        opacity: 1 !important;
    }
`;
document.head.appendChild(toastrStyle);

// Additional JavaScript to ensure opacity changes work
document.addEventListener('DOMContentLoaded', function() {
    // Function to apply opacity styles to toastr elements
    function applyToastrStyles() {
        const toastContainer = document.getElementById('toast-container');
        if (toastContainer) {
            const toasts = toastContainer.querySelectorAll('.toast');
            toasts.forEach(toast => {
                toast.style.opacity = '1';
                toast.style.transition = 'all 0.3s ease';
                toast.style.cursor = 'pointer';
                
                // Remove any existing click listeners to avoid duplicates
                toast.onclick = null;
                
                // Add click-to-dismiss functionality
                toast.addEventListener('click', function(e) {
                    e.preventDefault();
                    this.style.opacity = '0';
                    this.style.transform = 'scale(0.8)';
                    setTimeout(() => {
                        this.remove();
                    }, 300);
                });
                
                toast.addEventListener('mouseenter', function() {
                    this.style.opacity = '1';
                    this.style.transform = 'scale(1.05)';
                    this.style.boxShadow = '0 8px 25px rgba(0, 0, 0, 0.3)';
                    this.style.zIndex = '9999';
                });
                
                toast.addEventListener('mouseleave', function() {
                    this.style.opacity = '1';
                    this.style.transform = 'scale(1)';
                    this.style.boxShadow = '0 4px 12px rgba(0, 0, 0, 0.15)';
                    this.style.zIndex = 'auto';
                });
            });
        }
    }
    
    // Apply styles when toasts are created
    const observer = new MutationObserver(function(mutations) {
        mutations.forEach(function(mutation) {
            if (mutation.addedNodes.length > 0) {
                applyToastrStyles();
            }
        });
    });
    
    // Start observing for toast additions
    if (document.body) {
        observer.observe(document.body, {
            childList: true,
            subtree: true
        });
    }
    
    // Apply to existing toasts
    applyToastrStyles();
});

// Custom notification functions
window.showSuccess = function(message, title = "{{ __('Success') }}") {
    toastr.success(message, title);
};

window.showError = function(message, title = "{{ __('Error') }}") {
    toastr.error(message, title);
};

window.showWarning = function(message, title = "{{ __('Warning') }}") {
    toastr.warning(message, title);
};

window.showInfo = function(message, title = "{{ __('Information') }}") {
    toastr.info(message, title);
};
</script>
