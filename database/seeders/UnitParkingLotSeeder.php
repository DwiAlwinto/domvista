<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Unit;
use App\Models\ParkingLot;

class UnitParkingLotSeeder extends Seeder
{
    public function run()
    {
        // Ambil unit, misal T15A
        $unit = Unit::where('unit_code', 'T15A')->first();
        if (!$unit) {
            $this->command->error('❌ Unit T15A tidak ditemukan. Jalankan UnitSeeder dulu.');
            return;
        }

        // Ambil parking lot yang TIDAK punya unit dan tersedia
        $parkingLot = ParkingLot::whereNull('unit_id')
            ->where('is_available', true)
            ->where('lot_type', 'Parking 1')
            ->whereHas('parkingArea', function ($q) {
                $q->where('area_code', 'B1');
            })
            ->first();

        if (!$parkingLot) {
            $this->command->warn('⚠️ Tidak ada parking lot kosong di B1 (Parking 1). Coba yang lain.');
            return;
        }

        // ✅ Hubungkan dengan update unit_id
        $parkingLot->update([
            'unit_id' => $unit->id,
            'is_available' => false, // opsional: tandai sebagai dipakai
        ]);

        $this->command->info("✅ Parking Lot #{$parkingLot->id} ({$parkingLot->parkingArea->area_code} - {$parkingLot->lot_number}) terhubung ke Unit {$unit->unit_code}");
    }
}