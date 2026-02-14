<!-- Floating Social Media Icons -->
<div class="floating-social-icons" @if(app()->getLocale() == 'ar') dir="rtl" @endif>
    <a href="{{ config('app.facebook_url') }}" 
       target="_blank" 
       rel="noopener noreferrer" 
       class="floating-social-icon facebook"
       aria-label="Facebook"
       title="Facebook">
        <i class="fab fa-facebook-f"></i>
    </a>
    <a href="{{ config('app.instagram_url') }}" 
       target="_blank" 
       rel="noopener noreferrer" 
       class="floating-social-icon instagram"
       aria-label="Instagram"
       title="Instagram">
        <i class="fab fa-instagram"></i>
    </a>
    <a href="https://wa.me/{{ config('app.whatsapp_number') }}" 
       target="_blank" 
       rel="noopener noreferrer" 
       class="floating-social-icon whatsapp"
       aria-label="WhatsApp"
       title="WhatsApp">
        <i class="fab fa-whatsapp"></i>
    </a>
</div>

<style>
.floating-social-icons {
    position: fixed;
    {{ app()->getLocale() == 'ar' ? 'left: 20px;' : 'right: 20px;' }}
    top: 50%;
    transform: translateY(-50%);
    z-index: 999;
    display: flex;
    flex-direction: column;
    gap: 15px;
}

.floating-social-icon {
    width: 50px;
    height: 50px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    text-decoration: none;
    color: #ffffff;
    font-size: 20px;
    transition: all 0.3s ease;
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
    backdrop-filter: blur(10px);
}

.floating-social-icon:hover {
    transform: translateY(-5px) scale(1.1);
    box-shadow: 0 6px 20px rgba(0, 0, 0, 0.25);
}

.floating-social-icon.facebook {
    background: linear-gradient(135deg, #1877f2 0%, #0d5fbf 100%);
}

.floating-social-icon.facebook:hover {
    background: linear-gradient(135deg, #0d5fbf 0%, #1877f2 100%);
}

.floating-social-icon.instagram {
    background: linear-gradient(135deg, #f09433 0%, #e6683c 25%, #dc2743 50%, #cc2366 75%, #bc1888 100%);
}

.floating-social-icon.instagram:hover {
    background: linear-gradient(135deg, #bc1888 0%, #cc2366 25%, #dc2743 50%, #e6683c 75%, #f09433 100%);
}

.floating-social-icon.whatsapp {
    background: linear-gradient(135deg, #25d366 0%, #128c7e 100%);
}

.floating-social-icon.whatsapp:hover {
    background: linear-gradient(135deg, #128c7e 0%, #25d366 100%);
}

/* Responsive Design */
@media (max-width: 768px) {
    .floating-social-icons {
        {{ app()->getLocale() == 'ar' ? 'left: 15px;' : 'right: 15px;' }}
        top: 50%;
        transform: translateY(-50%);
        gap: 12px;
    }
    
    .floating-social-icon {
        width: 45px;
        height: 45px;
        font-size: 18px;
    }
}

@media (max-width: 480px) {
    .floating-social-icons {
        {{ app()->getLocale() == 'ar' ? 'left: 10px;' : 'right: 10px;' }}
        top: 50%;
        transform: translateY(-50%);
        gap: 10px;
    }
    
    .floating-social-icon {
        width: 40px;
        height: 40px;
        font-size: 16px;
    }
}
</style>

