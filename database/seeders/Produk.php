<?php

namespace Database\Seeders;

use App\Models\Produk as ModelsProduk;
use Illuminate\Database\Seeder;

class Produk extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            ['barcode_produk'   => '1922312'],
            ['nama_produk'      => 'SGM'],
            ['stok_produk'      => 10],
            ['harga_pemasok'    => 20000],
            ['harga_jual_pcs'   => 23000],
            ['harga_jual_partai' => 900000],
            ['id_jenis_produk'  => 1]
        ];

        foreach ($data as $datas) {
            ModelsProduk::create($datas);
        }
    }
}
