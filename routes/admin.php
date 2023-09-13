<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\UserController;




Route::get('/',function (){

})->name('admin.home');

// users

Route::resource('users', UserController::class, ['as' => 'admin']);
        