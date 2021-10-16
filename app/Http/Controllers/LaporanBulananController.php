<?php

namespace App\Http\Controllers;

use App\LaporanBulanan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class LaporanBulananController extends Controller
{
    public function index()
    {
        $data = DB::table('laporan_bulanans')->paginate(10);
        return view('admin.laporan-bulanan.index-laporan-bulanan', compact("data"));
    }

    public function show(LaporanBulanan $laporanBulanan, $id)
    {
        $laporan_bulanan = DB::table('laporan_bulanans')->where('id', $id)->first();
        $tanggal_laporan = \Carbon\Carbon::parse($laporan_bulanan->laporan_untuk)->isoFormat('MMMM Y');

        $data = DB::table('laporan_bulanan_details')
                ->select('laporan_bulanan_details.*', 'users.nama')
                ->orderBy('no_kandang')
                ->join('users', 'laporan_bulanan_details.id_karyawan', '=', 'users.id')
                ->where('id_laporan_bulanan', $id)
                ->paginate(10);

        return view('admin.laporan-bulanan.show-laporan-bulanan', compact("data", "tanggal_laporan"));
    }
}
