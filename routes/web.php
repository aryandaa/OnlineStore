<?php

use App\Http\Controllers\Admin\AdminHomeController;
use App\Http\Controllers\Admin\AdminProductController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\MyAccountController;
use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'index'])->name('home.index');
Route::get('/about', [HomeController::class, 'about'])->name('home.about');
Route::get('/products', [ProductController::class, 'index'])->name('product.index');
Route::get('/products/{id}', [ProductController::class, 'show'])->name('product.show');

Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
Route::get('/cart/delete', [CartController::class, 'delete'])->name('cart.delete');
Route::post('/cart/add/{id}', [CartController::class, 'add'])->name('cart.add');

Route::middleware('guest')->group(function (): void {
    Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [LoginController::class, 'login']);
    Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');
    Route::post('/register', [RegisterController::class, 'register']);
});

Route::post('/logout', [LoginController::class, 'logout'])
    ->middleware('auth')
    ->name('logout');

Route::middleware('auth')->group(function (): void {
    Route::get('/cart/purchase', [CartController::class, 'purchase'])->name('cart.purchase');
    Route::get('/my-account/orders', [MyAccountController::class, 'orders'])->name('myaccount.orders');
});

Route::middleware('admin')->group(function (): void {
    Route::get('/admin', [AdminHomeController::class, 'index'])->name('admin.home.index');
    Route::get('/admin/products', [AdminProductController::class, 'index'])->name('admin.product.index');
    Route::post('/admin/products/store', [AdminProductController::class, 'store'])->name('admin.product.store');
    Route::delete('/admin/products/{id}/delete', [AdminProductController::class, 'delete'])->name('admin.product.delete');
    Route::get('/admin/products/{id}/edit', [AdminProductController::class, 'edit'])->name('admin.product.edit');
    Route::put('/admin/products/{id}/update', [AdminProductController::class, 'update'])->name('admin.product.update');
});
