<?php

namespace Database\Seeders;

use App\Models\Pondok;
use Illuminate\Database\Seeder;

class PondokSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Pondok::create([
            'nama' => 'Latee 1',
        ]);
        Pondok::create([
            'nama' => 'Latee 2',
        ]);
        Pondok::create([
            'nama' => 'Lubangsa Putri',
        ]);
        Pondok::create([
            'nama' => 'Lubangsa Utara',
        ]);
        Pondok::create([
            'nama' => 'Lubangsa Selatan',
        ]);
        Pondok::create([
            'nama' => 'Al-Idrisi',
        ]);
        Pondok::create([
            'nama' => 'As-Syafi',
        ]);
        Pondok::create([
            'nama' => 'Bukit Lancaran',
        ]);
    }
}
