<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Staff extends Model
{
    use HasFactory;
    protected $table = 'staffs';
    protected $fillable = ['resident_id', 'name', 'type', 'phone', 'license_plate'];

    public function resident()
    {
        return $this->belongsTo(Resident::class);
    }
}