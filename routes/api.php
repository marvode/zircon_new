<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\CategoryController;
use App\Http\Controllers\Api\FoodItemController;

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

Route::post('auth/login', [AuthController::class, 'login'])->middleware(['guest']);
Route::post('auth/logout', [AuthController::class, 'logout'])->middleware(['auth:sanctum']);

Route::put('user/profile/change-password', [AuthController::class, 'changePassword'])->middleware(['auth:sanctum']);


Route::group([], function () {
    Route::get('/category', [CategoryController::class, 'index']);
    Route::get('/category/{category}', [CategoryController::class, 'show']);

    Route::get('/fooditem', [FoodItemController::class, 'index']);
    Route::get('/fooditem/{fooditem}', [FoodItemController::class, 'show']);
});

Route::group(['middleware' => 'auth:sanctum', 'prefix' => 'admin'], function () {
    Route::post('/category', [CategoryController::class, 'store']);
    Route::put('/category/{category}', [CategoryController::class, 'update']);

    Route::post('/fooditem', [FoodItemController::class, 'store']);
    Route::post('/fooditem/{fooditem}', [FoodItemController::class, 'update']);
});
