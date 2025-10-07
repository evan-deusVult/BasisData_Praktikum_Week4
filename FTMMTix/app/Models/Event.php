<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Event extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'slug',
        'poster_path',
        'venue',
        'start_at',
        'end_at',
        'description',
        'is_published',
        'category',
        'status',
        'participants',
        'price',
        'organizer',
    ];

    /**
     * Cast columns to specific data types.
     * This makes start_at and end_at automatically become Carbon instances.
     */
    protected $casts = [
        'start_at' => 'datetime',
        'end_at'   => 'datetime',
        'is_published' => 'boolean',
        'price' => 'decimal:2',
    ];

    /**
     * Relationships
     */
    public function ticketTypes()
    {
        return $this->hasMany(\App\Models\TicketType::class);
    }

    public function items()
    {
        return $this->hasMany(\App\Models\OrderItem::class);
    }

    public function tickets()
    {
        return $this->hasMany(\App\Models\Ticket::class);
    }
}
