<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AlamatPelanggan extends Model
{
    protected $table = "tbl_alamat_pelanggan";
    use HasFactory;

    protected $fillable = [
        'id_alamat_pelanggan',
        'alamat_detail'
    ];
}
