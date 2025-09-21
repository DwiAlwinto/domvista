<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Tower;

class TowerSeeder extends Seeder
{
    public function run()
    {
        Tower::insert([
            ['name' => 'T1', 'location' => 'Domaine One'],
            ['name' => 'T2', 'location' => 'Domaine Prive'],
        ]);
    }
}