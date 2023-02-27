<?php

use App\Http\Controllers\ProductsController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ThemeController;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\CartController;
use Illuminate\Support\Facades\Route;

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
    return view('accueil');
});

Route::get('/setTheme', [ThemeController::class, 'setTheme'])->name('setTheme');

Route::get('/accueil', [MenuController::class, 'index'])->name('accueil');

Route::get('/produits', [ProductsController::class, 'showProducts'])->name('produits');

Route::get('/produit{id}', [ProductController::class, 'showProduct'])->name('produit');

Route::get('/filterProducts', [ProductsController::class, 'filter'])->name('filterProducts');

Route::get('/login', function () {
    return view('login');
});

Route::get('/logout', function () {
    return view('logout');
});

Route::get('/register', function () {
    return view('register');
});

Route::get('/addToCart', [CartController::class, 'store'])->name('addToCart');

Route::get('/cart', [CartController::class, 'show'])->name('cart');

Route::get('/deleteFromCart', [CartController::class, 'destroy'])->name('deleteFromCart');

Route::get('/incProduct', [CartController::class, 'incProduct'])->name('incProduct');

Route::get('/decProduct', [CartController::class, 'decProduct'])->name('decProduct');

Route::get('/removeProduct', [CartController::class, 'removeProduct'])->name('removeProduct');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::patch('/profile', [ProfileController::class, 'avatar'])->name('profile.avatar');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
