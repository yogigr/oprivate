<?php

namespace App\Http\Controllers\Student;

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
	}

    public function index()
    {
    	$student = Auth::user();
    	$day_id = \App\Day::where('name', $this->getHariIni(today()->format('D')))->firstOrFail()->id;
    	$todaySchedules = $student->studentSchedules()->where('day_id', $day_id)->orderBy('time_id', 'asc')->get();
    	return view('student.page.index', compact('student', 'todaySchedules'));
    }
}
