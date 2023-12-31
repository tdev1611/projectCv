<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\IntroduceController;
use App\Http\Controllers\Admin\NotifyController;
use App\Http\Controllers\Admin\SettingController;
use App\Http\Controllers\Admin\BannerController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\CategoryProductController;
use App\Http\Controllers\Admin\ColorController;
use App\Http\Controllers\Admin\SizeController;
use App\Http\Controllers\Admin\DiscountCodeController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\Admin\IpController;




Route::get('/', [DashboardController::class, 'index'])->name('admin.home');


// notify

Route::resource('notify', NotifyController::class, ['as' => 'admin']);

// admin.introduces.create
Route::resource('introduces', IntroduceController::class, ['as' => 'admin']);

// setting
Route::resource('setting', SettingController::class, ['as' => 'admin']);

// slider banner

Route::resource('banners', BannerController::class, ['as' => 'admin']);
Route::get('banner/delete/{id}', [BannerController::class, 'delete'])->name('admin.banners.delete');





// users

Route::resource('users', UserController::class, ['as' => 'admin']);
Route::get('users/delete/{id}', [UserController::class, 'delete'])->name('admin.users.delete');
Route::post('users-action', [UserController::class, 'action'])->name('admin.users.action');


// products
Route::resource('products', ProductController::class, ['as' => 'admin']);
Route::get('products/delete/{id}', [ProductController::class, 'delete'])->name('admin.products.delete');
Route::post('products-action', [ProductController::class, 'action'])->name('admin.products.action');
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

// admin.ip-adress.index

Route::resource('ip-adress', IpController::class, ['as' => 'admin']);
Route::get('ip-adress/delete/{id}', [IpController::class, 'delete'])->name('admin.ip-adress.delete');
