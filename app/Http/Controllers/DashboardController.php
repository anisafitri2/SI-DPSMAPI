<?php

namespace App\Http\Controllers;

use App\Models\Siswa;
use App\Models\User;

class DashboardController extends Controller
{
    public function index()
    {
        $siswa = Siswa::count();
        $wali = User::role('wali')->count();
        $admin = User::role('admin')->count();
        $pengurus = User::role('pengurus')->count();
        $pelanggaran = Siswa::whereHas('pelanggaran')->count();
        $notPelanggaran = Siswa::whereDoesntHave('pelanggaran')->count();
        return view('dashboard', compact('siswa', 'wali', 'admin', 'pelanggaran', 'notPelanggaran', 'pengurus'));
    }
}
