<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Floor extends Model
{
    use HasFactory;

    protected $fillable = ['tower_id', 'floor_number'];

    public function tower()
    {
        return $this->belongsTo(Tower::class);
    }

    public function units()
    {
        return $this->hasMany(Unit::class);
    }
}
