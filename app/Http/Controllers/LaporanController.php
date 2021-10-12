<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\User;
use App\Kandang;
use App\Laporan;

class LaporanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $id = Auth::user()->id;

        $data = DB::table('laporans')
            ->orderBy('tanggal_laporan', 'desc')
            ->orderBy('no_kandang')
            ->where('id_karyawan', $id)
            ->paginate(20);

        foreach($data as $row){
            $row->tanggal_laporan = \Carbon\Carbon::parse($row->tanggal_laporan)->isoFormat('D MMMM Y');
        }

        return view('karyawan.laporan.index-laporan', compact("data"));
    }

    public function indexAdmin()
    {
        $id = Auth::user()->id;

        $data = DB::table('laporans')
            ->select('laporans.*', 'users.nama')
            ->orderBy('tanggal_laporan', 'desc')
            ->orderBy('no_kandang')
            ->join('users', 'laporans.id_karyawan', '=', 'users.id')
            ->paginate(20);

        foreach($data as $row){
            $row->tanggal_laporan = \Carbon\Carbon::parse($row->tanggal_laporan)->isoFormat('D MMMM Y');
        }

        return view('admin.laporan.index-laporan', compact("data"));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $id = Auth::user()->id;
        $data = DB::table('kandangs')->get()->where('id_karyawan', $id);

        return view('karyawan.laporan.create-laporan', compact("data"));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $id = Auth::user()->id;
        $request -> validate([
            "no_kandang"=> 'required|integer|gt:0|gte:0',
//            "no_kandang"=> 'required|integer|gt:0|gte:0|unique:laporans,tanggal_laporan,'.$id,
            "tanggal_laporan"=> 'required|date',
            "panen_harian"=> 'required|numeric|gt:0|gte:0',
            "jumlah_bebek_sakit" => 'required|integer|gt:0|gte:0',
            "jumlah_bebek_mati" => 'required|integer|gt:0|gte:0',
            "kondisi_kandang" => 'required|string',
        ],
        [
            'required' => 'Kolom :attribute tidak boleh kosong.',
            'min' => 'Isi kolom :attribute minimal :min karakter.',
            'gt' => 'Kolom :attribute harus bernilai angka positif',
        ]);


        $laporan = Laporan::create([
            'no_kandang' => $request->no_kandang,
            'tanggal_laporan' => $request->tanggal_laporan,
            'panen_harian' => $request->panen_harian,
            'jumlah_bebek_sakit' => $request->jumlah_bebek_sakit,
            'jumlah_bebek_mati' => $request->jumlah_bebek_mati,
            'kondisi_kandang' => $request->kondisi_kandang,
            'id_karyawan' => $id,
            'created_at' => \Carbon\Carbon::now()->toDateTimeString(),
        ]);

        return redirect(route("create-laporan-harian"));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function edit(Request $request, $id)
    {
        $row = Laporan::find($id);
        $id_auth = Auth::user()->id;
        $data = DB::table('kandangs')->get()->where('id_karyawan', $id_auth);

        return view('karyawan.laporan.edit-laporan', compact("row", "data"));
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

        $request -> validate([
//            "no_kandang"=> 'required|integer|gt:0|gte:0|unique:kandangs',
            "no_kandang"=> 'required|integer|gt:0|gte:0|unique:kandangs,no_kandang,'.$id,
            "jumlah_bebek" => 'required|integer|gt:0|gte:0',
            "id_karyawan" => 'required|integer',
        ],
            [
                'required' => 'Kolom :attribute tidak boleh kosong.',
                'no_kandang.unique' => 'Nomor kandang tidak boleh sama dengan kandang lain.',
                'min' => 'Isi kolom :attribute minimal :min karakter.',
                'gt' => 'Kolom :attribute harus bernilai angka positif',
            ]);

        Kandang::whereId($id)->update([
            'no_kandang' => $request->no_kandang,
            'jumlah_bebek' => $request->jumlah_bebek,
            'tanggal_lahir' => $request->tanggal_lahir,
            'id_karyawan' => $request->id_karyawan,
            'updated_at' => \Carbon\Carbon::now()->toDateTimeString(),
        ]);

        return redirect(route("admin-index-kandang"));
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        Kandang::whereId($id)->delete();
        return redirect(route("admin-index-kandang"));
    }
}
