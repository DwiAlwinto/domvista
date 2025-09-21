<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        $this->call([
            TowerSeeder::class,
            FloorSeeder::class,
            UnitTypeSeeder::class,
            UnitSeeder::class,
            ParkingAreaSeeder::class,
            ParkingLotSeeder::class,
            ResidentSeeder::class,
            FamilyMemberSeeder::class,
            StaffSeeder::class,
            DocumentSeeder::class,
            LeaseHistorySeeder::class,
            UnitParkingLotSeeder::class,
        ]);
    }
}