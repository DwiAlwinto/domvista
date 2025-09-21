<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Carbon\Carbon;

class LogbookEntry extends Model
{
    use HasFactory;

    protected $fillable = [
        'logbook_id',
        'tower',
        'unit',
        'description',
        'result',
        'status',
        'carried_from',
        'original_date',
        'is_carried_over',
        'carry_over_date',
        'is_carried_forward',
        'carry_over_to',
        'time_done',
        'user_done'
    ];

    protected $appends = ['logbook_number', 'formatted_time_done'];

    protected $casts = [
        'logbook_date' => 'datetime:Y-m-d',
        'time_done' => 'datetime',
        'created_at' => 'datetime:Y-m-d H:i:s',
        'updated_at' => 'datetime:Y-m-d H:i:s',
        'original_date' => 'date:Y-m-d',
        'carry_over_date' => 'date:Y-m-d',
    ];

    protected static function boot()
    {
        parent::boot();

        static::updating(function ($model) {
            // Otomatis update waktu Jakarta saat status menjadi Done
            if ($model->isDirty('status') && $model->status === 'Done') {
                $model->time_done = Carbon::now('Asia/Jakarta');
                $model->user_done = auth()->id();
            }
            $model->updated_at = Carbon::now('Asia/Jakarta');
        });

        static::creating(function ($model) {
            $model->created_at = Carbon::now('Asia/Jakarta');
            $model->updated_at = Carbon::now('Asia/Jakarta');
        });
    }

    public function logbook(): BelongsTo
    {
        return $this->belongsTo(Logbook::class)->withDefault([
            'logbook_number' => 'LB-N/A',
            'logbook_date' => now('Asia/Jakarta')
        ]);
    }

    public function userDone(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_done')->withDefault([
            'name' => 'System'
        ]);
    }

    public function getLogbookNumberAttribute()
    {
        return $this->logbook->logbook_number ?? 'LB-' . $this->created_at->timezone('Asia/Jakarta')->format('Ymd');
    }

    public function getFormattedTimeDoneAttribute()
    {
        return $this->time_done
            ? $this->time_done->timezone('Asia/Jakarta')->format('d/m/Y H:i')
            : null;
    }

    public function scopeUnfinished($query)
    {
        return $query->where('status', '!=', 'Done');
    }

    public function scopeFromTower($query, $tower)
    {
        return $query->where('tower', $tower);
    }
}
