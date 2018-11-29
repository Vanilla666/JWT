<?php

namespace App;

use Tymon\JWTAuth\Contracts\JWTSubject; //引入JWTSubject
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable implements JWTSubject //實作 JWT
{
    use Notifiable;

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
    public function posts() //使用者關聯文章 使用者可以有很多文章
    {
        return $this->hasMany('App\Entities\Post');
    }

    public function getJWTIdentifier() //獲得JWT 金鑰
    {
       
        return $this->getKey();
    }

    /**
     * Return a key value array, containing any custom claims to be added to the JWT.
     *
     * @return array
     */
    public function getJWTCustomClaims()
    {
        return [];
    }

}
