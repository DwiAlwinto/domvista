<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LeaseHistory extends Model
{
    protected $fillable = [
        'unit_id',
        'resident_id',
        'start_date',
        'end_date',
        'rent_amount',
        'contract_status',
        'notes'
    ];

    protected $casts = [
        'rent_amount' => 'decimal:2',
    ];

    // Relasi ke Resident dan Unit
    public function resident()
    {
        return $this->belongsTo(Resident::class);
    }

    public function unit()
    {
        return $this->belongsTo(Unit::class);
    }
}
