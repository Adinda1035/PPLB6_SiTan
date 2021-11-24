<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\User;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = User::with('roles')->get();
        return view('admin.user.index-user', compact("data"));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.user.create-user');
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
            "username"=> 'unique:users|required|string|min:6|max:30',
            "nama" => 'required|string|min:3|max:100',
            "email" => 'unique:users|required|email|regex:/(.*)@(.*)\.com/i|max:100',
            "telp" => 'required|string|min:6|max:13',
            "password" => 'required|min:8',
        ],
        [
            'unique' => 'Input pada kolom :attribute sudah digunakan. Tolong gunakan :attribute lain',
            'required' => 'Kolom :attribute tidak boleh kosong.',
            'email.regex' => 'Email harus diakhiri dengan .com',
            'min' => 'Isi kolom :attribute minimal :min karakter.',
            'max' => 'Isi kolom :attribute maksimal :max karakter.',
            'telp.min' => 'Isi kolom nomor telepon minimal :min karakter.',
            'telp.max' => 'Isi kolom nomor telepon maksimal :max karakter.',
            'email.max' => 'Isi kolom email maksimal :max karakter.',
            'between' => 'Isi kolom :attribute tidak di antara :min - :max karakter.',
        ]);

        $user = User::create([
            'username' => $request->username,
            'nama' => $request->nama,
            'email' => $request->email,
            'telp' => $request->telp,
            'password' => bcrypt($request->password),
        ]);

        if ($request->role == 'admin') {
            $user->assignRole('admin');
        }
        else if ($request->role == 'karyawan') {
            $user->assignRole('karyawan');
        }

        return redirect(route("admin-index-user"))->with('success','Sukses membuat user baru.');
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
        $row = User::with('roles')->get()->where('id', $id)->first();
        return view('admin.user.edit-user', compact("row"));
    }

    public function editProfile(Request $request)
    {
        $id = Auth::id();
        $row = User::with('roles')->get()->where('id', $id)->first();

        return view('edit-profile', compact("row"));
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
        $row = User::with('roles')->get()->where('id', $id)->first();

        $request -> validate([
            "nama" => 'required|string|min:3|max:100',
            "email" => 'required|email|regex:/(.*)@(.*)\.com/i|max:100|unique:users,email,'.$row->id,
            "telp" => 'required|string|min:6|max:13',
        ],
        [
            'unique' => 'Input pada kolom :attribute sudah digunakan. Tolong gunakan :attribute lain',
            'required' => 'Kolom :attribute tidak boleh kosong.',
            'email.regex' => 'Email harus diakhiri dengan .com',
            'min' => 'Isi kolom :attribute minimal :min karakter.',
            'max' => 'Isi kolom :attribute maksimal :max karakter.',
            'telp.min' => 'Isi kolom nomor telepon minimal :min karakter.',
            'telp.max' => 'Isi kolom nomor telepon maksimal :max karakter.',
            'email.max' => 'Isi kolom email maksimal :max karakter.',
            'between' => 'Isi kolom :attribute tidak di antara :min - :max karakter.',
        ]);


        if (strlen($request->password) < 8)
        {
            User::whereId($id)->update([
                'nama' => $request->nama,
                'email' => $request->email,
                'telp' => $request->telp,
            ]);
        }

        else {
            User::whereId($id)->update([
                'nama' => $request->nama,
                'email' => $request->email,
                'telp' => $request->telp,
                'password' => bcrypt($request->password),
            ]);
        }

        return redirect(route("admin-index-user"))->with('warning',"Sukses melakukan update user dengan username '$row->username'.");
    }

    public function updateProfile(Request $request)
    {
        $request -> validate(
            [
                "nama" => 'required|string|min:3',
                "email" => 'required|string|email|max:100',
                "telp" => 'required|string|min:6|max:20',
            ],
            [
                'required' => 'Kolom :attribute tidak boleh kosong.',
                'min' => 'Isi kolom :attribute minimal :min karakter.',
                'between' => 'Isi kolom :attribute tidak di antara :min - :max karakter.',
            ]);

        $id = Auth::id();

        if (strlen($request->password) > 8)
        {
            User::whereId($id)->update([
                'nama' => $request->nama,
                'email' => $request->email,
                'telp' => $request->telp,
            ]);
        }

        else {
            User::whereId($id)->update([
                'nama' => $request->nama,
                'email' => $request->email,
                'telp' => $request->telp,
                'password' => bcrypt($request->password),
            ]);
        }

        return redirect(route("dashboard"));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        $row = User::with('roles')->get()->where('id', $id)->first();
        User::whereId($id)->delete();
        return redirect(route("admin-index-user"))->with('success',"Sukses menghapus user dengan username '$row->username'");
    }
}
