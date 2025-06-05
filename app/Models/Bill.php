<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bill extends Model
{
    use HasFactory;

    protected $fillable = [
        'order_id',
        'bill_number',
        'bill_data',
    ];

    public function order()
    {
        return $this->belongsTo(Order::class);
    }
}
