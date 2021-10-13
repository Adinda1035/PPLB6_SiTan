<?php

namespace App\Http\Controllers;

use App\Kandang;
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
        if (Auth::user()->hasRole('admin'))
        {
            $data = DB::table('kandangs')
                ->select('kandangs.*', 'users.nama')
                ->orderBy('no_kandang')
                ->join('users', 'kandangs.id_karyawan', '=', 'users.id')
                ->get();

            foreach($data as $row){
                $row->laporan = DB::table('laporans')
                                    ->select('panen_harian', 'kondisi_kandang', 'jumlah_bebek_sakit', 'jumlah_bebek_mati')
                                    ->orderBy('tanggal_laporan', 'desc')
                                    ->orderBy('updated_at', 'desc')
                                    ->where('no_kandang', $row->no_kandang)->first();
            }
        }

        else {

            $id = Auth::user()->id;

            $data = DB::table('kandangs')
                ->select('kandangs.*', 'users.nama')
                ->orderBy('no_kandang')
                ->join('users', 'kandangs.id_karyawan', '=', 'users.id')
                ->where('id_karyawan', $id)
                ->get();

            foreach($data as $row){
                $row->laporan = DB::table('laporans')
                    ->select('panen_harian', 'kondisi_kandang', 'jumlah_bebek_sakit', 'jumlah_bebek_mati')
                    ->orderBy('tanggal_laporan', 'desc')
                    ->orderBy('updated_at', 'desc')
                    ->where('no_kandang', $row->no_kandang)->first();
            }
        }

        return view('dashboard', compact("data"));
    }
}
