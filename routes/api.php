<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\UserController;
use App\Http\Middleware\apiProtectedRoute;

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

/*Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});*/

Route::post('auth/login', [\App\Http\Controllers\Api\AuthController::class,'login']);
Route::get('/users', [\App\Http\Controllers\Api\UserController::class,'index']);
Route::post('/users/create',[\App\Http\Controllers\Api\UserController::class,'store']);
Route::put('/users/update/{id}',[\App\Http\Controllers\Api\UserController::class,'update']);
Route::delete('/users/delete/{id}',[\App\Http\Controllers\Api\UserController::class,'destroy']);



