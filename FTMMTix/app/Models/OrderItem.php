<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class OrderItem extends Model
{
    protected $fillable = ['order_id','event_id','ticket_type_id','qty','unit_price','subtotal'];
    public function order(){ return $this->belongsTo(Order::class); }
}

