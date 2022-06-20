<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\TodoController;
use Illuminate\Support\Facades\Route;

// Route::group(['middleware' => 'auth:api'], function () { 
    Route::apiResource('todos', TodoController::class);
    Route::put('todos/completed/{todo}', [TodoController::class, 'completed']);
// });

Route::controller(AuthController::class)->group(function () {
    Route::post('login', 'login')->name('login');
    Route::post('register', 'register');
    Route::post('logout', 'logout');
    Route::post('refresh', 'refresh');
});
