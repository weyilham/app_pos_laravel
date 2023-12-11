@extends('layouts.main')
@push('style')
    <style>
        form input {
            border-color: rgb(204, 204, 204) !important;
        }

        form input:focus {
            border-color: rgb(51, 101, 238) !important;
            /* box-shadow: 5px 3px 9px red; */

        }

        form select {
            border-color: rgb(204, 204, 204) !important;
        }
    </style>
@endpush
@section('content')
    <div class="col-md-12">
        <div class="card shadow" style="background-color: #fcfcfc">
            <div class="card-header">
                <h4>Form Tambah Data Produk</h4>
            </div>

            <div class="card-body">
                <form action="/product" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="row mb-3">
                        <label for="nama_produk" class="col-sm-2 col-form-label">Nama Produk</label>
                        <div class="col-sm-10">
                            <input type="text" name="nama_produk"
                                class="form-control @error('nama_produk') is-invalid @enderror" id="nama_produk"
                                value="{{ old('nama_produk') }}" autofocus>
                            @error('nama_produk')
                                <div class="invalid-feedback text-danger">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                    </div>
                    <div class="row mb-3">
                        <label for="id_kategori" class="col-sm-2 col-form-label">Kategori Produk</label>
                        <div class="col-sm-10">
                            <select class="form-control @error('id_kategori') is-invalid @enderror" name="id_kategori"
                                id="id_kategori" value="{{ old('id_kategori') }}">
                                <option value="" disabled selected>Pilih Kategori Produk</option>
                                @foreach ($kategori as $k)
                                    <option value="{{ $k->id }}">{{ $k->nama_kategori }}</option>
                                @endforeach
                            </select>
                            @error('id_kategori')
                                <div class="invalid-feedback text-danger">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="deskripsi" class="col-sm-2 col-form-label">Deskripsi</label>
                        <div class="col-sm-10">
                            <input type="text" name="deskripsi"
                                class="form-control @error('deskripsi') is-invalid @enderror" id="deskripsi"
                                value="{{ old('deskripsi') }}">
                            @error('deskripsi')
                                <div class="invalid-feedback text-danger">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label for="harga" class="col-sm-2 col-form-label">Harga</label>
                        <div class="col-sm-10">
                            <input type="number" name="harga" class="form-control @error('harga') is-invalid @enderror"
                                id="harga" value="{{ old('harga') }}">
                            @error('harga')
                                <div class="invalid-feedback text-danger">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label for="gambar" class="col-sm-2 col-form-label">Gambar</label>
                        <div class="col-sm-4">
                            <input type="file" name="gambar_produk"
                                class="form-control @error('gambar_produk') is-invalid @enderror" id="gambar"
                                onchange="previewImage()" value="{{ old('gambar') }}">
                            <img class="image-preview img-fluid my-3 d-none">
                            @error('gambar_produk')
                                <div class="invalid-feedback text-danger">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>


                    <button type="submit" class="btn btn-primary">Tambah Data</button>
                </form>
            </div>
        </div>
    </div>
@endsection

@push('script')
    <script>
        function previewImage() {
            const image = document.querySelector('#gambar')
            const imagePreview = document.querySelector('.image-preview')

            imagePreview.classList.remove('d-none')
            imagePreview.style.objectFit = 'cover'


            const ofReader = new FileReader()
            ofReader.readAsDataURL(image.files[0])

            ofReader.onload = function(oFREvent) {
                imagePreview.src = oFREvent.target.result
            }
        }
    </script>
@endpush
