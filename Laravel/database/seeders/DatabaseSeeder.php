<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Kelas;
use App\Models\Mapel;
class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::factory()->create([
            'name' => 'Admin User',
            'email' => 'admin@example.com',
            'password' => bcrypt('password'), // ganti sesuai kebutuhan
            'role' => 'admin',
        ]);

        User::factory()->create([
            'name' => 'Ortu User',
            'email' => 'ortu@example.com',
            'password' => bcrypt('password'), // ganti sesuai kebutuhan
            'role' => 'ortu',
        ]);

        User::factory()->create([
            'name' => 'Guru User',
            'email' => 'guru@example.com',
            'password' => bcrypt('password'), // ganti sesuai kebutuhan
            'role' => 'guru',
        ]);

        for ($class = 1; $class <= 6; $class++) {
            foreach (['A', 'B', 'C', 'D', 'E'] as $subClass) {
              Kelas::create([
                    'class' => $class,
                    'sub-class' => $subClass,
                ]);
            }
        }

        $mapelList = [
            'Matematika',
            'Bahasa Indonesia',
            'Bahasa Inggris',
            'IPA',
            'IPS',
            'Pendidikan Agama',
            'PJOK',
            'Seni Budaya',
            'Prakarya',
        ];

        $kelasAll = Kelas::all();

        foreach ($kelasAll as $kelas) {
            foreach ($mapelList as $mapel) {
              Mapel::create([
                    'name' => $mapel,
                    'kelas_id' => $kelas->id,
                ]);
            }
        }

    }
}
