<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TempatProduk extends Model
{
    protected $table = "tbl_tempat_produk";
    use HasFactory;

    protected $fillable = [
        'id_tempat_produk',
        'kode_rak',
    ];
}
