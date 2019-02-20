<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Schedule;

class ScheduleController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'teacher_id' => 'required',
            'student_id' => 'required',
            'day_id' => 'required',
            'time_id' => 'required',
        ]);

        if (Schedule::where('student_id', $request->student_id)->where('teacher_id', $request->teacher_id)
            ->where('day_id', $request->day_id)->where('time_id', $request->time_id)->exists()) {
            return back()->with('error', 'Permintaan ini pernah dikirim, harap menunggu konfirmasi dari guru bersangkutan.');
        }

        $schedule = Schedule::create([
            'teacher_id' => $request->teacher_id,
            'student_id' => $request->student_id,
            'day_id' => $request->day_id,
            'time_id' => $request->time_id,
            'note' => $request->note
        ]);

        return back()->with('success', 'Permintaan dikirim');
    }
}
