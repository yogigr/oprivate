<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Storage;
use Carbon\Carbon;

class Profile extends Model
{
    protected $fillable = [
    	'user_id', 'sex', 'birth_place', 'birth_date', 'about', 'image'
    ];

    public function getBirthDateAttribute($value)
    {
    	return Carbon::parse($value)->format('d/m/Y');
    }

    public function getImageThumbUrlAttribute()
    {   
        if (is_null($this->image)) {
            return asset('image/no-image.jpg');
        }

        if ($this->user->isTeacher()) {
            return asset('storage/teacher/thumb/'.$this->image);
        } elseif ($this->user->isStudent()) {
            return asset('storage/student/thumb/'.$this->image);
        }
        
    }

    //relation
    public function user()
    {
    	return $this->belongsTo('App\User');
    }
}
