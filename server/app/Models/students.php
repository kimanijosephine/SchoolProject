<?php

namespace App\Models;

use PHPOpenSourceSaver\JWTAuth\Contracts\JWTSubject;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Students extends Authenticatable implements JWTSubject
{
    use Notifiable;

    protected $fillable = [ 'name', 'course_id', 'year_of_study', 'class_year', 'email', 'password', 'school_id'];
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
            'role' => 'sponsor' // This helps identify the user type in Vue
        ];
    }
}
