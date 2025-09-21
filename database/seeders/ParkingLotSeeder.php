<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\ParkingLot;
use App\Models\ParkingArea;

class ParkingLotSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Nonaktifkan foreign key checks untuk truncate
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        ParkingLot::truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        // Ambil area berdasarkan ID
        $areaB1 = ParkingArea::find(1);
        $areaB2 = ParkingArea::find(2);
        $areaB3 = ParkingArea::find(3);

        // Validasi apakah area ditemukan
        if (!$areaB1 || !$areaB2 || !$areaB3) {
            $this->command->error('❌ Parking area dengan ID 1, 2, atau 3 tidak ditemukan.');
            $this->command->warn('Pastikan ParkingAreaSeeder sudah dijalankan dan data B1, B2, B3 tersedia.');
            return;
        }

        $createdCount = 0;

        // === Area B1: lot_number 1 - 187 ===
        $this->command->info("🔧 Membuat parking lot untuk area: {$areaB1->area_code} (B1)");
        for ($i = 1; $i <= 187; $i++) {
            ParkingLot::create([
                'parking_area_id' => $areaB1->id,
                'lot_number'      => $i,
                'lot_type'        => 'B1',
                'is_available'    => true,
                'resident_id'         => null, // kosongkan dulu, bisa diisi nanti via fitur
            ]);
            $createdCount++;
        }

        // === Area B2: lot_number 1 - 206 ===
        $this->command->info("🔧 Membuat parking lot untuk area: {$areaB2->area_code} (B2)");
        for ($i = 1; $i <= 206; $i++) {
            ParkingLot::create([
                'parking_area_id' => $areaB2->id,
                'lot_number'      => $i,
                'lot_type'        => 'B2',
                'is_available'    => true,
                'resident_id'         => null,
            ]);
            $createdCount++;
        }

        // === Area B3: lot_number 1 - 206 ===
        $this->command->info("🔧 Membuat parking lot untuk area: {$areaB3->area_code} (B3)");
        for ($i = 1; $i <= 206; $i++) {
            ParkingLot::create([
                'parking_area_id' => $areaB3->id,
                'lot_number'      => $i,
                'lot_type'        => 'B3',
                'is_available'    => true,
                'resident_id'         => null,
            ]);
            $createdCount++;
        }

        // Output sukses
        $this->command->info("✅ Berhasil membuat {$createdCount} parking lot.");
        $this->command->info("✅ Semua parking lot telah dibuat dengan is_available = true.");
        $this->command->info("✅ Struktur: B1 (1-187), B2 (1-206), B3 (1-206) sesuai area.");
    }
}
