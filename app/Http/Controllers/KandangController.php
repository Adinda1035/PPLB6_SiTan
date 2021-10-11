<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\User;
use App\Kandang;

class KandangController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = DB::table('kandangs')
                    ->select('kandangs.*', 'users.nama')
                    ->orderBy('no_kandang')
                    ->join('users', 'kandangs.id_karyawan', '=', 'users.id')
                    ->paginate(10);

        foreach($data as $row){
            $to = \Carbon\Carbon::now();
            $from = \Carbon\Carbon::createFromFormat('Y-m-d', $row->tanggal_lahir);
            $diff = $to->diff($from);
            $row->diffMonth = ($diff->y*12) + $diff->m ;
            $row->diffDay = ($diff->d);
        }

        return view('admin.kandang.index-kandang', compact("data"));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data = DB::table('users')->get();
        return view('admin.kandang.create-kandang', compact("data"));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request -> validate([
            "no_kandang"=> 'required|integer|gt:0|gte:0|unique:kandangs',
            "jumlah_bebek" => 'required|integer|gt:0|gte:0',
            "id_karyawan" => 'required|integer',
        ],
        [
            'required' => 'Kolom :attribute tidak boleh kosong.',
            'no_kandang.unique' => 'Nomor kandang tidak boleh sama dengan kandang lain.',
            'min' => 'Isi kolom :attribute minimal :min karakter.',
            'gt' => 'Kolom :attribute harus bernilai angka positif',
        ]);

        $kandang = Kandang::create([
            'no_kandang' => $request->no_kandang,
            'jumlah_bebek' => $request->jumlah_bebek,
            'tanggal_lahir' => $request->tanggal_lahir,
            'id_karyawan' => $request->id_karyawan,
            'created_at' => \Carbon\Carbon::now()->toDateTimeString(),
        ]);

        return redirect(route("admin-create-kandang"));
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
        $row = Kandang::find($id);
        $data = User::with('roles')->get();

        return view('admin.kandang.edit-kandang', compact("row", "data"));
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
