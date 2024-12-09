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
        return [
            'barcode_produk' => $this->barcode_produk,
            'nama_produk' => $this->nama_produk,
            'stok_produk' => $this->stok_produk,
            'harga_beli_produk' => $this->harga_beli_produk,
            'margin' => $this->margin,
            'harga_jual_produk' => $this->harga_jual_produk,
            'jenis_produk' => $this->whenLoaded('kategori', [
                'id' => $this->kategori->id_jenis_produk,
                'kategori_produk' => $this->kategori->kategori_produk
            ]),
            'tempat_produk' => $this->whenLoaded('tempatproduk', [
                'id' => $this->tempatproduk->id_tempat_produk,
                'kode_rak' => $this->tempatproduk->kode_rak
            ]),
        ];
    }
}
