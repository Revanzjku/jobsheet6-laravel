<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Kelas;
use App\Models\Siswa;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::create([
            'name' => 'admin',
            'email' => 'admin@gmail.com',
            'password' => Hash::make('admin123'),
            'role' => 'admin',
        ]);

        $kelas = ['XI PPLG 1', 'XI PPLG 2', 'XI TPFL', 'XI TO 1', 'XI TO 2'];

        foreach($kelas as $k) {
            Kelas::create(['nama_kelas' => $k]);
        }

        Siswa::factory(10)->create();
    }
}
