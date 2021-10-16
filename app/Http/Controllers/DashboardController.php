<?php

namespace App\Http\Controllers;

use App\Kandang;
use App\Laporan;
use App\LaporanBulanan;
use App\LaporanBulananDetail;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $laporan_bulanan_for = \Carbon\Carbon::now()->subMonth();

        $month_now = \Carbon\Carbon::now()->month;
        $last_laporan_date = DB::table('laporans')
            ->select('updated_at')
            ->orderBy('updated_at', 'desc')
            ->first();

        if ($last_laporan_date == null) {
            $last_laporan_month =  100;
        }

        else {
            $last_laporan_month =  \Carbon\Carbon::parse($last_laporan_date->updated_at)->format('m');
        }

        if ($month_now > $last_laporan_month) {
            $last_laporan_bulanan = DB::table('laporan_bulanans')
                ->select('updated_at')
                ->orderBy('updated_at', 'desc')
                ->first();


            if ($last_laporan_bulanan == null) {
                $last_laporan_bulanan_month = $laporan_bulanan_for->month;
            }

            else {
                $last_laporan_bulanan_month =  \Carbon\Carbon::parse($last_laporan_bulanan->updated_at)->format('m');
            }

            if ($month_now == $last_laporan_bulanan_month+1) {

                $query_kandang = DB::table('kandangs')
                    ->select('kandangs.*', 'users.id')
                    ->orderBy('no_kandang')
                    ->join('users', 'kandangs.id_karyawan', '=', 'users.id');

                $current = $query_kandang->get();



                $total_kandang = $query_kandang->count();
                $total_bebek = $query_kandang->sum('jumlah_bebek');
                $total_panen = 0;

                foreach($current as $row){
                    $query = DB::table('laporans')
                        ->where('no_kandang', $row->no_kandang)
                        ->whereMonth('tanggal_laporan', 10);

                    if (!$query->get() == null){
                        $row->sum_panen_harian_kandang = $query->sum( 'panen_harian');
                        $row->sum_jumlah_bebek_mati = $query->sum( 'jumlah_bebek_mati');
                        $row->sum_jumlah_bebek_sakit = $query->sum( 'jumlah_bebek_sakit');
                        $row->kondisi_kandang_baik = $query->where('kondisi_kandang', 'baik')->count();
                        $row->kondisi_kandang_buruk = $query->where('kondisi_kandang', 'buruk')->count();

                        if ($row->kondisi_kandang_baik >= $row->kondisi_kandang_buruk) {
                            $row->avg_kondisi_kandang = "baik";
                        }
                        else {
                            $row->avg_kondisi_kandang = "buruk";
                        }

                        $total_panen += $row->sum_panen_harian_kandang;
                    }
                }

                $laporan_bulanan = LaporanBulanan::create([
                    'laporan_untuk' => $laporan_bulanan_for,
                    'jumlah_kandang' => $total_kandang,
                    'jumlah_bebek' => $total_bebek,
                    'sum_panen_harian' => $total_panen,
                    'created_at' => \Carbon\Carbon::now()->toDateTimeString(),
                ]);

                $laporan_bulanan_recent = DB::table('laporan_bulanans')->max('id');

                foreach($current as $row){
                    $laporan_bulanan_detail = LaporanBulananDetail::create([
                        'id_laporan_bulanan' => $laporan_bulanan_recent,
                        'no_kandang' => $row->no_kandang,
                        'sum_panen_harian_kandang' => $row->sum_panen_harian_kandang,
                        'sum_jumlah_bebek_sakit' => $row->sum_jumlah_bebek_sakit,
                        'sum_jumlah_bebek_mati' => $row->sum_jumlah_bebek_mati,
                        'avg_kondisi_kandang' => $row->avg_kondisi_kandang,
                        'id_karyawan' => $row->id_karyawan,
                        'note' => "1",
                        'created_at' => \Carbon\Carbon::now()->toDateTimeString(),
                    ]);
                }
            }
        }


        if (Auth::user()->hasRole('admin'))
        {
            $data = DB::table('kandangs')
                ->select('kandangs.*', 'users.nama')
                ->orderBy('no_kandang')
                ->join('users', 'kandangs.id_karyawan', '=', 'users.id')
                ->get();
        }

        else {

            $id = Auth::user()->id;

            $data = DB::table('kandangs')
                ->select('kandangs.*', 'users.nama')
                ->orderBy('no_kandang')
                ->join('users', 'kandangs.id_karyawan', '=', 'users.id')
                ->where('id_karyawan', $id)
                ->get();
        }

        foreach($data as $row){
            $row->laporan = DB::table('laporans')
                ->select('tanggal_laporan', 'panen_harian', 'kondisi_kandang', 'jumlah_bebek_sakit', 'jumlah_bebek_mati')
                ->orderBy('tanggal_laporan', 'desc')
                ->orderBy('updated_at', 'desc')
                ->where('no_kandang', $row->no_kandang)->first();

            if (!$row->laporan == null){
                $row->laporan->tanggal_laporan = \Carbon\Carbon::parse($row->laporan->tanggal_laporan)->isoFormat('D MMMM Y');
            }
        }

        return view('dashboard', compact("data"));
    }
}
