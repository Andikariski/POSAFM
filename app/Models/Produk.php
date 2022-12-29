<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Produk extends Model
{
    
    protected $table = "tbl_produk";
    use HasFactory;
    // protected $primaryKey = 'barcode_produk';

    protected $fillable = [
        'barcode_produk',
        'nama_produk',
        'stok_produk',
        'harga_beli_produk',
        'harga_jual_produk',
        'profit',
        'fkid_jenis_produk',
        'fkid_tempat_produk'
    ];

    public function kategori()
    {
        return $this->belongsTo(JenisProduk::class, 'fkid_jenis_produk','id_jenis_produk');
    }

    public function tempatproduk(){
        return $this->belongsTo(TempatProduk::class,'fkid_tempat_produk','id_tempat_produk');
    }
}
