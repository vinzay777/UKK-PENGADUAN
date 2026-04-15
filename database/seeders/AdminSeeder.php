<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Admin;

class AdminSeeder extends Seeder
{
    public function run(): void
    {
        Admin::create([
            'username' => 'admin',
            'nama' => 'Admin FacilityHub',
            'kata_sandi' => 'admin123',
        ]);
    }
}
