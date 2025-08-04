<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    protected $fillable = [
        'name',
        'description',
        'excerpt',
        'image',
        'start_datetime',
        'duration',
        'location',
        'capacity',
        'is_active',
    ];

    protected $casts = [
        'start_datetime' => 'datetime',
        'duration' => 'integer',
        'is_active' => 'boolean',
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
