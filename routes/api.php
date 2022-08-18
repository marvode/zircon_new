<?php

use App\Http\Controllers\Api\AddressController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\CategoryController;
use App\Http\Controllers\Api\FoodItemController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\OrderItemController;
use App\Http\Controllers\VerifyOrderController;

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
Route::post('auth/register', [AuthController::class, 'register'])->middleware(['guest']);
Route::post('auth/logout', [AuthController::class, 'logout'])->middleware(['auth:sanctum']);
Route::get('auth/user', [AuthController::class, 'user'])->middleware(['auth:sanctum']);
Route::put('auth/user/edit-details', [AuthController::class, 'edit'])->middleware(['auth:sanctum']);

Route::get('is-logged-in', [AuthController::class, 'isLoggedIn'])->middleware(['auth:sanctum']);

Route::put('auth/change-password', [AuthController::class, 'changePassword'])->middleware(['auth:sanctum']);


Route::group([], function () {
    Route::get('/category', [CategoryController::class, 'index']);
    Route::get('/category/{category}', [CategoryController::class, 'show']);

    Route::get('/fooditem', [FoodItemController::class, 'index']);
    Route::get('/fooditem/{fooditem}', [FoodItemController::class, 'show']);

    Route::post('/user/address', [AddressController::class, 'store'])->middleware(['auth:sanctum']);
    Route::put('/user/address', [AddressController::class, 'update'])->middleware(['auth:sanctum']);
    Route::delete('/user/address/{id}', [AddressController::class, 'destroy'])->middleware(['auth:sanctum']);
    Route::put('/user/address/make-default', [AddressController::class, 'makeDefault'])->middleware(['auth:sanctum']);
});

Route::group(['middleware' => 'auth:sanctum'], function () {
    Route::get('/user/address', [AddressController::class, 'index']);

    Route::post('/order', [OrderController::class, 'store']);
    Route::post('/orderitem', [OrderItemController::class, 'store']);
    Route::post('/verify/order/{order}', [VerifyOrderController::class, 'call']);
});

Route::group(['middleware' => 'auth:sanctum', 'prefix' => 'admin'], function () {
    Route::post('/category', [CategoryController::class, 'store']);
    Route::put('/category/{category}', [CategoryController::class, 'update']);

    Route::post('/fooditem', [FoodItemController::class, 'store']);
    Route::post('/fooditem/{fooditem}', [FoodItemController::class, 'update']);
});
