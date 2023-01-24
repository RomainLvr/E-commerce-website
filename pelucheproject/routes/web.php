<?php

use App\Http\Controllers\ProductsController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ThemeController;
use App\Http\Controllers\MenuController;
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


Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
