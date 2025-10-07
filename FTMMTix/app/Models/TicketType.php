<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class TicketType extends Model
{
    protected $fillable = ['event_id','name','price','quota'];
    public function event(){ return $this->belongsTo(\App\Models\Event::class); }
}
