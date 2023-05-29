<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::post('/v1/login', [\App\Http\Controllers\Auth\AuthController::class, 'login']);
Route::post('/v1/register', [\App\Http\Controllers\Auth\AuthController::class, 'register']);


Route::group(['prefix' => 'v1', 'middleware' => 'auth:api'], function () {
    Route::post('/client/create', [\App\Http\Controllers\Auth\AuthController::class, 'createClient']);
    Route::get('/client/callback/{id}', [\App\Http\Controllers\Auth\AuthController::class, 'callbackClient']);
    Route::apiResource('/orders', \App\Http\Controllers\OrderController::class);
});




