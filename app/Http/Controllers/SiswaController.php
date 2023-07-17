<?php

namespace App\Http\Controllers;

use App\DataTables\SiswaDataTable;
use App\Models\Pondok;
use App\Models\Siswa;
use App\Models\User;

class SiswaController extends Controller
{
    public function index(SiswaDataTable $datatable)
    {
        return $datatable->render('siswa.index');
    }
    public function show(Siswa $siswa)
    {
        return view('siswa.show', compact('siswa'));
    }
    public function create()
    {
        $pondok = Pondok::all();
        $wali = User::role('wali')->get();
        return view('siswa.create', compact('pondok', 'wali'));
    }
    public function store()
    {
        $data = request()->validate([
            'nama' => 'required',
            'nis' => 'required|unique:siswas',
            'kelas' => 'required',
            'jurusan' => 'required',
            'jenis_kelamin' => 'required',
            'alamat' => 'required',
            'pondok_id' => 'required',
            'wali_id' => 'required',
        ]);
        Siswa::create($data);
        return redirect()->route('siswa.index')->with('success', 'Data siswa berhasil ditambahkan');
    }
    public function edit(Siswa $siswa)
    {
        $pondok = Pondok::all();
        $wali = User::role('wali')->get();
        return view('siswa.edit', compact('siswa', 'pondok', 'wali'));
    }
    public function update(Siswa $siswa)
    {
        $data = request()->validate([
            'nama' => 'required',
            'nis' => 'required|unique:siswas,nis,' . $siswa->id,
            'kelas' => 'required',
            'jurusan' => 'required',
            'jenis_kelamin' => 'required',
            'alamat' => 'required',
            'pondok_id' => 'required',
            'wali_id' => 'required',
        ]);
        $siswa->update($data);
        return redirect()->route('siswa.index')->with('success', 'Data siswa berhasil diubah');
    }
    public function destroy(Siswa $siswa)
    {
        $siswa->delete();
        // return a json response
        return response()->json([
            'success' => 'Data siswa berhasil dihapus',
        ]);
    }
}
