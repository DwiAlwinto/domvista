<?php

namespace App\Models;

use App\Models\Models\ParkingLot;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ParkingArea extends Model
{
    use HasFactory;

    protected $fillable = ['area_code', 'description'];

    public function parkingLots()
    {
        return $this->hasMany(ParkingLot::class);
    }
}