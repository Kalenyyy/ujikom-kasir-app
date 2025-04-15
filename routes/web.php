<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CategoryController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('login');
})->name('login');

Route::post('/login-auth', [LoginController::class, 'loginAuth'])->name('login.auth');
Route::get('/logout', [LoginController::class, 'logout'])->name('logout');

Route::middleware('isLogin')->group(function () {

    Route::get('/dashboard', [UserController::class, 'dashboard'])->name('dashboard');

    Route::middleware('isAdmin')->group(function () {
        Route::prefix('users')->name('users.')->group(function () {
            Route::get('/', [UserController::class, 'index'])->name('index');
            Route::post('/store', [UserController::class, 'store'])->name('store');
            Route::get('/edit/{id}', [UserController::class, 'edit'])->name('edit');
            Route::patch('/update/{id}', [UserController::class, 'update'])->name('update');
            Route::delete('/destroy/{id}', [UserController::class, 'destroy'])->name('destroy');
        });

        Route::prefix('products')->name('products.')->group(function () {
            Route::get('/', [ProductController::class, 'index'])->name('index');
            Route::post('/store', [ProductController::class, 'store'])->name('store');
            Route::get('/edit/{id}', [ProductController::class, 'edit'])->name('edit');
            Route::patch('/update/{id}', [ProductController::class, 'update'])->name('update');
            Route::delete('/destroy/{id}', [ProductController::class, 'destroy'])->name('destroy');
        });
    });

    Route::prefix('orders')->name('orders.')->group(function () {
        Route::get('/', [OrderController::class, 'index'])->name('index');
        Route::post('/checkout', [OrderController::class, 'showCheckout'])->name('process');
        Route::post('/checkout/store', [OrderController::class, 'checkout'])->name('store');
        Route::get('/checkout/detail-order/{id}', [OrderController::class, 'showDetailOrder'])->name('detail-order');
        Route::get('detail-order/{id}', [OrderController::class, 'detailPrintOrder'])->name('detail-order');
        Route::get('/checkout/member', [OrderController::class, 'showCheckoutMember'])->name('show-checkout-member');
        Route::post('/checkout/member/store', [OrderController::class, 'storeOrderMember'])->name('store-order-member');




        // Route::get('/edit/{id}', [OrderController::class, 'edit'])->name('edit');
        // Route::patch('/update/{id}', [OrderController::class, 'update'])->name('update');
    });
});
