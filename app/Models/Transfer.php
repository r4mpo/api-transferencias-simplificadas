<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Transfer extends Model
{
    protected $fillable = [
        'sender_id',
        'receiver_id',
        'value',
        'status',
    ];

    const STATUS_PENDING = 1;
    const STATUS_COMPLETE = 2;
    const STATUS_FAIL = 3;
}