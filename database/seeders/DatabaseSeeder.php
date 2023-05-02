<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\DataSiswa;
use App\Models\Jadwal;
use App\Models\Jurusan;
use App\Models\Kelas;
use App\Models\Mapel;
use App\Models\TahunAjaran;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::factory(10)->create();
        DataSiswa::factory(30)->create();
        Jurusan::factory(1)->create();
        Mapel::factory(1)->create();
        TahunAjaran::factory(1)->create();
        Jadwal::factory(1)->create();
        Kelas::factory(1)->create();
        Jurusan::create([
            'nama' => 'Teknik Instalasi Tenaga Listrik',
            'kode' => 'TITL',
            'keterangan' => 'Listrik'
        ]);

        User::create([
            'nip' => fake()->unique()->nik(),
            'nama' => 'Admin',
            'email' => fake()->unique()->email(),
            'alamat' => fake()->address(),
            'no_HP' => fake()->phoneNumber(),
            'status' => 'PNS',
            'tgl_lahir' => '1999-10-12',
            'role' => 1,
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            'remember_token' => Str::random(10),
        ]);

        Mapel::create([
            'nama' => 'Instalasi Listrik Dasar',
            'jurusan_id' => '2',
            'keterangan' => 'Mapel Kejuruan'
        ]);

        Jadwal::create([
            'kelas_id' => '2',
            'mapel_id' => '2',
            'user_id' => '2',
            'tahun_ajaran_id' => '1',
            'hari' => 'Selasa',
            'jam_mulai' => '13:00:00',
            'jam_selesai' => '15:00:00',
            'keterangan' => 'tes'
        ]);

        Kelas::create([
            'nama' => 'X TITL 1',
            'jurusan_id' => '2',
            'keterangan' => 'Listrik'
        ]);
        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
    }
}
