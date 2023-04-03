<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Jadwal>
 */
class JadwalFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [

            'kelas_id' => '1',
            'mapel_id' => '1',
            'user_id' => '1',
            'tahun_ajaran_id' => '1',
            'hari' => 'Senin',
            'jam_mulai' => '13:00:00',
            'jam_selesai' => '15:00:00',
            'keterangan' => 'Teknik Komputer Jaringan'
        ];
    }
}
