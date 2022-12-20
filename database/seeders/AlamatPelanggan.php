<?php

namespace Database\Seeders;

use App\Models\AlamatPelanggan as ModelsAlamatPelanggan;
use Illuminate\Database\Seeder;

class AlamatPelanggan extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            //Distrik Semangga
            ['alamat_detail' => 'Alamat Umum'],
            ['alamat_detail' => 'Semangga, Kmp. Matara'],
            ['alamat_detail' => 'Semangga, Kmp. Waninggap Nanggo'],
            ['alamat_detail' => 'Semangga, Kmp. Urumb'],
            ['alamat_detail' => 'Semangga, Kmp. Sidomulyo'],
            ['alamat_detail' => 'Semangga, Kmp. Kuprik'],
            ['alamat_detail' => 'Semangga, Kmp. Kuper'],
            ['alamat_detail' => 'Semangga, Kmp. Semangga Jaya'],
            ['alamat_detail' => 'Semangga, Kmp. Marga Mulya'],
            ['alamat_detail' => 'Semangga, Kmp. Muram Sari'],
            ['alamat_detail' => 'Semangga, Kmp. Waninggan Kai'],
            
            //Distrik Tanah Miring
            ['alamat_detail' => 'Tanah Miring, Kmp. Yasa Mulya'],
            ['alamat_detail' => 'Tanah Miring, Kmp. Sumber Harapan'],
            ['alamat_detail' => 'Tanah Miring, Kmp. Waninggap Sai'],
            ['alamat_detail' => 'Tanah Miring, Kmp. Amun Kay'],
            ['alamat_detail' => 'Tanah Miring, Kmp. Hidup Baru'],
            ['alamat_detail' => 'Tanah Miring, Kmp. Sarmayam Indah'],
            ['alamat_detail' => 'Tanah Miring, Kmp. Ngguti Bob'],
            ['alamat_detail' => 'Tanah Miring, Kmp. Waninggap Miraf'],
            ['alamat_detail' => 'Tanah Miring, Kmp. Isano Mbias'],
            ['alamat_detail' => 'Tanah Miring, Kmp. Yaba Maru'],
            ['alamat_detail' => 'Tanah Miring, Kmp. Soa'],
            ['alamat_detail' => 'Tanah Miring, Kmp. Tambat'],
            ['alamat_detail' => 'Tanah Miring, Kmp. Bersihati'],
            ['alamat_detail' => 'Tanah Miring, Kmp. Kamangi'],

            //Distrik Kurik
            ['alamat_detail' => 'Kurik, Kmp. Harapan Makmur'],
            ['alamat_detail' => 'Kurik, Kmp. Kurik'],
            ['alamat_detail' => 'Kurik, Kmp. Telaga Sari'],
            ['alamat_detail' => 'Kurik, Kmp. Sumber Rejeki'],
            ['alamat_detail' => 'Kurik, Kmp. Jaya Makmur'],
            ['alamat_detail' => 'Kurik, Kmp. Sumber Mulya'],
            ['alamat_detail' => 'Kurik, Kmp. Kaliki'],
            ['alamat_detail' => 'Kurik, Kmp. Ivimahad'],
            ['alamat_detail' => 'Kurik, Kmp. Salor Indah'],
            ['alamat_detail' => 'Kurik, Kmp. Wapeko'],
            ['alamat_detail' => 'Kurik, Kmp. Anum Bob'],
            ['alamat_detail' => 'Kurik, Kmp. Monorejo'],
            ['alamat_detail' => 'Kurik, Kmp. Candra Jaya'],

            //Distrik Malind
            ['alamat_detail' => 'Malind, Kmp. Kumbe'],
            ['alamat_detail' => 'Malind, Kmp. Kaiburse'],
            ['alamat_detail' => 'Malind, Kmp. Onggari'],
            ['alamat_detail' => 'Malind, Kmp. Domande'],
            ['alamat_detail' => 'Malind, Kmp. Suka Maju'],
            ['alamat_detail' => 'Malind, Kmp. Padang Raharja'],
            ['alamat_detail' => 'Malind, Kmp. Rawasari'],
            
            //Kota Merauke
            ['alamat_detail' => 'Kota Merauke'],
            ['alamat_detail' => 'Lain-Lain'],
        ];
        foreach ($data as $datas) {
            ModelsAlamatPelanggan::create($datas);
        }
    }
}
