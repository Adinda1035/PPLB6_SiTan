<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SimulasiController extends Controller
{
    public function create() {
        return view('karyawan.simulasi.create-simulasi');
    }

    public function store(Request $request) {

        $request -> validate([
            "jumlah_telur"=> 'required|integer|min:0',
        ],

        [
            'min' => 'Kolom Jumlah Telur harus bernilai angka positif atau 0',
            'required' => 'Kolom Jumlah Telur harus bernilai angka positif atau 0',
        ]);

        if ($request->metode_pembuatan === "1") {
            $ingredients = array(
                        "Air" => round($request->jumlah_telur*125) . " ml",
                        "Garam" => round($request->jumlah_telur*42) . " gram",
                        "Bawang Putih" => round(((round($request->jumlah_telur*125)+round($request->jumlah_telur*42)) * 0.3 )) . " gram",
                        "Waktu Pemeraman" => 12 . " hari",
                    );

            if ($request->tingkat_keasinan === "2") {
                $ingredients = array(
                    "Air" => round($request->jumlah_telur*125)  . " ml",
                    "Garam" => round($request->jumlah_telur*42) + round($request->jumlah_telur*42*0.25) . " gram",
                    "Bawang Putih" => round(((round($request->jumlah_telur*125))+(round($request->jumlah_telur*42) + round($request->jumlah_telur*42*0.25))) * 0.3 ) . " gram",
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

        else if ($request->metode_pembuatan === "2") {
            $ingredients = array(
                "Air" => round($request->jumlah_telur*125) . " ml",
                "Garam" => round($request->jumlah_telur*42) . " gram",
                "Waktu Pemeraman" => 12 . " hari",
            );
            if ($request->tingkat_keasinan === "2") {
                $ingredients = array(
                    "Air" => round($request->jumlah_telur*125) . " ml",
                    "Garam" => round($request->jumlah_telur*42) + round($request->jumlah_telur*42*0.25) . " gram",
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

        else if ($request->metode_pembuatan === "3") {
            $ingredients = array(
                "Air" => "Secukupnya",
                "Garam" => round($request->jumlah_telur*42) . " gram",
                "Serbuk Batu Bata" => round($request->jumlah_telur*34) . " gram",
                "Waktu Pemeraman" => 12 . " hari",
            );
            if ($request->tingkat_keasinan === "2") {
                $ingredients = array(
                    "Air" => "Secukupnya",
                    "Garam" => round($request->jumlah_telur*42) + round($request->jumlah_telur*42*0.25) . " gram",
                    "Serbuk Batu Bata" => round($request->jumlah_telur*34) . " gram",
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

        else if ($request->metode_pembuatan === "4") {
            $ingredients = array(
                "Air" => "Secukupnya",
                "Garam" => round($request->jumlah_telur*5) . " gram",
                "Abu Gosok" => round($request->jumlah_telur*100) . " gram",
                "Waktu Pemeraman" => 12 . " hari",
            );
            if ($request->tingkat_keasinan === "2") {
                $ingredients = array(
                    "Air" => "Secukupnya",
                    "Garam" => round($request->jumlah_telur*5) + round($request->jumlah_telur*5*0.25) . " gram",
                    "Abu Gosok" => round($request->jumlah_telur*100) . " gram",
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

        else if ($request->metode_pembuatan === "5") {
            $ingredients = array(
                "Air" => "Secukupnya",
                "Garam" => round($request->jumlah_telur*41) . " gram",
                "Serbuk Batu Bata" => round($request->jumlah_telur*34) . " gram",
                "Kulit Manggis" => round($request->jumlah_telur*41) * 3 . " gram",
                "Waktu Pemeraman" => 12 . " hari",
            );
            if ($request->tingkat_keasinan === "2") {
                $ingredients = array(
                    "Air" => "Secukupnya",
                    "Garam" => round($request->jumlah_telur*41) + round($request->jumlah_telur*41*0.25) . " gram",
                    "Serbuk Batu Bata" => round($request->jumlah_telur*34) . " gram",
                    "Kulit Manggis" => round((round($request->jumlah_telur*41) + round($request->jumlah_telur*41*0.25)) * 0.3) . " gram",
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

        return redirect()->action([SimulasiController::class, 'show'], ['ingredients' => $ingredients, 'steps' => $steps]);
    }

    public function show(Request $request) {
        $ingredients = $request->ingredients;
        $steps = $request->steps;
        return view('karyawan.simulasi.result-simulasi', compact("ingredients", "steps"));
    }
}
