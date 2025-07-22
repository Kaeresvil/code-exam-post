<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AuthController;

Route::controller(AuthController::class)->group(function () {

    Route::post('/login', 'login')->name('login'); // Login route
    Route::post('/register', 'register')->name('register'); // Register route
   
    Route::post('/logout', 'logout')->middleware('auth:sanctum')->name('user.logout');
    Route::get('/auth_user', 'authUser')->middleware('auth:sanctum')->name('user.auth_show');
}); 