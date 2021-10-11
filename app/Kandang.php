<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Kandang extends Model
{
    protected $fillable = [
        'no_kandang', 'jumlah_bebek', 'tanggal_lahir', 'id_karyawan',
    ];
}
