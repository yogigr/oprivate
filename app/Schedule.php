<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable;

class Schedule extends Model
{
    use Sortable;

    protected $fillable = [
    	'teacher_id', 'student_id', 'day_id', 'time_id', 'is_active', 'is_request_finish', 'note'
    ];

    protected $sortable = ['id', 'teacher_id', 'student_id', 'time_id', 'day_id'];

    //relationship
    public function teacher()
    {
    	return $this->belongsTo('App\User', 'teacher_id');
    }

    public function student()
    {
    	return $this->belongsTo('App\User', 'student_id');
    }

    public function day()
    {
    	return $this->belongsTo('App\Day');
    }

    public function time()
    {
    	return $this->belongsTo('App\Time');
    }
}
