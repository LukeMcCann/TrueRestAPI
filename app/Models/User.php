<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Str;

class User extends Authenticatable
{
    use Notifiable;

    const VERIFIED_USER = '1';
    const UNVERIFIED_USER = '0';

    const ADMIN_USER = 'true';
    const REGULAR_USER = 'false';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'verified',
        'verification_token',
        'admin',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
        'verification_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * Check the user is verified.
     * 
     * @var boolean
     */
    public function isVerified() 
    {
        return $this->verified == User::VERIFIED_USER;
    }

    /**
     * Check whether the user is an admin.
     * 
     * @var boolean
     */
    public function isAdmin()
    {
        return $this->admin == User::ADMIN_USER;
    }

    /**
     * Generate a random verification code up to 40 characaters
     * in length.
     * 
     * @var string 
     */
    public static function generateVerificationCode() 
    {
        return Str::random(40);
    }
}
