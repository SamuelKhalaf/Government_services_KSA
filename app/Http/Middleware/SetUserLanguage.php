<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class SetUserLanguage
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Priority: Session locale > User preference > Config default
        $sessionLang = session('locale');
        $userLang = null;
        
        // If user is authenticated, get their preferred language
        if (auth()->check()) {
            $userLang = auth()->user()->preferred_language;
        }
        
        // Determine the final locale
        $finalLocale = $sessionLang ?: ($userLang ?: config('app.locale'));

        // Set application locale
        app()->setLocale($finalLocale);
        
        // Ensure session has the current locale
        if (session('locale') !== $finalLocale) {
            session(['locale' => $finalLocale]);
        }
        
        // Set the direction for CSS
        session(['direction' => $finalLocale === 'ar' ? 'rtl' : 'ltr']);

        return $next($request);
    }
}
