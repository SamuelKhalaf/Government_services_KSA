@extends('layouts.app')

@section('content')
<html lang="{{ app()->getLocale() }}" dir="{{ app()->getLocale() == 'ar' ? 'rtl' : 'ltr' }}">
<!--begin::Navbar-->
<nav class="navbar navbar-expand-lg navbar-dark position-fixed w-100" style="background: linear-gradient(135deg, #0d6efd 0%, #0a58ca 50%, #084298 100%); z-index: 1000; backdrop-filter: blur(10px);">
    <div class="container">
        <!-- Brand -->
        <a class="navbar-brand fw-bold fs-2" href="{{ route('home') }}">
            <img src="{{asset('assets/media/logos/logo-sm.png')}}" alt="TEBRA" height="45" class="me-3">
            <span class="text-warning fs-1 fw-bold">Solar</span><span class="text-danger fs-1 fw-bold">Verse</span>
        </a>
        
        <!-- Mobile Toggle -->
        <button class="navbar-toggler border-0" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        
        <!-- Navbar Items -->
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav me-auto">
                <li class="nav-item">
                    <a class="nav-link" style="font-size:2rem; color:#fff;" href="#services">{{ __('home.nav.services') }}</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" style="font-size:2rem; color:#fff;" href="#packages">{{ __('home.nav.packages') }}</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" style="font-size:2rem; color:#fff;" href="#features">{{ __('home.nav.features') }}</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" style="font-size:2rem; color:#fff;" href="#contact">{{ __('home.nav.contact') }}</a>
                </li>
            </ul>
            
            <!-- Language Switcher -->
            <div class="dropdown me-3">
                <button class="btn btn-outline-warning btn-sm dropdown-toggle" type="button" id="languageDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                    <i class="fas fa-globe me-1"></i>
                    <span id="current-lang">{{ app()->getLocale() == 'ar' ? 'العربية' : 'English' }}</span>
                </button>
                <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="languageDropdown">
                    <li>
                        <a class="dropdown-item" href="#" onclick="changeLanguage('ar')">
                            <i class="fas fa-flag me-2"></i>العربية
                        </a>
                    </li>
                    <li>
                        <a class="dropdown-item" href="#" onclick="changeLanguage('en')">
                            <i class="fas fa-flag me-2"></i>English
                        </a>
                    </li>
                </ul>
            </div>
            
            <!-- Auth Buttons -->
            <div class="d-flex gap-2">
                @auth
                    <a href="{{ route('admin.dashboard') }}" class="btn btn-warning btn-sm px-4 fw-semibold">
                        <i class="fas fa-tachometer-alt me-1"></i>{{ __('home.nav.dashboard') }}
                    </a>
                @else
                    <a href="{{ route('login') }}" class="btn btn-warning btn-sm px-4 fw-semibold">
                        <i class="fas fa-sign-in-alt me-1"></i>{{ __('home.nav.login') }}
                    </a>
                @endauth
            </div>
        </div>
    </div>
</nav>
<!--end::Navbar-->

<style>
/* Custom hover effects and animations */
.hover-lift {
    transition: all 0.3s ease;
}

.hover-lift:hover {
    transform: translateY(-5px);
    box-shadow: 0 20px 40px rgba(0,0,0,0.1) !important;
}

.hover-bg-light:hover {
    background-color: rgba(13, 110, 253, 0.05) !important;
}

.backdrop-blur {
    backdrop-filter: blur(10px);
    -webkit-backdrop-filter: blur(10px);
}

/* Custom text colors */
.text-white-75 {
    color: rgba(255, 255, 255, 0.75) !important;
}

.text-white-50 {
    color: rgba(255, 255, 255, 0.5) !important;
}

.text-dark-75 {
    color: rgba(33, 37, 41, 0.75) !important;
}

/* Animation for floating elements */
@keyframes float {
    0%, 100% { transform: translateY(0px); }
    50% { transform: translateY(-10px); }
}

.floating {
    animation: float 3s ease-in-out infinite;
}

/* Enhanced keyframe animations for hero section */
@keyframes gradientShift {
    0% { 
        background: linear-gradient(135deg, #0d6efd 0%, #0a58ca 50%, #084298 100%); 
    }
    25% { 
        background: linear-gradient(135deg, #084298 0%, #0d6efd 50%, #0a58ca 100%); 
    }
    50% { 
        background: linear-gradient(135deg, #0a58ca 0%, #084298 50%, #0d6efd 100%); 
    }
    75% { 
        background: linear-gradient(135deg, #0d6efd 0%, #084298 50%, #0a58ca 100%); 
    }
    100% { 
        background: linear-gradient(135deg, #0d6efd 0%, #0a58ca 50%, #084298 100%); 
    }
}

@keyframes floatParticle {
    0%, 100% { 
        transform: translateY(0px) translateX(0px) rotate(0deg);
        opacity: 0.3;
    }
    25% { 
        transform: translateY(-20px) translateX(10px) rotate(90deg);
        opacity: 0.8;
    }
    50% { 
        transform: translateY(-10px) translateX(-5px) rotate(180deg);
        opacity: 0.5;
    }
    75% { 
        transform: translateY(-30px) translateX(15px) rotate(270deg);
        opacity: 0.9;
    }
}

@keyframes rotateSlow {
    0% { transform: rotate(0deg); }
    100% { transform: rotate(360deg); }
}

@keyframes pulse {
    0%, 100% { 
        transform: scale(1);
        opacity: 0.1;
    }
    50% { 
        transform: scale(1.1);
        opacity: 0.3;
    }
}

@keyframes slideInFromTop {
    0% {
        transform: translateY(-50px);
        opacity: 0;
    }
    100% {
        transform: translateY(0);
        opacity: 1;
    }
}

@keyframes slideInFromLeft {
    0% {
        transform: translateX(-50px);
        opacity: 0;
    }
    100% {
        transform: translateX(0);
        opacity: 1;
    }
}

@keyframes slideInFromRight {
    0% {
        transform: translateX(50px);
        opacity: 0;
    }
    100% {
        transform: translateX(0);
        opacity: 1;
    }
}

@keyframes slideInFromBottom {
    0% {
        transform: translateY(50px);
        opacity: 0;
    }
    100% {
        transform: translateY(0);
        opacity: 1;
    }
}

/* Gradient text effect */
.gradient-text {
    background: linear-gradient(135deg, #0d6efd, #0a58ca);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    background-clip: text;
}

/* Custom button styles */
.btn-outline-warning.border-2 {
    border-width: 2px !important;
}

.btn-outline-primary.border-2 {
    border-width: 2px !important;
}

/* Card hover effects */
.card:hover .symbol-label {
    transform: scale(1.1);
    transition: transform 0.3s ease;
}

/* Enhanced text sizing */
p, span, li {
    font-size: 1.1rem !important;
    line-height: 1.6;
}

.fs-6 {
    font-size: 1.1rem !important;
}

.fs-5 {
    font-size: 1.25rem !important;
}

.fs-4 {
    font-size: 1.5rem !important;
}

.fs-3 {
    font-size: 1.75rem !important;
}

.fs-2 {
    font-size: 2rem !important;
}

/* Remove small text classes */
.small {
    font-size: 1rem !important;
}

/* Override icon colors to white */
i.bi, 
i[class^="fonticon-"], 
i[class*=" fonticon-"], 
i[class^="fa-"], 
i[class*=" fa-"], 
i[class^="la-"], 
i[class*=" la-"] {
    color: white !important;
}

/* Smooth scrolling */
html {
    scroll-behavior: smooth;
}

/* Navbar styling */
.navbar {
    transition: all 0.3s ease;
    box-shadow: 0 2px 20px rgba(0,0,0,0.1);
}

.navbar-brand {
    transition: all 0.3s ease;
}

.navbar-brand:hover {
    transform: scale(1.05);
}

.nav-link {
    transition: all 0.3s ease;
    position: relative;
}

.nav-link:hover {
    color: #ffc107 !important;
    transform: translateY(-2px);
}

.nav-link::after {
    content: '';
    position: absolute;
    width: 0;
    height: 2px;
    bottom: 0;
    left: 50%;
    background-color: #ffc107;
    transition: all 0.3s ease;
    transform: translateX(-50%);
}

.nav-link:hover::after {
    width: 100%;
}

/* Navbar toggler styling */
.navbar-toggler:focus {
    box-shadow: none;
}

.navbar-toggler-icon {
    background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 30 30'%3e%3cpath stroke='rgba%28255, 255, 255, 1%29' stroke-linecap='round' stroke-miterlimit='10' stroke-width='2' d='M4 7h22M4 15h22M4 23h22'/%3e%3c/svg%3e");
}

/* Enhanced brand name styling */
.navbar-brand {
    text-shadow: 2px 2px 4px rgba(0,0,0,0.3);
    letter-spacing: 1px;
}

.navbar-brand .text-warning,
.navbar-brand .text-danger {
    text-shadow: 2px 2px 4px rgba(0,0,0,0.5);
    font-weight: 900 !important;
    letter-spacing: 2px;
}

/* Enhanced Hero Section Styling */
.hero-section {
    position: relative;
    overflow: hidden;
    background: linear-gradient(135deg, #0d6efd 0%, #0a58ca 50%, #084298 100%);
}

.hero-bg {

    background: linear-gradient(135deg, rgb(8, 66, 152) 0%, rgb(13, 110, 253) 50%, rgb(10, 88, 202) 100%);
    /* animation: gradientShift 12s ease-in-out infinite; */
}


/* Hero content animations */
.hero-badge {
    animation: slideInFromTop 1s ease-out 0.5s both;
    transition: all 0.3s ease;
}

.hero-badge:hover {
    transform: scale(1.05) translateY(-2px);
    box-shadow: 0 10px 25px rgba(255, 193, 7, 0.3);
}

.hero-title {
    animation: slideInFromLeft 1s ease-out 0.8s both;
}

.brand-text-solar {
    animation: slideInFromLeft 1s ease-out 1.2s both;
    display: inline-block;
    transition: all 0.3s ease;
}

.brand-text-verse {
    animation: slideInFromLeft 1s ease-out 1.4s both;
    display: inline-block;
    transition: all 0.3s ease;
}

.brand-text-solar:hover,
.brand-text-verse:hover {
    transform: scale(1.05);
    text-shadow: 0 0 20px rgba(255, 193, 7, 0.5);
}

.hero-subtitle {
    animation: slideInFromLeft 1s ease-out 1.6s both;
    transition: all 0.3s ease;
}

.hero-subtitle:hover {
    transform: translateX(10px);
}

.hero-description {
    animation: slideInFromLeft 1s ease-out 1.8s both;
    transition: all 0.3s ease;
}

.hero-description:hover {
    transform: translateX(10px);
}

/* Feature cards enhanced styling */
.feature-card {
    transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
    animation: slideInFromBottom 1s ease-out 2s both;
    position: relative;
    overflow: hidden;
}

/* Package cards hover effects */
.package-card {
    transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
    cursor: pointer;
}

.package-card:hover {
    transform: translateY(-15px) scale(1.02);
    box-shadow: 0 25px 50px rgba(0, 0, 0, 0.15) !important;
}

.package-card:hover .card-header {
    /* background: linear-gradient(135deg, rgba(255, 255, 255, 0.15) 0%, rgba(255, 255, 255, 0.1) 100%) !important; */
}

.package-card:hover .bg-white.bg-opacity-20,
.package-card:hover .bg-dark.bg-opacity-20 {
    /* background: rgba(255, 255, 255, 0.3) !important; */
    transform: scale(1.05);
    transition: all 0.3s ease;
}

.package-card:hover .badge {
    transform: scale(1.1);
    transition: all 0.3s ease;
}

.package-card:hover .symbol-label {
    transform: scale(1.1);
    transition: all 0.3s ease;
}

.feature-card::before {
    content: '';
    position: absolute;
    top: 0;
    left: -100%;
    width: 100%;
    height: 100%;
    background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.2), transparent);
    transition: left 0.5s;
}

.feature-card:hover::before {
    left: 100%;
}

.feature-card:hover {
    transform: translateY(-10px) scale(1.02);
    box-shadow: 0 20px 40px rgba(0, 0, 0, 0.15);
    border: 2px solid rgba(13, 110, 253, 0.3);
}

.feature-icon {
    transition: all 0.3s ease;
}

.feature-card:hover .feature-icon {
    transform: scale(1.2) rotate(5deg);
}

.feature-text {
    transition: all 0.3s ease;
}

.feature-card:hover .feature-text {
    color: #0d6efd !important;
    font-weight: 700 !important;
}

/* Stats cards enhanced styling */
.stat-card {
    transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
    animation: slideInFromRight 1s ease-out 2.2s both;
    position: relative;
    overflow: hidden;
    backdrop-filter: blur(10px);
    border: 1px solid rgba(255, 255, 255, 0.1);
}

.stat-card::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: linear-gradient(45deg, transparent, rgba(255, 255, 255, 0.1), transparent);
    opacity: 0;
    transition: opacity 0.3s ease;
}

.stat-card:hover::before {
    opacity: 1;
}

.stat-card:hover {
    transform: translateY(-8px) scale(1.03);
    box-shadow: 0 15px 35px rgba(0, 0, 0, 0.2);
    background: rgba(255, 255, 255, 0.15);
    border-color: rgba(255, 193, 7, 0.3);
}

.stat-number {
    transition: all 0.3s ease;
    position: relative;
}

.stat-card:hover .stat-number {
    transform: scale(1.1);
    text-shadow: 0 0 20px rgba(255, 193, 7, 0.5);
}

.stat-suffix {
    transition: all 0.3s ease;
}

.stat-card:hover .stat-suffix {
    transform: scale(1.2);
    color: #ffc107;
}

.stat-label {
    transition: all 0.3s ease;
}

.stat-card:hover .stat-label {
    color: rgba(255, 255, 255, 0.9) !important;
    transform: translateY(-2px);
}

/* Logo placeholder animation */
.logo-placeholder {
    animation: float 3s ease-in-out infinite;
    transition: all 0.3s ease;
}

.logo-placeholder:hover {
    transform: scale(1.05);
}

/* Hero section brand styling */
.hero-content .text-warning,
.hero-content .text-danger {
    text-shadow: 3px 3px 6px rgba(0,0,0,0.4);
    font-weight: 900 !important;
    letter-spacing: 3px;
}

/* Features section brand styling */
.text-warning,
.text-danger {
    text-shadow: 2px 2px 4px rgba(0,0,0,0.2);
    font-weight: 900 !important;
    letter-spacing: 2px;
}

/* Responsive adjustments */
@media (max-width: 768px) {
    .display-1 {
        font-size: 3rem !important;
    }
    
    .display-2 {
        font-size: 2.5rem !important;
    }
    
    .display-3 {
        font-size: 2rem !important;
    }
    
    .display-4 {
        font-size: 1.75rem !important;
    }
    
    .display-5 {
        font-size: 1.5rem !important;
    }
    
    .navbar-brand {
        font-size: 1.5rem !important;
    }
    
    .navbar-brand .fs-1 {
        font-size: 1.75rem !important;
    }
    
    .hero-content .text-warning,
    .hero-content .text-danger {
        letter-spacing: 1px;
    }
    
    /* Enhanced responsive design for hero section */
    @media (max-width: 768px) {
        .hero-section {
            min-height: 90vh;
            padding-top: 60px;
        }
        
        .hero-title {
            font-size: 2.5rem !important;
        }
        
        .brand-text-solar,
        .brand-text-verse {
            font-size: 3rem !important;
            letter-spacing: 1px !important;
        }
        
        .hero-subtitle {
            font-size: 1.5rem !important;
        }
        
        .hero-description {
            font-size: 1.1rem !important;
        }
        
        .feature-card,
        .stat-card {
            margin-bottom: 1rem;
        }
        
        
        .hero-logo-container img {
            max-height: 150px !important;
        }
    }
    
    @media (max-width: 576px) {
        .hero-section {
            min-height: 80vh;
            padding-top: 40px;
        }
        
        .hero-title {
            font-size: 2rem !important;
        }
        
        .brand-text-solar,
        .brand-text-verse {
            font-size: 2.5rem !important;
            display: block !important;
            line-height: 1.2 !important;
        }
        
        .hero-subtitle {
            font-size: 1.2rem !important;
        }
        
        .hero-description {
            font-size: 1rem !important;
        }
        
        .feature-card,
        .stat-card {
            padding: 1rem !important;
        }
        
        .feature-icon i,
        .stat-number {
            font-size: 1.5rem !important;
        }
        
        .hero-logo-container img {
            max-height: 120px !important;
        }
        
        .stats-container .col-6 {
            margin-bottom: 1rem;
        }
    }
    
    /* Performance optimizations */
    .hero-section * {
        will-change: auto;
    }
    
    .feature-card:hover,
    .stat-card:hover {
        will-change: transform, box-shadow;
    }
    
    /* Reduced motion support */
    @media (prefers-reduced-motion: reduce) {
        .hero-section *,
        .hero-badge,
        .hero-title,
        .brand-text-solar,
        .brand-text-verse,
        .hero-subtitle,
        .hero-description,
        .feature-card,
        .stat-card,
        .logo-placeholder {
            animation: none !important;
            transition: none !important;
        }
        
        .hero-bg {
            animation: none !important;
        }
    }
    
    p, span, li {
        font-size: 1rem !important;
    }
}

/* Language switcher styling */
#languageDropdown {
    border: 2px solid #ffc107;
    color: white;
    background: transparent;
    transition: all 0.3s ease;
}

#languageDropdown:hover {
    background: #ffc107;
    color: #000;
    transform: translateY(-2px);
}

#languageDropdown:focus {
    box-shadow: 0 0 0 0.2rem rgba(255, 193, 7, 0.25);
}

.dropdown-menu {
    background: rgba(13, 110, 253, 0.95);
    backdrop-filter: blur(10px);
    border: 1px solid rgba(255, 255, 255, 0.2);
    box-shadow: 0 8px 32px rgba(0, 0, 0, 0.3);
}

.dropdown-item {
    color: white;
    transition: all 0.3s ease;
}

.dropdown-item:hover {
    background: rgba(255, 193, 7, 0.2);
    color: #ffc107;
    transform: translateX(5px);
}

/* RTL Support */
[dir="rtl"] .navbar-nav {
    margin-right: auto;
    margin-left: 0;
}

[dir="rtl"] .me-auto {
    margin-left: auto !important;
    margin-right: 0 !important;
}

[dir="rtl"] .me-3 {
    margin-left: 1rem !important;
    margin-right: 0 !important;
}

[dir="rtl"] .me-2 {
    margin-left: 0.5rem !important;
    margin-right: 0 !important;
}

[dir="rtl"] .me-1 {
    margin-left: 0.25rem !important;
    margin-right: 0 !important;
}

[dir="rtl"] .text-end {
    text-align: right !important;
}

[dir="rtl"] .text-start {
    text-align: left !important;
}

/* Language switcher RTL adjustments */
[dir="rtl"] .dropdown-menu-end {
    right: auto;
    left: 0;
}
</style>

<script>
function changeLanguage(lang) {
    // Use the existing language switch route
    window.location.href = '{{ url("/language/switch") }}/' + lang + '?return_url=' + encodeURIComponent(window.location.href);
}

// Enhanced Hero Section Interactions
document.addEventListener('DOMContentLoaded', function() {
    // Counter animation for stats
    function animateCounters() {
        const counters = document.querySelectorAll('.stat-number[data-target]');
        
        counters.forEach(counter => {
            const target = parseInt(counter.getAttribute('data-target'));
            const duration = 2000; // 2 seconds
            const increment = target / (duration / 16); // 60fps
            let current = 0;
            
            const timer = setInterval(() => {
                current += increment;
                if (current >= target) {
                    current = target;
                    clearInterval(timer);
                }
                // Preserve the plus sign by updating only the number part
                const suffix = counter.querySelector('.stat-suffix');
                if (suffix) {
                    counter.innerHTML = Math.floor(current) + '<span class="stat-suffix">+</span>';
                } else {
                    counter.textContent = Math.floor(current);
                }
            }, 16);
        });
    }
    
    // Intersection Observer for animations
    const observerOptions = {
        threshold: 0.1,
        rootMargin: '0px 0px -50px 0px'
    };
    
    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.classList.add('animate-in');
                
                // Trigger counter animation when stats come into view
                if (entry.target.classList.contains('stats-container')) {
                    setTimeout(animateCounters, 500);
                }
            }
        });
    }, observerOptions);
    
    // Observe elements for animation
    const elementsToObserve = document.querySelectorAll('.hero-badge, .hero-title, .hero-subtitle, .hero-description, .feature-card, .stat-card, .stats-container');
    elementsToObserve.forEach(el => observer.observe(el));
    
    // Enhanced hover effects for feature cards
    const featureCards = document.querySelectorAll('.feature-card');
    featureCards.forEach(card => {
        card.addEventListener('mouseenter', function() {
            this.style.transform = 'translateY(-10px) scale(1.02)';
            this.style.boxShadow = '0 20px 40px rgba(0, 0, 0, 0.15)';
        });
        
        card.addEventListener('mouseleave', function() {
            this.style.transform = 'translateY(0) scale(1)';
            this.style.boxShadow = '0 10px 25px rgba(0, 0, 0, 0.1)';
        });
    });
    
    // Enhanced hover effects for stat cards
    const statCards = document.querySelectorAll('.stat-card');
    statCards.forEach(card => {
        card.addEventListener('mouseenter', function() {
            this.style.transform = 'translateY(-8px) scale(1.03)';
            this.style.boxShadow = '0 15px 35px rgba(0, 0, 0, 0.2)';
        });
        
        card.addEventListener('mouseleave', function() {
            this.style.transform = 'translateY(0) scale(1)';
            this.style.boxShadow = '0 5px 15px rgba(0, 0, 0, 0.1)';
        });
    });
    
    
    // Add ripple effect to cards
    function createRipple(event) {
        const card = event.currentTarget;
        const rect = card.getBoundingClientRect();
        const size = Math.max(rect.width, rect.height);
        const x = event.clientX - rect.left - size / 2;
        const y = event.clientY - rect.top - size / 2;
        
        const ripple = document.createElement('div');
        ripple.style.cssText = `
            position: absolute;
            width: ${size}px;
            height: ${size}px;
            left: ${x}px;
            top: ${y}px;
            background: rgba(255, 255, 255, 0.3);
            border-radius: 50%;
            transform: scale(0);
            animation: ripple 0.6s linear;
            pointer-events: none;
        `;
        
        card.appendChild(ripple);
        
        setTimeout(() => {
            ripple.remove();
        }, 600);
    }
    
    // Add ripple effect to all interactive cards
    const interactiveCards = document.querySelectorAll('.feature-card, .stat-card');
    interactiveCards.forEach(card => {
        card.addEventListener('click', createRipple);
    });
    
    // Add CSS for ripple animation
    const style = document.createElement('style');
    style.textContent = `
        @keyframes ripple {
            to {
                transform: scale(4);
                opacity: 0;
            }
        }
    `;
    document.head.appendChild(style);
});
</script>
<!--begin::Hero Section-->
<section class="hero-section position-relative overflow-hidden" style="padding-top: 80px; min-height: 100vh;">
    <!-- Animated Background Gradient -->
    <div class="hero-bg position-absolute top-0 start-0 w-100 h-100"></div>
    
    
    <div class="container position-relative py-20">
        <div class="row justify-content-center">
            <!-- Single Column Hero Content -->
            <div class="col-lg-10 col-xl-8">
                <div class="hero-content text-center text-white">
                    <!-- Badge with Animation -->
                    <div class="hero-badge-container mb-6">
                        <span class="badge bg-warning text-dark fs-6 px-4 py-2 mb-4 d-inline-block shadow-sm hero-badge">{{ __('home.hero.badge') }}</span>
                    </div>
                    
                    <!-- Main Title with Enhanced Typography -->
                    <div class="hero-title-container mb-6">
                        <h1 class="display-1 fw-bold mb-4 text-white hero-title" style="direction: ltr;">
                            {{ __('home.hero.title') }}
                            <br>
                            <span class="text-warning brand-text-solar" style=" font-size: 5rem !important; line-height: 1; font-weight: 900 !important;">Solar</span>
                            <span class="text-danger brand-text-verse" style="font-size: 5rem !important; line-height: 1; font-weight: 900 !important;">Verse</span>
                        </h1>
                        <p class="lead fs-2 mb-4 text-white-50 hero-subtitle">{{ __('home.hero.subtitle') }}</p>
                        <p class="fs-5 mb-6 text-white-75 hero-description">{{ __('home.hero.description') }}</p>
                    </div>

                    <!-- Logo Placeholder with Animation -->
                    <div class="hero-logo-container mb-6">
                        <div class="logo-placeholder floating d-inline-block">
                            <img src="{{asset('assets/media/logos/logo-sm.png')}}" alt="TEBRA" class="img-fluid" style="max-height: 200px; filter: drop-shadow(0 20px 40px rgba(0,0,0,0.3));">
                        </div>
                    </div>

                    <!-- Stats Cards with Enhanced Animations -->
                    <div class="stats-container mb-6">
                        <div class="row g-4 justify-content-center">
                            <div class="col-6 col-md-3">
                                <div class="stat-card bg-white bg-opacity-10 rounded-3 p-4 text-center backdrop-blur">
                                    <div class="stat-number-container">
                                        <h3 class="fw-bold text-warning mb-2 stat-number" data-target="500">0<span class="stat-suffix">+</span></h3>
                                    </div>
                                    <p class="mb-0 text-white-75 stat-label">{{ __('home.hero.stats.clients') }}</p>
                                </div>
                            </div>
                            <div class="col-6 col-md-3">
                                <div class="stat-card bg-white bg-opacity-10 rounded-3 p-4 text-center backdrop-blur">
                                    <div class="stat-number-container">
                                        <h3 class="fw-bold text-warning mb-2 stat-number" data-target="10">0<span class="stat-suffix">+</span></h3>
                                    </div>
                                    <p class="mb-0 text-white-75 fs-6 stat-label">{{ __('home.hero.stats.experience') }}</p>
                                </div>
                            </div>
                            <div class="col-6 col-md-3">
                                <div class="stat-card bg-white bg-opacity-10 rounded-3 p-4 text-center backdrop-blur">
                                    <div class="stat-number-container">
                                        <h3 class="fw-bold text-warning mb-2 stat-number">24/7</h3>
                                    </div>
                                    <p class="mb-0 text-white-75 fs-6 stat-label">{{ __('home.hero.stats.support') }}</p>
                                </div>
                            </div>
                            <div class="col-6 col-md-3">
                                <div class="stat-card bg-white bg-opacity-10 rounded-3 p-4 text-center backdrop-blur">
                                    <div class="stat-number-container">
                                        <h3 class="fw-bold text-warning mb-2 stat-number">100%</h3>
                                    </div>
                                    <p class="mb-0 text-white-75 fs-6 stat-label">{{ __('home.hero.stats.satisfaction') }}</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Feature Cards with Enhanced Hover Effects -->
                    <div class="hero-features">
                        <div class="row g-4 justify-content-center">
                            <div class="col-12 col-md-4">
                                <div class="feature-card bg-white bg-opacity-10 rounded-3 p-4 text-center backdrop-blur">
                                    <div class="feature-icon mb-3">
                                        <i class="fas fa-shield-alt fs-3 text-warning" style="color: #ffc107 !important;"></i>
                                    </div>
                                    <p class="mb-0 text-white fw-bold fs-6 feature-text">{{ __('home.hero.features.security') }}</p>
                                </div>
                            </div>
                            <div class="col-12 col-md-4">
                                <div class="feature-card bg-white bg-opacity-10 rounded-3 p-4 text-center backdrop-blur">
                                    <div class="feature-icon mb-3">
                                        <i class="fas fa-clock fs-3 text-warning" style="color: #ffc107 !important;"></i>
                                    </div>
                                    <p class="mb-0 text-white fw-bold fs-6 feature-text">{{ __('home.hero.features.speed') }}</p>
                                </div>
                            </div>
                            <div class="col-12 col-md-4">
                                <div class="feature-card bg-white bg-opacity-10 rounded-3 p-4 text-center backdrop-blur">
                                    <div class="feature-icon mb-3">
                                        <i class="fas fa-dollar-sign fs-3 text-warning" style="color: #ffc107 !important;"></i>
                                    </div>
                                    <p class="mb-0 text-white fw-bold fs-6 feature-text">{{ __('home.hero.features.pricing') }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!--end::Hero Section-->

<!--begin::Services Section-->
<div id="services" class="services-section py-20 position-relative">
    <!-- Background Pattern -->
    <div class="position-absolute top-0 start-0 w-100 h-100 opacity-5">
        <div class="position-absolute top-0 start-0 w-100 h-100" style="background-image: url('data:image/svg+xml,<svg xmlns=\"http://www.w3.org/2000/svg\" viewBox=\"0 0 100 100\"><defs><pattern id=\"grid\" width=\"10\" height=\"10\" patternUnits=\"userSpaceOnUse\"><path d=\"M 10 0 L 0 0 0 10\" fill=\"none\" stroke=\"%230d6efd\" stroke-width=\"0.5\"/></pattern></defs><rect width=\"100\" height=\"100\" fill=\"url(%23grid)\"/></svg>');"></div>
    </div>
    
    <div class="container position-relative">
        <div class="text-center mb-15">
            <div class="d-inline-block bg-primary bg-opacity-10 rounded-pill px-4 py-2 mb-4">
                <span class="text-primary fw-bold">{{ __('home.services.badge') }}</span>
            </div>
            <h2 class="display-4 fw-bold text-gray-900 mb-5">{{ __('home.services.title') }}</h2>
            <p class="fs-3 text-gray-600 mb-0">{{ __('home.services.description') }}</p>
        </div>
        
        <div class="row g-6">
            <!-- Ministry of Commerce -->
            <div class="col-lg-6 col-md-6">
                <div class="card h-100 border-0 shadow-lg hover-lift">
                    <div class="card-body p-8 position-relative">
                        <!-- Card Header with Gradient -->
                        <div class="position-absolute top-0 start-0 w-100 h-4 bg-primary rounded-top"></div>
                        
                        <div class="d-flex align-items-center mb-6 mt-2">
                            <div class="symbol symbol-60px me-4 ms-4">
                                <div class="symbol-label bg-primary text-white rounded-3 shadow-sm">
                                    <i class="fas fa-building fs-2"></i>
                                </div>
                            </div>
                            <h3 class="card-title text-gray-900 mb-0 fs-2">{{ __('home.services.commerce.title') }}</h3>
                        </div>
                        <ul class="list-unstyled">
                            <li class="d-flex align-items-center mb-3 p-3 rounded-2 hover-bg-light">
                                <div class="symbol symbol-35px me-3">
                                    <div class="symbol-label bg-success text-success rounded-circle">
                                        <i class="fas fa-check fs-5"></i>
                                    </div>
                                </div>
                                <span class="text-gray-700 fs-6">{{ __('home.services.commerce.issue') }}</span>
                            </li>
                            <li class="d-flex align-items-center mb-3 p-3 rounded-2 hover-bg-light">
                                <div class="symbol symbol-35px me-3">
                                    <div class="symbol-label bg-success text-success rounded-circle">
                                        <i class="fas fa-check fs-5"></i>
                                    </div>
                                </div>
                                <span class="text-gray-700 fs-6">{{ __('home.services.commerce.renew') }}</span>
                            </li>
                            <li class="d-flex align-items-center mb-3 p-3 rounded-2 hover-bg-light">
                                <div class="symbol symbol-35px me-3">
                                    <div class="symbol-label bg-success text-success rounded-circle">
                                        <i class="fas fa-check fs-5"></i>
                                    </div>
                                </div>
                                <span class="text-gray-700 fs-6">{{ __('home.services.commerce.cancel') }}</span>
                            </li>
                            <li class="d-flex align-items-center p-3 rounded-2 hover-bg-light">
                                <div class="symbol symbol-35px me-3">
                                    <div class="symbol-label bg-success text-success rounded-circle">
                                        <i class="fas fa-check fs-5"></i>
                                    </div>
                                </div>
                                <span class="text-gray-700 fs-6">{{ __('home.services.commerce.modify') }}</span>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>

            <!-- Ministry of Human Resources -->
            <div class="col-lg-6 col-md-6">
                <div class="card h-100 border-0 shadow-lg hover-lift">
                    <div class="card-body p-8 position-relative">
                        <div class="position-absolute top-0 start-0 w-100 h-4 bg-success rounded-top"></div>
                        
                        <div class="d-flex align-items-center mb-6 mt-2">
                            <div class="symbol symbol-60px me-4 ms-4">
                                <div class="symbol-label bg-success text-white rounded-3 shadow-sm">
                                    <i class="fas fa-users fs-2"></i>
                                </div>
                            </div>
                            <h3 class="card-title text-gray-900 mb-0 fs-2">{{ __('home.services.hr.title') }}</h3>
                        </div>
                        <ul class="list-unstyled">
                            <li class="d-flex align-items-center mb-3 p-2 rounded-2 hover-bg-light">
                                <div class="symbol symbol-30px me-3">
                                    <div class="symbol-label bg-success text-success rounded-circle">
                                        <i class="fas fa-check fs-6"></i>
                                    </div>
                                </div>
                                <span class="text-gray-700 fs-6">{{ __('home.services.hr.establishment_file') }}</span>
                            </li>
                            <li class="d-flex align-items-center mb-3 p-3 rounded-2 hover-bg-light">
                                <div class="symbol symbol-35px me-3">
                                    <div class="symbol-label bg-success text-success rounded-circle">
                                        <i class="fas fa-check fs-5"></i>
                                    </div>
                                </div>
                                <span class="text-gray-700 fs-6">{{ __('home.services.hr.work_permits') }}</span>
                            </li>
                            <li class="d-flex align-items-center mb-3 p-3 rounded-2 hover-bg-light">
                                <div class="symbol symbol-35px me-3">
                                    <div class="symbol-label bg-success text-success rounded-circle">
                                        <i class="fas fa-check fs-5"></i>
                                    </div>
                                </div>
                                <span class="text-gray-700 fs-6">{{ __('home.services.hr.work_permits_renewal') }}</span>
                            </li>
                            <li class="d-flex align-items-center mb-3 p-3 rounded-2 hover-bg-light">
                                <div class="symbol symbol-35px me-3">
                                    <div class="symbol-label bg-success text-success rounded-circle">
                                        <i class="fas fa-check fs-5"></i>
                                    </div>
                                </div>
                                <span class="text-gray-700 fs-6">{{ __('home.services.hr.labor_transfer') }}</span>
                            </li>
                            <li class="d-flex align-items-center p-3 rounded-2 hover-bg-light">
                                <div class="symbol symbol-35px me-3">
                                    <div class="symbol-label bg-success text-success rounded-circle">
                                        <i class="fas fa-check fs-5"></i>
                                    </div>
                                </div>
                                <span class="text-gray-700 fs-6">{{ __('home.services.hr.data_update') }}</span>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>

            <!-- Ministry of Interior -->
            <div class="col-lg-6 col-md-6">
                <div class="card h-100 border-0 shadow-lg hover-lift">
                    <div class="card-body p-8 position-relative">
                        <div class="position-absolute top-0 start-0 w-100 h-4 bg-info rounded-top"></div>
                        
                        <div class="d-flex align-items-center mb-6 mt-2">
                            <div class="symbol symbol-60px me-4 ms-4">
                                <div class="symbol-label bg-info text-white rounded-3 shadow-sm">
                                    <i class="fas fa-passport fs-2"></i>
                                </div>
                            </div>
                            <h3 class="card-title text-gray-900 mb-0 fs-2">{{ __('home.services.interior.title') }}</h3>
                        </div>
                        <ul class="list-unstyled">
                            <li class="d-flex align-items-center mb-3 p-3 rounded-2 hover-bg-light">
                                <div class="symbol symbol-35px me-3">
                                    <div class="symbol-label bg-success text-success rounded-circle">
                                        <i class="fas fa-check fs-5"></i>
                                    </div>
                                </div>
                                <span class="text-gray-700 fs-6">{{ __('home.services.interior.iqama_issuance') }}</span>
                            </li>
                            <li class="d-flex align-items-center mb-3 p-3 rounded-2 hover-bg-light">
                                <div class="symbol symbol-35px me-3">
                                    <div class="symbol-label bg-success text-success rounded-circle">
                                        <i class="fas fa-check fs-5"></i>
                                    </div>
                                </div>
                                <span class="text-gray-700 fs-6">{{ __('home.services.interior.iqama_renewal') }}</span>
                            </li>
                            <li class="d-flex align-items-center mb-3 p-3 rounded-2 hover-bg-light">
                                <div class="symbol symbol-35px me-3">
                                    <div class="symbol-label bg-success text-success rounded-circle">
                                        <i class="fas fa-check fs-5"></i>
                                    </div>
                                </div>
                                <span class="text-gray-700 fs-6">{{ __('home.services.interior.sponsorship_transfer') }}</span>
                            </li>
                            <li class="d-flex align-items-center mb-3 p-3 rounded-2 hover-bg-light">
                                <div class="symbol symbol-35px me-3">
                                    <div class="symbol-label bg-success text-success rounded-circle">
                                        <i class="fas fa-check fs-5"></i>
                                    </div>
                                </div>
                                <span class="text-gray-700 fs-6">{{ __('home.services.interior.visa_issuance') }}</span>
                            </li>
                            <li class="d-flex align-items-center p-3 rounded-2 hover-bg-light">
                                <div class="symbol symbol-35px me-3">
                                    <div class="symbol-label bg-success text-success rounded-circle">
                                        <i class="fas fa-check fs-5"></i>
                                    </div>
                                </div>
                                <span class="text-gray-700 fs-6">{{ __('home.services.interior.visa_cancellation') }}</span>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>

            <!-- GOSI -->
            <div class="col-lg-6 col-md-6">
                <div class="card h-100 border-0 shadow-lg hover-lift">
                    <div class="card-body p-8 position-relative">
                        <div class="position-absolute top-0 start-0 w-100 h-4 bg-warning rounded-top"></div>
                        
                        <div class="d-flex align-items-center mb-6 mt-2">
                            <div class="symbol symbol-60px me-4 ms-4">
                                <div class="symbol-label bg-warning text-white rounded-3 shadow-sm">
                                    <i class="fas fa-shield-alt fs-2"></i>
                                </div>
                            </div>
                            <h3 class="card-title text-gray-900 mb-0 fs-2">{{ __('home.services.gosi.title') }}</h3>
                        </div>
                        <ul class="list-unstyled">
                            <li class="d-flex align-items-center mb-3 p-3 rounded-2 hover-bg-light">
                                <div class="symbol symbol-35px me-3">
                                    <div class="symbol-label bg-success text-success rounded-circle">
                                        <i class="fas fa-check fs-5"></i>
                                    </div>
                                </div>
                                <span class="text-gray-700 fs-6">{{ __('home.services.gosi.new_establishment') }}</span>
                            </li>
                            <li class="d-flex align-items-center mb-3 p-3 rounded-2 hover-bg-light">
                                <div class="symbol symbol-35px me-3">
                                    <div class="symbol-label bg-success text-success rounded-circle">
                                        <i class="fas fa-check fs-5"></i>
                                    </div>
                                </div>
                                <span class="text-gray-700 fs-6">{{ __('home.services.gosi.saudi_employees') }}</span>
                            </li>
                            <li class="d-flex align-items-center mb-3 p-3 rounded-2 hover-bg-light">
                                <div class="symbol symbol-35px me-3">
                                    <div class="symbol-label bg-success text-success rounded-circle">
                                        <i class="fas fa-check fs-5"></i>
                                    </div>
                                </div>
                                <span class="text-gray-700 fs-6">{{ __('home.services.gosi.foreign_employees') }}</span>
                            </li>
                            <li class="d-flex align-items-center mb-3 p-3 rounded-2 hover-bg-light">
                                <div class="symbol symbol-35px me-3">
                                    <div class="symbol-label bg-success text-success rounded-circle">
                                        <i class="fas fa-check fs-5"></i>
                                    </div>
                                </div>
                                <span class="text-gray-700 fs-6">{{ __('home.services.gosi.employee_data_update') }}</span>
                            </li>
                            <li class="d-flex align-items-center p-3 rounded-2 hover-bg-light">
                                <div class="symbol symbol-35px me-3">
                                    <div class="symbol-label bg-success text-success rounded-circle">
                                        <i class="fas fa-check fs-5"></i>
                                    </div>
                                </div>
                                <span class="text-gray-700 fs-6">{{ __('home.services.gosi.employee_termination') }}</span>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>

            <!-- Municipality Services -->
            <div class="col-lg-6 col-md-6">
                <div class="card h-100 border-0 shadow-lg hover-lift">
                    <div class="card-body p-8 position-relative">
                        <div class="position-absolute top-0 start-0 w-100 h-4 bg-danger rounded-top"></div>
                        
                        <div class="d-flex align-items-center mb-6 mt-2">
                            <div class="symbol symbol-60px me-4 ms-4">
                                <div class="symbol-label bg-danger text-white rounded-3 shadow-sm">
                                    <i class="fas fa-city fs-2"></i>
                                </div>
                            </div>
                            <h3 class="card-title text-gray-900 mb-0 fs-2">{{ __('home.services.municipality.title') }}</h3>
                        </div>
                        <ul class="list-unstyled">
                            <li class="d-flex align-items-center mb-3 p-3 rounded-2 hover-bg-light">
                                <div class="symbol symbol-35px me-3">
                                    <div class="symbol-label bg-success text-success rounded-circle">
                                        <i class="fas fa-check fs-5"></i>
                                    </div>
                                </div>
                                <span class="text-gray-700 fs-6">{{ __('home.services.municipality.license_issuance') }}</span>
                            </li>
                            <li class="d-flex align-items-center mb-3 p-3 rounded-2 hover-bg-light">
                                <div class="symbol symbol-35px me-3">
                                    <div class="symbol-label bg-success text-success rounded-circle">
                                        <i class="fas fa-check fs-5"></i>
                                    </div>
                                </div>
                                <span class="text-gray-700 fs-6">{{ __('home.services.municipality.license_renewal') }}</span>
                            </li>
                            <li class="d-flex align-items-center mb-3 p-3 rounded-2 hover-bg-light">
                                <div class="symbol symbol-35px me-3">
                                    <div class="symbol-label bg-success text-success rounded-circle">
                                        <i class="fas fa-check fs-5"></i>
                                    </div>
                                </div>
                                <span class="text-gray-700 fs-6">{{ __('home.services.municipality.license_cancellation') }}</span>
                            </li>
                            <li class="d-flex align-items-center p-3 rounded-2 hover-bg-light">
                                <div class="symbol symbol-35px me-3">
                                    <div class="symbol-label bg-success text-success rounded-circle">
                                        <i class="fas fa-check fs-5"></i>
                                    </div>
                                </div>
                                <span class="text-gray-700 fs-6">{{ __('home.services.municipality.license_modification') }}</span>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>

            <!-- ZATCA -->
            <div class="col-lg-6 col-md-6">
                <div class="card h-100 border-0 shadow-lg hover-lift">
                    <div class="card-body p-8 position-relative">
                        <div class="position-absolute top-0 start-0 w-100 h-4 bg-dark rounded-top"></div>
                        
                        <div class="d-flex align-items-center mb-6 mt-2">
                            <div class="symbol symbol-60px me-4 ms-4">
                                <div class="symbol-label bg-dark text-white rounded-3 shadow-sm">
                                    <i class="fas fa-calculator fs-2"></i>
                                </div>
                            </div>
                            <h3 class="card-title text-gray-900 mb-0 fs-2">{{ __('home.services.zatca.title') }}</h3>
                        </div>
                        <ul class="list-unstyled">
                            <li class="d-flex align-items-center mb-3 p-3 rounded-2 hover-bg-light">
                                <div class="symbol symbol-35px me-3">
                                    <div class="symbol-label bg-success text-success rounded-circle">
                                        <i class="fas fa-check fs-5"></i>
                                    </div>
                                </div>
                                <span class="text-gray-700 fs-6">{{ __('home.services.zatca.establishment_registration') }}</span>
                            </li>
                            <li class="d-flex align-items-center mb-3 p-3 rounded-2 hover-bg-light">
                                <div class="symbol symbol-35px me-3">
                                    <div class="symbol-label bg-success text-success rounded-circle">
                                        <i class="fas fa-check fs-5"></i>
                                    </div>
                                </div>
                                <span class="text-gray-700 fs-6">{{ __('home.services.zatca.vat_registration') }}</span>
                            </li>
                            <li class="d-flex align-items-center mb-3 p-3 rounded-2 hover-bg-light">
                                <div class="symbol symbol-35px me-3">
                                    <div class="symbol-label bg-success text-success rounded-circle">
                                        <i class="fas fa-check fs-5"></i>
                                    </div>
                                </div>
                                <span class="text-gray-700 fs-6">{{ __('home.services.zatca.tax_declarations') }}</span>
                            </li>
                            <li class="d-flex align-items-center p-3 rounded-2 hover-bg-light">
                                <div class="symbol symbol-35px me-3">
                                    <div class="symbol-label bg-success text-success rounded-circle">
                                        <i class="fas fa-check fs-5"></i>
                                    </div>
                                </div>
                                <span class="text-gray-700 fs-6">{{ __('home.services.zatca.violations_penalties') }}</span>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>

            <!-- Additional Services Row -->
            <div class="col-lg-4 col-md-6">
                <div class="card h-100 border-0 shadow-lg hover-lift">
                    <div class="card-body p-8 position-relative">
                        <div class="position-absolute top-0 start-0 w-100 h-4 bg-primary rounded-top"></div>
                        
                        <div class="d-flex align-items-center mb-6 mt-2">
                            <div class="symbol symbol-60px me-4 ms-4">
                                <div class="symbol-label bg-primary text-white rounded-3 shadow-sm">
                                    <i class="fas fa-tools fs-2"></i>
                                </div>
                            </div>
                            <h3 class="card-title text-gray-900 mb-0 fs-2">{{ __('home.services.quwa.title') }}</h3>
                        </div>
                        <ul class="list-unstyled">
                            <li class="d-flex align-items-center mb-3 p-3 rounded-2 hover-bg-light">
                                <div class="symbol symbol-35px me-3">
                                    <div class="symbol-label bg-success text-success rounded-circle">
                                        <i class="fas fa-check fs-5"></i>
                                    </div>
                                </div>
                                <span class="text-gray-700 fs-6">{{ __('home.services.quwa.regulations') }}</span>
                            </li>
                            <li class="d-flex align-items-center mb-3 p-3 rounded-2 hover-bg-light">
                                <div class="symbol symbol-35px me-3">
                                    <div class="symbol-label bg-success text-success rounded-circle">
                                        <i class="fas fa-check fs-5"></i>
                                    </div>
                                </div>
                                <span class="text-gray-700 fs-6">{{ __('home.services.quwa.work_contracts') }}</span>
                            </li>
                            <li class="d-flex align-items-center mb-3 p-3 rounded-2 hover-bg-light">
                                <div class="symbol symbol-35px me-3">
                                    <div class="symbol-label bg-success text-success rounded-circle">
                                        <i class="fas fa-check fs-5"></i>
                                    </div>
                                </div>
                                <span class="text-gray-700 fs-6">{{ __('home.services.quwa.saudization_certificates') }}</span>
                            </li>
                            <li class="d-flex align-items-center p-3 rounded-2 hover-bg-light">
                                <div class="symbol symbol-35px me-3">
                                    <div class="symbol-label bg-success text-success rounded-circle">
                                        <i class="fas fa-check fs-5"></i>
                                    </div>
                                </div>
                                <span class="text-gray-700 fs-6">{{ __('home.services.quwa.localization_verification') }}</span>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>

            <div class="col-lg-4 col-md-6">
                <div class="card h-100 border-0 shadow-lg hover-lift">
                    <div class="card-body p-8 position-relative">
                        <div class="position-absolute top-0 start-0 w-100 h-4 bg-success rounded-top"></div>
                        
                        <div class="d-flex align-items-center mb-6 mt-2">
                            <div class="symbol symbol-60px me-4 ms-4">
                                <div class="symbol-label bg-success text-white rounded-3 shadow-sm">
                                    <i class="fas fa-heartbeat fs-2"></i>
                                </div>
                            </div>
                            <h3 class="card-title text-gray-900 mb-0 fs-2">{{ __('home.services.medical_insurance.title') }}</h3>
                        </div>
                        <ul class="list-unstyled">
                            <li class="d-flex align-items-center mb-3 p-3 rounded-2 hover-bg-light">
                                <div class="symbol symbol-35px me-3">
                                    <div class="symbol-label bg-success text-success rounded-circle">
                                        <i class="fas fa-check fs-5"></i>
                                    </div>
                                </div>
                                <span class="text-gray-700 fs-6">{{ __('home.services.medical_insurance.insurance_documents') }}</span>
                            </li>
                            <li class="d-flex align-items-center mb-3 p-3 rounded-2 hover-bg-light">
                                <div class="symbol symbol-35px me-3">
                                    <div class="symbol-label bg-success text-success rounded-circle">
                                        <i class="fas fa-check fs-5"></i>
                                    </div>
                                </div>
                                <span class="text-gray-700 fs-6">{{ __('home.services.medical_insurance.document_renewal') }}</span>
                            </li>
                            <li class="d-flex align-items-center p-3 rounded-2 hover-bg-light">
                                <div class="symbol symbol-35px me-3">
                                    <div class="symbol-label bg-success text-success rounded-circle">
                                        <i class="fas fa-check fs-5"></i>
                                    </div>
                                </div>
                                <span class="text-gray-700 fs-6">{{ __('home.services.medical_insurance.employee_management') }}</span>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>

            <div class="col-lg-4 col-md-6">
                <div class="card h-100 border-0 shadow-lg hover-lift">
                    <div class="card-body p-8 position-relative">
                        <div class="position-absolute top-0 start-0 w-100 h-4 bg-info rounded-top"></div>
                        
                        <div class="d-flex align-items-center mb-6 mt-2">
                            <div class="symbol symbol-60px me-4 ms-4">
                                <div class="symbol-label bg-info text-white rounded-3 shadow-sm">
                                    <i class="fas fa-handshake fs-2"></i>
                                </div>
                            </div>
                            <h3 class="card-title text-gray-900 mb-0 fs-2">{{ __('home.services.additional_services.title') }}</h3>
                        </div>
                        <ul class="list-unstyled">
                            <li class="d-flex align-items-center mb-3 p-3 rounded-2 hover-bg-light">
                                <div class="symbol symbol-35px me-3">
                                    <div class="symbol-label bg-success text-success rounded-circle">
                                        <i class="fas fa-check fs-5"></i>
                                    </div>
                                </div>
                                <span class="text-gray-700 fs-6">{{ __('home.services.additional_services.document_attestation') }}</span>
                            </li>
                            <li class="d-flex align-items-center mb-3 p-3 rounded-2 hover-bg-light">
                                <div class="symbol symbol-35px me-3">
                                    <div class="symbol-label bg-success text-success rounded-circle">
                                        <i class="fas fa-check fs-5"></i>
                                    </div>
                                </div>
                                <span class="text-gray-700 fs-6">{{ __('home.services.additional_services.government_follow_up') }}</span>
                            </li>
                            <li class="d-flex align-items-center p-3 rounded-2 hover-bg-light">
                                <div class="symbol symbol-35px me-3">
                                    <div class="symbol-label bg-success text-success rounded-circle">
                                        <i class="fas fa-check fs-5"></i>
                                    </div>
                                </div>
                                <span class="text-gray-700 fs-6">{{ __('home.services.additional_services.violation_response') }}</span>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!--end::Services Section-->

<!--begin::Packages Section-->
<div id="packages" class="packages-section py-20 position-relative bg-light">
    <!-- Background Pattern -->
    <div class="position-absolute top-0 start-0 w-100 h-100 opacity-3">
        <div class="position-absolute top-0 start-0 w-100 h-100" style="background-image: radial-gradient(circle at 20% 50%, rgba(13, 110, 253, 0.1) 0%, transparent 50%), radial-gradient(circle at 80% 20%, rgba(13, 110, 253, 0.1) 0%, transparent 50%), radial-gradient(circle at 40% 80%, rgba(13, 110, 253, 0.1) 0%, transparent 50%);"></div>
    </div>
    
    <div class="container position-relative">
        <div class="text-center mb-15">
            <div class="d-inline-block bg-primary bg-opacity-10 rounded-pill px-4 py-2 mb-4">
                <span class="text-primary fw-bold">{{ __('home.packages.badge') }}</span>
            </div>
            <h2 class="display-4 fw-bold text-gray-900 mb-5">{{ __('home.packages.title') }}</h2>
            <p class="fs-3 text-gray-600 mb-0">{{ __('home.packages.description') }}</p>
        </div>
        
        <div class="row g-6">
            <!-- Small Companies (3 employees or less) -->
            <div class="col-lg-4">
                <div class="card h-100 shadow-lg border-0 position-relative overflow-hidden package-card">
                    <!-- Card Gradient Background -->
                    <div class="position-absolute top-0 start-0 w-100 h-100" style="background: linear-gradient(135deg, #0d6efd 0%, #0a58ca 100%); opacity: 0.05;"></div>
                    
                    <div class="card-header bg-primary text-white text-center py-8 position-relative">
                        <div class="position-absolute top-0 start-0 w-100 h-100" style="background: linear-gradient(135deg, rgba(255,255,255,0.1) 0%, rgba(255,255,255,0.05) 100%);"></div>
                        <div class="position-relative">
                            <h3 class="card-title text-white mb-2 fs-2">{{ __('home.packages.small_company.title') }}</h3>
                            <div class="bg-white bg-opacity-20 rounded-pill px-4 py-2 mb-0 d-inline-block">
                                <p class="text-white mb-0 fs-4 fw-bold">{{ __('home.packages.small_company.subtitle') }}</p>
                            </div>
                        </div>
                    </div>
                    <div class="card-body p-8 position-relative">
                        <div class="text-center mb-8">
                            <div class="d-flex justify-content-center align-items-baseline mb-3" style="direction: ltr;">
                                <img src="{{asset('assets/media/Riyal.svg')}}" alt="ريال" class="me-2" style="width: 24px; height: 24px;">
                                <span class="fs-1 fw-bold text-primary ms-2">{{ __('home.packages.small_company.basic_price') }}</span>
                            </div>
                            <div class="badge bg-primary bg-opacity-10 text-primary px-3 py-2 rounded-pill">{{ __('home.packages.small_company.basic_package') }}</div>
                        </div>
                        <div class="text-center mb-8">
                            <div class="d-flex justify-content-center align-items-baseline mb-3" style="direction: ltr;">
                                <img src="{{asset('assets/media/Riyal.svg')}}" alt="ريال" class="me-2" style="width: 24px; height: 24px;">
                                <span class="fs-1 fw-bold text-primary ms-2">{{ __('home.packages.small_company.advanced_price') }}</span>
                            </div>
                            <div class="badge bg-success bg-opacity-10 text-success px-3 py-2 rounded-pill">{{ __('home.packages.small_company.advanced_package') }}</div>
                        </div>
                        <div class="text-center mb-8">
                            <div class="d-flex justify-content-center align-items-baseline mb-3" style="direction: ltr;">
                                <img src="{{asset('assets/media/Riyal.svg')}}" alt="ريال" class="me-2" style="width: 24px; height: 24px;">
                                <span class="fs-1 fw-bold text-primary ms-2">{{ __('home.packages.small_company.comprehensive_price') }}</span>
                            </div>
                            <div class="badge bg-warning bg-opacity-10 text-warning px-3 py-2 rounded-pill">{{ __('home.packages.small_company.comprehensive_package') }}</div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Medium Companies (10 employees or less) -->
            <div class="col-lg-4">
                <div class="card h-100 shadow-lg border-0 position-relative package-card">
                    <!-- Popular Badge -->
                    <div class="position-absolute top-0 start-50 translate-middle" style="z-index: 10; transform: translateX(-50%) translateY(-50%);">
                        <span class="badge bg-warning text-dark fs-6 px-4 py-2 shadow-lg">{{ __('home.packages.most_popular') }}</span>
                    </div>
                    
                    <!-- Card Gradient Background -->
                    <div class="position-absolute top-0 start-0 w-100 h-100" style="background: linear-gradient(135deg, #198754 0%, #146c43 100%); opacity: 0.05;"></div>
                    
                    <div class="card-header bg-success text-white text-center py-8 position-relative">
                        <div class="position-absolute top-0 start-0 w-100 h-100" style="background: linear-gradient(135deg, rgba(255,255,255,0.1) 0%, rgba(255,255,255,0.05) 100%);"></div>
                        <div class="position-relative">
                            <h3 class="card-title text-white mb-2 fs-2">{{ __('home.packages.medium_company.title') }}</h3>
                            <div class="bg-white bg-opacity-20 rounded-pill px-4 py-2 mb-0 d-inline-block">
                                <p class="text-white mb-0 fs-4 fw-bold">{{ __('home.packages.medium_company.subtitle') }}</p>
                            </div>
                        </div>
                    </div>
                    <div class="card-body p-8 position-relative">
                        <div class="text-center mb-8">
                            <div class="d-flex justify-content-center align-items-baseline mb-3" style="direction: ltr;">
                                <img src="{{asset('assets/media/Riyal.svg')}}" alt="ريال" class="me-2" style="width: 24px; height: 24px;">
                                <span class="fs-1 fw-bold text-success ms-2">{{ __('home.packages.medium_company.basic_price') }}</span>
                            </div>
                            <div class="badge bg-primary bg-opacity-10 text-primary px-3 py-2 rounded-pill">{{ __('home.packages.medium_company.basic_package') }}</div>
                        </div>
                        <div class="text-center mb-8">
                            <div class="d-flex justify-content-center align-items-baseline mb-3" style="direction: ltr;">
                                <img src="{{asset('assets/media/Riyal.svg')}}" alt="ريال" class="me-2" style="width: 24px; height: 24px;">
                                <span class="fs-1 fw-bold text-success ms-2">{{ __('home.packages.medium_company.advanced_price') }}</span>
                            </div>
                            <div class="badge bg-success bg-opacity-10 text-success px-3 py-2 rounded-pill">{{ __('home.packages.medium_company.advanced_package') }}</div>
                        </div>
                        <div class="text-center mb-8">
                            <div class="d-flex justify-content-center align-items-baseline mb-3" style="direction: ltr;">
                                <img src="{{asset('assets/media/Riyal.svg')}}" alt="ريال" class="me-2" style="width: 24px; height: 24px;">
                                <span class="fs-1 fw-bold text-success ms-2">{{ __('home.packages.medium_company.comprehensive_price') }}</span>
                            </div>
                            <div class="badge bg-warning bg-opacity-10 text-warning px-3 py-2 rounded-pill">{{ __('home.packages.medium_company.comprehensive_package') }}</div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Large Companies (10+ employees) -->
            <div class="col-lg-4">
                <div class="card h-100 shadow-lg border-0 position-relative overflow-hidden package-card">
                    <!-- Card Gradient Background -->
                    <div class="position-absolute top-0 start-0 w-100 h-100" style="background: linear-gradient(135deg, #fd7e14 0%, #e8590c 100%); opacity: 0.05;"></div>
                    
                    <div class="card-header bg-warning text-dark text-center py-8 position-relative">
                        <div class="position-absolute top-0 start-0 w-100 h-100" style="background: linear-gradient(135deg, rgba(0,0,0,0.05) 0%, rgba(0,0,0,0.02) 100%);"></div>
                        <div class="position-relative">
                            <h3 class="card-title text-dark mb-2 fs-2">{{ __('home.packages.large_company.title') }}</h3>
                            <div class="bg-dark bg-opacity-20 rounded-pill px-4 py-2 mb-0 d-inline-block">
                                <p class="text-dark mb-0 fs-4 fw-bold">{{ __('home.packages.large_company.subtitle') }}</p>
                            </div>
                        </div>
                    </div>
                    <div class="card-body p-8 text-center position-relative">
                        <div class="mb-8">
                            <div class="symbol symbol-80px mx-auto mb-4">
                                <div class="symbol-label bg-warning bg-opacity-10 text-warning rounded-circle">
                                    <i class="fas fa-phone-alt fs-2"></i>
                                </div>
                            </div>
                            <h4 class="text-gray-900 mb-3 fs-3">{{ __('home.packages.large_company.contact_title') }}</h4>
                            <p class="text-gray-600 mb-6 fs-5">{{ __('home.packages.large_company.contact_description') }}</p>
                            
                            <!-- Contact Info -->
                            <div class="bg-warning bg-opacity-10 rounded-3 p-4 mb-4">
                                <div class="d-flex align-items-center justify-content-center mb-3">
                                    <i class="fas fa-phone text-warning me-2"></i>
                                    <span dir="ltr" class="text-gray-700 fw-bold">{{ __('home.packages.large_company.phone_number') }}</span>
                                </div>
                                <div class="d-flex align-items-center justify-content-center">
                                    <i class="fas fa-envelope text-warning me-2"></i>
                                    <span class="text-gray-700 fw-bold">{{ __('home.packages.large_company.email_address') }}</span>
                                </div>
                            </div>
                            
                            <div class="btn btn-warning btn-lg px-6 shadow-sm">{{ __('home.packages.large_company.contact_button') }}</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!--end::Packages Section-->

<!--begin::Features Section-->
<div id="features" class="features-section py-20 position-relative">
    <!-- Background Pattern -->
    <div class="position-absolute top-0 start-0 w-100 h-100 opacity-5">
        <div class="position-absolute top-0 start-0 w-100 h-100" style="background-image: url('data:image/svg+xml,<svg xmlns=\"http://www.w3.org/2000/svg\" viewBox=\"0 0 100 100\"><defs><pattern id=\"dots\" width=\"20\" height=\"20\" patternUnits=\"userSpaceOnUse\"><circle cx=\"10\" cy=\"10\" r=\"2\" fill=\"%230d6efd\" opacity=\"0.3\"/></pattern></defs><rect width=\"100\" height=\"100\" fill=\"url(%23dots)\"/></svg>');"></div>
    </div>
    
    <div class="container position-relative">
        <div class="text-center mb-15">
            <div class="d-inline-block bg-primary bg-opacity-10 rounded-pill px-4 py-2 mb-4">
                <span class="text-primary fw-bold">{{ __('home.features.badge') }}</span>
            </div>
            <h2 class="display-3 fw-bold text-gray-900 mb-5">{{ __('home.features.title') }}</h2>
            <p class="fs-3 text-gray-600 mb-0">{{ __('home.features.description') }}</p>
        </div>
        
        <div class="row g-6">
            <div class="col-lg-6">
                <div class="card border-0 shadow-sm h-100 hover-lift">
                    <div class="card-body p-6">
                <div class="d-flex align-items-start">
                            <div class="symbol symbol-60px me-6 ms-6">
                                <div class="symbol-label bg-primary text-white rounded-3 shadow-sm">
                            <i class="fas fa-shield-alt fs-2"></i>
                        </div>
                    </div>
                    <div>
                                <h4 class="text-gray-900 mb-3 fs-3">{{ __('home.features.peace_of_mind.title') }}</h4>
                                <p class="text-gray-600 mb-0">{{ __('home.features.peace_of_mind.description') }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="col-lg-6">
                <div class="card border-0 shadow-sm h-100 hover-lift">
                    <div class="card-body p-6">
                <div class="d-flex align-items-start">
                            <div class="symbol symbol-60px me-6 ms-6">
                                <div class="symbol-label bg-success text-white rounded-3 shadow-sm">
                            <i class="fas fa-rocket fs-2"></i>
                        </div>
                    </div>
                    <div>
                                <h4 class="text-gray-900 mb-3 fs-3">{{ __('home.features.fast_execution.title') }}</h4>
                                <p class="text-gray-600 mb-0">{{ __('home.features.fast_execution.description') }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="col-lg-6">
                <div class="card border-0 shadow-sm h-100 hover-lift">
                    <div class="card-body p-6">
                <div class="d-flex align-items-start">
                            <div class="symbol symbol-60px me-6 ms-6">
                                <div class="symbol-label bg-info text-white rounded-3 shadow-sm">
                            <i class="fas fa-dollar-sign fs-2"></i>
                        </div>
                    </div>
                    <div>
                                <h4 class="text-gray-900 mb-3 fs-3">{{ __('home.features.cost_savings.title') }}</h4>
                                <p class="text-gray-600 mb-0">{{ __('home.features.cost_savings.description') }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="col-lg-6">
                <div class="card border-0 shadow-sm h-100 hover-lift">
                    <div class="card-body p-6">
                <div class="d-flex align-items-start">
                            <div class="symbol symbol-60px me-6 ms-6">
                                <div class="symbol-label bg-warning text-white rounded-3 shadow-sm">
                            <i class="fas fa-bell fs-2"></i>
                        </div>
                    </div>
                    <div>
                                <h4 class="text-gray-900 mb-3 fs-3">{{ __('home.features.proactive_follow_up.title') }}</h4>
                                <p class="text-gray-600 mb-0">{{ __('home.features.proactive_follow_up.description') }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="col-lg-12">
                <div class="card border-0 shadow-sm hover-lift">
                    <div class="card-body p-6">
                <div class="d-flex align-items-start">
                            <div class="symbol symbol-60px me-6 ms-6">
                                <div class="symbol-label bg-danger text-white rounded-3 shadow-sm">
                            <i class="fas fa-chart-line fs-2"></i>
                        </div>
                    </div>
                    <div>
                                <h4 class="text-gray-900 mb-3 fs-3">{{ __('home.features.clear_reports.title') }}</h4>
                                <p class="text-gray-600 mb-0">{{ __('home.features.clear_reports.description') }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="text-center mt-15">
            <div class="position-relative overflow-hidden rounded-4 p-8" style="background: linear-gradient(135deg, #0d6efd 0%, #0a58ca 50%, #084298 100%);">
                <!-- Background Pattern -->
                <div class="position-absolute top-0 start-0 w-100 h-100 opacity-10">
                    <div class="position-absolute top-0 start-0 w-100 h-100" style="background-image: url('data:image/svg+xml,<svg xmlns=\"http://www.w3.org/2000/svg\" viewBox=\"0 0 100 100\"><defs><pattern id=\"stars\" width=\"20\" height=\"20\" patternUnits=\"userSpaceOnUse\"><polygon points=\"10,2 12,8 18,8 13,12 15,18 10,14 5,18 7,12 2,8 8,8\" fill=\"white\" opacity=\"0.3\"/></pattern></defs><rect width=\"100\" height=\"100\" fill=\"url(%23stars)\"/></svg>');"></div>
                </div>
                
                <div class="position-relative text-white">
                    <h3 class="text-white mb-4 fs-2">{{ __('home.features.cta.title') }}</h3>
                    <p class="text-white-75 fs-5 mb-6">{{ __('home.features.cta.description') }}</p>
                </div>
            </div>
        </div>
    </div>
</div>
<!--end::Features Section-->

<!--begin::Contact Section-->
<div id="contact" class="contact-section py-20 position-relative">
    <!-- Background Gradient -->
    <div class="position-absolute top-0 start-0 w-100 h-100" style="background: linear-gradient(135deg, #0d6efd 0%, #0a58ca 50%, #084298 100%);"></div>
    
    <!-- Decorative Elements -->
    <div class="position-absolute top-0 start-0 w-100 h-100 opacity-10">
        <div class="position-absolute top-0 start-0 w-50 h-50" style="background: radial-gradient(circle, rgba(255,255,255,0.1) 0%, transparent 70%);"></div>
        <div class="position-absolute bottom-0 end-0 w-50 h-50" style="background: radial-gradient(circle, rgba(255,255,255,0.1) 0%, transparent 70%);"></div>
    </div>
    
    <div class="container position-relative">
        <div class="row align-items-center">
            <div class="col-lg-8">
                <div class="text-white">
                    <div class="d-inline-block bg-white bg-opacity-10 rounded-pill px-4 py-2 mb-4">
                        <span class="text-white fw-bold">{{ __('home.contact.badge') }}</span>
                    </div>
                    <h2 class="display-5 fw-bold text-white mb-4">{{ __('home.contact.title') }}</h2>
                    <p class="fs-3 text-white-75 mb-6">{{ __('home.contact.description') }}</p>
                    
                    <!-- Contact Info Cards -->
                    <div class="row g-4">
                        <div class="col-md-6">
                            <div class="bg-white bg-opacity-10 rounded-3 p-4 backdrop-blur">
                                <div class="d-flex align-items-center">
                                    <div class="symbol symbol-40px me-3">
                                        <div class="symbol-label bg-warning text-white rounded-circle">
                                            <i class="fas fa-phone fs-5"></i>
                                        </div>
                                    </div>
                                    <div>
                                        <h6 class="text-white mb-2 fs-5">{{ __('home.contact.phone_label') }}</h6>
                                        <p dir="ltr" class="text-white-75 mb-0 fs-6">{{ __('home.contact.phone_number') }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="bg-white bg-opacity-10 rounded-3 p-4 backdrop-blur">
                                <div class="d-flex align-items-center">
                                    <div class="symbol symbol-40px me-3">
                                        <div class="symbol-label bg-warning text-white rounded-circle">
                                            <i class="fas fa-envelope fs-5"></i>
                                        </div>
                                    </div>
                                    <div>
                                        <h6 class="text-white mb-2 fs-5">{{ __('home.contact.email_label') }}</h6>
                                        <p class="text-white-75 mb-0 fs-6">{{ __('home.contact.email_address') }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @if(config('app.tax_number'))
                        <div class="col-md-6">
                            <div class="bg-white bg-opacity-10 rounded-3 p-4 backdrop-blur">
                                <div class="d-flex align-items-center">
                                    <div class="symbol symbol-40px me-3">
                                        <div class="symbol-label bg-warning text-white rounded-circle">
                                            <i class="fas fa-file-invoice fs-5"></i>
                                        </div>
                                    </div>
                                    <div>
                                        <h6 class="text-white mb-2 fs-5">{{ __('home.contact.tax_number_label') }}</h6>
                                        <p class="text-white-75 mb-0 fs-6">{{ config('app.tax_number') }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endif
                        @if(config('app.commercial_registration_number'))
                        <div class="col-md-6">
                            <div class="bg-white bg-opacity-10 rounded-3 p-4 backdrop-blur">
                                <div class="d-flex align-items-center">
                                    <div class="symbol symbol-40px me-3">
                                        <div class="symbol-label bg-warning text-white rounded-circle">
                                            <i class="fas fa-building fs-5"></i>
                                        </div>
                                    </div>
                                    <div>
                                        <h6 class="text-white mb-2 fs-5">{{ __('home.contact.commercial_registration_label') }}</h6>
                                        <p class="text-white-75 mb-0 fs-6">{{ config('app.commercial_registration_number') }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endif
                    </div>
                </div>
            </div>
            <div class="col-lg-4 text-lg-end">
                <div class="card border-0 shadow-lg bg-white bg-opacity-10 backdrop-blur">
                    <div class="card-body p-6 text-center">
                        <div class="d-flex align-items-center justify-content-center mb-4">
                            <div class="symbol symbol-50px me-3">
                                <div class="symbol-label bg-success text-white rounded-circle">
                                    <i class="fas fa-certificate fs-3"></i>
                                </div>
                            </div>
                            <h4 class="text-white mb-0 fw-bold">{{ __('home.registration.title') }}</h4>
                        </div>
                        <p class="text-white-75 fs-5 mb-4">
                            {{ __('home.registration.description') }}
                        </p>
                        <div class="mt-4">
                            <span class="badge bg-success fs-6 px-4 py-2">
                                <i class="fas fa-check-circle me-2"></i>
                                {{ __('home.registration.verified') }}
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!--end::Contact Section-->
@endsection
