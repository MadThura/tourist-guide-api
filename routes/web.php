<?php


use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\PlaceController;
use App\Http\Controllers\Admin\ReviewController;
use App\Http\Controllers\Admin\UserController;
use Illuminate\Support\Facades\Route;

<<<<<<< HEAD
=======
Route::get('/', function () {
    return view('welcome');
});

Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);
    Route::get('/register', [AuthController::class, 'register'])->name('register');
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
});

Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {

    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    Route::prefix('/users')->name('users.')->group(function () {
        Route::get('/', [UserController::class, 'index'])->name('index');
        Route::patch('/{user}/changeRole', [UserController::class, 'changeRole'])->name('changeRole');
        Route::patch('/{user}/toggle', [UserController::class, 'toggleStatus'])->name('toogle');
    });

    Route::prefix('/places')->name('places.')->group(function () {
        Route::get('/', [PlaceController::class, 'index'])->name('index');
        Route::get('/create', [PlaceController::class, 'create'])->name('create');
        Route::post('/', [PlaceController::class, 'store'])->name('store');
        Route::get('/{place}/edit', [PlaceController::class, 'edit'])->name('edit');
        Route::put('/{place}', [PlaceController::class, 'update'])->name('update');
        Route::delete('/{place}', [PlaceController::class, 'destroy'])->name('destroy');
        Route::get('/trashed', [PlaceController::class, 'trashed'])->name('trashed');
        Route::patch('/{place}/restore', [PlaceController::class, 'restore'])->name('restore');
        Route::delete('/{place}/force-delete', [PlaceController::class, 'forceDelete'])->name('forceDelete');

        //images delete
        Route::delete('/{place}/image', [PlaceController::class, 'destroyMainImage'])->name('image.destroy');
        Route::delete('/{place}/images/{image}', [PlaceController::class, 'destroyImage'])->name('images.destroy');
    });

    Route::prefix('/categories')->name('categories.')->group(function () {
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

    Route::prefix('/reviews')->name('reviews.')->group(function () {
        Route::get('/', [ReviewController::class, 'index'])->name('index');
        Route::patch('/{review}/approve', [ReviewController::class, 'approve'])->name('approve');
        Route::patch('/{review}/reject', [ReviewController::class, 'reject'])->name('reject');
        Route::delete('/{review}', [ReviewController::class, 'destroy'])->name('destroy');

        Route::get('/trashed', [ReviewController::class, 'trashed'])->name('trashed');
        Route::patch('/{review}/restore', [ReviewController::class, 'restore'])->name('restore');
        Route::delete('/{review}/force-delete', [ReviewController::class, 'forceDelete'])->name('forceDelete');
    });
});
>>>>>>> Admin-CM-from-web
