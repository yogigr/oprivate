<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Achievement extends Model
{
    protected $fillable = [
    	'user_id', 'year', 'name', 'certificate_image'
    ];

    protected $appends = ['certificate_url'];

    public function getCertificateUrlAttribute(){
        if (is_null($this->certificate_image)) {
            return asset('image/no-image.jpg');
        }
    	return asset('storage/certificate_ach/'.$this->certificate_image);
    }

    //relationship
    public function user()
    {
    	return $this->belongsTo('App\User');
    }
}
