<?php

namespace App\Models;

use App\Models\Staff;
use App\Models\Document;
use App\Models\FamilyMember;
use App\Models\ParkingAssignment;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Resident extends Model
{
    protected $fillable = [
        'full_name',
        'phone',
        'email',
        'identity_number',
        'citizenship',
        'religion',
        'date_of_birth',
        'gender',
        'occupation',
        'company',
        'agent_name',
        'agent_company',
        'number_agent',
        'is_owner'
    ];

    // Enkripsi data sensitif
    public function setPhoneAttribute($value)
    {
        $this->attributes['phone'] = Crypt::encryptString($value);
    }

    public function getPhoneAttribute($value)
    {
        return $value ? Crypt::decryptString($value) : null;
    }

    public function setEmailAttribute($value)
    {
        $this->attributes['email'] = Crypt::encryptString($value);
    }

    public function getEmailAttribute($value)
    {
        return $value ? Crypt::decryptString($value) : null;
    }

    public function units()
    {
        return $this->belongsToMany(Unit::class, 'unit_residents', 'resident_id', 'unit_id')
            ->withPivot('role', 'start_date', 'end_date', 'is_primary', 'date_sold', 'date_handover')
            ->withTimestamps();
    }
    public function familyMembers()
    {
        return $this->hasMany(FamilyMember::class);
    }

    public function staffs()
    {
        return $this->hasMany(Staff::class);
    }

    public function documents()
    {
        return $this->hasMany(Document::class);
    }

    // PERBAIKAN: Ganti nama relasi menjadi parkingAssignments (plural)
    public function parkingAssignments()
    {
        return $this->hasMany(ParkingAssignment::class);
    }


    public function activeParkingAssignment()
    {
        return $this->hasMany(ParkingAssignment::class, 'resident_id')
            ->whereNull('released_at');
    }

    // Relasi untuk semua parking lots melalui assignments
    public function parkingLots()
    {
        return $this->hasManyThrough(
            ParkingLot::class,
            ParkingAssignment::class,
            'resident_id', // Foreign key on parking_assignments table
            'id', // Foreign key on parking_lots table
            'id', // Local key on residents table
            'parking_id' // Local key on parking_assignments table
        );
    }

    // App\Models\Resident.php
    public function scopeLeasee($query)
    {
        return $query->whereHas('units', function ($q) {
            $q->where(function ($q2) {
                $q2->where('unit_residents.role', 'Leasee')
                    ->orWhere('unit_residents.role', 'Co-Leasee');
            });
        });
    }
}
