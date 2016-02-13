<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    
	/**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['hours_count', 'cost'];

    public function user()
    {
    	return $this->belongsTo('App\User');
    }

    public function hours()
    {
        return $this->hasMany('App\Hour');
    }

    public function payments()
    {
        return $this->hasMany('App\Payment');
    }

    public function osk()
    {
        return $this->belongsTo('App\Osk');
    }

    public function getUsedHours($list)
    {
        return 12;
    }

}
