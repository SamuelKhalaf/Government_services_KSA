<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Enums\PermissionEnum;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // No middleware needed here as we handle authentication in the index method
    }

    /**
     * Show the application dashboard or redirect based on authentication status.
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        if (Auth::check()) {
            // User is authenticated, check if they have dashboard access
            if (Auth::user()->hasPermissionTo(PermissionEnum::VIEW_DASHBOARD->value)) {
                // User has dashboard permission, redirect to dashboard
                return redirect()->route('admin.dashboard');
            } else {
                // User is authenticated but doesn't have dashboard access
                // Show the home page with limited access message
                return view('home')->with('limited_access', true);
            }
        }
        
        // User is not authenticated, redirect to login
        return redirect()->route('login');
    }
}
