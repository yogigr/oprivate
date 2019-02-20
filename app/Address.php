<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    protected $fillable = [
    	'user_id', 'province_id', 'city_id', 'address', 'postal_code'
    ];

    //relationship
    public function user()
    {
    	return $this->belongsTo('App\User');
    }

    public function province()
    {
    	return $this->belongsTo('App\Province');
    }

    public function city()
    {
    	return $this->belongsTo('App\City');
    }
}
