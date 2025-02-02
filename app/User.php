<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

   public function threads()
   {
    return $this->hasMany('App\Thread');
   }

   public function comments()
   {
    return $this->hasMany('App\Comment');
   }

   public function profile()
   {
       return $this->morphTo();
   }

   public function getHasAdminProfileAttribute()
  {
    return $this->profile_type == 'App\AdminProfile';
  }
  
  public function getHasUserProfileAttribute()
  {
    return $this->profile_type == 'App\UserProfile';
  }
   
   
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

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

    protected $with = [
        'profile'
    ];
}
