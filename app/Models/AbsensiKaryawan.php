<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class AbsensiKaryawan extends Model
{
    protected $table = "tbl_absensi_karyawan";
    use HasFactory;

    protected $fillable = [
        'fkid_user',
        'tanggal_absen',
        'masuk_pagi',
        'keluar_siang',
        'masuk_siang',
        'keluar_sore',
        'masuk_pagi_status',
        'keluar_siang_status',
        'masuk_siang_status',
        'keluar_sore_status',
        'catatan'
    ];

    protected $casts = [
        'tanggal_absen' => 'date',
        'masuk_page' => 'datetime',
        'keluar_siang' => 'datetime',
        'masuk_siang' => 'datetime',
        'keluar_sore' => 'datetime'
    ];

    // relational function dengan users
    public function karyawan(): BelongsTo
    {
        return $this->belongsTo(User::class, 'fkid_user');
    }
}
