
@foreach ($produk as $p)
<div class="col-md-3 my-2">
    <div class="card-produk">
        <img src="storage/{{ $p->gambar_produk }}" alt="gambar-produk">
        <strong class="text-primary">{{ $p->nama_produk }}</strong>
        <p class="deskripsi-produk">{{ $p->deskripsi }}</p>
        <strong>Rp. {{ $p->harga }}</strong>
    </div>
</div>
@endforeach
    