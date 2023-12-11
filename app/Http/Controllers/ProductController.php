<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Yajra\DataTables\Facades\DataTables;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $data = Product::orderBy('nama_produk', 'asc');
        return DataTables::of($data)
        ->addIndexColumn()
        ->addColumn('aksi', function($data){
            return view('master.product.tombol')->with('data', $data);
        })
        ->make(true);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $data = Category::all();
        return view('master.product.tambah', ['title' => 'Tambah Produk', 'kategori' => $data]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        // ddd($request->file('gambar'));
        $validasi = $request->validate([
            'id_kategori' => 'required',
            'nama_produk' => 'required',
            'deskripsi' => 'required',
            'harga' => 'required',
            'gambar_produk' => 'image|file|max:1024'
        ]);
        

        if($request->file('gambar_produk')){
            $validasi['gambar_produk'] = $request->file('gambar_produk')->store('gambar-produk');
        }

        Product::create($validasi);
        return redirect('/produk')->with('success', 'data berhasil di tambahkan');
        // dd($validasi);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        $product = Product::where('id', $id)->first();
        return response()->json(['product' => $product]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        //
        // return $product->id;
        return view('master.product.edit', [
            'title' => 'Edit Produk',
            'produk' => Product::where('id', $product->id)->first(),
            'kategori' => Category::all()
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product)
    {
        //

        $validasi = $request->validate([
            'id_kategori' => 'required',
            'nama_produk' => 'required',
            'deskripsi' => 'required',
            'harga' => 'required',
            'gambar_produk' => 'image|file|max:1024'
        ]);
        

        if($request->file('gambar_produk')){
            Storage::delete($request->oldImage);
            $validasi['gambar_produk'] = $request->file('gambar_produk')->store('gambar-produk');
        }

        Product::where('id', $product->id)->update($validasi);
        return redirect('/produk')->with('success', 'data berhasil di Update');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        //
        Product::where('id', $product->id)->delete();
        Storage::delete($product->gambar_produk);
        return response()->json(['result' => 'Data Berhasil dihapus!']);
    }
}
