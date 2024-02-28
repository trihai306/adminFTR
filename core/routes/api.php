<?php

use Illuminate\Http\Request;
use Modules\Core\Http\Controllers\AuthController;

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

Route::post('request-otp', [AuthController::class, 'requestOTP']);
Route::post('verify-otp', [AuthController::class, 'verifyOTP']);
