<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
    protected $fillable=['order_id','event_id','code'];
    public function order(){ return $this->belongsTo(Order::class); }
}


