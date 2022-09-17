<?php

use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::name('auth.')->group(function () {
    Route::get('login', [AuthController::class, 'login'])->name('login');
    Route::post('login', [AuthController::class, 'loginPost'])->name('login');
    Route::get('forgot-password', [AuthController::class, 'forgotpswd'])->name('forgotpswd');
    Route::post('forgot-password', [AuthController::class, 'forgotPost'])->name('forgotpswd');
});


Route::get('dashboard', function () {
    return view('dashboard.index');
})->name('dashboard');
