<?php

use App\Http\Controllers\Auth\LoginController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\IndexController;
use Inertia\Inertia;
use App\Http\Middleware\RedirectIfAuthenticated;
use App\Http\Controllers\Auth\SocialAuthController;

Route::middleware(RedirectIfAuthenticated::class)->group(function () {
    Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
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

