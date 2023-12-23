<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ProductResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        // return parent::toArray($request);
        return [
            "id" => $this->id,
            "nama_produk" => $this->nama_produk,
            "gambar_produk" => $this->gambar_produk,
            "deskripsi" => $this->deskripsi,
            "harga" => $this->harga,
            "id_kategori" => $this->id_kategori,
            'kategori' => $this->categories
        ];
    }
}
