<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Client\WelcomeController;
use App\Http\Controllers\Client\ProductController;

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

Route::get('/', [WelcomeController::class, 'index'])->name('home');


Route::group(['prefix' => 'san-pham'], function () {
    // Route::get('/', 'ProductsController@productShows')->name('productShows');
    // Route::get('/loc-san-pham', 'ProductsController@sortProduct')->name('products.sort');
    // Route::get('/{slug}.html', 'ProductsController@productDetail')->name('productDetail');
    Route::get('/{slug}.html', [ProductController::class, 'show'])->name('client.product.show');
    Route::get('/{slug}', [ProductController::class, 'showProducts'])->name('client.product.byCategory');
    // Route::get('/loc-san-cates/{slug}', 'ProductsController@softProductsByCate')->name('softProductsByCate'); //sortProductBycate--ajax
    // commnent
    // Route::post('products/{product}/comments','ProductsController@comment')->name('comment')->middleware('auth');

});

// Route::group(['prefix' => 'admin', 'middleware' => ['auth', 'CheckLogin', 'CheckAdmin']], function () {
//     include 'admin.php';
// });


Route::group(['prefix' => 'admin'], function () {
    include 'admin.php';
});
