<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;

class LanguageController extends Controller
{
    /**
     * Switch user language preference
     *
     * @param Request $request
     * @param string $language
     * @return RedirectResponse|JsonResponse
     */
    public function switch(Request $request, string $language): RedirectResponse|JsonResponse
    {
        // Validate language
        if (!in_array($language, ['ar', 'en'])) {
            return back()->with('error', 'Invalid language selected.');
        }

        try {
            // Store in session for immediate use - use put to ensure it's saved immediately
            session()->put('locale', $language);
            session()->save(); // Force immediate save
            
            // Set application locale for current request
            app()->setLocale($language);

            // If user is authenticated, update their preferred language
            if (auth()->check()) {
                $user = auth()->user();
                $user->update([
                    'preferred_language' => $language
                ]);
            }

            if ($request->expectsJson()) {
                return response()->json([
                    'status' => 'success',
                    'message' => $language === 'ar' 
                        ? 'تم تغيير اللغة بنجاح' 
                        : 'Language changed successfully',
                    'language' => $language,
                    'redirect_url' => url()->previous()
                ]);
            }

            $message = $language === 'ar' 
                ? 'تم تغيير اللغة إلى العربية بنجاح' 
                : 'Language changed to English successfully';

            // Get the previous URL and redirect there
            $previousUrl = url()->previous();
            
            // If coming from login page, redirect back to login
            if (str_contains($previousUrl, '/login') || str_contains($previousUrl, 'login')) {
                return redirect()->route('login')->with('success', $message);
            }

            return redirect($previousUrl)->with('success', $message);

        } catch (\Exception $e) {
            if ($request->expectsJson()) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Failed to change language'
                ], 500);
            }

            return back()->with('error', 'Failed to change language. Please try again.');
        }
    }

    /**
     * Get current language information
     *
     * @return JsonResponse
     */
    public function current(): JsonResponse
    {
        if (auth()->check()) {
            $user = auth()->user();
            $language = $user->preferred_language ?? config('app.locale');
        } else {
            // For guests, get language from session or config
            $language = session('locale', config('app.locale'));
        }

        return response()->json([
            'current_language' => $language,
            'is_rtl' => $language === 'ar',
            'display_name' => $language === 'ar' ? 'العربية' : 'English',
            'available_languages' => [
                'ar' => ['name' => 'العربية', 'direction' => 'rtl'],
                'en' => ['name' => 'English', 'direction' => 'ltr']
            ]
        ]);
    }
}
