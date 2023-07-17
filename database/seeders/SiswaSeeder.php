<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class SiswaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        \App\Models\Siswa::factory()->count(100)->create();
    }
}
