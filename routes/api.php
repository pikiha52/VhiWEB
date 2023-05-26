<?php

use App\Http\Controllers\Api\Auth\AuthController;
use App\Http\Controllers\Api\Post\PostController;
use Illuminate\Http\Request;
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

Route::post('/signin', App\Http\Controllers\Api\Auth\AuthController::class)->name('signin');
Route::post('/signup', [AuthController::class, 'storeSignUp'])->name('signup');

Route::get('/photos', [PostController::class, 'index'])->name('photos');
Route::post('/photos', [PostController::class, 'store'])->name('posts.store')->middleware('verifyToken');
Route::get('/photos/{id}', [PostController::class, 'show'])->name('photos.show');
Route::put('/photos/{id}', [PostController::class, 'update'])->name('photos.update')->middleware('verifyToken');
Route::delete('/photos/{id}', [PostController::class, 'delete'])->name('photos.delete')->middleware('verifyToken');
Route::post('/photos/{id}/like', [PostController::class, 'storeLike'])->name('photos.like')->middleware('verifyToken');
Route::post('/photos/{id}/unlike', [PostController::class, 'storeLike'])->name('photos.unlike')->middleware('verifyToken');

