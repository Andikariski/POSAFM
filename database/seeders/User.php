<?php

namespace Database\Seeders;

use App\Models\Produk as ModelsProduk;
use App\Models\User as ModelsUser;
use Illuminate\Database\Seeder;

class User extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            [
                'name'   => 'Andika Riski',
                'email'   => 'dika@gmail.com',
                'password'   => bcrypt('12345678'),
                'is_admin' => 1
            ],
            [
                'name'   => 'Fitria Nuraini',
                'email'   => 'fitria@gmail.com',
                'password'   => bcrypt('12345678'),
                'is_admin' => 0
            ]
        ];

        foreach ($data as $datas) {
            ModelsUser::create($datas);
        }
    }
}
