@extends('layouts.main')

@push('style')
    <style>
        .card-head{
            background-color: rgb(255, 255, 255) !important;
            padding: 10px 20px 10px 20px;
            border-radius: 10px;
            box-shadow: 1px 3px 2px rgba(0, 0, 0, 0.082);
        }
        .kategori{
            margin-bottom: 0px;
            list-style: none;
            display: flex;
            column-gap: 15px;
            align-content: center;
        }
        .kategori li{
            margin: 5px;
        }
        .kategori li a{
            text-decoration: none;
            /* color: black */
        }
        .kategori li a:hover{
            background-color: rgb(79, 79, 247);
            padding: 10px;
            color: rgb(255, 255, 255) !important;
            border-radius: 10px
            /* color: black */
        }
        .kategori-active a{
            background-color: rgb(79, 79, 247);
            color: rgb(255, 255, 255) !important;
            padding: 10px;  
            border-radius: 10px
        }
       
        .card-produk{
            background-color: rgb(255, 255, 255) !important;
            padding: 10px 20px 10px 20px;
            text-align: center;
            border-radius: 5px;
            box-shadow: 1px 3px 2px rgba(0, 0, 0, 0.082);
            max-height: 300px;

        }
        .card-produk:hover{
            background-color: rgb(92, 63, 252) !important;
            color: white;
            /* width: 150px; */
            padding: 15px 25px 15px 25px;
            transition: .3s all;

        }
        .card-produk .deskripsi-produk{
            /* background-color: red; */
            max-height: 80px;
            font-style: italic;
            overflow: hidden;
        }
        .card-produk img{
            display: block;
            width: 100%;
            max-height: 100px;
            border-radius: 10px;
            margin-bottom: 5px;
            object-fit: cover;
        }
        .cart{
            background-color: rgb(255, 255, 255) ;
            border-radius: 5px;
            padding: 15px;
            height: 70vh;
            overflow: auto;
            box-shadow: 1px 3px 2px rgba(0, 0, 0, 0.082);
            

        }

        .cart-card{
            background-color: rgb(243, 243, 243);
            box-shadow: 1px 3px 2px rgba(0, 0, 0, 0.082);

        }
        .cart-border-left{
            border-left: 3px solid rgb(57, 60, 255);
            border-top-left-radius: 5px;
            border-bottom-left-radius: 5px;
            transition: .5s all;
            
        }
        .detail-pesanan{
            display: none;
        }
    </style>
@endpush

@section('content')
<div class="row">
    <div class="col-md-8">
        <div class="container-fluid">
            <div class="card-head">
                <ul class="kategori">
                    <li id="kategori-all" class="list-kategori"><a href="">All</a></li>
                    @foreach ($kategori as $item)
                        <li id="kategori" class="list-kategori" data-id="{{ $item->id }}"><a href=""> {{ $item->nama_kategori }} </a> </li>
                    @endforeach
                    
                </ul>
            </div>

            <div class="row produk mt-4" id="card-produk">
                @if ($produk)
                    @foreach ($produk as $p)
                    <div class="col-md-3 my-2">
                        <div class="card-produk" data-id="{{ $p->id }}">
                            <img src="storage/{{ $p->gambar_produk }}" alt="gambar-produk">
                            <strong class="text-primary">{{ $p->nama_produk }}</strong>
                            <p class="deskripsi-produk">{{ $p->deskripsi }}</p>
                            <strong>Rp. {{ $p->harga }}</strong>
                        </div>
                    </div>
                    @endforeach
                @else
                    <div class="alert alert-danger" role="alert">
                    Data Belum Tersedia!
                    </div>
                @endif
  
            </div>

        </div>


        
    </div>

    <div class="col-md-4 cart">
        <div class="cart-list">
            <div class="cart-header d-flex justify-content-between align-item-center">
                <h5> List Pemesanan</h5>
                <i class="fas fa-cart-plus"></i>
            </div>
            
            <div class="cart-body mt-4 ">
                <div class="card cart-card m-0">
               
                    <div class="card-body" id="pesanan">
                      <table class="col-md-12">
                        <tr>
                            <td width="20px"><a href="" class="tombol-detail text-danger"><i class="fas fa-angle-right"></i></a> </td>
                            <td width="30px">1</td>
                            <td ><strong>Nama Makanan</strong> </td>
                            <td width="100px"> <strong>Rp.10000</strong> </td>
                            <td>
                                <button class="btn btn-danger rounded-circle">X</button>
                            </td>
                        </tr>
                      </table>

                      <div class="detail-pesanan">
                        <hr>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="jumlah" class="form-label">Jumlah Pesanan</label>
                                    <input type="number" class="form-control form-control-sm" id="jumlah">
                                  </div>
                            </div>

                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="diskon" class="form-label">Diskon(%)</label>
                                    <input type="number" class="form-control form-control-sm" id="diskon" value="0">
                                  </div>
                            </div>
                        </div>

                      </div>
                    </div>
                  </div>
            </div>   
          </div>        

    </div>
    

</div>
@endsection
@push('script')
    <script>
        $(document).ready(function(){
            $('body').addClass('sidebar-mini')

            $(document).on('click', '.tombol-detail', function(e){
                e.preventDefault()
                // $(this).html('<i class="fas fa-angle-down"></i>')
                $('.cart-card').toggleClass('cart-border-left')
                $(".detail-pesanan").slideToggle("slow");
                // $(this).html('<i class="fas fa-angle-down"></i>')
            })

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

            // console.log(header);

            //tampil produk all
            $('#kategori-all').on('click', function(e){
                e.preventDefault()
                // $(this).addClass('kategori-active')
                $.ajax({
                    url: 'getProdukAjax',
                    type: 'get',
                    success: function(respons){
                        $('#card-produk').html(respons)   
                    }
                })
            })

            //tampil produk by kategori
            $(document).on('click', '#kategori', function(e){
                e.preventDefault()
                const id = $(this).data('id')
                if(id){
                    $(this).addClass('kategori-active')
                }
                $.ajax({
                    url: 'getProdukId/'+id,
                    type: 'get',
                    success: function(respons){
                        // console.log(respons)
                        
                        $('#card-produk').html(respons)   
                    }
                })
            })

            
        // console.log($('body'))
        })
    </script>
@endpush