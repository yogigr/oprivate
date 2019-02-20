<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable;

class Role extends Model
{
	use Sortable;

    protected $fillable = ['name'];
    protected $sortable = ['name'];
}
