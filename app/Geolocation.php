<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Geolocation extends Model
{
    protected $fillable = [
    	'user_id', 'latitude', 'longitude'
    ];

    //relationship
    public function user()
    {
    	return $this->belongsTo('App\User');
    }
}
