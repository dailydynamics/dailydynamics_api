<?php

use App\Http\Controllers\ApiAuthController;
use App\Http\Controllers\BannerController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\Dashboard\ContactController;
use App\Http\Controllers\LocationController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\UserController;
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

// ***************ROUTES FOR DASHBOARD ****************************************
Route::middleware(['cors'])->prefix('dashboard')->group(function () {
    Route::prefix('contacts')->group(function () {
        Route::get('/', [ContactController::class, 'list']);
        Route::get('{contact}', [ContactController::class, 'show']);
    });
    Route::resource('banner', BannerController::class)->middleware(['cors']);
    Route::resource('book', BookingController::class)->middleware(['cors']);
    Route::resource('location', LocationController::class)->middleware(['cors']);
    Route::resource('notification', NotificationController::class)->middleware(['cors']);
    Route::resource('user', UserController::class)->middleware(['cors']);
});


// ****************************************************************************
// ******************ROUTES FOR WEBSITE*********************************

Route::post('wesite/contact', [ContactController::class, 'store']);


// *********************************************************************

// *************ROUTES FOR MOBILE APP ************************

Route::post('login', [ApiAuthController::class, 'login']);
Route::post('register', [ApiAuthController::class, 'register']);

Route::middleware('auth:sanctum')->group(
    function () {
        Route::prefix('me')->group(function () {
            Route::get('/', [ApiAuthController::class, 'me']);
            Route::delete('delete', [ApiAuthController::class, 'destroy']);
            Route::delete('update', [ApiAuthController::class, 'update']);
            Route::put('password', [ApiAuthController::class, 'updatePassword']);
        });
        Route::prefix('banner')->group(function () {
            Route::get('top', [BannerController::class, 'recent']);
        });
        Route::prefix('book')->group(function () {
            Route::post('/', [BookingController::class, 'store']);
            Route::get('{booking}', [BookingController::class, 'show']);
            Route::get('history', [BookingController::class, 'history']);
        });
        Route::get('location', [LocationController::class, 'index']);
        Route::get('notification/me', [NotificationController::class, 'history']);
    }
);


// **********************************************************************************
