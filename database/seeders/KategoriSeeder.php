<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Kategori;

class KategoriSeeder extends Seeder
{
    public function run(): void
    {
        $kategori = [
            'Ruang Kelas',
            'Toilet',
            'Laboratorium',
            'Perpustakaan',
            'Kantin',
            'Lapangan',
        ];

        foreach ($kategori as $nama) {
            Kategori::firstOrCreate(['nama' => $nama]);
        }
    }
}
