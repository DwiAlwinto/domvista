<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ParkingAssignment extends Model
{
    protected $fillable = [
        'parking_id',
        'unit_id',
        'resident_id',
        'assigned_at',
        'released_at',
        'notes'
    ];

    protected $casts = [
        'assigned_at' => 'datetime',
        'released_at' => 'datetime',
    ];

    public function parkingLot()
    {
        return $this->belongsTo(ParkingLot::class, 'parking_id');
    }

    public function unit()
    {
        return $this->belongsTo(Unit::class);
    }

    public function resident()
    {
        return $this->belongsTo(Resident::class);
    }

    public function scopeActive($query)
    {
        return $query->whereNull('released_at');
    }
}
