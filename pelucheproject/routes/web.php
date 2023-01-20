<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\ThemeController;
use App\Http\Controllers\ProductsController;
use App\Http\Controllers\ProductController;

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

Route::get('/setTheme', [ThemeController::class, 'setTheme'])-> name('setTheme');

Route::get('/accueil', [MenuController::class, 'index'])-> name('accueil');

Route::get('/produits', [ProductsController::class, 'showProducts'])-> name('produits');

Route::get('/produit{id}', [ProductController::class, 'showProduct'])-> name('produit');

Route::get('/sortProducts', [ProductsController::class, 'sort'])-> name('sortProducts');

Route::get('searchProducts', [ProductsController::class, 'search'])-> name('searchProducts');