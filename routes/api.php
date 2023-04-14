<?php

use App\Http\Controllers\{Api\AuthController, Api\PostController, Api\ProjectController};
use Illuminate\Support\Facades\Route;


Route::post('/registration', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

Route::get('/',[ProjectController::class, 'index']);

Route::group(['prefix' => '/posts'], function () {
    Route::get('/', [PostController::class, 'index']);
    Route::get('/{id}', [PostController::class, 'show']);
});

Route::group(['middleware' => 'auth:sanctum'], function () {
    Route::post('/logout', [AuthController::class, 'logout']);

    Route::group(['prefix' => '/posts'], function () {
        Route::post('/', [PostController::class, 'store']);
        Route::post('/{id}/like', [PostController::class, 'storeLike']);
        Route::delete('/{id}/like', [PostController::class, 'deleteLike']);
    });

    Route::group(['prefix' => '/projects'], function () {
        Route::post('/create', [ProjectController::class, 'store']);
        Route::delete('/{id}/delete', [ProjectController::class, 'destroy']);
    });
});
