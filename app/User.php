<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    protected $fillable = [
		'name', 'email', 'facebook_id',  'vkontakte_id', 'avatar', 'gender', 'role',
		];

    protected $hidden = [ 'remember_token', ];
    
    public function comments()
    {
		return $this->hasMany('App\Comment');
	}
}
