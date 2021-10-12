<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Laporan extends Model
{
    protected $fillable = [
            'no_kandang',
            'panen_harian',
            'jumlah_bebek_sakit',
            'jumlah_bebek_mati',
            'kondisi_kandang',
            'tanggal_laporan',
            'id_karyawan',
        ];
}
