<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\{
    AdminContoller,
    AuthController,
    DashboardController,
    UserController,
    PlaceController,
    CategoryController,
    ReviewController,
    SettingController
};

Route::get('/', fn() => view('welcome'));

Route::prefix('admin')->name('admin.')->group(function () {
    // Auth routes
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);
    Route::get('/register', [AuthController::class, 'register'])->name('register');
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
});

Route::middleware(['web', 'auth', 'role:superadmin,admin,moderator'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Admin-only: Users
    Route::middleware('role:superadmin,admin')->group(function () {
        Route::prefix('/users')->name('users.')->group(function () {
            Route::get('/', [UserController::class, 'index'])->name('index');
            Route::patch('/{user}/changeRole', [UserController::class, 'changeRole'])->name('changeRole');
            Route::patch('/{user}/toggle', [UserController::class, 'toggleStatus'])->name('toggle');
        });

        Route::prefix('settings')->name('settings.')->group(function () {
            Route::get('/', [SettingController::class, 'edit'])->name('edit');
            Route::put('/update', [SettingController::class, 'update'])->name('update');
        });
    });

    // Shared (admin + moderator)
    // Places
    Route::prefix('places')->name('places.')->group(function () {
        Route::get('/', [PlaceController::class, 'index'])->name('index');
        Route::get('/create', [PlaceController::class, 'create'])->name('create');
        Route::post('/', [PlaceController::class, 'store'])->name('store');
        Route::get('/{place}/edit', [PlaceController::class, 'edit'])->name('edit');
        Route::put('/{place}', [PlaceController::class, 'update'])->name('update');
        Route::delete('/{place}', [PlaceController::class, 'destroy'])->name('destroy');

        // Soft delete
        Route::get('/trashed', [PlaceController::class, 'trashed'])->name('trashed');
        Route::patch('/{place}/restore', [PlaceController::class, 'restore'])->name('restore');
        Route::delete('/{place}/force-delete', [PlaceController::class, 'forceDelete'])->name('forceDelete');

        // Images
        Route::delete('/{place}/image', [PlaceController::class, 'destroyMainImage'])->name('image.destroy');
        Route::delete('/{place}/images/{image}', [PlaceController::class, 'destroyImage'])->name('images.destroy');
    });

    // Categories
    Route::prefix('categories')->name('categories.')->group(function () {
        Route::get('/', [CategoryController::class, 'index'])->name('index');
        Route::get('/create', [CategoryController::class, 'create'])->name('create');
        Route::post('/', [CategoryController::class, 'store'])->name('store');
        Route::get('/{category}/edit', [CategoryController::class, 'edit'])->name('edit');
        Route::put('/{category}', [CategoryController::class, 'update'])->name('update');
        Route::delete('/{category}', [CategoryController::class, 'destroy'])->name('destroy');

        Route::get('/trashed', [CategoryController::class, 'trashed'])->name('trashed');
        Route::patch('/{category}/restore', [CategoryController::class, 'restore'])->name('restore');
        Route::delete('/{category}/force-delete', [CategoryController::class, 'forceDelete'])->name('forceDelete');
    });

    // Reviews
    Route::prefix('reviews')->name('reviews.')->group(function () {
        Route::get('/', [ReviewController::class, 'index'])->name('index');
        Route::patch('/{review}/approve', [ReviewController::class, 'approve'])->name('approve');
        Route::patch('/{review}/reject', [ReviewController::class, 'reject'])->name('reject');
        Route::delete('/{review}', [ReviewController::class, 'destroy'])->name('destroy');

        Route::get('/trashed', [ReviewController::class, 'trashed'])->name('trashed');
        Route::patch('/{review}/restore', [ReviewController::class, 'restore'])->name('restore');
        Route::delete('/{review}/force-delete', [ReviewController::class, 'forceDelete'])->name('forceDelete');
    });

    Route::post('/toggle-darkmode', [AdminContoller::class, 'toggleDarkMode'])->name('toggle.darkmode');
});
