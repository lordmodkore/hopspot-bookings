<?php
use App\Http\Controllers\Auth\LoginController;

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\IndexController;
use Inertia\Inertia;
use App\Http\Middleware\RedirectIfAuthenticated;
use App\Http\Controllers\Auth\SocialAuthController;
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Auth\ResetPasswordController;
Route::middleware(RedirectIfAuthenticated::class)->group(function () {
    Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
});

Route::get('/password-reset', [ForgotPasswordController::class, 'showLinkRequestForm'])->name('password.reset.form');
Route::post('/send-password-reset-email', [ForgotPasswordController::class, 'sendResetLinkEmail'])->name('password.email');

Route::get('password-reset/{token}', [ResetPasswordController::class, 'showResetForm'])->name('password.reset');
Route::post('password-update', [ResetPasswordController::class, 'reset'])->name('password.update');

Route::middleware(['web'])->group(function () {
    Route::post('/process-login', [LoginController::class, 'processLogin'])->name('processLogin');
});


Route::middleware(['auth'])->group(function () {
    Route::get('/', [IndexController::class, 'index'])->name('home');
    // Add other protected routes here
});



Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
Route::get('/logout', [LoginController::class, 'logout'])->name('logout');




Route::get('auth/google', [SocialAuthController::class, 'redirectToGoogle'])->name('auth.google');
Route::get('auth/google/callback', [SocialAuthController::class, 'handleGoogleCallback']);
Route::get('auth/facebook', [SocialAuthController::class, 'redirectToFacebook'])->name('auth.facebook');
Route::get('auth/facebook/callback', [SocialAuthController::class, 'handleFacebookCallback']);

