<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\View\View;
use Illuminate\Validation\ValidationException;

class BlogAuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     */
    public function create(): View
    {
        return view('auth.blog_login');
    }

    /**
     * Handle an incoming authentication request.
     */
    public function store(LoginRequest $request): RedirectResponse
    {
        // Custom authentication logic for the 'blog' guard
        $request->ensureIsNotRateLimited();

        if (! Auth::guard('blog')->attempt($request->only('email', 'password'), $request->boolean('remember'))) {
            RateLimiter::hit($request->throttleKey());

            throw ValidationException::withMessages([
                'email' => trans('auth.failed'),
            ]);
        }

        RateLimiter::clear($request->throttleKey());

        $request->session()->regenerate();

        // Check if the user actually has the blog_admin role
        // Even if they log in successfully, we might want to restrict access if they aren't a blog admin.
        // But since this is a separate portal, letting any valid user log in is fine as long as routes restrict access.
        // Actually, let's allow it, the dashboard route will just show 0 stats if they aren't blog admins.

        return redirect()->intended(route('blog-admin.dashboard', absolute: false));
    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('blog')->logout();

        // We specifically don't invalidate the whole session if they might be logged into the web guard.
        // However, Laravel's session regeneration might cause issues if both are active. 
        // Typically, we only regenerate the token if no guards are logged in, but for simplicity:
        // Let's just logout the blog guard and redirect.
        
        if (!Auth::guard('web')->check()) {
            $request->session()->invalidate();
            $request->session()->regenerateToken();
        }

        return redirect('/blog-user');
    }
}
