<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\DetailProductResource;
use App\Http\Resources\ProductResource;
use App\Models\Product;

class ProductApiController extends Controller
{
    //
    public function index()
    {
        $products = Product::with('categories:id,nama_kategori')->get();
        // dd($products);
        return ProductResource::collection($products);
    }

    public function show($id)
    {
        $product = Product::with('categories:id,nama_kategori')->where('id', $id)->first();
        // dd($product);
        return new DetailProductResource($product);
    }

    public function showByCategories($id_kategori)
    {
        $products = Product::with('categories:id,nama_kategori')->where('id_kategori', $id_kategori)->get();
        // dd($product);
        return DetailProductResource::collection($products);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'nama_produk' => 'required',
            'id_kategori' => 'required',
            'gambar_produk' => 'required',
            'deskripsi' => 'required',
            'harga' => 'required'
        ]);

        Product::create($data);

        return response()->json(['data' => 'data produk berhasil di tambahkan']);
    }
}
