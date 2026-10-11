<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\BusinessController;
use App\Http\Controllers\NewsController;
use App\Http\Controllers\SustainabilityController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\Admin\AdminAuthController;
use App\Http\Controllers\Admin\AdminDashboardController;
use App\Http\Controllers\Admin\AdminNewsController;
use App\Http\Controllers\Admin\AdminProductController;
use App\Http\Controllers\Admin\AdminDirectorController;
use App\Http\Controllers\SuperadminController;

/*
|--------------------------------------------------------------------------
| Web Routes - PT. Musashi Auto Parts Indonesia
|--------------------------------------------------------------------------
*/

// Language Switcher (EN / ID / JP) - Instant Native 0ms Server-Side Switch
Route::get('locale/{locale}', function ($locale) {
    if (in_array($locale, ['en', 'id', 'ja'])) {
        session(['locale' => $locale]);
        app()->setLocale($locale);
        cookie()->queue(cookie()->forget('googtrans'));
        cookie()->queue('googtrans', '', -1, '/');
    }
    return redirect()->back();
})->name('locale.switch');

// 1. Home
Route::get('/', [HomeController::class, 'index'])->name('home');

// 2. Company Module
Route::prefix('company')->name('company.')->group(function () {
    Route::get('about-us', [CompanyController::class, 'about'])->name('about');
    Route::get('corporate-message', [CompanyController::class, 'message'])->name('message');
    Route::get('philosophy', [CompanyController::class, 'philosophy'])->name('philosophy');
    Route::get('global-vision', [CompanyController::class, 'vision'])->name('vision');
    Route::get('company-outline', [CompanyController::class, 'outline'])->name('outline');
    Route::get('board-of-directors', [CompanyController::class, 'bod'])->name('bod');
    Route::get('network', [CompanyController::class, 'network'])->name('network');
});

// 3. Product Module
Route::prefix('product')->name('product.')->group(function () {
    Route::get('/', [ProductController::class, 'index'])->name('index');
    Route::get('{slug}', [ProductController::class, 'show'])->name('show');
});

// 4. Business Module (Mobility, Industry, Energy, Well-being, Technology & Innovation)
Route::prefix('business')->name('business.')->group(function () {
    Route::get('mobility', [BusinessController::class, 'mobility'])->name('mobility');
    Route::get('industry', [BusinessController::class, 'industry'])->name('industry');
    Route::get('energy', [BusinessController::class, 'energy'])->name('energy');
    Route::get('well-being', [BusinessController::class, 'wellbeing'])->name('wellbeing');
    Route::get('technology', [BusinessController::class, 'technology'])->name('technology');
    Route::get('innovation', [BusinessController::class, 'innovation'])->name('innovation');
});

// Direct Musashi.co.id URL Aliases (Case-insensitive support)
Route::get('mobility', [BusinessController::class, 'mobility']);
Route::get('industry', [BusinessController::class, 'industry']);
Route::get('Industry', [BusinessController::class, 'industry']);
Route::get('energy', [BusinessController::class, 'energy']);
Route::get('Energy', [BusinessController::class, 'energy']);
Route::get('well-being', [BusinessController::class, 'wellbeing']);
Route::get('Well-being', [BusinessController::class, 'wellbeing']);
Route::get('technology', [BusinessController::class, 'technology']);
Route::get('Technology', [BusinessController::class, 'technology']);
Route::get('innovation', [BusinessController::class, 'innovation']);
Route::get('Innovation', [BusinessController::class, 'innovation']);

// 5. News Module
Route::prefix('news')->name('news.')->group(function () {
    Route::get('/', [NewsController::class, 'index'])->name('index');
    Route::get('{slug}', [NewsController::class, 'show'])->name('show');
});

// 6. Sustainability Module
Route::get('sustainability', [SustainabilityController::class, 'index'])->name('sustainability.index');

// 7. Contact Us Completely Removed (Redirect to Home)
Route::redirect('contact', '/')->name('contact.index');

// 8. Unified Superadmin Musashi Portal (Landing Page CMS & Full Database Management)
// Protected by auth middleware: only authenticated admins can access
Route::prefix('SuperadminMusashi')->middleware('auth')->group(function () {
    // Main Unified Dashboard & CMS
    Route::get('/', [SuperadminController::class, 'index'])->name('superadmin.index');
    Route::get('/dashboard', [SuperadminController::class, 'index'])->name('admin.dashboard');
    Route::post('/update', [SuperadminController::class, 'update'])->name('superadmin.update');
    Route::post('/hero/update', [SuperadminController::class, 'updateHero'])->name('superadmin.hero.update');
    Route::post('/hero/slide/delete', [SuperadminController::class, 'deleteHeroSlide'])->name('superadmin.hero.deleteSlide');
    Route::post('/news/{news}/toggle', [SuperadminController::class, 'toggleNews'])->name('superadmin.news.toggle');
    Route::post('/product/{product}/toggle', [SuperadminController::class, 'toggleProduct'])->name('superadmin.product.toggle');

    // Superadmin News CRUD
    Route::post('/news/store', [SuperadminController::class, 'storeNews'])->name('superadmin.news.store');
    Route::post('/news/{news}/update', [SuperadminController::class, 'updateNews'])->name('superadmin.news.update');
    Route::delete('/news/{news}/destroy', [SuperadminController::class, 'destroyNews'])->name('superadmin.news.destroy');

    // Superadmin Products CRUD
    Route::post('/products/store', [SuperadminController::class, 'storeProduct'])->name('superadmin.products.store');
    Route::post('/products/{product}/update', [SuperadminController::class, 'updateProduct'])->name('superadmin.products.update');
    Route::delete('/products/{product}/destroy', [SuperadminController::class, 'destroyProduct'])->name('superadmin.products.destroy');

    // Superadmin Directors CRUD
    Route::post('/directors/store', [SuperadminController::class, 'storeDirector'])->name('superadmin.directors.store');
    Route::post('/directors/{director}/update', [SuperadminController::class, 'updateDirector'])->name('superadmin.directors.update');
    Route::delete('/directors/{director}/destroy', [SuperadminController::class, 'destroyDirector'])->name('superadmin.directors.destroy');

    // News CRUD (Resource)
    Route::resource('news', AdminNewsController::class)->names('admin.news');
    
    // Products CRUD (Resource)
    Route::resource('products', AdminProductController::class)->names('admin.products');

    // Board of Directors CRUD (Resource)
    Route::resource('directors', AdminDirectorController::class)->names('admin.directors');

    // Logout
    Route::post('logout', [AdminAuthController::class, 'logout'])->name('admin.logout');
});

// Authentication Routes (Dedicated Superadmin Login)
Route::get('SuperadminMusashi/login', [AdminAuthController::class, 'showLoginForm'])->name('login');
Route::post('SuperadminMusashi/login', [AdminAuthController::class, 'login'])->name('login.submit');
Route::get('login', fn () => redirect()->route('login'))->name('superadmin.login');
Route::post('SuperadminMusashi/login/submit', [AdminAuthController::class, 'login'])->name('superadmin.login.submit');

// Case-insensitive redirects for SuperadminMusashi (NO route to /admin exists)
Route::redirect('superadminmusashi', '/SuperadminMusashi');
Route::redirect('superadmin', '/SuperadminMusashi');

