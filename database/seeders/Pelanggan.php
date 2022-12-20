<?php

namespace Database\Seeders;

use App\Models\Pelanggan as ModelsPelanggan;
use Illuminate\Database\Seeder;

class Pelanggan extends Seeder
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
                'nama_pelanggan'       => 'Umum',
                'nomer_hp'             => '+62',
                'fkid_alamat_pelanggan'            => 1,
                'deskripsi'            => 'Pelanggan Siapa saja yang belum jadi member'
            ],
            [
                'nama_pelanggan'       => 'Emanuel Bako',
                'nomer_hp'             => '00',
                'fkid_alamat_pelanggan'            => 4,
                'deskripsi'            => '-'
            ],
            [
                'nama_pelanggan'       => 'Kristanto',
                'nomer_hp'             => '00',
                'fkid_alamat_pelanggan'            => 2,
                'deskripsi'            => '-'
            ],
            [
                'nama_pelanggan'       => 'Budar(Gimun)',
                'nomer_hp'             => '000',
                'fkid_alamat_pelanggan'            => 11,
                'deskripsi'            => 'Jalan Poros jlr 7'
            ],
            [
                'nama_pelanggan'       => 'Wandi',
                'nomer_hp'             => '000',
                'fkid_alamat_pelanggan'            => 11,
                'deskripsi'            => 'Jalan poros jlr 8'
            ],
            [
                'nama_pelanggan'       => 'Djuangga',
                'nomer_hp'             => '000',
                'fkid_alamat_pelanggan'            => 1,
                'deskripsi'            => '-'
            ],
            [
                'nama_pelanggan'       => 'Mukson',
                'nomer_hp'             => '000',
                'fkid_alamat_pelanggan'            => 11,
                'deskripsi'            => 'Jalur 8'
            ],
            [
                'nama_pelanggan'       => 'Linda ndun',
                'nomer_hp'             => '000',
                'fkid_alamat_pelanggan'            => 1,
                'deskripsi'            => '-'
            ],
            [
                'nama_pelanggan'       => 'Irul(vitalis)',
                'nomer_hp'             => '000',
                'fkid_alamat_pelanggan'            => 11,
                'deskripsi'            => '-'
            ],
            [
                'nama_pelanggan'       => 'Musiran',
                'nomer_hp'             => '000',
                'fkid_alamat_pelanggan'            => 1,
                'deskripsi'            => '-'
            ],
            [
                'nama_pelanggan'       => 'Siti Rohatun',
                'nomer_hp'             => '000',
                'fkid_alamat_pelanggan'            => 11,
                'deskripsi'            => 'jalur 8'
            ],
            [
                'nama_pelanggan'       => 'Alex Mandem',
                'nomer_hp'             => '000',
                'fkid_alamat_pelanggan'            => 11,
                'deskripsi'            => 'Jalan poros jalur 7'
            ],
            [
                'nama_pelanggan'       => 'Sugito',
                'nomer_hp'             => '000',
                'fkid_alamat_pelanggan'            => 11,
                'deskripsi'            => '-'
            ],
            [
                'nama_pelanggan'       => 'Nurdiyanto',
                'nomer_hp'             => '000',
                'fkid_alamat_pelanggan'            => 11,
                'deskripsi'            => 'Jalan poros jalur 8'
            ],
            [
                'nama_pelanggan'       => 'Anordus Komak',
                'nomer_hp'             => '000',
                'fkid_alamat_pelanggan'            => 11,
                'deskripsi'            => 'Jalur 8'
            ],
            [
                'nama_pelanggan'       => 'Solikin',
                'nomer_hp'             => '000',
                'fkid_alamat_pelanggan'            => 11,
                'deskripsi'            => 'Jalur 8'
            ],
            [
                'nama_pelanggan'       => 'Willhelmina Tikubun',
                'nomer_hp'             => '000',
                'fkid_alamat_pelanggan'            => 1,
                'deskripsi'            => '-'
            ],
            [
                'nama_pelanggan'       => 'M. Slamet',
                'nomer_hp'             => '000',
                'fkid_alamat_pelanggan'            => 11,
                'deskripsi'            => '-'
            ],
            [
                'nama_pelanggan'       => 'Sukirmant',
                'nomer_hp'             => '000',
                'fkid_alamat_pelanggan'            => 1,
                'deskripsi'            => '-'
            ],
            [
                'nama_pelanggan'       => 'Sunyoto',
                'nomer_hp'             => '000',
                'fkid_alamat_pelanggan'            => 11,
                'deskripsi'            => '-'
            ],
            [
                'nama_pelanggan'       => 'Rustam',
                'nomer_hp'             => '000',
                'fkid_alamat_pelanggan'            => 11,
                'deskripsi'            => 'Jalan poros jalur 7'
            ],
            [
                'nama_pelanggan'       => 'Robert Fernando',
                'nomer_hp'             => '000',
                'fkid_alamat_pelanggan'            => 1,
                'deskripsi'            => '-'
            ],
            [
                'nama_pelanggan'       => 'Yohana Rinti',
                'nomer_hp'             => '000',
                'fkid_alamat_pelanggan'            => 1,
                'deskripsi'            => '-'
            ],
            [
                'nama_pelanggan'       => 'Leonardus Lea',
                'nomer_hp'             => '000',
                'fkid_alamat_pelanggan'            => 1,
                'deskripsi'            => '-'
            ],
            [
                'nama_pelanggan'       => 'Parno A',
                'nomer_hp'             => '000',
                'fkid_alamat_pelanggan'            => 11,
                'deskripsi'            => '-'
            ],
            [
                'nama_pelanggan'       => 'Suwondo',
                'nomer_hp'             => '000',
                'fkid_alamat_pelanggan'            => 11,
                'deskripsi'            => 'Jalan poros jalur 6'
            ],
            [
                'nama_pelanggan'       => 'Hari Saputra',
                'nomer_hp'             => '000',
                'fkid_alamat_pelanggan'            => 11,
                'deskripsi'            => '-'
            ],
            [
                'nama_pelanggan'       => 'Suhendra',
                'nomer_hp'             => '000',
                'fkid_alamat_pelanggan'            => 1,
                'deskripsi'            => '-'
            ],
            [
                'nama_pelanggan'       => 'Maria Nagarema',
                'nomer_hp'             => '000',
                'fkid_alamat_pelanggan'            => 1,
                'deskripsi'            => '-'
            ],
            [
                'nama_pelanggan'       => 'Untung',
                'nomer_hp'             => '000',
                'fkid_alamat_pelanggan'            => 11,
                'deskripsi'            => 'Jalur 7'
            ],
            [
                'nama_pelanggan'       => 'Husea Bay',
                'nomer_hp'             => '000',
                'fkid_alamat_pelanggan'            => 1,
                'deskripsi'            => '-'
            ],
            [
                'nama_pelanggan'       => 'Antika Wahyu',
                'nomer_hp'             => '000',
                'fkid_alamat_pelanggan'            => 11,
                'deskripsi'            => 'Jalan poros jalur 7'
            ],
            [
                'nama_pelanggan'       => 'Sahril',
                'nomer_hp'             => '000',
                'fkid_alamat_pelanggan'            => 11,
                'deskripsi'            => 'Jalur 7'
            ],
            [
                'nama_pelanggan'       => 'Irwanto',
                'nomer_hp'             => '000',
                'fkid_alamat_pelanggan'            => 1,
                'deskripsi'            => '-'
            ],
            [
                'nama_pelanggan'       => 'Junaedi',
                'nomer_hp'             => '000',
                'fkid_alamat_pelanggan'            => 1,
                'deskripsi'            => '-'
            ],
            [
                'nama_pelanggan'       => 'Soleh',
                'nomer_hp'             => '000',
                'fkid_alamat_pelanggan'            => 1,
                'deskripsi'            => 'Jalur 8'
            ],
            [
                'nama_pelanggan'       => 'Masrip',
                'nomer_hp'             => '000',
                'fkid_alamat_pelanggan'            => 11,
                'deskripsi'            => 'Jalan poros jalur 7'
            ],
            [
                'nama_pelanggan'       => 'Tuyono',
                'nomer_hp'             => '000',
                'fkid_alamat_pelanggan'            => 1,
                'deskripsi'            => '-'
            ],
            [
                'nama_pelanggan'       => 'Agus setiawan',
                'nomer_hp'             => '000',
                'fkid_alamat_pelanggan'            => 11,
                'deskripsi'            => 'Jalur 7'
            ],
            [
                'nama_pelanggan'       => 'Adi Sismanto',
                'nomer_hp'             => '000',
                'fkid_alamat_pelanggan'            => 11,
                'deskripsi'            => 'Jalur 7'
            ],
            [
                'nama_pelanggan'       => 'Ricky(Pitono)',
                'nomer_hp'             => '000',
                'fkid_alamat_pelanggan'            => 11,
                'deskripsi'            => 'Jalan poros jalur 7'
            ],
            [
                'nama_pelanggan'       => 'Sutrisno',
                'nomer_hp'             => '000',
                'fkid_alamat_pelanggan'            => 11,
                'deskripsi'            => 'Jalur 8'
            ],
            [
                'nama_pelanggan'       => 'Kasno',
                'nomer_hp'             => '000',
                'fkid_alamat_pelanggan'            => 11,
                'deskripsi'            => '-'
            ],
            [
                'nama_pelanggan'       => 'Amin',
                'nomer_hp'             => '000',
                'fkid_alamat_pelanggan'            => 1,
                'deskripsi'            => '-'
            ],
        ];
        foreach ($data as $datas) {
            ModelsPelanggan::create($datas);
        }
    }
}
