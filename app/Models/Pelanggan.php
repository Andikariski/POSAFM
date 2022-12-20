<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pelanggan extends Model
{
    protected $table = "tbl_pelanggan";
    use HasFactory;

    protected $fillable = [
        'id_pelanggan',
        'nama_pelanggan',
        'nomer_hp',
        'deskripsi',
        'fkid_alamat_pelanggan',
    ];

    public function alamat()
    {
        return $this->belongsTo(AlamatPelanggan::class,'fkid_alamat_pelanggan','id_alamat_pelanggan');
    }
}
