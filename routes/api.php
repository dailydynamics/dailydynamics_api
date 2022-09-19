<?php

use App\Http\Controllers\BannerController;
use App\Http\Controllers\Dashboard\ContactController;
use App\Http\Controllers\LocationController;
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


Route::middleware(['cors'])->prefix('dashboard')->group(function () {
    Route::prefix('contacts')->group(function () {
        Route::get('/', [ContactController::class, 'list']);
        Route::get('{contact}', [ContactController::class, 'show']);
        Route::post('store', [ContactController::class, 'store']);
    });
});

Route::resource('banner', BannerController::class)->middleware(['cors']);
Route::resource('location', LocationController::class)->middleware(['cors']);
Route::get('topBanners', [BannerController::class, 'recent']);
