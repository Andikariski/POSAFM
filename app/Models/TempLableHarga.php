<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TempLableHarga extends Model
{
    protected $table = "tbl_temp_lable_harga";
    use HasFactory;
    // protected $primaryKey = 'barcode_produk';

    protected $fillable = [
        'barcode_produk',
        'nama_produk',
        'harga_jual_produk',
    ];
}
