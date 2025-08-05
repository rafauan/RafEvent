<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Registration extends Model
{
    protected $fillable = [
        'event_id',
        'name',
        'email',
        'phone',
        'agree',
        'status',
        'registered_at',
        'confirmation_token',
    ];

    protected $casts = [
        'registered_at' => 'datetime',
        'status' => 'string',
        'agree' => 'boolean',
        'confirmation_token' => 'string',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function event()
    {
        return $this->belongsTo(Event::class);
    }
}
