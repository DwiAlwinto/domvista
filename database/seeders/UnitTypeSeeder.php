<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\UnitType;

class UnitTypeSeeder extends Seeder
{
    public function run()
    {
        UnitType::insert([
            ['code' => 'A', 'description' => 'Type A - 3 Bedroom'],
            ['code' => 'B', 'description' => 'Type B - 3 Bedroom'],
            ['code' => 'C', 'description' => 'Type C - 3 Bedroom'],
            ['code' => 'D', 'description' => 'Type D - 2 Bedroom'],
            ['code' => 'AB', 'description' => 'Type AB - 4 Bedroom'],
            ['code' => 'CD', 'description' => 'Type CD - 4 Bedroom'],
            ['code' => 'PH', 'description' => 'Penthouse - 4 Bedroom'],
        ]);
    }
}