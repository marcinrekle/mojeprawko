<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Instructor extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['user_id'];

    public function user()
    {
    	return $this->hasOne('App\User');
    }

    public function students()
    {
    	return $this->hasMany('App\Student');
    }

}
