<?php

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

use App\Http\Controllers\AddPostController;
use App\Http\Controllers\RegistrationController;
use Illuminate\Support\Facades\Route;


Route::get('/', [RegistrationController::class, 'index']);
Route::post('/', [RegistrationController::class, 'index'])->name('main');
Route::post('/registration', [RegistrationController::class, 'store'])->name('registration');

Route::get('/post/add', [AddPostController::class, 'index'])->name('post');
Route::post('/post/add', [AddPostController::class, 'store'])->name('post_add');
