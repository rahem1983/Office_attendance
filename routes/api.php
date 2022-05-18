<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\UserController;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::controller(AdminController::class)->group(function () {
    Route::post('setUser', 'setUser');
    Route::get('getTodayAttendance', 'getTodayAttendance');
    Route::get('getUserId', 'getUserId');
    Route::post('setIpHost', 'setIpHost');
    Route::post('getIpHost', 'getIpHost');
    Route::post('giveAttendance', 'giveAttendance');
});

Route::controller(UserController::class)->group(function () {
    Route::get('getQr', 'getQr');
    // Route::post('/restaurantSignup', 'Signup');
});
