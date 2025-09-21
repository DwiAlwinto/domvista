<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class LogbookStaff extends Model
{
    use HasFactory;

    protected $fillable = [
        'logbook_id',
        'mod',
        'chief_tr',
        'chief_enginer',
        'chief_security',
        'chief_hk',
        'c_morning',
        'c_afternoon',
        'c_evening',
        'hc_morning',
        'hc_afternoon',
        'enginer_morning',
        'enginer_afternoon',
        'enginer_night',
        'hk_morning',
        'hk_afternoon',
        'hk_night',
        'sec_morning',
        'sec_afternoon',
        'sec_night',
        'hse_morning',
        'hse_afternoon',
        'hse_night',
    ];

    // Relasi balik ke logbook
    public function logbook(): BelongsTo
    {
        return $this->belongsTo(Logbook::class);
    }
}
