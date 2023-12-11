@extends('layouts.main')

@section('content')
    <div class="col-md-12">
        <div class="card shadow" style="background-color: #fcfcfc">
            <div class="card-header">
                <h4>Form Edit Data Produk</h4>
            </div>

            <div class="card-body">
                <form action="/product/{{ $produk->id }}" method="post" enctype="multipart/form-data">
                    @method('put')
                    @csrf
                    <div class="row mb-3">
                        <label for="nama_produk" class="col-sm-2 col-form-label">Nama Produk</label>
                        <div class="col-sm-10">
                            <input type="text" name="nama_produk"
                                class="form-control @error('nama_produk') is-invalid @enderror" id="nama_produk"
                                value="{{ old('nama_produk', $produk->nama_produk) }}" autofocus>
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
                                    @if ($produk->id_kategori == $k->id)
                                        <option value="{{ $k->id }}" selected>{{ $k->nama_kategori }}</option>
                                    @else
                                        <option value="{{ $k->id }}">{{ $k->nama_kategori }}</option>
                                    @endif
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
                                value="{{ old('deskripsi', $produk->deskripsi) }}">
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
                                id="harga" value="{{ old('harga', $produk->harga) }}">
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
                                onchange="previewImage()" value="{{ old('gambar_produk', $produk->gambar_produk) }}">
                            <input type="hidden" name="oldImage" value="{{ $produk->gambar_produk }}">
                            @if ($produk->gambar_produk)
                                <img src="/{{ 'storage/' . $produk->gambar_produk }}"
                                    class="image-preview img-fluid my-3 d-block">
                            @else
                                <img class="image-preview img-fluid my-3 d-none">
                            @endif
                            @error('gambar_produk')
                                <div class="invalid-feedback text-danger">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>


                    <button type="submit" class="btn btn-primary">Update Data</button>
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
