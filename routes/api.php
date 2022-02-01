<?php

use App\Http\Controllers\Api\Cartcontroller;
use App\Http\Controllers\Api\Categoriecontoller;
use App\Http\Controllers\Api\ProductController;
use App\Http\Controllers\Api\Salecontroller;
use App\Http\Controllers\Api\Stockcontroller;
use App\Http\Controllers\Api\Usercontroller;
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
Route::apiResource('users',Usercontroller::class);
Route::apiResource('categories',Categoriecontoller::class);
Route::apiResource('products',ProductController::class);
Route::apiResource('stocks',Stockcontroller::class);
Route::apiResource('sales',Salecontroller::class);
Route::apiResource('carts',Cartcontroller::class);
