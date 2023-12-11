@extends('layouts.main')

@section('content')
    <div class="row">
        <div class="col-6">
            <div class="card">
                <div class="card-header">
                    <h4 class="text-dark">Kategori</h4>

                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped" id="myTable">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama Kategori</th>
                                    <th>Slug</th>
                                    <th>Action</th>
                                </tr>
                            </thead>

                        </table>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-6">
            <div class="card">
                <div class="card-body">
                    <div class="section-title mt-0 header-form-kategori"><i class="fas fa-plus-square text-primary"></i>
                        Tambah Data Kategori</div>

                    <div class="form-group">
                        <label>Nama Kategori</label>
                        <input type="text" name="nama_kategori" class="form-control form-control-sm">
                        <div id="nama_invalid" class="invalid-feedback"> </div>
                    </div>

                    <div class="form-group">
                        <label>Slug</label>
                        <input type="text" name="slug" class="form-control form-control-sm" readonly>
                        <div id="slug_invalid" class="invalid-feedback"> </div>
                    </div>

                    <button type="submit" class="btn btn-primary btn-sm tombol-simpan">Tambah Data</button>

                </div>
            </div>
        </div>
    </div>
    </div>
@endsection

@push('script')
    <script>
        $(document).ready(function() {

            $('input[name=nama_kategori]').change(function(e) {
                $slug = this.value
                $('input[name=slug]').val($slug.toLowerCase().split(" ").join("_"))
                // console.log(this.value)
            })

            // PROSES SIMPAN DATA
            $('.tombol-simpan').click(function() {

                simpan()
            })

            //proses delete data
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
                            url: 'kategoriAjax/' + id,
                            type: 'DELETE',
                            success: function(response) {
                                Swal.fire({
                                    title: "Deleted!",
                                    text: response.success,
                                    icon: "success"
                                });
                                $('#myTable').DataTable().ajax.reload();
                            }
                        })

                    }
                });



            })

            // PROSES UBAH DATA
            $(document).on('click', '#tombol-ubah', function(e) {
                var id = $(this).data('id')
                $('.tombol-simpan').html('Update Data')
                $('.tombol-simpan').html('Update Data')
                $('.header-form-kategori').html('Update Data')
                // $('.tombol-simpan').removeClass('tombol-simpan')


                // $('.tombol-simpan').addClass('d-none')
                // $('.tombol-update').removeClass('d-none')

                $.ajax({
                    url: 'kategoriAjax/' + id + '/edit',
                    type: 'GET',
                    success: function(response) {
                        $('input[name=nama_kategori]').val(response.result.nama_kategori)
                        $('input[name=slug]').val(response.result.slug)




                    }

                })
            })

            function simpan(id = '') {

                if (id == '') {
                    $.ajax({
                        url: 'kategoriAjax',
                        type: 'post',
                        data: {
                            nama_kategori: $('input[name=nama_kategori]').val(),
                            slug: $('input[name=slug]').val()
                        },
                        success: function(res) {

                            let nama_kategori = $('input[name=nama_kategori]')
                            let slug = $('input[name=slug]')

                            let nama_invalid = $('#nama_invalid')
                            let slug_invalid = $('#slug_invalid')

                            if (res.errors) {
                                $.each(res.errors, function(key, value) {
                                    // nama_kategori.addClass('is-invalid')
                                    // slug.addClass('is-invalid')
                                    // console.log(value)
                                    if (!nama_kategori.val()) {
                                        nama_kategori.addClass('is-invalid')
                                        nama_invalid.html(value)
                                    } else {
                                        nama_kategori.removeClass('is-invalid')
                                        nama_invalid.html()
                                        // nama_kategori.val()
                                    }
                                    if (!slug.val()) {
                                        slug.addClass('is-invalid')
                                        slug_invalid.html(value)

                                    } else {
                                        slug.removeClass('is-invalid')
                                        slug_invalid.html()
                                        // slug_kategori.val()
                                    }
                                })
                                // console.log(nama_kategori)
                            } else {

                                nama_kategori.val('')
                                slug.val('')
                                Swal.fire({
                                    title: "Good job!",
                                    text: res.success,
                                    icon: "success"
                                });
                            }
                            $('#myTable').DataTable().ajax.reload();
                        }
                    })
                } else {
                    $.ajax({
                        url: 'kategoriAjax/' + id,
                        type: 'put',
                        data: {
                            nama_kategori: $('input[name=nama_kategori]').val(),
                            slug: $('input[name=slug]').val()
                        },
                        success: function(res) {

                            let nama_kategori = $('input[name=nama_kategori]')
                            let slug = $('input[name=slug]')

                            let nama_invalid = $('#nama_invalid')
                            let slug_invalid = $('#slug_invalid')

                            if (res.errors) {
                                $.each(res.errors, function(key, value) {
                                    // nama_kategori.addClass('is-invalid')
                                    // slug.addClass('is-invalid')
                                    // console.log(value)
                                    if (!nama_kategori.val()) {
                                        nama_kategori.addClass('is-invalid')
                                        nama_invalid.html(value)
                                    } else {
                                        nama_kategori.removeClass('is-invalid')
                                        nama_invalid.html()
                                        // nama_kategori.val()
                                    }
                                    if (!slug.val()) {
                                        slug.addClass('is-invalid')
                                        slug_invalid.html(value)

                                    } else {
                                        slug.removeClass('is-invalid')
                                        slug_invalid.html()
                                        // slug_kategori.val()
                                    }
                                })
                                // console.log(nama_kategori)
                            } else {

                                nama_kategori.val('')
                                slug.val('')
                                Swal.fire({
                                    title: "Good job!",
                                    text: res.success,
                                    icon: "success"
                                });
                            }
                            $('#myTable').DataTable().ajax.reload();
                        }
                    })
                }
            }






            $('#myTable').DataTable({
                processing: true,
                serverside: true,
                ajax: "{{ url('kategoriAjax') }}",
                columns: [{
                        data: 'DT_RowIndex',
                        name: 'DT_RowIndex',
                        orderable: false,
                        searchable: false
                    },
                    {
                        data: 'nama_kategori',
                        name: 'Nama Kategori'
                    }, {
                        data: 'slug',
                        name: 'Slug'
                    }, {
                        data: 'aksi',
                        name: 'Aksi'
                    }
                ]
            })



        })
    </script>
@endpush
