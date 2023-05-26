<?php

use App\Http\Controllers\FrontEnd\DashboardController;
use App\Http\Controllers\FrontEnd\SigninController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/signin', [SigninController::class, 'index'])->name('login');
Route::get('/signup', [SigninController::class, 'signup'])->name('register');

Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
Route::get('/photos/detail/{id}', [DashboardController::class, 'detail'])->name('photos.detail');
