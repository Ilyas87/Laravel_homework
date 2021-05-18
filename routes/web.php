<?php

use App\Http\Controllers\CarController;
use App\Http\Controllers\FavoriteController;
use App\Http\Controllers\LikeController;
use App\Http\Controllers\UserController;
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

require __DIR__.'/auth.php';

Route::get('/', function () {
    return view('layouts.app');
})->name('home');

Route::redirect('/', 'cars');

Route::resource('cars', CarController::class);

Route::prefix('cars/{car}')->group(function() {

    Route::put('removeImage', [CarController::class, 'removeImage'])
        ->name('cars.removeImage');

    Route::get('downloadImage', [CarController::class, 'downloadImage'])
        ->name('cars.downloadImage');

    Route::post('favorite', [FavoriteController::class, 'toggleFavorite'])
        ->middleware('auth')
        ->name('cars.favorite');

    Route::post('like', [LikeController::class, 'toggleLike'])
        ->middleware('auth')
        ->name('cars.like');
});

Route::get('/profile/{user}', [UserController::class, 'show'])
    ->name('profile.show');

Route::get('/profile/{user}/favorite', [FavoriteController::class, 'favorite'])
    ->middleware('auth')
    ->name('favorite');
