<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UnitParkingLot extends Model
{
    protected $table = 'unit_parking_lots';
    protected $fillable = ['unit_id', 'parking_lot_id'];

    public function unit()
    {
        return $this->belongsTo(Unit::class);
    }

    public function parkingLot()
    {
        return $this->belongsTo(ParkingLot::class);
    }
}