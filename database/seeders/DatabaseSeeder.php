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
            'nama' => 'testuser',
            'username' => 'user',
            'password' => Hash::make('admin12345'),
            'jabatan' => 'Ketua Koperasi',
            'nip' => '5520122035',
            'no_hp' => '082296029563',
            'role' => 'admin',
        ]);
    }
}
