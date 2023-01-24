<?php

namespace App\Imports;

use App\Models\Produk;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithStartRow;

class ImportProduk implements ToModel,WithStartRow
{
    /**
    * @param Collection $collection
    */
    public function model(array $row)
    {
        return new Produk([
            'barcode_produk'        =>  $row[0],
            'nama_produk'           =>  $row[1],
            'stok_produk'           =>  $row[2],
            'harga_beli_produk'     =>  $row[3],
            'harga_jual_produk'     =>  $row[4],
            'margin'                =>  $row[5],
            'fkid_jenis_produk'     =>  $row[6],
            'fkid_tempat_produk'    =>  $row[7]
        ]);
    }

    public function startRow(): int
    {
        return 2;
    }
}
