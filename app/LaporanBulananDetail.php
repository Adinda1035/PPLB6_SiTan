<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class LaporanBulananDetail extends Model
{
    protected $fillable = [
        'id_laporan_bulanan',
        'no_kandang',
        'sum_panen_harian_kandang',
        'sum_jumlah_bebek_sakit',
        'sum_jumlah_bebek_mati',
        'avg_kondisi_kandang',
        'id_karyawan',
        'note',
    ];
}
