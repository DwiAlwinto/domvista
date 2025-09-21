<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\ParkingArea;

class ParkingAreaSeeder extends Seeder
{
    public function run()
    {
        ParkingArea::insert([
            ['area_code' => 'B1', 'description' => 'Basement 1'],
            ['area_code' => 'B2', 'description' => 'Basement 2'],
            ['area_code' => 'B3', 'description' => 'Basement 3'],
        ]);
    }
}