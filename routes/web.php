<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PelanggaranController;
use App\Http\Controllers\PengurusController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SiswaController;
use App\Http\Controllers\WaliController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
 */

Route::get('/', function () {
    return redirect()->route('login');
});

Route::get('/dashboard', [DashboardController::class, 'index'])->middleware(['auth', 'verified'])->name('dashboard');

Route::group(['prefix' => 'siswa', 'middleware' => ['auth']], function () {
    Route::get('/', [SiswaController::class, 'index'])->name('siswa.index');
    Route::get('/create', [SiswaController::class, 'create'])->name('siswa.create');
    Route::post('/', [SiswaController::class, 'store'])->name('siswa.store');
    Route::get('/{siswa}', [SiswaController::class, 'show'])->name('siswa.show');
    Route::get('/{siswa}/edit', [SiswaController::class, 'edit'])->name('siswa.edit');
    Route::post('/{siswa}/update', [SiswaController::class, 'update'])->name('siswa.update');
    Route::delete('/{siswa}', [SiswaController::class, 'destroy'])->name('siswa.destroy');
});

Route::group(['prefix' => 'pelanggaran', 'middleware' => ['auth', 'role:admin|pengurus']], function () {
    Route::get('/', [PelanggaranController::class, 'index'])->name('pelanggaran.index');
    Route::get('/create', [PelanggaranController::class, 'create'])->name('pelanggaran.create');
    Route::post('/', [PelanggaranController::class, 'store'])->name('pelanggaran.store');
    Route::get('/{pelanggaran}/edit', [PelanggaranController::class, 'edit'])->name('pelanggaran.edit');
    Route::post('/{pelanggaran}/update', [PelanggaranController::class, 'update'])->name('pelanggaran.update');
    Route::delete('/{pelanggaran}', [PelanggaranController::class, 'destroy'])->name('pelanggaran.destroy');
});

// pengurus route
Route::group(['prefix' => 'pengurus', 'middleware' => ['auth', 'role:admin']], function () {
    Route::get('/', [PengurusController::class, 'index'])->name('pengurus.index');
    Route::get('/create', [PengurusController::class, 'create'])->name('pengurus.create');
    Route::post('/', [PengurusController::class, 'store'])->name('pengurus.store');
    Route::get('/{pengurus}/edit', [PengurusController::class, 'edit'])->name('pengurus.edit');
    Route::post('/{pengurus}/update', [PengurusController::class, 'update'])->name('pengurus.update');
    // delete
    Route::delete('/{pengurus}', [PengurusController::class, 'destroy'])->name('pengurus.destroy');
});
// wali route
Route::group(['prefix' => 'wali', 'middleware' => ['auth', 'role:admin']], function () {
    Route::get('/', [WaliController::class, 'index'])->name('wali.index');
    Route::get('/create', [WaliController::class, 'create'])->name('wali.create');
    Route::post('/', [WaliController::class, 'store'])->name('wali.store');
    Route::get('/{wali}/edit', [WaliController::class, 'edit'])->name('wali.edit');
    Route::post('/{wali}/update', [WaliController::class, 'update'])->name('wali.update');
    // delete
    Route::delete('/{wali}', [WaliController::class, 'destroy'])->name('wali.destroy');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
