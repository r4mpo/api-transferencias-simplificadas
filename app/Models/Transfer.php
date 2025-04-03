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
    const STATUS_EMAIL_NOT_SEND = 4;

    public function sender()
    {
        return $this->belongsTo(User::class, 'id', 'sender_id');
    }
    
    public function receiver()
    {
        return $this->belongsTo(User::class, 'id', 'receiver_id');
    }
}