<?php

use App\Http\Controllers\CarController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
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

Route::get('/profile/{user}', [UserController::class, 'show'])
    ->name('profile.show');
