<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ConciergeStaff extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'shift'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function workOrders()
    {
        return $this->belongsToMany(WorkOrder::class, 'work_order_concierge');
    }
}
