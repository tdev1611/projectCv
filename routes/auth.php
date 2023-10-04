<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\UserController;
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




// Route::group(['prefix' => 'admin', 'middleware' => ['auth', 'CheckLogin', 'CheckAdmin']], function () {
//     include 'admin.php';
// });



Route::get('/register', [UserController::class, 'registerForm'])->name('auth.register.form');
Route::post('/register', [UserController::class, 'register'])->name('auth.post.register');
Route::get('/login', [UserController::class, 'loginForm'])->name('auth.login.form');
Route::post('/login', [UserController::class, 'login'])->name('auth.post.login');
Route::get('logout', [UserController::class, 'logout'])->name('auth.logout');



Route::get('refresh_captcha', [UserController::class, 'refreshCaptcha'])->name('auth.refresh_captcha');

