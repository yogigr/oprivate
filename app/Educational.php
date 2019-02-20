<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Educational extends Model
{
    protected $fillable = [
    	'user_id', 'start_year', 'end_year', 'name', 'certificate_image'
    ];

    protected $appends = ['certificate_url'];

    public function getCertificateUrlAttribute(){
        if (is_null($this->certificate_image)) {
            return asset('image/no-image.jpg');
        }
    	return asset('storage/certificate_edu/'.$this->certificate_image);
    }

    //relationship
    public function user()
    {
    	return $this->belongsTo('App\User');
    }
}
