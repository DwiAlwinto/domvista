<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class ParkingLot extends Model
{
    protected $fillable = [
        'parking_area_id',
        'name',
        'type',
        'is_available',
        'notes'
    ];

    protected $casts = [
        'is_available' => 'boolean',
    ];

    public function parkingArea()
    {
        return $this->belongsTo(ParkingArea::class);
    }

    public function units()
    {
        return $this->belongsToMany(Unit::class, 'parking_assignments')
            ->withPivot('resident_id', 'assigned_at', 'released_at')
            ->withTimestamps();
    }

    public function residents()
    {
        return $this->belongsToMany(Resident::class, 'parking_assignments')
            ->withPivot('unit_id', 'assigned_at', 'released_at')
            ->withTimestamps();
    }

    public function parkingAssignments()
    {
        return $this->hasMany(ParkingAssignment::class, 'parking_id');
    }

    public function scopeAvailable($query)
    {
        return $query->where('is_available', true)
            ->whereDoesntHave('parkingAssignments', function ($q) {
                $q->whereNull('released_at');
            });
    }

    public function scopeForUnit($query, $unitId)
    {
        return $query->whereHas('parkingAssignments', function ($q) use ($unitId) {
            $q->where('unit_id', $unitId)->whereNull('released_at');
        });
    }
}
