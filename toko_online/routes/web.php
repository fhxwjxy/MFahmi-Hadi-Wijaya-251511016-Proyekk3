<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\KeranjangController;
use App\Http\Controllers\PesananController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\RoleController;
use Illuminate\Support\Facades\Route;

Route::get('/', [ProductController::class, 'index'])->name('produk.index');

Route::get('/stateless', [CartController::class, 'index'])->name('stateless.index');
Route::post('/cart/add', [CartController::class, 'add'])->name('cart.add');
Route::post('/cart/update', [CartController::class, 'update'])->name('cart.update');


Route::middleware(['auth', 'can:manage-roles'])->group(function () {
    Route::get('/admin/users', [RoleController::class, 'index'])
        ->name('admin.users.index');

    Route::patch('/admin/users/{user}/role', [RoleController::class, 'update'])
        ->name('admin.users.role.update');
});

Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);
});

Route::middleware('auth')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

    Route::get('/keranjang', [KeranjangController::class, 'index'])->name('keranjang.index');
    Route::post('/keranjang/kosongkan', [KeranjangController::class, 'kosongkan'])->name('keranjang.kosongkan');
    Route::post('/keranjang/tambah/{id}', [KeranjangController::class, 'tambah'])->name('keranjang.tambah');
    Route::post('/keranjang/{id}/ubah', [KeranjangController::class, 'ubah'])->name('keranjang.ubah');
    Route::post('/keranjang/{id}/hapus', [KeranjangController::class, 'hapus'])->name('keranjang.hapus');

    Route::post('/checkout', [CheckoutController::class, 'proses'])->name('checkout');

    Route::get('/pesanan', [PesananController::class, 'index'])->name('pesanan.index');
    Route::get('/pesanan/{id}', [PesananController::class, 'show'])->name('pesanan.show');
});