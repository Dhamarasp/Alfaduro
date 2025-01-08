<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;

class PegawaiController extends Controller
{
    public function index()
    {
        $jabatan = Role::all();
        $pegawai = User::with('jabatan')->get();
        return view('pegawai.index', compact('jabatan', 'pegawai'));
    }

    public function store(Request $request)
    {
        //dd($request->all());

        User::create([
            'name' => $request->nama,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'alamat' => $request->alamat,
            'noTelp' => $request->noTelp,
            'id_jabatan' => $request->id_jabatan,
        ]);

        return redirect()->route("pegawai.index")->with("success","Berhasil Tambah Pegawai");
    }
    
    public function destroy(User $pegawai)
    {
        $pegawai->delete();
        return redirect()->route("pegawai.index")->with("success","Berhasil Hapus Pegawai");
    }
}
