<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'social_id', 'avatar', 'social_token', 'osk_id', 'is_admin', 'password','confirm_code','confirmed'
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token','is_admin','confirmed','confirm_code','social_token'
    ];

    public function osk()
    {
        return $this->belongsTo('App\Osk');
    }

    

    public function student()
    {
        return $this->hasOne('App\Student');
    }

    public function instructor()
    {
        return $this->hasOne('App\Instructor');
    }

    public function getFormValue($name){
        return $this->$name;
    }

}
