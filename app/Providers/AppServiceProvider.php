<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        \Illuminate\Pagination\Paginator::useTailwind();
        try {
            \Illuminate\Support\Facades\View::composer('*', function ($view) {
                $siteSetting = \App\Models\SiteSetting::firstOrCreate(
                    ['id' => 1],
                    [
                        'hero_heading' => 'A Legacy of Excellence.',
                        'hero_subheading' => 'Discover world-class luxury residences and commercial spaces crafted by ATS and ATS Homekraft.',
                    ]
                );
                $view->with('siteSetting', $siteSetting);
            });
        } catch (\Exception $e) {
            // Ignore for initial migrations where table might not exist
        }
    }
}
