<?php

namespace Database\Seeders;

use App\Models\Kegiatan;
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

        Kegiatan::insert([
            [
                'tanggal' => '2025-12-10',
                'kegiatan' => 'Gotong royong membersihkan lingkungan RT 01.',
            ],
            [
                'tanggal' => '2025-12-15',
                'kegiatan' => 'Rapat rutin bulanan warga untuk membahas program kerja.',
            ],
            [
                'tanggal' => '2025-12-20',
                'kegiatan' => 'Senam pagi bersama di lapangan desa.',
            ],
            [
                'tanggal' => '2025-12-05',
                'kegiatan' => 'Pembagian sembako kepada warga kurang mampu.',
            ],
            [
                'tanggal' => '2025-12-12',
                'kegiatan' => 'Pelatihan UMKM untuk warga tentang pemasaran online.',
            ],
        ]);
    }
}