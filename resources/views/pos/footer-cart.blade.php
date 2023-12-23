<table class="col-12">
    {{-- <tr>
        <td>Sub Total</td>
        <td class="text-right">Rp. <span id="sub-total">{{ Cart::priceTotal() }}</span></td>
    </tr> --}}
    {{-- <tr>
        <td>Diskon</td>
        <td class="text-right">Rp. <span id="set-diskon">{{ Cart::discount() }}</span></td>
    </tr> --}}
    <tr>
        <td>Total Bayar</td>
        <td class="text-right fw-bold">Rp. <span id="set-total">{{ Cart::total() }}</span></td>
    </tr>
    <tr>
        <td colspan="2">
            <hr>
        </td>
    </tr>
    <tr>
        <td colspan="2" class="text-right">
            <button class="btn btn-warning">Transfer</button>
            <button class="btn btn-success bayar-langsung" data-toggle="modal" data-target="#exampleModal">Bayar
                Langsung</button>
        </td>
    </tr>
</table>
