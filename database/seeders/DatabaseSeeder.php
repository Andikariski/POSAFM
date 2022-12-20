<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(JenisProduk::class);
        $this->call(AlamatPelanggan::class);
        $this->call(Pelanggan::class);
        // $this->call(Produk::class);
        $this->call(User::class);
        $this->call(TempatProduk::class);
    }
}
