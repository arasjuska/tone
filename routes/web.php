<?php

use App\Http\Controllers\GiftCardValidationController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::prefix('admin')
        ->name('admin.')
        ->group(function () {
            Route::middleware(['throttle:5,1'])
                ->get('/gift-cards/{record}/validate/{token}', [GiftCardValidationController::class, 'validateGiftCard'])
                ->name('gift-cards.validate');
        });

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
