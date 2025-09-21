<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Carbon\Carbon;
use App\Models\UnitResident;
use App\Models\LeaseHistory;
use Illuminate\Support\Facades\DB;

class CheckExpiredLeases extends Command
{
    protected $signature = 'leases:check-expired';
    protected $description = 'Cek dan pindahkan semua lease yang end_date-nya sudah lewat ke lease_histories';

    public function handle()
    {
        $today = Carbon::today();

        $expiredResidents = DB::table('unit_residents')
            ->where('role', 'Leasee')
            ->whereNotNull('end_date')
            ->where('end_date', '<', $today)
            ->whereNotExists(function ($query) {
                $query->select(DB::raw(1))
                    ->from('lease_histories')
                    ->whereColumn('unit_residents.unit_id', 'lease_histories.unit_id')
                    ->whereColumn('unit_residents.resident_id', 'lease_histories.resident_id')
                    ->whereColumn('unit_residents.end_date', 'lease_histories.end_date');
            })
            ->get();

        foreach ($expiredResidents as $entry) {
            LeaseHistory::create([
                'unit_id' => $entry->unit_id,
                'resident_id' => $entry->resident_id,
                'start_date' => $entry->start_date,
                'end_date' => $entry->end_date,
                'contract_status' => 'expired',
                'notes' => 'Masa sewa berakhir pada ' . $entry->end_date,
            ]);

            // Hapus dari unit_residents agar tidak muncul sebagai aktif
            DB::table('unit_residents')
                ->where('unit_id', $entry->unit_id)
                ->where('resident_id', $entry->resident_id)
                ->delete();

            // Opsional: Update parking menjadi tersedia
            DB::table('parking_assignments')
                ->where('unit_id', $entry->unit_id)
                ->where('resident_id', $entry->resident_id)
                ->update(['is_active' => false]);

            DB::table('parking_lots')
                ->whereIn('id', function ($query) use ($entry) {
                    $query->select('parking_id')
                        ->from('parking_assignments')
                        ->where('unit_id', $entry->unit_id)
                        ->where('resident_id', $entry->resident_id);
                })
                ->update(['is_available' => true]);
        }

        $count = count($expiredResidents);
        $this->info("✅ Berhasil diproses {$count} riwayat sewa yang kedaluwarsa.");
    }
}
