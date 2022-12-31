<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TransaksiPenjualan extends Model
{
    protected $table = "tbl_transaksi_penjualan";
    use HasFactory;

    protected $fillable = [
        'faktur',
        'fkid_pelanggan',
        'fkid_user',
        'total_pembayaran',
        'uang_terbayar',
        'status_transaksi',
        'tanggal',
    ];

    public function pelanggan(){
        return $this->belongsTo(Pelanggan::class, 'fkid_pelanggan','id_pelanggan');
    }
    public function kasir(){
        return $this->belongsTo(User::class, 'fkid_user','id');
    }
    public function subpenjualan(){
        return $this->hasMany(SubTransaksiPenjualan::class,'faktur','fkid_faktur');
    }
}
