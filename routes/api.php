<?php

use App\Http\Controllers\API\V1\Auth\LoginAction;
use App\Http\Controllers\API\V1\Auth\RegisterAction;
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


Route::middleware('guest')->prefix('auth')->name('auth.')->group(function () {
    Route::post('register', RegisterAction::class)->name('register');
    Route::post('login', LoginAction::class)->name('login');
});
