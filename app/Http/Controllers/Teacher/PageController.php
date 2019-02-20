<?php

namespace App\Http\Controllers\Teacher;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Traits\Hari;

class PageController extends Controller
{
	use Hari;

	public function __construct()
	{
		$this->middleware('checkProfile');
		$this->middleware('reqEdAc'); // require Educational / Achievement
        $this->middleware('reqTeachSet'); //set price and course
	}

    public function index()
    {
    	$teacher = Auth::user();
    	$day_id = \App\Day::where('name', $this->getHariIni(today()->format('D')))->firstOrFail()->id;
    	$todaySchedules = $teacher->teacherSchedules()->where('day_id', $day_id)->orderBy('time_id', 'asc')->get();
    	return view('teacher.page.index', compact('teacher', 'todaySchedules'));
    }
}
