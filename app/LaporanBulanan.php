<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class LaporanBulanan extends Model
{
    protected $fillable = [
        'laporan_untuk',
        'jumlah_kandang',
        'jumlah_bebek',
        'sum_panen_harian',
    ];
}
