<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Floor;

class FloorSeeder extends Seeder
{
    public function run()
    {
        // Ambil Tower berdasarkan nama
        $tower1 = \App\Models\Tower::where('name', 'T1')->first();
        $tower2 = \App\Models\Tower::where('name', 'T2')->first();

        if (!$tower1 || !$tower2) {
            $this->command->error('Pastikan Tower T1 dan T2 sudah ada di database.');
            return;
        }

        // Tambahkan lantai untuk Tower 1: 5 sampai 61
        for ($i = 5; $i <= 61; $i++) {
            Floor::create([
                'tower_id' => $tower1->id,
                'floor_number' => $i,
            ]);
        }

        // Tambahkan lantai untuk Tower 2: 5 sampai 57
        for ($i = 5; $i <= 57; $i++) {
            Floor::create([
                'tower_id' => $tower2->id,
                'floor_number' => $i,
            ]);
        }

        $this->command->info('Lantai untuk T1 (5-61) dan T2 (5-57) berhasil diisi.');
    }
}
