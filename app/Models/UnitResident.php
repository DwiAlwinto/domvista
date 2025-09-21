<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UnitResident extends Model
{
    protected $table = 'unit_residents';
    protected $fillable = ['unit_id', 'resident_id', 'role', 'start_date', 'end_date', 'is_primary', 'notes'];

    public function unit()
    {
        return $this->belongsTo(Unit::class);
    }

    public function resident()
    {
        return $this->belongsTo(Resident::class);
    }
}