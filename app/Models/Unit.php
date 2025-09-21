<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Floor;
use App\Models\Tower;
use App\Models\UnitType;
use App\Models\ParkingLot;       
use App\Models\LeaseHistory; 
use App\Models\Resident;

class Unit extends Model
{
    use HasFactory;

    protected $fillable = [
        'tower_id',
        'floor_id',
        'unit_type_id',
        'unit_code',
        'unit_status',
        'date_sold',
        'date_handover'
    ];

    protected $dates = ['date_sold', 'date_handover'];

    public function tower()
    {
        return $this->belongsTo(Tower::class);
    }

    public function floor()
    {
        return $this->belongsTo(Floor::class);
    }

    public function unitType()
    {
        return $this->belongsTo(UnitType::class);
    }

    public function residents()
    {
        return $this->belongsToMany(Resident::class, 'unit_residents')
            ->withPivot('role', 'start_date', 'end_date', 'is_primary', 'notes', 'date_sold', 'date_handover')
            ->withTimestamps();
    }


    public function leaseHistories()
    {
        return $this->hasMany(LeaseHistory::class);
    }

    // Tambahkan relasi ini:
    public function parkingLots()
    {
        return $this->belongsToMany(ParkingLot::class, 'parking_assignments')
            ->withPivot('resident_id', 'assigned_at', 'released_at')
            ->withTimestamps();
    }

    public function parkingAssignments()
    {
        return $this->hasMany(ParkingAssignment::class);
    }

    public function activeResidents()
    {
        return $this->belongsToMany(Resident::class, 'unit_residents')
            ->withPivot(['role', 'start_date', 'end_date', 'is_primary'])
            ->where(function ($query) {
                $query->whereNull('end_date')
                    ->orWhere('end_date', '>=', now()->startOfDay());
            });
    }

    public function pastResidents()
    {
        return $this->belongsToMany(Resident::class, 'unit_residents')
            ->withPivot(['role', 'start_date', 'end_date'])
            ->whereNotNull('end_date')
            ->where('end_date', '<', now()->startOfDay());
    }
}
