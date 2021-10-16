<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLaporanBulananDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('laporan_bulanan_details', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_laporan_bulanan');
            $table->foreign('id_laporan_bulanan')->references('id')->on('laporan_bulanans');
            $table->integer('no_kandang');
            $table->double('sum_panen_harian_kandang', 8, 2);
            $table->integer('sum_jumlah_bebek_sakit');
            $table->integer('sum_jumlah_bebek_mati');
            $table->string('avg_kondisi_kandang');
            $table->bigInteger('id_karyawan');
            $table->string('note');
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
        Schema::dropIfExists('laporan_bulanan_details');
    }
}
