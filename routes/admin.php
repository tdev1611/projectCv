<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\NotifyController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\CategoryProductController;
use App\Http\Controllers\Admin\ColorController;
use App\Http\Controllers\Admin\SizeController;
use App\Http\Controllers\Admin\DiscountCodeController;
use App\Http\Controllers\Admin\OrderController;

Route::get('/', function () {
})->name('admin.home');

// notify

Route::resource('notify', NotifyController::class, ['as' => 'admin']);


// users

Route::resource('users', UserController::class, ['as' => 'admin']);
Route::get('users/delete/{id}', [UserController::class, 'delete'])->name('admin.users.delete');
Route::post('users-action', [UserController::class, 'action'])->name('admin.users.action');


// products
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


//discount code
Route::resource('discount-code', DiscountCodeController::class, ['as' => 'admin']);
Route::get('discount-code/delete/{id}', [DiscountCodeController::class, 'delete'])->name('admin.discount-code.delete');


// orders

Route::resource('orders', OrderController::class, ['as' => 'admin']);
Route::get('orders/delete/{id}', [OrderController::class, 'delete'])->name('admin.orders.delete');