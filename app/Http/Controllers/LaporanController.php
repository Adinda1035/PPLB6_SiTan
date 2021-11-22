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
            ->paginate(8);

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
        $available = [];

        $id = Auth::user()->id;
        $data = DB::table('kandangs')->get()->where('id_karyawan', $id);

        foreach($data as $row){
            $to = \Carbon\Carbon::now();
            $from = \Carbon\Carbon::createFromFormat('Y-m-d', $row->tanggal_lahir);
            $diff = $to->diff($from);
            $row->diffMonth = ($diff->y*12) + $diff->m;

            if ($row->diffMonth>5) {
                array_push($available, $row->no_kandang);
            }
        }

        return view('karyawan.laporan.create-laporan', compact("data", "available"));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if ($request->panen_harian == null) {
            $request->panen_harian = 0;
        }

        $row = Kandang::where('no_kandang', $request->no_kandang)->firstOrFail();

        $id = Auth::user()->id;
        $request -> validate([
            "no_kandang"=> 'required|integer|gt:0|gte:0',
            "tanggal_laporan"=> 'required|date',
            "panen_harian"=> 'numeric|min:0',
            "jumlah_bebek_sakit" => 'required|integer|min:0|max:'.$row->jumlah_bebek ,
            "jumlah_bebek_mati" => 'required|integer|min:0|max:'.$row->jumlah_bebek ,
            "kondisi_kandang" => 'required|string',
        ],

        [
            'required' => 'Kolom :attribute tidak boleh kosong.',
            'min' => 'Kolom :attribute harus bernilai angka positif',
            'max' => 'Kolom :attribute tidak boleh lebih dari jumlah bebek :max',
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

        if ($request->jumlah_bebek_mati > 0) {
            Kandang::whereId($row->id)->update([
                'jumlah_bebek' => ($row->jumlah_bebek - $request->jumlah_bebek_mati),
                'updated_at' => \Carbon\Carbon::now()->toDateTimeString(),
            ]);
        }

        return redirect(route("index-laporan-harian"))->with('success','Sukses membuat laporan harian baru.');
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
        if ($request->panen_harian == null) {
            $request->panen_harian = 0;
        }

        $id_karyawan = Auth::user()->id;
        $row = Kandang::where('no_kandang', $request->no_kandang)->firstOrFail();
        $row_laporan = Laporan::whereId($id)->firstOrFail();

        $request -> validate([
            "no_kandang"=> 'required|integer|gt:0|gte:0',
            "tanggal_laporan"=> 'required|date',
            "panen_harian"=> 'required|numeric|min:0',
            "jumlah_bebek_sakit" => 'required|integer|min:0|max:'.$row->jumlah_bebek ,
            "jumlah_bebek_mati" => 'required|integer|min:0|max:'.$row->jumlah_bebek ,
            "kondisi_kandang" => 'required|string',
        ],
            [
                'required' => 'Kolom :attribute tidak boleh kosong.',
                'min' => 'Isi kolom :attribute minimal :min karakter.',
                'gt' => 'Kolom :attribute harus bernilai angka positif',
            ]);

        if ($request->jumlah_bebek_mati != $row_laporan->jumlah_bebek_mati) {

            if ($request->jumlah_bebek_mati > $row_laporan->jumlah_bebek_mati) {
                $jumlah_bebek_baru = $row->jumlah_bebek - ($request->jumlah_bebek_mati - $row_laporan->jumlah_bebek_mati);
                Kandang::whereId($row->id)->update([
                    'jumlah_bebek' => $jumlah_bebek_baru,
                    'updated_at' => \Carbon\Carbon::now()->toDateTimeString(),
                ]);
            }

            elseif ($request->jumlah_bebek_mati < $row_laporan->jumlah_bebek_mati) {
                $jumlah_bebek_baru = $row->jumlah_bebek + ($row_laporan->jumlah_bebek_mati - $request->jumlah_bebek_mati);
                Kandang::whereId($row->id)->update([
                    'jumlah_bebek' => $jumlah_bebek_baru,
                    'updated_at' => \Carbon\Carbon::now()->toDateTimeString(),
                ]);
            }
        }

        Laporan::whereId($id)->update([
            'no_kandang' => $request->no_kandang,
            'tanggal_laporan' => $request->tanggal_laporan,
            'panen_harian' => $request->panen_harian,
            'jumlah_bebek_sakit' => $request->jumlah_bebek_sakit,
            'jumlah_bebek_mati' => $request->jumlah_bebek_mati,
            'kondisi_kandang' => $request->kondisi_kandang,
            'id_karyawan' => $id,
            'updated_at' => \Carbon\Carbon::now()->toDateTimeString(),
        ]);

        return redirect(route("index-laporan-harian"))->with('warning',"Sukses melakukan update laporan tanggal $row_laporan->tanggal_laporan.");
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        //
    }
}
