<?php

use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\CategoryController;
use App\Http\Controllers\Api\EmailVerificationController;
use App\Http\Controllers\Api\PlaceController;
use App\Http\Controllers\Api\ReviewController;
use App\Http\Controllers\Api\SaveController;
use Illuminate\Support\Facades\Route;

Route::post('/users/register', [UserController::class, 'store']);
Route::post('/users/login', [UserController::class, 'login']);

// Verify email (from email link)
Route::get('/email/verify/{id}/{hash}', [EmailVerificationController::class, 'verify'])->middleware(['signed'])->name('verification.verify');
Route::post('/email/resend', [EmailVerificationController::class, 'resend'])
    ->middleware(['auth', 'throttle:6,1']) // 6 attempts per minute
    ->name('verification.send');

   
Route::get('/places', [PlaceController::class, 'index']);
Route::get('/places/{place}/reviews', [ReviewController::class, 'index']);
Route::get('/categories', [CategoryController::class, 'index']);

Route::middleware('auth:sanctum', 'verified')->group(function () {
    Route::post('/places/{place}/handle-save', [SaveController::class, 'handleSavingPlaces']);

    // Review
    Route::post('/places/{place}/reviews', [ReviewController::class, 'store']);
    Route::put('/reviews/{review}', [ReviewController::class, 'update']);
    Route::delete('/user/reviews/{review}', [ReviewController::class, 'destroyByUser']);
});

Route::middleware(['auth:sanctum', 'admin'])->group(function () {

    // Place
    Route::post('/places', [PlaceController::class, 'store']);
    Route::put('/places/{place}', [PlaceController::class, 'update']);
    Route::delete('/places/{place}', [PlaceController::class, 'destroy']);

    // Category
    Route::post('/categories', [CategoryController::class, 'store']);
    Route::put('/categories/{category}', [CategoryController::class, 'update']);
    Route::delete('/categories/{category}', [CategoryController::class, 'destroy']);

    // Admin deletes any review and notifies user
    Route::delete('/admin/reviews/{review}', [ReviewController::class, 'destroyByAdmin']);

    Route::get('/admin', function () {
        return response()->json([
            'message' => 'hi admin'
        ]);
    });
});

// Route::get('/user', function (Request $request) {
//     return $request->user();
// })->middleware('auth:sanctum');
