<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;

class Admin extends Authenticatable
{
    protected $table = 'admins'; 

    protected $fillable = [
        'username',
        'email',
        'password',
        'foto_profile',
    ];

    protected $hidden = [
        'password',
    ];

    public $timestamps = true;
}
