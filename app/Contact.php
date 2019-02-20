<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable;

class Contact extends Model
{
	use Sortable;

    protected $fillable = [
    	'user_id', 'phone_number', 'wa_number', 'facebook_url', 'instagram_url'
    ];

    protected $sortable = [
    	'phone_number'
    ];

    //relationship
    public function user()
    {
    	return $this->belongsTo('App\User');
    }
}
