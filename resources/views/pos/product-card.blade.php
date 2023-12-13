@foreach ($produk as $p)
    <div class="col-md-3 my-2 position-relative">
        <div class="card-produk" id="card-produk" data-id="{{ $p->id }}">
            <img src="storage/{{ $p->gambar_produk }}" alt="gambar-produk">
            <strong class="nama-produk">{{ $p->nama_produk }}</strong>
            <div class="deskripsi-produk">
                <p>{{ $p->deskripsi }}</p>
            </div>
            <div class="harga-produk btn btn-sm btn-danger">
                <strong>Rp. {{ $p->harga }}</strong>
            </div>
        </div>
    </div>
@endforeach
