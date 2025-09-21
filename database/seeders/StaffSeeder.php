<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Staff;

class StaffSeeder extends Seeder
{
    public function run()
    {
        $owner = \App\Models\Resident::where('full_name', 'Erwin Wiriadi')->first();
        $leasee = \App\Models\Resident::where('full_name', 'William T')->first();

        if ($owner) {
            Staff::insert([
                // Driver - punya license plate
                [
                    'resident_id' => $owner->id,
                    'name' => 'Rudi',
                    'type' => 'Driver',
                    'phone' => null,
                    'license_plate' => 'B 1234 ABC',
                ],
                [
                    'resident_id' => $owner->id,
                    'name' => 'Retno',
                    'type' => 'Driver',
                    'phone' => null,
                    'license_plate' => 'B 5678 DEF',
                ],
                // Maid - TIDAK punya license plate → isi NULL
                [
                    'resident_id' => $owner->id,
                    'name' => 'Iis',
                    'type' => 'Maid',
                    'phone' => null,
                    'license_plate' => null,
                ],
                [
                    'resident_id' => $owner->id,
                    'name' => 'Erna',
                    'type' => 'Maid',
                    'phone' => null,
                    'license_plate' => null,
                ],
            ]);
        }

        if ($leasee) {
            Staff::insert([
                [
                    'resident_id' => $leasee->id,
                    'name' => 'Rudi',
                    'type' => 'Driver',
                    'license_plate' => 'L 9999 XYZ',
                ],
                [
                    'resident_id' => $leasee->id,
                    'name' => 'Retno',
                    'type' => 'Driver',
                    'license_plate' => 'L 8888 XYZ',
                ],
                [
                    'resident_id' => $leasee->id,
                    'name' => 'Iis',
                    'type' => 'Maid',
                    'license_plate' => null,
                ],
                [
                    'resident_id' => $leasee->id,
                    'name' => 'Erna',
                    'type' => 'Maid',
                    'license_plate' => null,
                ],
            ]);
        }
    }
}