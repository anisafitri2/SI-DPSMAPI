<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Siswa>
 */
class SiswaFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'nama' => $this->faker->name,
            'nis' => $this->faker->unique()->numerify('##########'),
            'kelas' => $this->faker->randomElement(['X', 'XI', 'XII']),
            // jurusan = IIS,MIPA,IBB,IIK
            'jurusan' => $this->faker->randomElement(['IIS', 'MIPA', 'IBB', 'IIK']),
            'alamat' => $this->faker->address,
            'pondok_id' => $this->faker->randomElement([1, 2, 3]),
            'wali_id' => $this->faker->randomElement([1, 2, 3]),
            'jenis_kelamin' => $this->faker->randomElement(['Laki-laki', 'Perempuan']),

        ];
    }
}
