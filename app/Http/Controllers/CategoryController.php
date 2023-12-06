<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Yajra\DataTables\Contracts\DataTable;
use Yajra\DataTables\Facades\DataTables;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
        // return view('master.category.index', [
        //     'title' => 'Data Kategori',
        //     'kategori' => Category::all()
        // ]);

        $data = Category::orderBy('nama_kategori', 'asc');
        return DataTables::of($data)
        ->addIndexColumn()
        ->addColumn('aksi', function($data){
            return view('master.category.tombolAjax')->with('data', $data);
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
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //validasi
        $validasi = Validator::make($request->all(), [
            'nama_kategori' => 'required',
            'slug' => 'required',
        ], [
            'nama_kategori.required' => 'Data Wajib di isi',
            'slug.required' => 'Data Wajib di isi',
        ]);

        if($validasi->fails()){
            return response()->json(['errors' => $validasi->errors()]);
        }else{
            $data = [
                'nama_kategori' => $request->nama_kategori,
                'slug' => $request->slug
            ];
            Category::create($data);

            return response()->json(['success' => 'Data Berhasil Di Tambahkan']);

        }

       
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function show(Category $category)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $data = Category::where('id', $id)->first();
        return response()->json(['result' => $data]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        //validasi
        $validasi = Validator::make($request->all(), [
            'nama_kategori' => 'required',
            'slug' => 'required',
        ], [
            'nama_kategori.required' => 'Data Wajib di isi',
            'slug.required' => 'Data Wajib di isi',
        ]);

        if($validasi->fails()){
            return response()->json(['errors' => $validasi->errors()]);
        }else{
            $data = [
                'nama_kategori' => $request->nama_kategori,
                'slug' => $request->slug
            ];

            // dd($data);
            Category::where('id', $id)->update($data);

            return response()->json(['success' => 'Data Berhasil Di Update']);

        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $category, $id)
    {
        //
        Category::where('id', $id)->delete();
        return response()->json(['success' => 'Data Berhasil dihapus!']);
    }
}
