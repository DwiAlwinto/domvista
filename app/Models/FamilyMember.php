<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FamilyMember extends Model
{
    use HasFactory;

    protected $fillable = ['resident_id', 'name', 'relationship', 'date_of_birth', 'gender', 'identity_number'];

    protected $dates = ['date_of_birth'];

    public function resident()
    {
        return $this->belongsTo(Resident::class);
    }
}