<?php

use App\Http\Controllers\API\V1\Auth\LoginAction;
use App\Http\Controllers\API\V1\Auth\RegisterAction;
use App\Http\Controllers\API\V1\ProductController;
use App\Http\Controllers\API\V1\ProductLinkController;
use App\Http\Controllers\API\V1\ProductVisitCountAction;
use App\Http\Controllers\API\V1\ProductVisitCountController;
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


Route::name('api.')->group(function () {
    Route::middleware('guest')->prefix('auth')->name('auth.')->group(function () {
        Route::post('register', RegisterAction::class)->name('register');
        Route::post('login', LoginAction::class)->name('login');
    });

    Route::middleware('auth:sanctum')->group(function () {
        Route::get('products/visits-count', [ProductVisitCountController::class, 'index'])->name('count-visit-product.index');
        Route::get('products/{product}/visits-count', [ProductVisitCountController::class, 'show'])->name('count-visit-product.show');
        Route::apiResource('products', ProductController::class);
        Route::apiResource('products.links', ProductLinkController::class);
    });
});
