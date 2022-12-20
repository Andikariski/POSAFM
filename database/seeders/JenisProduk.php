<?php

namespace Database\Seeders;

// use App\Models\JenisBarang as ModelsJenisBarang;
use App\Models\JenisProduk as ModelsJenisProduk;
use Illuminate\Database\Seeder;

class JenisProduk extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            ['kategori_produk' => 'Rokok'],
            ['kategori_produk' => 'Susu'],
            ['kategori_produk' => 'Pestisida'],
            ['kategori_produk' => 'Frozen Food'],
            ['kategori_produk' => 'Snack'],
            ['kategori_produk' => 'Alat Pancing'],
            ['kategori_produk' => 'Benih Tanaman'],
            ['kategori_produk' => 'Pecah Belah'],
            ['kategori_produk' => 'Minuman'],
            ['kategori_produk' => 'Sembako'],
            ['kategori_produk' => 'Perlengkapan Bayi'],
            ['kategori_produk' => 'Alat & Bahan Bangunan'],
            ['kategori_produk' => 'Spare Part'],
            ['kategori_produk' => 'Oli'],
            ['kategori_produk' => 'Obat Obatan'],
            ['kategori_produk' => 'Tas'],
            ['kategori_produk' => 'Boneka'],
            ['kategori_produk' => 'Sepatu'],
            ['kategori_produk' => 'Sendal'],
            ['kategori_produk' => 'Sabun Mandi'],
            ['kategori_produk' => 'Bahan Makanan'],
            ['kategori_produk' => 'Kacang Kacangan'],
            ['kategori_produk' => 'Ikat rambut & Variasi'],
            ['kategori_produk' => 'Perlengkapan sekolah & kantor'],
            ['kategori_produk' => 'Skin Care'],
            ['kategori_produk' => 'Minyak Rambut'],
            ['kategori_produk' => 'Deterjen'],
            ['kategori_produk' => 'Sabun Cuci Piring'],
            ['kategori_produk' => 'Mie Instan'],
            ['kategori_produk' => 'BBM'],
            ['kategori_produk' => 'Titipan'],
            ['kategori_produk' => 'Lain-Lain'],
        ];
        foreach ($data as $datas) {
            ModelsJenisProduk::create($datas);
        }
    }
}
