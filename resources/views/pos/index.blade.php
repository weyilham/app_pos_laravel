@extends('layouts.main')

@push('style')
    <style>
        .card-head {
            background-color: rgb(255, 255, 255) !important;
            padding: 10px 20px 10px 20px;
            border-radius: 10px;
            box-shadow: 1px 3px 2px rgba(0, 0, 0, 0.082);
        }

        .kategori {
            margin-bottom: 0px;
            list-style: none;
            display: flex;
            column-gap: 15px;
            align-content: center;
        }

        .kategori li {
            margin: 5px;
        }

        .kategori li a {
            text-decoration: none;
            /* color: black */
        }

        .kategori li a:hover {
            background-color: rgb(79, 79, 247);
            padding: 10px;
            color: rgb(255, 255, 255) !important;
            border-radius: 10px;
            /* color: black */
        }

        .kategori-active a {
            background-color: rgb(79, 79, 247);
            color: rgb(255, 255, 255) !important;
            padding: 10px;
            border-radius: 10px
        }

        .card-produk {
            background-color: rgb(255, 255, 255) !important;
            padding: 5px;
            text-align: center;
            border-radius: 5px;
            box-shadow: 1px 3px 2px rgba(0, 0, 0, 0.082);
            height: 270px;

        }

        .card-produk:hover {
            background-color: rgb(92, 63, 252) !important;
            color: white;
            /* width: 150px; */
            /* max-height: 200px; */
            padding: 8px;
            cursor: pointer;
            transition: .3s all;
        }

        .card-produk:active {
            padding: 5px;
        }

        .card-produk .deskripsi-produk {
            /* background-color: red; */
            max-height: 80px;
            /* background-color: red; */
            font-style: italic;
            overflow: hidden;
        }

        .card-produk .harga-produk {
            position: absolute !important;
            /* left: 10%%; */
            bottom: 5%;
            right: 10%;
        }

        .card-produk img {
            display: block;
            width: 100%;
            max-height: 100px;
            /* padding: 10px !important; */
            border-radius: 10px;
            margin-bottom: 5px;
            object-fit: cover;
        }

        .cart {
            background-color: rgb(255, 255, 255);
            border-radius: 5px;
            padding: 15px;
            height: 100%;
            overflow: auto;
            box-shadow: 1px 3px 2px rgba(0, 0, 0, 0.082);


        }

        .cart-card {
            /* background-color: rgb(243, 243, 243); */
            box-shadow: 1px 3px 2px rgba(0, 0, 0, 0.082);

        }

        .cart-card:nth-child(odd) {
            background-color: rgb(243, 243, 243);

        }

        .cart-card:nth-child(even) {
            background-color: rgb(255, 255, 255);
            border: 1px solid rgb(233, 233, 233)
        }



        .cart-border-left {
            border-left: 3px solid rgb(57, 60, 255) !important;
            border-top-left-radius: 5px;
            border-bottom-left-radius: 5px;
            transition: .5s all;

        }

        .detail-pesanan {
            display: none;
        }
    </style>
@endpush

@section('content')
    {{-- @dd(Cart::content()) --}}
    {{-- {{ Cart::destroy() }} --}}
    <div class="row">
        <div class="col-md-8">
            <div class="container-fluid">
                <div class="card-head">
                    <ul class="kategori">
                        <li id="kategori-all" class="list-kategori"><a href="">All</a></li>
                        @foreach ($kategori as $item)
                            <li id="kategori" class="list-kategori" data-id="{{ $item->id }}"><a href="">
                                    {{ $item->nama_kategori }} </a> </li>
                        @endforeach

                    </ul>
                </div>

                <div class="row produk mt-4" id="products">
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
                </div>

            </div>



        </div>

        <div class="col-md-4 cart">
            <div class="cart-list">
                <div class="cart-header d-flex justify-content-between align-item-center">
                    <button type="button" class="btn btn-primary">
                        Pesanan <span class="badge badge-light" id="jumlah-pesanan">{{ Cart::count() }}</span>
                        <span class="sr-only">unread messages</span>
                    </button>

                    <button class="btn btn-danger btn-sm hapus-semua-cart">
                        <i class="fas fa-trash-alt"></i>
                    </button>
                    {{-- <i class="fas fa-cart-plus"></i> --}}
                </div>

                <div class="cart-body mt-4 ">
                    <div class="cart-list" id="pesanan">
                        @if (Cart::count() > 0)
                            @foreach (Cart::content() as $item)
                                {{-- @dd($item) --}}
                                <div class="card cart-card  my-3 cart-border-left">
                                    <div class="card-body">
                                        <table class="col-md-12">
                                            <tr>

                                                <td width="30px">{{ $loop->iteration }}</td>
                                                <td width="150px"><strong>{{ $item->name }}</strong> </td>
                                                <td width="70px" class="text-right"> <strong
                                                        id="harga">{{ $item->price }}</strong>
                                                </td>

                                                <td class="text-right" width="100px">
                                                    <button class="btn btn-success btn-sm detail-cart "
                                                        data-toggle="collapse" href="#detail-cart{{ $item->id }}"
                                                        role="button" aria-expanded="false"
                                                        aria-controls="detail-cart{{ $item->id }}"><i
                                                            class="far fa-edit"></i></button>
                                                    <button class="btn btn-danger btn-sm mx-1 delete-cart"
                                                        data-id="{{ $item->rowId }}"><i
                                                            class="far fa-trash-alt"></i></button>
                                                </td>
                                            </tr>
                                        </table>

                                        <div class="collapse" id="detail-cart{{ $item->id }}">
                                            <hr>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="mb-3">
                                                        <label for="jumlah" class="form-label">Jumlah Pesanan</label>
                                                        <input type="number" class="form-control form-control-sm"
                                                            id="qty" data-id="{{ $item->rowId }}" min="1"
                                                            value="{{ $item->qty }}">
                                                    </div>
                                                </div>

                                                {{-- <div class="col-md-6">
                                                    <div class="mb-3">
                                                        <label for="diskon" class="form-label">Diskon(%)</label>
                                                        <input type="number" class="form-control form-control-sm"
                                                            id="diskon" data-id="{{ $item->rowId }}" value="0"
                                                            min="0">
                                                    </div>
                                                </div> --}}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        @else
                            <strong class="text-danger">Belum ada pesanan</strong>
                        @endif
                    </div>

                    <hr class="mt-5 mb-2">

                    <div class="footer-cart" id="footer-cart">
                        <table class="col-12">
                            {{-- <tr>
                                <td>Sub Total</td>
                                <td class="text-right">Rp. <span id="sub-total">{{ Cart::priceTotal() }}</span></td>
                            </tr> --}}
                            {{-- <tr>
                                <td>Diskon</td>
                                <td class="text-right">Rp. <span id="set-diskon">{{ Cart::discount() }}</span></td>
                            </tr> --}}
                            <tr style="font-weight: bold !important">
                                <td>Total Bayar</td>
                                <td class="text-right">Rp. <span id="set-total">{{ Cart::total() }}</span></td>
                            </tr>
                            <tr>
                                <td colspan="2">
                                    <hr>
                                </td>
                            </tr>
                            <tr>
                                <td colspan="2" class="text-right">
                                    <button class="btn btn-warning">Transfer</button>
                                    <button class="btn btn-success bayar-langsung" data-toggle="modal"
                                        data-target="#exampleModal">Bayar
                                        Langsung</button>
                                </td>
                            </tr>
                        </table>

                    </div>
                </div>
            </div>

        </div>


    </div>

    {{-- Modal Bayar --}}
    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Pembayaran</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="controler">
                        <div class="header-pembayarann">
                            <img src="" alt="">
                            <strong class="text-primary">Total Pembayaran : </strong>
                            <h3 class="total-pembayaran">Rp.20000</h3>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Keluar</button>
                    <button type="button" class="btn btn-success bayar-pesanan">Bayar Pesanan</button>
                </div>
            </div>
        </div>
    </div>



@endsection
@push('script')
    <script>
        $(document).ready(function() {

            $('body').addClass('sidebar-mini')
            //add class active
            const header = $('#kategori')
            const listKategori = $('.list-kategori')

            for (var i = 0; i < listKategori.length; i++) {
                listKategori[i].addEventListener("click", function() {
                    var current = document.getElementsByClassName("kategori-active");
                    if (current.length > 0) {
                        current[0].className = current[0].className.replace(" kategori-active", "");
                    }
                    this.className += " kategori-active";
                });
            }

            //hapus modal-backdrop di modal
            $(document).on('click', '.bayar-langsung', function(e) {
                $('.modal-backdrop').removeClass('modal-backdrop')
            })

            // console.log(header);

            //tampil produk all
            $('#kategori-all').on('click', function(e) {
                e.preventDefault()
                // $(this).addClass('kategori-active')
                $.ajax({
                    url: 'getProdukAjax',
                    type: 'get',
                    success: function(respons) {
                        $('#products').html(respons)
                    }
                })
            })

            //tampil produk by kategori
            $(document).on('click', '#kategori', function(e) {
                e.preventDefault()
                const id = $(this).data('id')
                if (id) {
                    $(this).addClass('kategori-active')
                }
                $.ajax({
                    url: 'getProdukId/' + id,
                    type: 'get',
                    success: function(respons) {
                        // console.log(respons)
                        $('#products').html(respons)
                    }
                })
            })


            // console.log($('body'))
            //Proses Cart
            $(document).on('click', '#card-produk', function(e) {

                const id = $(this).data('id')

                $.ajax({
                    url: 'cart',
                    type: 'post',
                    data: {
                        id: id
                    },
                    success: function(respons) {
                        let jumlahPesanan = $('#jumlah-pesanan').html()

                        $('#jumlah-pesanan').html(parseInt(jumlahPesanan, 10) + 1)
                        $('#pesanan').html(respons)

                        changeFooter()

                    }
                })

            })


            $(document).on('click', '.hapus-semua-cart', function() {
                const id = 1000000
                $.ajax({
                    url: 'clear-cart',
                    type: 'delete',
                    success: function(respons) {
                        $('#jumlah-pesanan').html('0')
                        $('#pesanan').html(respons)

                        changeFooter()
                    }
                })
            })

            $(document).on('click', '.delete-cart', function() {
                const id = $(this).data('id')
                $.ajax({
                    url: 'cart/' + id,
                    type: 'delete',
                    success: function(respons) {
                        let jumlahPesanan = $('#jumlah-pesanan').html()

                        $('#jumlah-pesanan').html(parseInt(jumlahPesanan, 10) - 1)
                        $('#pesanan').html(respons)
                        // console.log(respons);
                        changeFooter()
                    }
                })
            })

            //fungsi set quantity
            $(document).on('change', '#qty', function() {
                const id = $(this).data('id')
                let harga = $('#harga').html()
                let qty = $(this).val()
                // let diskon = $('#set-total').html().split(',').join('')
                // let totalBayar = $('#set-diskon').html().split(',').join('')

                $.ajax({
                    url: 'cart/' + id,
                    type: 'put',
                    data: {
                        id: id,
                        qty: qty,
                    },
                    success: function(respons) {
                        changeFooter()
                    }
                })
            })

            //set diskon

            function changeFooter() {
                $.ajax({
                    url: 'footer-cart',
                    type: 'get',
                    success: function(respons) {
                        $('#footer-cart').html(respons)
                    }
                })
            }

        })
    </script>
@endpush
