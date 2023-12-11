<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PosController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CategoryController;
use App\Models\Product;

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

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/dashboard', function () {
    return view('dashboard.index', [
        'title' => 'Dashboard'
    ]);
});

Route::get('kategori', function(){
    return view('master.category.index', [
        'title' => 'Data Kategori'
    ]);
});
Route::resource('kategoriAjax', CategoryController::class);

Route::get('produk', function(){
    return view('master.product.index', [
        'title' => 'Data Produk'
    ]);
});

Route::resource('product', ProductController::class);

Route::resource('pos', PosController::class);

Route::get('getProdukAjax', function(){
    return view('pos.product-card', ['produk' => Product::all()]);
});

Route::get('getProdukId/{id}', function($id){
        $produk = Product::where('id_kategori', $id)->get();
        return view('pos.product-card', ['produk' => $produk]);
});


Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
