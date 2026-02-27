<?php

use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use App\Http\Controllers\Admin\{
    AdminContoller,
    AuthController,
    DashboardController,
    UserController,
    PlaceController,
    CategoryController,
    EmailController,
    ReviewController,
    SettingController
};
use App\Http\Controllers\ContactController;
use App\Http\Controllers\ProfileController;

// public welcome page converted to Inertia
Route::get('/', function () {
    return Inertia::render('Welcome');
});
Route::post('/contact', [ContactController::class, 'send'])->name('contact.send');


Route::controller(AuthController::class)
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {
        // Auth routes
        Route::get('/login', 'showLogin')->name('login');
        Route::post('/login', 'login');
        Route::get('/register', 'register')->name('register');
        Route::post('/logout',  'logout')->name('logout')->middleware(['web.auth']);
    });

Route::middleware(['web.auth', 'active', 'role:superadmin,admin,moderator'])
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {

        Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

        Route::controller(ProfileController::class)
            ->prefix('/profile')
            ->name('profile.')
            ->group(function () {
                Route::get('/edit', 'edit')->name('edit');
                Route::put('/update', 'update')->name('update');

                // Route::get('/password', [ProfileController::class, 'editPassword'])->name('password');
                Route::put('/password', 'updatePassword')->name('password');
            });

        // Admin-only: Users
        Route::middleware('role:superadmin,admin')->group(function () {

            Route::controller(UserController::class)
                ->prefix('/users')
                ->name('users.')
                ->group(function () {
                    Route::get('/', 'index')->name('index');
                    Route::patch('/{user}/changeRole', 'changeRole')->name('changeRole');
                    Route::patch('/{user}/toggle', 'toggleStatus')->name('toggle');
                });

            Route::controller(SettingController::class)
                ->prefix('settings')
                ->name('settings.')
                ->group(function () {
                    Route::get('/', 'edit')->name('edit');
                    Route::put('/update', 'update')->name('update');
                });
        });

        // Shared (admin + moderator)
        // Places
        Route::controller(PlaceController::class)
            ->prefix('places')
            ->name('places.')
            ->group(function () {
                Route::get('/', 'index')->name('index');
                Route::get('/create', 'create')->name('create');
                Route::post('/', 'store')->name('store');
                Route::get('/{place}/edit', 'edit')->name('edit');
                Route::put('/{place}', 'update')->name('update');
                Route::delete('/{place}', 'destroy')->name('destroy');

                // Soft delete
                // Route::get('/trashed', 'trashed')->name('trashed');
                // Route::patch('/{place}/restore', 'restore')->name('restore');
                Route::delete('/{place}/force-delete', 'forceDelete')->name('forceDelete');

                // Images
                Route::delete('/{place}/image', 'destroyMainImage')->name('image.destroy');
                Route::delete('/{place}/images/{image}', 'destroyImage')->name('images.destroy');
            });

        // Categories
        Route::controller(CategoryController::class)
            ->prefix('categories')
            ->name('categories.')
            ->group(function () {
                Route::get('/', 'index')->name('index');
                Route::get('/create', 'create')->name('create');
                Route::post('/', 'store')->name('store');
                Route::get('/{category}/edit', 'edit')->name('edit');
                Route::put('/{category}', 'update')->name('update');
                Route::delete('/{category}', 'destroy')->name('destroy');

                // Route::get('/trashed', 'trashed')->name('trashed');
                // Route::patch('/{category}/restore', 'restore')->name('restore');
                Route::delete('/{category}/force-delete', 'forceDelete')->name('forceDelete');
            });

        // Reviews
        Route::controller(ReviewController::class)
            ->prefix('reviews')
            ->name('reviews.')
            ->group(function () {
                Route::get('/', 'index')->name('index');
                Route::patch('/{review}/approve', 'approve')->name('approve');
                Route::patch('/{review}/reject', 'reject')->name('reject');
                Route::delete('/{review}', 'destroy')->name('destroy');

                // Route::get('/trashed', 'trashed')->name('trashed');
                // Route::patch('/{review}/restore', 'restore')->name('restore');
                Route::delete('/{review}/force-delete', 'forceDelete')->name('forceDelete');
            });


        Route::get('/emails', [EmailController::class, 'index'])->name('emails.index');
        Route::post('/emails/send', [EmailController::class, 'send'])->name('emails.send');

        Route::post('/toggle-darkmode', [AdminContoller::class, 'toggleDarkMode'])->name('toggle.darkmode');
    });
