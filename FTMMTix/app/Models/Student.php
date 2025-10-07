<?php
// namespace App\Models;
// use Illuminate\Foundation\Auth\User as Authenticatable;
// use Illuminate\Notifications\Notifiable;
// use Illuminate\Database\Eloquent\Factories\HasFactory;

// class Student extends Authenticatable
// {
//     use HasFactory, Notifiable;

//     protected $table = 'students';
//     protected $fillable = ['nim','name','password','email'];
//     protected $hidden = ['password','remember_token'];
// }


namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable; // penting
use Illuminate\Notifications\Notifiable;

class Student extends Authenticatable
{
    use Notifiable;

    protected $fillable = [
        'nim', 'name', 'email', 'password',
    ];

    protected $hidden = [
        'password',
    ];
}
