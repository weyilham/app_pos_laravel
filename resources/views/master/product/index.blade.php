@extends('layouts.main')

@section('content')
    <div class="row">
        <div class="col-md">
            <div class="card">
                <div class="card-header d-flex justify-content-between">
                    <h4 class="text-dark">Produk</h4>
                    <a href="/product/create" class="btn btn-primary btn-sm">Tambah Data</a>

                </div>

                <div class="card-body">
                    <div class="success" data-success="{{ session()->has('success') }}"></div>

                    <div class="table-responsive">
                        <table class="table table-striped" id="myTable">
                            <thead>
                                <tr class="">
                                    <th>No</th>
                                    <th>Nama Produk</th>
                                    <th>Deskripsi</th>
                                    <th>Harga</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>

                        </table>
                    </div>
                </div>
            </div>
        </div>

    </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Detail Produk</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-8">
                            <table class="table table-striped table-hover table-bordered">

                                <tbody class="table-detail"></tbody>
                            </table>
                        </div>
                        <div class="col-md-4">
                            <img src="" class="gambar-produk w-100 h-100 object-fit-fill" alt="">
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Keluar</button>
                    <button type="button" class="btn btn-primary tombol-simpan d-none">Simpan</button>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('script')
    <script>
        $(document).ready(function() {


            $('#myTable').DataTable({
                processing: true,
                serverside: true,
                columnDefs: [{
                    "width": "40%",
                    "targets": 2
                }],
                ajax: "{{ url('product') }}",
                columns: [{
                        data: 'DT_RowIndex',
                        name: 'DT_RowIndex',
                        orderable: false,
                        searchable: false
                    },
                    {
                        data: 'nama_produk',
                        name: 'Nama Produk'
                    },
                    {
                        data: 'deskripsi',
                        name: 'Deskripsi'
                    },
                    {
                        data: 'harga',
                        name: 'Harga'
                    },
                    {
                        data: 'aksi',
                        name: 'Aksi'
                    }
                ]
            })
            //simpan data ketika berhasil muncul swal
            if ($('.success').data('success')) {
                Swal.fire({
                    title: "Good job!",
                    text: "Data Berhasil disimpan!",
                    icon: "success"
                });
            }

            //hapus data
            $(document).on('click', '#tombol-hapus', function(e) {
                var id = $(this).data('id')
                Swal.fire({
                    title: "Apakah Anda Yakin Akan Menghapus Data ini?",
                    text: "",
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#3085d6",
                    cancelButtonColor: "#d33",
                    confirmButtonText: "Ya, Hapus"
                }).then((result) => {
                    if (result.isConfirmed) {

                        $.ajax({
                            url: 'product/' + id,
                            type: 'DELETE',
                            success: function(response) {
                                Swal.fire({
                                    title: "Deleted!",
                                    text: response.result,
                                    icon: "success"
                                });
                                $('#myTable').DataTable().ajax.reload();
                            }
                        })
                    }
                });
            })


            $(document).on('click', '#tombol-detail', function() {
                var id = $(this).data('id')
                $('.modal-backdrop').removeClass('modal-backdrop')
                // console.log(id)

                $.ajax({
                    url: 'product/' + id,
                    type: 'GET',
                    success: function(response) {
                        const nama_barang = response.product.nama_produk
                        const deskripsi = response.product.deskripsi
                        const harga = response.product.harga.toString().replace(
                            /\B(?=(\d{3})+(?!\d))/g, '.')
                        console.log(nama_barang)

                        $('.table-detail').html(`
            
            <tr>
                  <td>Nama Barang </td> 
                  <td>${nama_barang}</td>    
                </tr>  
                <tr>
                  <td>Deskripsi</td> 
                  <td>${deskripsi}</td>    
              </tr> 
              <tr>
                <td>Harga Barang </td> 
                <td>Rp. ${harga}</td>    
            </tr>
            `);

                        $('.gambar-produk').attr('src', response.product.gambar_produk)
                    }
                })
            })


        })
    </script>
@endpush
