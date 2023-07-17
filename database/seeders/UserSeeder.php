<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'name' => 'Wali 1',
            'email' => 'wali@email.com',
            'password' => bcrypt('password'),
        ])->assignRole('wali');
        User::create([
            'name' => 'Wali 2',
            'email' => 'wali2@email.com',
            'password' => bcrypt('password'),
        ])->assignRole('wali');
        User::create([
            'name' => 'Wali 3',
            'email' => 'wali3@email.com',
            'password' => bcrypt('password'),
        ])->assignRole('wali');
        User::create([
            'name' => 'Admin',
            'email' => 'admin@email.com',
            'password' => bcrypt('password'),
        ])->assignRole('admin');

        User::create([
            'name' => 'Pengurus 1',
            'pondok_id' => 1,
            'email' => 'pengurus@email.com',
            'password' => bcrypt('password'),
        ])->assignRole('pengurus');
    }
}
