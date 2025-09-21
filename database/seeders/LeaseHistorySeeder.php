<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Unit;
use App\Models\Resident;
use App\Models\LeaseHistory;

class LeaseHistorySeeder extends Seeder
{
    public function run()
    {
        // ✅ Gunakan unit yang benar-benar ada: T15A
        $unit = Unit::where('unit_code', 'T15A')->first();
        if (!$unit) {
            $this->command->error('❌ Unit T15A tidak ditemukan. Pastikan UnitSeeder sudah dijalankan.');
            return;
        }

        // Cari leasee "William T"
        $leasee = Resident::where('full_name', 'William T')->where('is_owner', false)->first();
        if (!$leasee) {
            $this->command->error('❌ Resident "William T" (Leasee) tidak ditemukan.');
            return;
        }

        // Update status unit menjadi Rented
        $unit->update(['unit_status' => 'Rented']);

        // Data history dari Excel
        $histories = [
            [
                'unit_id' => $unit->id,
                'resident_id' => $leasee->id,
                'start_date' => '2019-11-11',
                'end_date' => '2020-11-11',
                'rent_amount' => 12000000,
                'contract_status' => 'Expired',
            ],
            [
                'unit_id' => $unit->id,
                'resident_id' => $leasee->id,
                'start_date' => '2022-11-11',
                'end_date' => '2023-11-11',
                'rent_amount' => 13000000,
                'contract_status' => 'Expired',
            ],
            [
                'unit_id' => $unit->id,
                'resident_id' => $leasee->id,
                'start_date' => '2024-11-11',
                'end_date' => '2025-11-11',
                'rent_amount' => 14000000,
                'contract_status' => 'Expired',
            ],
            [
                'unit_id' => $unit->id,
                'resident_id' => $leasee->id,
                'start_date' => '2025-11-11',
                'end_date' => '2026-11-11',
                'rent_amount' => 15000000,
                'contract_status' => 'Active',
            ],
        ];

        foreach ($histories as $history) {
            LeaseHistory::create($history);
        }

        $this->command->info("✅ 4 riwayat sewa berhasil disimpan untuk William T di unit {$unit->unit_code}");
    }
}
