<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Jenis extends Model
{
    use HasFactory;
    //jangan lupa buka proteksi ya untuk add jenis ini harus manual
    protected $guarded = [];
}
