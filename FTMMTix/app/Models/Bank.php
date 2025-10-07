<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
class Bank extends Model { protected $fillable=['name','code','account_name','account_number','is_active']; }
