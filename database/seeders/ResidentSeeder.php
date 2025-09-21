<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Resident;

class ResidentSeeder extends Seeder
{
    public function run()
    {
        // Owner
        $owner = Resident::create([
            'full_name' => 'Erwin Wiriadi',
            'phone' => '82123144123',
            'email' => 'ew@gmail.com',
            'identity_number' => '3212312312312312',
            'citizenship' => 'Indonesia',
            'religion' => 'Islam',
            'gender' => 'Male',
            'agent_name' => 'Raisa',
            'agent_company' => 'Cushwake',
            'is_owner' => true,
        ]);

        // Leasee
        $leasee = Resident::create([
            'full_name' => 'William T',
            'phone' => '852432344',
            'email' => 'WT@gmail.com',
            'identity_number' => 'UK123456789',
            'citizenship' => 'England',
            'religion' => 'Christian',
            'date_of_birth' => '1983-11-11',
            'gender' => 'Male',
            'agent_company' => 'Billy',
            'is_owner' => false,
        ]);

        // Assign to unit (contoh unit A101)
        $unit = \App\Models\Unit::where('unit_code', 'T1101')->first();
        if ($unit) {
            $unit->residents()->attach($owner->id, [
                'role' => 'Owner',
                'start_date' => now(),
                'is_primary' => true
            ]);

            $unit->residents()->attach($leasee->id, [
                'role' => 'Leasee',
                'start_date' => '2025-11-11',
                'end_date' => '2026-11-11',
                'is_primary' => true
            ]);

            $unit->update(['unit_status' => 'Rented']);
        }
    }
}