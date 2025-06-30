<?php

use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\PlaceController;
use Illuminate\Support\Facades\Route;

Route::get('/admin', function () {
    return view('admin.index');
});

Route::prefix('admin/places')->name('admin.places.')->group(function () {
    Route::get('/', [PlaceController::class, 'index'])->name('index');
    Route::get('/create', [PlaceController::class, 'create'])->name('create');
    Route::post('/', [PlaceController::class, 'store'])->name('store');
    Route::get('/{place}/edit', [PlaceController::class, 'edit'])->name('edit');
    Route::put('/{place}', [PlaceController::class, 'update'])->name('update');
    Route::delete('/{place}', [PlaceController::class, 'destroy'])->name('destroy');
});

Route::prefix('admin/categories')->name('admin.categories.')->group(function () {
    Route::get('/', [CategoryController::class, 'index'])->name('index');
    Route::get('/create', [CategoryController::class, 'create'])->name('create');
    Route::post('/', [CategoryController::class, 'store'])->name('store');
    Route::get('/{category}/edit', [CategoryController::class, 'edit'])->name('edit');
    Route::put('/{category}', [CategoryController::class, 'update'])->name('update');
    Route::delete('/{category}', [CategoryController::class, 'destroy'])->name('destroy');
});
