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
            'username' => 'admin',
            'email' => 'admin@example.com',
            'kode_warga' => 'KW001',
            'nama_lengkap' => 'Administrator Sistem',
            'email_verified_at' => now(),
            'password' => Hash::make('password123'),
            'alamat' => 'Jalan Raya Administrasi No. 1',
            'pekerjaan' => 'Admin',
            'tanggal_lahir' => '1990-01-01',
            'nik' => '1234567890123456',
            'no_hp' => '081234567890',
            'role' => 'Admin',
            'status_keluarga' => 'kepala_keluarga',
        ]);
    }
}