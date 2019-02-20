<?php

namespace App\Http\Controllers\Student;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Schedule;

class ScheduleController extends Controller
{
    public function __construct()
    {
        $this->middleware('checkProfile');
    }
    
	public function index()
	{
		$schedules = Auth::user()->studentSchedules()->where('is_active', 1)->sortable()->get();
    	return view('student.schedule.index', compact('schedules'));
	}

    public function show(Schedule $schedule)
    {
        return view('student.schedule.show', compact('schedule'));
    }

    public function requestFinish(Schedule $schedule)
    {
        $schedule->is_request_finish = true;
        $schedule->save();
        return back()->with('success', 'Permintaan selesai dikirim');
    }

    public function pending()
    {
    	$schedules = Auth::user()->studentSchedules()->where('is_active', 0)->sortable()->get();
    	return view('student.schedule.pending', compact('schedules'));
    }

    public function cancel(Schedule $schedule)
    {
    	$schedule->delete();
    	return back()->with('error', 'Permintaan Jadwal dihapus');
    }
}
