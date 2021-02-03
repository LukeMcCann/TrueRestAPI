<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Indirectly implemented through the 
 * buyer/seller models inheritance.
 */
class User extends Authenticatable
{
    use SoftDeletes, HasFactory, Notifiable;

    protected $dates = ['deleted_at'];
    
    const VERIFIED_USER = '1';
    const UNVERIFIED_USER = '0';

    const ADMIN_USER = 'true';
    const REGULAR_USER = 'false';

    protected $table = 'users';

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
     * Mutator for accessing the name attribute.
     * 
     * @param string
     */
    public function setNameAttribute(string $name) 
    {
        $this->attributes['name'] = strtolower($name);
    }

    /**
     * Accessor for accessing the name attribute.
     * 
     * @var string
     */
    public function getNameAttribute(string $name)
    {
        return ucwords($name);
    }

    /**
     * Mutator for accessing the email attribute
     * 
     * @param string
     */
    public function setEmailAttribute(string $email) 
    {
        $this->attributes['email'] = strtolower($email);
    }

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
