<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PelangganPLN extends Model
{
    use HasFactory;

    protected $table = "tbl_pelanggan_pln";
    use HasFactory;

    protected $fillable = [
        'id_pelanggan_pln',
        'nomer_pelanggan_pln',
        'fkid_pelanggan',
    ];

    public function nama(){
        return $this->belongsTo(Pelanggan::class,'fkid_pelanggan','id_pelanggan');
    }
}
