<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLaporansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('laporans', function (Blueprint $table) {
            $table->id();
            $table->integer('no_kandang');
            $table->double('panen_harian', 8, 2);
            $table->integer('jumlah_bebek_sakit');
            $table->integer('jumlah_bebek_mati');
            $table->string('kondisi_kandang');
            $table->date('tanggal_laporan');
            $table->bigInteger('id_karyawan');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('laporans');
    }
}
