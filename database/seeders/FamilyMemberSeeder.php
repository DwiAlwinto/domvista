<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\FamilyMember;

class FamilyMemberSeeder extends Seeder
{
    public function run()
    {
        $owner = \App\Models\Resident::where('full_name', 'Erwin Wiriadi')->first();
        $leasee = \App\Models\Resident::where('full_name', 'William T')->first();

        if ($owner) {
            FamilyMember::insert([
                ['resident_id' => $owner->id, 'name' => 'Michael', 'relationship' => 'Husband'],
                ['resident_id' => $owner->id, 'name' => 'Billy', 'relationship' => 'Siblings'],
            ]);
        }

        if ($leasee) {
            FamilyMember::insert([
                ['resident_id' => $leasee->id, 'name' => 'Michael', 'relationship' => 'Husband'],
                ['resident_id' => $leasee->id, 'name' => 'Billy', 'relationship' => 'Siblings'],
            ]);
        }
    }
}