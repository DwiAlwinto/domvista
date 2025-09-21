<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Unit;
use App\Models\Floor;
use App\Models\UnitType;
use App\Models\Tower;

class UnitSeeder extends Seeder
{
    public function run()
    {
        $floors = Floor::with('tower')->get();
        $this->command->info("🔍 Ditemukan " . $floors->count() . " lantai.");

        if ($floors->isEmpty()) {
            $this->command->error('❌ Tidak ada lantai ditemukan. Jalankan FloorSeeder dulu.');
            return;
        }

        // Ambil unit_type_id berdasarkan code
        $types = UnitType::pluck('id', 'code');

        if ($types->isEmpty()) {
            $this->command->error('❌ Tidak ada UnitType ditemukan. Jalankan UnitTypeSeeder dulu.');
            return;
        }

        // Validasi tipe yang dibutuhkan
        $requiredTypes = ['A', 'B', 'C', 'D', 'PH'];
        foreach ($requiredTypes as $code) {
            if (!$types->has($code)) {
                $this->command->error("❌ UnitType dengan code '{$code}' tidak ditemukan.");
                return;
            }
        }

        // Ambil tower
        $t1 = Tower::where('name', 'T1')->first();
        $t2 = Tower::where('name', 'T2')->first();

        if (!$t1 || !$t2) {
            $this->command->error("❌ Tower T1 atau T2 tidak ditemukan.");
            return;
        }

        $count = ['T1' => 0, 'T2' => 0];

        // Daftar lantai yang di-skip
        $skippedFloors = [13, 14, 24, 33, 34, 44, 54];

        // === TOWER 1: LANTAI 5 – 61 ===
        $this->command->info("🏗️ Membuat unit untuk T1 (lantai 5 - 61, tanpa lantai: " . implode(', ', $skippedFloors) . ")");

        for ($floorNum = 5; $floorNum <= 61; $floorNum++) {
            if (in_array($floorNum, $skippedFloors)) {
                $this->command->warn("🚫 Melewatkan lantai {$floorNum} (tidak digunakan)");
                continue;
            }

            $floor = $floors->firstWhere(fn($f) => $f->floor_number == $floorNum && $f->tower_id == $t1->id);
            if (!$floor) {
                $this->command->warn("⚠️ Lantai {$floorNum} untuk T1 tidak ditemukan di database.");
                continue;
            }

            $availableTypes = [];
            if ($floorNum >= 5 && $floorNum <= 57) {
                $availableTypes = ['A', 'B', 'C', 'D'];
            } elseif ($floorNum >= 58 && $floorNum <= 61) {
                $availableTypes = ['PH'];
            }

            if ($floorNum == 35) {
                $availableTypes = ['A', 'B'];
            }

            foreach ($availableTypes as $type) {
                if ($count['T1'] >= 186) break;

                $unitCode = "T1-{$floorNum}{$type}";
                if ($type == 'B' && $floorNum == 35) {
                    $unitCode = "T1-35B-1";
                }

                Unit::create([
                    'tower_id'        => $t1->id,
                    'floor_id'        => $floor->id,
                    'unit_type_id'    => $types[$type],
                    'unit_code'       => $unitCode,
                    'unit_status'     => 'Unsold',
                    'date_sold'       => null,
                    'date_handover'   => null,
                ]);
                $count['T1']++;
            }
        }

        // === TOWER 2: LANTAI 5 – 57 ===
        $this->command->info("🏗️ Membuat unit untuk T2 (lantai 5 - 57, tanpa lantai: " . implode(', ', $skippedFloors) . ")");

        for ($floorNum = 5; $floorNum <= 57; $floorNum++) {
            if (in_array($floorNum, $skippedFloors)) {
                $this->command->warn("🚫 Melewatkan lantai {$floorNum} (tidak digunakan)");
                continue;
            }

            $floor = $floors->firstWhere(fn($f) => $f->floor_number == $floorNum && $f->tower_id == $t2->id);
            if (!$floor) {
                $this->command->warn("⚠️ Lantai {$floorNum} untuk T2 tidak ditemukan di database.");
                continue;
            }

            $availableTypes = [];

            // Aturan spesifik T2
            if ($floorNum == 35) {
                $availableTypes = ['A']; // hanya A
            } elseif ($floorNum == 36 || $floorNum == 38 || $floorNum == 39 || $floorNum == 40 || $floorNum == 41 || $floorNum == 42 || $floorNum == 43 || $floorNum == 45 || $floorNum == 46 || $floorNum == 47 || $floorNum == 48) {
                $availableTypes = ['A', 'B']; // hanya A dan B
            } elseif ($floorNum == 37 || $floorNum == 49) {
                $availableTypes = ['A', 'B', 'C', 'D']; // lengkap
            } elseif ($floorNum >= 5 && $floorNum <= 32) {
                $availableTypes = ['A', 'B', 'C', 'D']; // 5–32 (kecuali skip)
            } elseif ($floorNum >= 50 && $floorNum <= 52) {
                $availableTypes = ['A', 'B'];
            } elseif (in_array($floorNum, [53, 55, 56, 57])) {
                $availableTypes = ['PH'];
            } else {
                $availableTypes = []; // lantai tidak valid
            }

            foreach ($availableTypes as $type) {
                if ($count['T2'] >= 140) break;

                $unitCode = "T2-{$floorNum}{$type}";

                Unit::create([
                    'tower_id'        => $t2->id,
                    'floor_id'        => $floor->id,
                    'unit_type_id'    => $types[$type],
                    'unit_code'       => $unitCode,
                    'unit_status'     => 'Unsold',
                    'date_sold'       => null,
                    'date_handover'   => null,
                ]);
                $count['T2']++;
            }
        }

        // Laporan akhir
        $this->command->info("✅ T1: {$count['T1']} / 186 unit dibuat.");
        $this->command->info("✅ T2: {$count['T2']} / 140 unit dibuat.");
        $this->command->info("✅ Format: T1-5A, T1-35B-1, T1-61PH, T2-35A, T2-36B, T2-57PH, dll.");
        $this->command->info("✅ Semua unit: status = 'Unsold', tanpa tanggal.");
        $this->command->info("🚫 Lantai dilewati: " . implode(', ', $skippedFloors));
    }
}
