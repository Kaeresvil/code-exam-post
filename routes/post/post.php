<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Post\PostController;


Route::apiResource('posts', PostController::class);

