<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Pelanggaran>
 */
class PelanggaranFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'siswa_id' => \App\Models\Siswa::factory(),
            'nama_pelanggaran' => $this->faker->word,
            'keterangan' => $this->faker->sentence,
            'tanggal' => $this->faker->date(),
            'kategori' => $this->faker->randomElement(['ringan', 'sedang', 'berat']),
        ];
    }
}
