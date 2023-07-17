<?php

namespace App\Http\Controllers;

use App\DataTables\WaliDataTable;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class WaliController extends Controller
{
    public function index(WaliDataTable $dataTable)
    {
        return $dataTable->render('wali.index');
    }
    public function create()
    {
        return view('wali.create');
    }
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|unique:users',
            'password' => 'required',
        ]);
        $wali = new User();
        $wali->name = $request->name;
        $wali->email = $request->email;
        $wali->password = Hash::make($request->password);
        $wali->save();
        $wali->assignRole('wali');
        return redirect()->route('wali.index')->with('success', 'Data berhasil ditambahkan');
    }
    public function edit($id)
    {
        $wali = User::findOrFail($id);
        return view('wali.edit', compact('wali'));
    }
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
            'email' => "required",
        ]);
        $wali = User::findOrFail($id);
        $wali->name = $request->name;
        $wali->email = $request->email;
        if ($request->password) {
            $wali->password = Hash::make($request->password);
        }
        $wali->save();
        return redirect()->route('wali.index')->with('success', 'Data berhasil diubah');
    }
    public function destroy($id)
    {
        $wali = User::findOrFail($id);
        $wali->delete();

        return response()->json([
            'success' => true,
            'message' => 'Data berhasil dihapus',
        ]);
    }

}
