<?php

namespace App\Http\Controllers;

use App\Simulasi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class SimulasiController extends Controller
{
    public function index()
    {
        $id = Auth::user()->id;

        $data = DB::table('simulasis')
                    ->where('id_karyawan', $id)
                    ->orderBy('created_at', 'desc')
                    ->simplePaginate(10);

        return view('karyawan.simulasi.index-simulasi', compact("data"));
    }

    public function create() {
        return view('karyawan.simulasi.create-simulasi');
    }

    public function store(Request $request) {
        $request -> validate([
            "jumlah_telur"=> 'required|integer|min:0|max:9999999',
        ],

        [
            'min' => 'Kolom Jumlah Telur harus bernilai angka positif atau 0',
            'max' => 'Kolom Jumlah Telur tidak boleh lebih dari :max.',
            'required' => 'Kolom Jumlah Telur harus bernilai angka positif atau 0',
        ]);

        $id = Auth::user()->id;

        $laporan = Simulasi::create([
            'metode_pembuatan' => $request->metode_pembuatan,
            'tingkat_keasinan' => $request->tingkat_keasinan,
            'jumlah_telur' => $request->jumlah_telur,
            'id_karyawan' => $id,
            'created_at' => \Carbon\Carbon::now()->toDateTimeString(),
        ]);

        return redirect(route("index-simulasi"))->with('success',"Sukses menambahkan simulasi baru");
    }

    public function show(Request $request, $id) {
        $row = Simulasi::whereId($id)->first();


        if ($row->metode_pembuatan == 1) {
            $ingredients = array(
                "Air" => round($row->jumlah_telur*125) . " ml",
                "Garam" => round($row->jumlah_telur*42) . " gram",
                "Bawang Putih" => round(((round($row->jumlah_telur*125)+round($row->jumlah_telur*42)) * 0.3 )) . " gram",
                "Waktu Pemeraman" => 12 . " hari",
            );

            if ($row->tingkat_keasinan == 2) {
                $ingredients = array(
                    "Air" => round($row->jumlah_telur*125)  . " ml",
                    "Garam" => round($row->jumlah_telur*42) + round($row->jumlah_telur*42*0.25) . " gram",
                    "Bawang Putih" => round(((round($row->jumlah_telur*125))+(round($row->jumlah_telur*42) + round($row->jumlah_telur*42*0.25))) * 0.3 ) . " gram",
                    "Waktu Pemeraman" => 15 . " hari",
                );
            }
            $steps = [
                "Cuci bersih telur bebek, lalu sisihkan",
                "Kupas bawang putih dan haluskan",
                "Campurkan bawang, garam, dan air lalu rebus hingga mendidih. Setelah mendidih dinginkan larutan garam dan bawang",
                "Masukkan telur, dan larutan garam dan bawang ke dalam toples lalu tutup. Diamkan telur tersebut dalam kurun waktu yang sudah ditentukan",
                "Setelah waktu pemeraman selesai, keluarkan telur dari toples dan cuci bersih",
                "Rebus telur yang sudah diperam sampai matang",
                "Setelah matang diamkan sampai dingin, dan telur asin siap dijual",
            ];
        }

        else if ($row->metode_pembuatan == 2) {
            $ingredients = array(
                "Air" => round($row->jumlah_telur*125) . " ml",
                "Garam" => round($row->jumlah_telur*42) . " gram",
                "Waktu Pemeraman" => 12 . " hari",
            );
            if ($row->tingkat_keasinan == 2) {
                $ingredients = array(
                    "Air" => round($row->jumlah_telur*125) . " ml",
                    "Garam" => round($row->jumlah_telur*42) + round($row->jumlah_telur*42*0.25) . " gram",
                    "Waktu Pemeraman" => 15 . " hari",
                );
            }
            $steps = [
                "Cuci bersih telur bebek, lalu sisihkan",
                "Campurkan garam dan air ke dalam toples",
                "Masukkan telur ke dalam toples lalu tutup rapat. Diamkan telur tersebut dalam kurun waktu yang sudah ditentukan",
                "Setelah waktu pemeraman selesai, keluarkan telur dari toples dan cuci bersih",
                "Rebus telur yang sudah diperam sampai matang",
                "Setelah matang diamkan sampai dingin, dan telur asin siap dijual"
            ];
        }

        else if ($row->metode_pembuatan == 3) {
            $ingredients = array(
                "Air" => "Secukupnya",
                "Garam" => round($row->jumlah_telur*42) . " gram",
                "Serbuk Batu Bata" => round($row->jumlah_telur*34) . " gram",
                "Waktu Pemeraman" => 12 . " hari",
            );
            if ($row->tingkat_keasinan == 2) {
                $ingredients = array(
                    "Air" => "Secukupnya",
                    "Garam" => round($row->jumlah_telur*42) + round($row->jumlah_telur*42*0.25) . " gram",
                    "Serbuk Batu Bata" => round($row->jumlah_telur*34) . " gram",
                    "Waktu Pemeraman" => 14 . " hari",
                );
            }
            $steps = [
                "Cuci telur hingga bersih kemudian sisihkan",
                "Campurkan batu bata dan garam ke dalam sebuah ember",
                "Tuangkan air sedikit demi sedikit hingga tekstur adonan seperti pasta",
                "Masukkan telur ke dalam adonan, tata sedemikian rupa sehingga telur dapat terendam adonan",
                "Tutup ember dan biarkan selama waktu yang telah ditentukan",
                "Apabila pemeraman selesai, ambil dan bersihkan telur",
                "Rebus telur hingga matang, kemudian dinginkan dan telur siap dijual"
            ];
        }

        else if ($row->metode_pembuatan == 4) {
            $ingredients = array(
                "Air" => "Secukupnya",
                "Garam" => round($row->jumlah_telur*5) . " gram",
                "Abu Gosok" => round($row->jumlah_telur*100) . " gram",
                "Waktu Pemeraman" => 12 . " hari",
            );
            if ($row->tingkat_keasinan == 2) {
                $ingredients = array(
                    "Air" => "Secukupnya",
                    "Garam" => round($row->jumlah_telur*5) + round($row->jumlah_telur*5*0.25) . " gram",
                    "Abu Gosok" => round($row->jumlah_telur*100) . " gram",
                    "Waktu Pemeraman" => 14 . " hari",
                );
            }
            $steps = [
                "Cuci telur hingga bersih kemudian sisihkan",
                "Campurkan abu gosok dan garam ke dalam sebuah wadah",
                "Tuangkan air sedikit demi sedikit hingga tekstur adonan seperti pasta",
                "Balurkan adonan abu gosok ke telur hingga ketebalan -/+ 3cm",
                "Tata telur yang sudah dibaluri adonan abu gosok ke sebuah wadah lalu tutup wadahnya dan diamkan selama waktu yang telah ditentukan",
                "Apabila pemeraman selesai, ambil dan bersihkan telur",
                "Rebus telur hingga matang, kemudian dinginkan dan telur siap dijual"
            ];
        }

        else if ($row->metode_pembuatan == 5) {
            $ingredients = array(
                "Air" => "Secukupnya",
                "Garam" => round($row->jumlah_telur*41) . " gram",
                "Serbuk Batu Bata" => round($row->jumlah_telur*34) . " gram",
                "Kulit Manggis" => round($row->jumlah_telur*41) * 3 . " gram",
                "Waktu Pemeraman" => 12 . " hari",
            );
            if ($row->tingkat_keasinan == 2) {
                $ingredients = array(
                    "Air" => "Secukupnya",
                    "Garam" => round($row->jumlah_telur*41) + round($row->jumlah_telur*41*0.25) . " gram",
                    "Serbuk Batu Bata" => round($row->jumlah_telur*34) . " gram",
                    "Kulit Manggis" => round((round($row->jumlah_telur*41) + round($row->jumlah_telur*41*0.25)) * 0.3) . " gram",
                    "Waktu Pemeraman" => 14 . " hari",
                );
            }
            $steps = [
                "Cuci telur hingga bersih kemudian sisihkan",
                "Haluskan kulit manggis",
                "Campurkan batu bata, kulit maggis, dan garam ke dalam sebuah ember",
                "Tuangkan air sedikit demi sedikit hingga tekstur adonan seperti pasta",
                "Masukkan telur ke dalam adonan, tata sedemikian rupa sehingga telur dapat terendam adonan",
                "Tutup ember dan biarkan selama waktu yang telah ditentukan",
                "Apabila pemeraman selesai, ambil dan bersihkan telur",
                "Rebus telur hingga matang, kemudian dinginkan dan telur siap dijual"
            ];
        }

        return view('karyawan.simulasi.result-simulasi', compact("row","ingredients", "steps"));
    }

    public function destroy(Request $request, $id) {
        Simulasi::whereId($id)->delete();
        return redirect(route("index-simulasi"))->with('success',"Sukses menghapus simulasi tersebut");
    }
}
