<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

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

Route::get('/', function () {
    if (Auth::user()) {
        return view('home');
    }

    return view('auth.login');
});

Auth::routes();

Route::group(['middleware' => 'auth'], function() {
    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

    Route::get('/products', [App\Http\Controllers\ProductController::class, 'index'])->name('products');

    Route::post('/cart/product/{productId}', [App\Http\Controllers\CartController::class, 'update'])
        ->where('productId', '[0-9]+');
    Route::get('/cart', [App\Http\Controllers\CartController::class, 'show']);

    Route::post('/order', [App\Http\Controllers\OrderController::class, 'store']);
    Route::get('/order', [App\Http\Controllers\OrderController::class, 'index']);
    Route::get('/order/{orderId}', [App\Http\Controllers\OrderController::class, 'show'])
        ->where('orderId', '[0-9]+');
});
