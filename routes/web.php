<?php

use App\Models\Product;
use App\Models\Category;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PosController;
use Gloudemans\Shoppingcart\Facades\Cart;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CategoryController;

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
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard.index', [
        'title' => 'Dashboard'
    ]);
});

Route::get('kategori', function () {
    return view('master.category.index', [
        'title' => 'Data Kategori'
    ]);
});
Route::resource('kategoriAjax', CategoryController::class);

Route::get('produk', function () {
    return view('master.product.index', [
        'title' => 'Data Produk'
    ]);
});

Route::resource('product', ProductController::class);

// Route::resource('pos', PosController::class);

//route POS
Route::get('pos', function () {
    return view('pos.index', [
        'title' => 'Point Of Sale',
        'kategori' => Category::all(),
        'produk' => Product::all(),
    ]);
});

Route::get('getProdukAjax', function () {
    return view('pos.product-card', ['produk' => Product::all()]);
});

Route::get('getProdukId/{id}', function ($id) {
    $produk = Product::where('id_kategori', $id)->get();
    return view('pos.product-card', ['produk' => $produk]);
});

//Cart
Route::delete('clear-cart', function () {
    Cart::destroy();
    return view('pos.cart');
});
Route::get('footer-cart', function () {

    return view('pos.footer-cart');
});
Route::resource('cart', PosController::class)->except('index');


Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
// Route::get('/login', [App\Http\Controllers\Auth\LoginController::class, 'index'])->name('login');
