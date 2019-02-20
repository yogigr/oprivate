<?php

namespace App\Http\Controllers\Teacher;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\TeacherCourse;
use App\TeacherPrice;
use App\Course;

class SettingController extends Controller
{
    public function __construct()
    {
        $this->middleware('checkProfile');
    }
    
    public function edit()
    {   
        $teacher = Auth::user();
    	$courses = Course::all();
    	return view('teacher.setting.index', compact('courses', 'teacher', 'teacherCourse', 'teacherPrice'));
    }

    public function update(Request $request)
    {
    	$teacher = Auth::user();
    	$request->validate([
    		'course_id' => 'required',
            'price' => 'required|numeric'
    	]);

    	$teacher->course_id = $request->course_id;
        $teacher->price = $request->price;
        $teacher->save();

    	return redirect('teacher/setting')->with('success', 'Berhasil update setting');
    }
}
