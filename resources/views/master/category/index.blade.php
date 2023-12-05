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
            <div class="section-title mt-0"><i class="fas fa-plus-square text-primary"></i> Tambah Data Kategori</div>
       
            <div class="form-group">
              <label>Nama Kategori</label>
              <input type="text" name="nama_kategori" class="form-control form-control-sm">
              <div id="nama_invalid" class="invalid-feedback"> </div>
        
            </div>

            <div class="form-group">
                <label>Slug</label>
                <input type="text" name="slug" class="form-control form-control-sm"  readonly>
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

    $('input[name=nama_kategori]').change(function(e){
      $slug = this.value
      $('input[name=slug]').val($slug.toLowerCase().split(" ").join("_"))
      // console.log(this.value)
    })
    

    $('.tombol-simpan').click(function(){
      $.ajax({
        url: 'kategoriAjax',
        type: 'post',
        data: {
          nama_kategori: $('input[name=nama_kategori]').val(),
          slug: $('input[name=slug]').val()
        },
        success: function(res){

          let nama_kategori = $('input[name=nama_kategori]')
          let slug = $('input[name=slug]')

          let nama_invalid = $('#nama_invalid')
          let slug_invalid = $('#slug_invalid')

          if(res.errors){
            $.each(res.errors, function(key, value){
              // nama_kategori.addClass('is-invalid')
              // slug.addClass('is-invalid')
              if(!nama_kategori.val() ){
                nama_kategori.addClass('is-invalid')
                nama_invalid.html(value)
              }else{
                nama_kategori.removeClass('is-invalid')
                nama_invalid.html()
                // nama_kategori.val()
              }
              if(!slug.val()){
                slug.addClass('is-invalid')
                slug_invalid.html(value)

              }else{
                slug.removeClass('is-invalid')
                slug_invalid.html()
                // slug_kategori.val()
              }
            })
            console.log(nama_kategori)
          }else{
            
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
    })



    $('#myTable').DataTable({
      processing:true,
      serverside:true,
      ajax:"{{ url('kategoriAjax') }}",
      columns: [
      {
        data:'DT_RowIndex',
        name:'DT_RowIndex',
        orderable:false,
        searchable:false
      },  
      {
        data:'nama_kategori',
        name: 'Nama Kategori'
      }, {
        data:'slug',
        name: 'Slug'
      }, {
        data:'aksi',
        name: 'Aksi'
      }]
    })
    


  })

</script>
@endpush