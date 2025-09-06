<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LaporanOlshop extends Model
{
    use HasFactory;

    protected $fillable = [
        'laporan_keuangan_id',
        'nama_laporan',
        'tanggal_laporan',
        'jumlah_laporan',
        'keterangan_laporan',
        'status_laporan',
        'kategori_laporan',
    ];
}
