<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Osk extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'slug', 'description', 
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [];

    public function users()
    {
    	return $this->hasMany('App\User');
    }

}
