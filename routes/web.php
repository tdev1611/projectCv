<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Client\WelcomeController;
use App\Http\Controllers\Client\ProductController;
use App\Http\Controllers\Client\CartController;
use App\Http\Controllers\Client\OrderController;
use App\Http\Controllers\Client\ProfileController;
use App\Http\Controllers\Client\ShippingAddressController;
use App\Http\Controllers\Client\PaymentHistoryController;

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


Route::group(['prefix' => 'thong-tin', 'middleware' => ['auth', 'checkLogin']], function () {
    // info user
    Route::get('/', [ProfileController::class, 'index'])->name('client.profile.index');
    Route::put('/{id}', [ProfileController::class, 'update'])->name('client.profile.update');


    Route::get('/dia-chi', [ShippingAddressController::class, 'index'])->name('client.address.index');
    Route::post('/dia-chi', [ShippingAddressController::class, 'store'])->name('client.address.store');
    Route::post('/cap-nhat-dia-chi', [ShippingAddressController::class, 'update'])->name('client.address.update');


    Route::get('/lich-su-mua-hang', [PaymentHistoryController::class, 'index'])->name('client.history.index');
    Route::get('/lich-su-mua-hang/{code}', [PaymentHistoryController::class, 'show'])->name('client.history.show');
});


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






Route::group(['middleware' => ['auth', 'checkLogin']], function () {
    // cart
    Route::resource('gio-hang', CartController::class, ['as' => 'client']);
    Route::get('/gio-hang-deleteAll', [CartController::class, 'deleleCart'])->name('client.cart.deleleCart');
    Route::get('/gio-hang/delete/{id}', [CartController::class, 'delete'])->name('client.cart.delete');

    // check out
    Route::get('/thanh-toan', [OrderController::class, 'index'])->name('client.checkout.index');
    Route::post('/thanh-toan', [OrderController::class, 'store'])->name('client.checkout.store');
    Route::get('/dat-hang-thanh-cong', [OrderController::class, 'thank'])->name('client.checkout.thank');
});




// Route::group(['prefix' => 'admin', 'middleware' => ['auth', 'CheckLogin', 'CheckAdmin']], function () {
//     include 'admin.php';
// });


Route::group(['prefix' => 'admin'], function () {
    include 'admin.php';
});
