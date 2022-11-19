<?php

use App\Http\Controllers\Admin\BookingController;
use App\Http\Controllers\Admin\ContactController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\LocationController;
use App\Http\Controllers\Admin\NotificationController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\UserRoleController;
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


Route::prefix('admin')->group(function () {
    Route::get('stats', [DashboardController::class, 'userStats']);
    Route::get('recent-bookings', [DashboardController::class, 'recentBookings']);

    Route::resource('contacts', ContactController::class);
    Route::resource('book', BookingController::class);
    Route::resource('location', LocationController::class);
    Route::resource('notification', NotificationController::class);
    Route::resource('user', UserController::class);
    Route::resource('role', UserRoleController::class);
});

Route::prefix('customer')->group(function () {
    # code...
});
