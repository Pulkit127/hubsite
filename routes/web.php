<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\VideoController;
use App\Http\Controllers\Admin\PlanController;
use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Frontend\HomeController;
use App\Http\Controllers\Frontend\FrontAuthController;
use App\Http\Controllers\Frontend\FrontProfileController;
use App\Http\Controllers\Frontend\FrontPlanController;
use App\Http\Controllers\Admin\MusicController;
use App\Http\Controllers\Admin\PageController;
use App\Http\Controllers\Admin\AdBannerController;



/*
|--------------------------------------------------------------------------
| Admin Routes
|--------------------------------------------------------------------------
*/

Route::prefix('admin')->group(function () {

    // Guest admin routes (login/register)
    Route::middleware('guest:admin')->group(function () {
        Route::get('/login', [AuthController::class, 'loginForm'])->name('admin.login');
        Route::post('/login', [AuthController::class, 'login'])->name('admin.login.submit');

        Route::get('/register', [AuthController::class, 'registerForm'])->name('admin.register');
        Route::post('/register', [AuthController::class, 'register'])->name('admin.register.submit');
    });

    // Authenticated admin routes
    Route::middleware('auth.admin')->group(function () {
        Route::get('/dashboard', function () {
            return view('admin.dashboard');
        })->name('admin.dashboard');

        Route::resource('users', UserController::class);
        Route::resource('categories', CategoryController::class);
        Route::resource('videos', VideoController::class);
        Route::resource('plans', PlanController::class);
        Route::resource('music', MusicController::class);
        Route::resource('ads', AdBannerController::class);
        Route::resource('pages', PageController::class);


        Route::get('/logout', [AuthController::class, 'logout'])->name('admin.logout');
    });
});


/*
|--------------------------------------------------------------------------
| Frontend Routes
|--------------------------------------------------------------------------
*/

// Guest user routes (home page available for all)
Route::get('/', [HomeController::class, 'home'])->name('frontend.home');
Route::get('/login', [FrontAuthController::class, 'loginForm'])->name('login');
Route::post('/login', [FrontAuthController::class, 'login'])->name('login.submit');

Route::get('/register', [FrontAuthController::class, 'registerForm'])->name('register');
Route::post('/register', [FrontAuthController::class, 'register'])->name('register.submit');

Route::get('/page/{slug}', [HomeController::class, 'show'])->name('page.show');

// Authenticated frontend user routes
Route::middleware('auth')->group(function () {

    Route::get('/search', [HomeController::class, 'searchVideos'])->name('frontend.search');
    Route::middleware('checkPlan')->group(function () {
        Route::get('videos/subcategory/{id}', [HomeController::class, 'subcategory'])->name('videos.subcategory');
        Route::get('music/subcategory/{id}', [HomeController::class, 'musicSubCategory'])->name('music.subcategory');
    });

    Route::get('/download/{id}', [HomeController::class, 'download'])->name('video.download');

    Route::get('/upgrade-plan', [FrontPlanController::class, 'upgrade'])->name('plans.upgrade');
    Route::post('/upgrade-plan/{plan_id}', [FrontPlanController::class, 'upgradeSubmit'])->name('plans.upgrade.submit');
    Route::post('/plans/payment/complete', [FrontPlanController::class, 'completePayment'])->name('plans.payment.complete');

    Route::get('/profile', [FrontProfileController::class, 'index'])->name('profile');
    Route::post('/profile', [FrontProfileController::class, 'update'])->name('profile.update');

    Route::get('/change-password', [FrontProfileController::class, 'changePassword'])->name('change.password');
    Route::post('/change-password', [FrontProfileController::class, 'updatePassword'])->name('password.update');

    Route::post('/logout', [FrontAuthController::class, 'logout'])->name('logout');
});
