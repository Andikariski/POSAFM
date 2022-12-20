<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\TempatProduk as TempProduk;

class TempatProduk extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            ['kode_rak'   => 'RAK001'],
            ['kode_rak'   => 'RAK002'],
            ['kode_rak'   => 'RAK003'],
            ['kode_rak'   => 'RAK004'],
            ['kode_rak'   => 'RAK005'],
        ];

        foreach ($data as $datas) {
            TempProduk::create($datas);
        }
    }
}
