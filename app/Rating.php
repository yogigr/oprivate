<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Rating extends Model
{
    protected $fillable = ['user_id', 'rating'];

    //relationship
    public function teacher()
    {
    	return $this->belongsTo('App\User', 'user_id');
    }
}
