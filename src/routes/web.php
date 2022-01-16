<?php


use Teampro\OneAuth\Http\Controllers\OneAuthController;
use Illuminate\Support\Facades\Route;

Route::group([
    'middleware' => 'web',
    'prefix' => 'one',
], function () {
    Route::get("/auth", [OneAuthController::class, 'auth'])->name('one.auth');
    Route::get("/login", [OneAuthController::class, 'login'])->name('one.login');
});
