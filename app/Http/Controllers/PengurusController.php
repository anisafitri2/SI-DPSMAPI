<?php

namespace App\Http\Controllers;

use App\DataTables\PengurusDataTable;
use App\Models\Pondok;
use App\Models\User;

class PengurusController extends Controller
{
    public function index(PengurusDataTable $pengurusDataTable)
    {
        return $pengurusDataTable->render('pengurus.index');
    }
    public function create()
    {
        $pondok = Pondok::all();
        return view('pengurus.create', compact('pondok'));
    }
    public function store()
    {
        $data = request()->validate([
            'name' => 'required',
            'email' => 'required|unique:users',
            'password' => 'required',
            'pondok_id' => 'required',
        ]);
        $data['password'] = bcrypt($data['password']);
        $user = User::create($data);
        $user->assignRole('pengurus');
        return redirect()->route('pengurus.index');
    }
    public function edit(User $pengurus)
    {
        $pondok = Pondok::all();
        return view('pengurus.edit', compact('pengurus', 'pondok'));
    }
    public function update(User $pengurus)
    {
        $data = request()->validate([
            'name' => 'required',
            'email' => 'required',
            'pondok_id' => 'required',
        ]);
        $pengurus->update($data);
        return redirect()->route('pengurus.index');
    }
    //soft delete
    public function destroy(User $pengurus)
    {
        $pengurus->delete();
        // return json
        return response()->json([
            'success' => true,
            'message' => 'Data berhasil dihapus',
        ]);
    }
}
