<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\LogoutController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\MedicalExamController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\SkywayController;
use App\Http\Controllers\UserController;

Route::post('/login', LoginController::class)->name('login');
Route::post('/register', [RegisteredUserController::class, 'store']);

Route::middleware('auth:sanctum')->group(function () {
    Route::post('/logout', LogoutController::class)->name('logout');

    Route::get('user', function (Request $request) {
        return $request->user();
    });

    //医師検索
    Route::get('/search', [SearchController::class, 'search']);

    // *****検査情報*********
    Route::post('/medical-exams', [MedicalExamController::class, 'store']);

    Route::get('/medical-exams/{notificationId}', [MedicalExamController::class, 'show']);

   
    // *****通知**********
    Route::post('/notifications', [NotificationController::class, 'store']);

    Route::get('/notifications', [NotificationController::class, 'index']);

    Route::get('/notifications/{notification}', [NotificationController::class, 'show']);

    Route::put('/notifications/{notification}', [NotificationController::class, 'update']);

    //skywayのデータ取得
    Route::get('/notifications/{notificationId}/skyway-id', [SkywayController::class, 'getSkywayData']);

    //*****ユーザー情報********
    Route::put('/profile-detail', [UserController::class, 'update']);

    Route::get('/get-user-data', [UserController::class, 'getUserData']);


    Route::get('test', function () {
        return response()->json(['message' => 'This is a protected route!']);
    });
});
