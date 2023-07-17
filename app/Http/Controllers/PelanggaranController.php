<?php

namespace App\Http\Controllers;

use App\DataTables\PelanggaranDataTable;
use App\Models\Pelanggaran;
use App\Models\Siswa;

class PelanggaranController extends Controller
{
    public function index(PelanggaranDataTable $dataTable)
    {
        return $dataTable->render('pelanggaran.index');
    }
    public function create()
    {
        $siswa = Siswa::all();
        return view('pelanggaran.create', compact('siswa'));
    }
    public function store()
    {
        $data = request()->validate([
            'siswa_id' => 'required',
            'nama_pelanggaran' => 'required',
            'keterangan' => 'required',
            'tanggal' => 'required',
            'kategori' => 'required',
        ]);
        Pelanggaran::create($data);
        return redirect()->route('pelanggaran.index');
    }
    public function edit(Pelanggaran $pelanggaran)
    {
        $siswa = Siswa::all();
        return view('pelanggaran.edit', compact('pelanggaran', 'siswa'));
    }
    public function update(Pelanggaran $pelanggaran)
    {
        $data = request()->validate([
            'siswa_id' => 'required',
            'nama_pelanggaran' => 'required',
            'keterangan' => 'required',
            'tanggal' => 'required',
            'kategori' => 'required',
        ]);
        $pelanggaran->update($data);
        return redirect()->route('pelanggaran.index');
    }
    public function destroy(Pelanggaran $pelanggaran)
    {
        $pelanggaran->delete();
        // return resporse a json data
        return response()->json([
            'success' => true,
            'message' => 'Data berhasil dihapus',
        ]);

    }
}
