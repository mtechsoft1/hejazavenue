<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasApiTokens, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password','type','phone','company_name', 'profile_image', 'address','city','state','country','zip','license_number','company_description','bank_name', 'account_number', 'account_title','user_role', 'is_approved_by_admin', 'token',
    ];
    
    protected $table      = 'users';
    protected $primaryKey = 'id';

    public function tours()
    {
        return $this->hasMany(Tour::class);
    }

    public function accommodationBookings()
    {
        return $this->hasMany(Booking::class, 'user_id');
    }

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function isAdmin()
    {
        return $this->type == USER_TYPES['admin'];
    }
    public function isAgency()
    {
        return $this->type == USER_TYPES['agency'];
    }

    public function isUser()
    {
        return $this->type == USER_TYPES['user'];
    }

}
