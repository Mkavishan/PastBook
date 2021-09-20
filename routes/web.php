<?php

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
})->name('welcome');

/**
 * For calling facebook login api.
 */
Route::get('/facebook_auth/redirect', function () {
    return \Laravel\Socialite\Facades\Socialite::driver('facebook')->scopes(['user_photos', 'user_likes'])
        ->redirect();
});

/**
 * Callback url for after user authenticated by facebook.
 */
Route::get('/auth/callback', [\App\Http\Controllers\UserController::class, 'register']);

/**
 * Images add/edit actions.
 */
Route::prefix('images')->middleware('auth')->group(function () {
    Route::post('', [\App\Http\Controllers\ImageController::class, 'store']);
    Route::put('/{image}', [\App\Http\Controllers\ImageController::class, 'edit']);
});

/**
 * Dashboard loading.
 */
Route::get('/dashboard', [\App\Http\Controllers\DashboardController::class, 'view']);
//Route::get('/dashboard', [\App\Http\Controllers\DashboardController::class, 'view'])->middleware('auth');
