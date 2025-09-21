<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Carbon\Carbon;

class Logbook extends Model
{
    use HasFactory;

    protected $fillable = [
        'logbook_date',
        'logbook_number',
        'status'
    ];

    protected $casts = [
        'logbook_date' => 'date',
    ];


    // Relasi ke staff - HAS ONE karena foreign key ada di tabel logbook_staff
    public function staff(): HasOne
    {
        return $this->hasOne(LogbookStaff::class);
    }

    // Relasi ke entries
    public function entries(): HasMany
    {
        return $this->hasMany(LogbookEntry::class);
    }
    
    // Add this method to update overall status based on entries
    public function updateStatus()
    {
        $entries = $this->entries;

        if ($entries->isEmpty()) {
            $this->status = 'Draft';
        } elseif ($entries->where('status', '!=', 'Done')->isEmpty()) {
            $this->status = 'Completed';
        } else {
            $this->status = 'On Progress';
        }

        $this->save();
    }
}
