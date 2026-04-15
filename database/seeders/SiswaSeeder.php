<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Siswa;

class SiswaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Siswa::create([
            'nisn' => '1234567890',
            'nama' => 'Vinza Pradita',
            'email' => 'vinza@gmail.com',
            'kata_sandi' => 'password123',
            'kelas' => 'XII RPL 1',
        ]);
    }
}
