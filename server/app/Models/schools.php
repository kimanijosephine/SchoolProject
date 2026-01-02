<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;

class schools extends Authenticatable
{
    protected $fillable = ['name', 'email', 'password', 'id'];
    protected $hidden = ['password'];
}
