<?php

use App\Http\Controllers\Api\authApiController;
use App\Http\Controllers\Api\ProductApiController;
use App\Http\Resources\authApiResource;
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

Route::middleware(['auth:sanctum'])->group(function () {
    //PRODUCT API
    Route::get('/product', [ProductApiController::class, 'index']);
    Route::get('/product/{id}', [ProductApiController::class, 'show']);
    Route::get('/product/show/{category:id}', [ProductApiController::class, 'showByCategories']);
    Route::post('product', [ProductApiController::class, 'store']);

    //AUTH LOGOUT
    Route::get('/logout', [authApiController::class, 'logout']);
});



Route::post('/login', [authApiController::class, 'login']);


Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
