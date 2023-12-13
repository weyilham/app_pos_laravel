@foreach (Cart::content() as $item)
    {{-- @dd($item) --}}
    <div class="card cart-card  my-3 cart-border-left">
        <div class="card-body">
            <table class="col-md-12">
                <tr>

                    <td width="30px">{{ $loop->iteration }}</td>
                    <td width="150px"><strong>{{ $item->name }}</strong> </td>
                    <td width="70px" class="text-right"> <strong>{{ $item->price }}</strong>
                    </td>

                    <td class="text-right" width="100px">
                        <button class="btn btn-success btn-sm detail-cart " data-toggle="collapse"
                            href="#detail-cart{{ $item->id }}" role="button" aria-expanded="false"
                            aria-controls="detail-cart{{ $item->id }}"><i class="far fa-edit"></i></button>
                        <button class="btn btn-danger btn-sm mx-1 delete-cart" data-id="{{ $item->rowId }}"><i
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
                            <input type="number" class="form-control form-control-sm" id="jumlah"
                                value="{{ $item->qty }}">
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
@endforeach
