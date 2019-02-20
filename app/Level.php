<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable;

class Level extends Model
{
	use Sortable;
	
    protected $fillable = ['name', 'short_name'];
    public $sortable = ['id', 'name', 'short_name'];
}
