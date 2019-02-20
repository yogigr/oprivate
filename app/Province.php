<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Province extends Model
{
    protected $fillable = ['name'];

    //relationship
    public function cities()
    {
    	return $this->hasMany('App\City');
    }
}
