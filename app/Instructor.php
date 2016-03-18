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
    protected $fillable = ['user_id','status'];

    public function user()
    {
    	return $this->belongsTo('App\User');
    }

    public function drives()
    {
    	return $this->hasMany('App\Drive');
    }

    public function drivesGtTomorrow()
    {
        return $this->hasMany('App\Drive')->where('date', '>', date('Y-m-d', strtotime('tomorrow')));
    }

    

}
