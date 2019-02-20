<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable;

class Course extends Model
{
	use Sortable;

    protected $fillable = ['name', 'short_name', 'level_id'];
    public $sortable = ['id', 'name', 'short_name'];
    protected $appends = ['level_name'];
    public function getLevelNameAttribute()
    {
        return $this->level->name;
    }

    //relation
    public function level()
    {
    	return $this->belongsTo('App\Level');
    }

    public function teacherCourses()
    {
    	return $this->hasMany('App\TeacherCourse');
    }
}
