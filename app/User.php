<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Kyslik\ColumnSortable\Sortable;

class User extends Authenticatable
{
    use Notifiable, Sortable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'role_id', 'is_active', 'price', 'course_id', 'rated'
    ];

    protected $sortable = [
        'name', 'email'
    ];

    protected $appends = ['print_rate_star', 'course_name', 'lat_long'];
    protected $with = ['profile'];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function isActive()
    {
        return $this->is_active == 1;
    }

    public function isAdmin()
    {
        return $this->role_id == 1;
    }

    public function isTeacher()
    {
        return $this->role_id == 2;
    }

    public function isStudent()
    {
        return $this->role_id == 3;
    }

    public function status()
    {
        if ($this->isActive()) {
            return 'Aktif';
        }

        return 'Tidak Active';
    }

    public function statusBadge()
    {
        if ($this->isActive()) {
            return "<span class='badge bg-green'>".$this->status()."</span>";
        }
        return "<span class='badge bg-red'>".$this->status()."</span>";
    }

    public function getPrintRateStarAttribute()
    {
        $star = '';
        for ($i=1; $i <= 5 ; $i++) { 
            if ($i <= $this->rated) {
                $star .= '<span class="fa fa-star fa-2x text-warning"></span>';
            } else {
                $star .= '<span class="fa fa-star fa-2x text-light"></span>';
            }
        }
        return $star;
    }

    public function getCourseNameAttribute()
    {
        return !is_null($this->course_id) ? $this->course->name : '';
    }

    public function getLatLongAttribute()
    {
        return [
            'latitude' => $this->geolocation->latitude,
            'longitude' => $this->geolocation->longitude
        ];
    }

    public function age()
    {
        return \Carbon\Carbon::createFromFormat('d/m/Y', $this->profile->birth_date)->age;
    }

    public function getAgeAttribute()
    {
        return $this->age();
    }

    //relationship
    public function role()
    {
        return $this->belongsTo('App\Role');
    }

    public function profile()
    {
        return $this->hasOne('App\Profile');
    }

    public function address()
    {
        return $this->hasOne('App\Address');
    }

    public function contact()
    {
        return $this->hasOne('App\Contact');
    }

    public function geolocation()
    {
        return $this->hasOne('App\Geolocation');
    }

    public function educationals()
    {
        return $this->hasMany('App\Educational');
    }

    public function achievements()
    {
        return $this->hasMany('App\Achievement');
    }

    public function ratings()
    {
        return $this->hasMany('App\Rating');
    }

    public function course()
    {
        return $this->belongsTo('App\Course');
    }

    public function teacherSchedules()
    {
        return $this->hasMany('App\Schedule', 'teacher_id');
    }

    public function studentSchedules()
    {
        return $this->hasMany('App\Schedule', 'student_id');
    }
}
