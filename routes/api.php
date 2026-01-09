<?php

use App\Http\Controllers\Api\Auth\AuthController;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\CategoryController;
use App\Http\Controllers\Api\EmailVerificationController;
use App\Http\Controllers\Api\PlaceController;
use App\Http\Controllers\Api\ReviewController;
use App\Http\Controllers\Api\SaveController;
use Illuminate\Support\Facades\Route;

Route::post('/auth/register', [AuthController::class, 'store']);
Route::post('/auth/login', [AuthController::class, 'login']);
Route::post('/auth/logout', [AuthController::class, 'logout']);

// Verify email (from email link)
Route::get('/email/verify/{id}/{hash}', [EmailVerificationController::class, 'verify'])->middleware(['signed'])->name('verification.verify');
Route::post('/email/resend', [EmailVerificationController::class, 'resend'])
    ->middleware(['auth', 'throttle:6,1']) // 6 attempts per minute
    ->name('verification.send');

// Fetch all tourist spots
Route::resource('places', PlaceController::class, ['only' => ['index', 'show']]);

// Fetch reviews of each places
Route::get('/places/{place}/reviews', [ReviewController::class, 'index']);

// Fetch all categories
Route::get('/categories', [CategoryController::class, 'index']);

Route::middleware(['api.auth', 'active', 'isUser'])->group(function () {

    // User saved a place
    Route::post('/places/{place}/handle-save', [SaveController::class, 'handleSavingPlaces']);

    // Fetch User's saved places
    Route::get('/users/saved-places', [PlaceController::class, 'getSavedPlaces']);

    // User write a review for a tourist spot
    Route::post('/places/{place:id}/reviews', [ReviewController::class, 'store']);

    // User update his review
    Route::put('/reviews/{review:id}', [ReviewController::class, 'update']);

    // User delete his review
    Route::delete('/reviews/{review:id}', [ReviewController::class, 'destroy']);

    // User's profile
    Route::get('/users/me', [UserController::class, 'me']);

    // Update username and profile img
    Route::put('/users/update', [UserController::class, 'update']);

    // Update password
    Route::put('/users/change-password', [UserController::class, 'changePassword']);
});
