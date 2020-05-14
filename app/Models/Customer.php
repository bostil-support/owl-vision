<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Customer extends Authenticatable
{
    use Notifiable;

    protected $guard = 'customer';

    protected $fillable = [
        'name',
        'email',
        'username',
        'password',
        'email_verified_at'
    ];

    protected $hidden = ['password'];
}