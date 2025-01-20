<?php

use App\Http\Controllers\Admin\ProductCategoryController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;

Route::get('/login', [AuthController::class, 'loginUser'])->name('login');
Route::get('/admin/login', [AuthController::class, 'loginAdmin'])->name('admin.login');
Route::post('/login', [AuthController::class, 'login']);
Route::get('/logout', [AuthController::class, 'logout'])->name('logout');

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/products', [ProductController::class, 'productIndex']);
Route::get('/product/{id}', [ProductController::class, 'detailProduct'])->name('product-detail');

Route::middleware('auth')->group(function () {
    Route::get('/my-profile', [AuthController::class, 'myProfile'])->name('my-profile');
    Route::post('/my-profile', [AuthController::class, 'updateProfile'])->name('update-profile');
    Route::get('/keranjang', [HomeController::class, 'keranjang'])->name('keranjang');
    Route::post('/update-keranjang', [HomeController::class, 'updateKeranjang'])->name('update-keranjang');
    Route::get('/tambahkan-keranjang', [HomeController::class, 'addToCart'])->name('tambahkan-keranjang');
    Route::get('/masukkan-wishlist', [HomeController::class, 'addToWishlist'])->name('masukkan-wishlist');
    Route::get('/hapus-wishlist', [HomeController::class, 'removeFromWishlist'])->name('hapus-wishlist');
    Route::get('/checkout', [HomeController::class, 'checkout'])->name('checkout');
    Route::post('/checkout', [HomeController::class, 'processCheckout'])->name('processCheckout');
});

Route::prefix('admin')->middleware('auth')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    Route::prefix('/product-category')->controller(ProductCategoryController::class)->group(function () {
        Route::get('/', 'index')->name('product-category');
        Route::get('/create', 'create')->name('product-category.create');
        Route::get('/edit/{id}', 'edit')->name('product-category.edit');
        Route::post('/store', 'store')->name('product-category.store');
        Route::put('/update/{id}', 'update')->name('product-category.update');
        Route::delete('/destroy/{id}', 'destroy')->name('product-category.destroy');
    });

    Route::prefix('/products')->controller(ProductController::class)->group(function () {
        Route::get('/', 'index')->name('products');
        Route::get('/create', 'create')->name('products.create');
        Route::get('/edit/{id}', 'edit')->name('products.edit');
        Route::post('/store', 'store')->name('products.store');
        Route::put('/update/{id}', 'update')->name('products.update');
        Route::delete('/destroy/{id}', 'destroy')->name('products.destroy');
    });
});
