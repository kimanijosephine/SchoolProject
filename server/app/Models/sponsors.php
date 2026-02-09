<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use PHPOpenSourceSaver\JWTAuth\Contracts\JWTSubject;

class Sponsors extends Authenticatable implements JWTSubject
{
    use Notifiable;

    protected $fillable = ['company_name', 'email', 'password'];

    protected $hidded = ['password'];

    /**
     * Get the identifier that will be stored in the subject claim of the JWT.
     */
    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    /**
     * Return a key value array, containing any custom claims to be added to the JWT.
     */
    public function getJWTCustomClaims()
    {
        return [
            'role' => 'sponsor', // This helps identify the user type in Vue
        ];
    }

    public function students()
    {
        return $this->hasMany(Students::class, 'sponsor_id');
    }

    // This allows you to get all unique schools a sponsor is supporting students in
    public function schools()
    {
        return $this->hasManyThrough(Schools::class, Students::class, 'sponsor_id', 'id', 'id', 'school_id')->distinct();
    }
}
