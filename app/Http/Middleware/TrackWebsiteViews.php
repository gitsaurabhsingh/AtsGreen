<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class TrackWebsiteViews
{
    /**
     * Handle an incoming request.
     *
     * @param  Closure(Request): (Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (!$request->is('admin/*') && !$request->is('admin') && !$request->session()->has('has_visited')) {
            $settings = \App\Models\SiteSetting::first();
            if ($settings) {
                $settings->increment('total_views');
                $request->session()->put('has_visited', true);
            }
        }
        return $next($request);
    }
}
