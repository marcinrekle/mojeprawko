<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Drive extends Model
{

	/**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['instructor_id', 'date', 'hours_count'];

    public function hours()
    {
    	return $this->hasMany('App\Hour');
    }

    public function instructor()
    {
        return $this->belongsTo('App\Instructor');
    }

    public function getFormValue($name){
        return $this->$name;
    }

    public function scopeStartAt($query, $date = 'tomorrow')
    {
        return $query->where('date', '>', date('Y-m-d', strtotime($date)));
    }
}
