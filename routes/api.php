<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\LogoutController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\SearchController;

Route::post('/login', LoginController::class)->name('login');
Route::post('/register', [RegisteredUserController::class, 'store']);

Route::middleware('auth:sanctum')->group(function () {
    Route::post('/logout', LogoutController::class)->name('logout');

    Route::get('user', function (Request $request) {
        return $request->user();
    });

    Route::get('/search', [SearchController::class, 'search']);

    Route::post('/notifications', [NotificationController::class, 'store']);

    Route::get('/notifications', [NotificationController::class, 'index']);




    Route::get('test', function () {
        return response()->json(['message' => 'This is a protected route!']);
    });
});
