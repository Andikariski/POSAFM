<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubTransaksiPenjualan extends Model
{
    protected $table = "tbl_sub_transaksi_penjualan";
    use HasFactory;
    protected $primaryKey = 'id_temp_transaksi_penjualan';

    protected $fillable = [
        'id_temp_transaksi_penjualan',
        'fkid_barcode_produk',
        'nama_produk',
        'harga_satuan',
        'fkid_faktur',
        'jumlah_produk',
        'sub_total',
        'profit',
        'tanggal',
    ];

    public function produk(){
        return $this->belongsTo(Produk::class,'fkid_barcode_produk','barcode_produk');
     }
 
     public function pelanggan(){
         return $this->belongsTo(Pelanggan::class,'fkid_pelanggan','id_pelanggan');
     }
 
     public function kasir(){
         return $this->belongsTo(User::class,'fkid_user','id');
     }

     public function penjualan(){
        return $this->belongsTo(TransaksiPenjualan::class,'fkid_faktur','faktur');
     }
}
