<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\NotifyController;




Route::get('/',function (){

})->name('admin.home');

// notify

Route::resource('notify', NotifyController::class, ['as' => 'admin']);
        



// users

Route::resource('users', UserController::class, ['as' => 'admin']);
        