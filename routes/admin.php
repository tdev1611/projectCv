<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\NotifyController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\CategoryProductController;
use App\Http\Controllers\Admin\ColorController;
use App\Http\Controllers\Admin\SizeController;

Route::get('/', function () {
})->name('admin.home');

// notify

Route::resource('notify', NotifyController::class, ['as' => 'admin']);


// users

Route::resource('users', UserController::class, ['as' => 'admin']);


Route::resource('products', ProductController::class, ['as' => 'admin']);
Route::get('products/delete/{id}', [ProductController::class, 'delete'])->name('admin.products.delete');

// category-products
Route::resource('category-products', CategoryProductController::class, ['as' => 'admin']);
Route::get('category-products/delete/{id}', [CategoryProductController::class, 'delete'])->name('admin.category-products.delete');


// colors
Route::resource('colors', ColorController::class, ['as' => 'admin']);
Route::get('colors/delete/{id}', [ColorController::class, 'delete'])->name('admin.colors.delete');

//sizes
Route::resource('sizes', SizeController::class, ['as' => 'admin']);
Route::get('sizes/delete/{id}', [SizeController::class, 'delete'])->name('admin.sizes.delete');
