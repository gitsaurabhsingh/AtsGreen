<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\FrontendController;

Route::get('/', [FrontendController::class, 'home'])->name('home');

// Original Breeze dashboard, let's redirect to admin dashboard for now, or keep it.
Route::get('/dashboard', function () {
    // Redirect to admin dashboard if they are an admin
    return redirect()->route('admin.dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// Blog User Login
Route::middleware('guest')->group(function () {
    Route::get('/blog-user', [\App\Http\Controllers\Auth\BlogAuthenticatedSessionController::class, 'create'])->name('blog-user.login');
    Route::post('/blog-user', [\App\Http\Controllers\Auth\BlogAuthenticatedSessionController::class, 'store'])->name('blog-user.login.submit');
});

Route::post('/blog-admin/logout', [\App\Http\Controllers\Auth\BlogAuthenticatedSessionController::class, 'destroy'])->name('blog-admin.logout');

Route::middleware(['auth:blog'])->prefix('blog-admin')->name('blog-admin.')->group(function () {
    Route::get('/', [\App\Http\Controllers\AdminController::class, 'dashboard'])->name('dashboard');
    Route::resource('blogs', \App\Http\Controllers\Admin\BlogController::class);
    Route::resource('blog-categories', \App\Http\Controllers\Admin\BlogCategoryController::class);
});

use App\Http\Controllers\Admin\BrandController;
use App\Http\Controllers\Admin\ProjectController;
use App\Http\Controllers\Admin\LeadController;
use App\Http\Controllers\Admin\CityController;
use App\Http\Controllers\Admin\ProjectTypeController;
use App\Http\Controllers\Admin\BlogController;
use App\Http\Controllers\Admin\BlogCategoryController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\ResaleCategoryController;
use App\Http\Controllers\Admin\ResalePropertyController;

Route::middleware(['auth', 'verified'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/', [AdminController::class, 'dashboard'])->name('dashboard');
    Route::resource('brands', BrandController::class);
    Route::post('projects/{project}/toggle-status', [ProjectController::class, 'toggleStatus'])->name('projects.toggle_status');
    Route::resource('projects', ProjectController::class);
    Route::resource('resale-categories', ResaleCategoryController::class);
    Route::resource('resale-properties', ResalePropertyController::class);
    Route::resource('leads', LeadController::class);
    Route::resource('cities', CityController::class);
    Route::resource('project-types', ProjectTypeController::class);
    Route::resource('hero-sliders', \App\Http\Controllers\Admin\HeroSliderController::class);
    Route::patch('blogs/{blog}/approve', [BlogController::class, 'approve'])->name('blogs.approve');
    Route::patch('blogs/{blog}/reject', [BlogController::class, 'reject'])->name('blogs.reject');
    Route::resource('blogs', BlogController::class);
    Route::resource('blog-categories', BlogCategoryController::class);
    Route::resource('users', UserController::class);
    
    // Site Settings
    Route::get('/settings', [\App\Http\Controllers\Admin\SiteSettingController::class, 'edit'])->name('settings.edit');
    Route::put('/settings', [\App\Http\Controllers\Admin\SiteSettingController::class, 'update'])->name('settings.update');

    Route::get('/subscribers', [\App\Http\Controllers\Admin\SubscriberController::class, 'index'])->name('subscribers');
    Route::delete('/subscribers/{subscriber}', [\App\Http\Controllers\Admin\SubscriberController::class, 'destroy'])->name('subscribers.destroy');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';

// Enquiry Submission
Route::post('/enquire', [FrontendController::class, 'submitEnquiry'])->name('frontend.enquire');
Route::post('/subscribe', [FrontendController::class, 'subscribe'])->name('frontend.subscribe');
Route::get('/download-brochure/{id}', [FrontendController::class, 'downloadBrochure'])->name('frontend.download_brochure');

// Static Pages
Route::get('/about', [FrontendController::class, 'about'])->name('frontend.about');
Route::get('/contact', [FrontendController::class, 'contact'])->name('frontend.contact');

// Blog Pages
Route::get('/blogs', [FrontendController::class, 'blogs'])->name('frontend.blogs');
Route::get('/blogs/{category_slug}/{slug}', [FrontendController::class, 'blogDetail'])->name('frontend.blog_detail');

// Catch-all dynamic slug routes
Route::get('/sitemap.xml', [FrontendController::class, 'sitemap'])->name('sitemap');
Route::get('/{category_slug}/{slug}', [FrontendController::class, 'resalePropertyDetail'])->name('frontend.resale_detail');
Route::get('/{slug}/{type}', [FrontendController::class, 'dynamicSlugWithType'])->name('frontend.dynamic.type');
Route::get('/{slug}', [FrontendController::class, 'dynamicSlug'])->name('frontend.dynamic');
