<div class="d-flex align-items-center gap-2">
    <a href="/product/{{ $data->id }}/edit" class="btn btn-success btn-sm " id="tombol-ubah">ubah</a>
    <button class="btn btn-warning btn-sm " id="tombol-detail" data-id="{{ $data->id }}" data-toggle="modal"
        data-target="#exampleModal">detail</button>
    <button class="btn btn-danger btn-sm " id="tombol-hapus" data-id="{{ $data->id }}">hapus</button>

</div>
