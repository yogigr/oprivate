<?php

namespace App\Http\Controllers\Teacher;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Schedule;

class ScheduleController extends Controller
{
    public function __construct()
    {
        $this->middleware('checkProfile');
        $this->middleware('reqEdAc'); // require Educational / Achievement
        $this->middleware('reqTeachSet'); //set price and course
    }
    
    public function index()
	{
		$schedules = Auth::user()->teacherSchedules()->where('is_active', 1)->sortable()->get();
    	return view('teacher.schedule.index', compact('schedules'));
	}

    public function show(Schedule $schedule)
    {
        return view('teacher.schedule.show', compact('schedule'));
    }

    public function confirmFinish(Schedule $schedule)
    {
        $schedule->delete();
        return redirect('teacher/schedule')->with('success', 'Jadwal telah dikonfirmasi selesai');
    }

    public function pending()
    {
    	$schedules = Auth::user()->teacherSchedules()->where('is_active', 0)->sortable()->get();
    	return view('teacher.schedule.pending', compact('schedules'));
    }

    public function confirm(Schedule $schedule)
    {
    	$schedule->is_active = true;
    	$schedule->save();
    	return back()->with('success', 'Konfirmasi permintaan jadwal');
    }

    public function updateNote(Request $request, Schedule $schedule)
    {
    	$schedule->note = $request->note;
    	$schedule->save();
    	return back();
    }
}
