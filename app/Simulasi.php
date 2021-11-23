<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Simulasi extends Model
{
    protected $fillable = [
        'metode_pembuatan',
        'tingkat_keasinan',
        'jumlah_telur',
        'id_karyawan',
    ];
}
