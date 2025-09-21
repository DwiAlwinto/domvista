<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WorkOrder extends Model
{
    use HasFactory;

    protected $fillable = [
        'wo_no',
        'tower_id',
        'unit_id',
        'date_request_wo',
        'tenant_name',
        'work_description',
        'details',
        'schedule_date',
        'time_schedule',
        'status',
        'present',
        'cancel_reason',
        'canceled_by',
        'engineer_name',
        'engineer_notes',
        'assigned_at',
        'completed_at',
        'wo_done_by',
        'wo_done_at',
        'deskripsi_wo_done'
    ];

    protected $casts = [
        'present' => 'boolean',
        'schedule_date' => 'date',
        'date_request_wo' => 'date',
        'time_schedule' => 'datetime:H:i',
        'assigned_at' => 'datetime',
        'completed_at' => 'datetime',
        'wo_done_at' => 'datetime'
    ];

    // app/Models/WorkOrder.php
    public function getStatusBadgeAttribute()
    {
        $badges = [
            'On Progress' => 'info',
            'Proses' => 'warning',
            'Done' => 'success',
            'Cancel' => 'danger',
            'Reschedule' => 'secondary'
        ];

        return $badges[$this->status] ?? 'secondary';
    }

    // App\Models\WorkOrder.php


    public function tower()
    {
        return $this->belongsTo(Tower::class);
    }

    public function unit()
    {
        return $this->belongsTo(Unit::class);
    }

    public function concierges()
    {
        return $this->belongsToMany(ConciergeStaff::class, 'work_order_concierge', 'work_order_id', 'concierge_id');
    }

    public function canceledBy()
    {
        return $this->belongsTo(User::class, 'canceled_by');
    }

    public function doneBy()
    {
        return $this->belongsTo(User::class, 'wo_done_by');
    }
}
