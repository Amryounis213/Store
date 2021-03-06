<?php

use App\Http\Controllers\Api\AccessTokensController;
use App\Http\Controllers\Api\CartController;
use App\Http\Controllers\Api\CategoriesController;
use App\Http\Controllers\Api\ProductController;
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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});




Route::post('login', [AccessTokensController::class, 'store']);
Route::delete('login', [AccessTokensController::class, 'destroy'])->middleware('auth:sanctum');


Route::middleware('auth:sanctum')->group(function(){
    Route::apiResource('categories', CategoriesController::class);
    Route::apiResource('products', ProductController::class);
    Route::apiResource('cart' , CartController::class);
});





