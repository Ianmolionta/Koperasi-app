<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::create([
            'nama' => 'Sudarmin',
            'username' => 'Admin',
            'password' => Hash::make('admin12345'),
            'jabatan' => 'Ketua Koperasi',
            'no_hp' => '082296029563',
            'role' => 'admin',
        ]);
    }
}
