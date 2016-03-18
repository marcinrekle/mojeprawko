<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Hour extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id','student_id', 'count', 'drive_id',
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [];

    public function student()
    {
    	return $this->belongsTo('App\Student');
    }

    public function drive()
    {
        return $this->belongsTo('App\Drive');
    }
}
