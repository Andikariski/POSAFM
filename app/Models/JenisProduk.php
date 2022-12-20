<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JenisProduk extends Model
{
    protected $table = "tbl_jenis_produk";
    use HasFactory;

    protected $fillable = [
        'id_jenis_produk', 'kategori_produk'
    ];
}
