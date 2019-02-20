<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Course;
use App\Level;

class CourseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (request('search')) {
            $courses = Course::where('name', 'like', '%'.request('search').'%')
            ->orWhere('short_name', 'like', '%'.request('search').'%')->sortable()->paginate(10);
        } else {
            $courses = Course::sortable(['id' => 'desc'])->paginate(10);
        }
        
        return view('admin.course.index', compact('courses'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $levels = Level::all();
        return view('admin.course.create', compact('levels'));
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
            'course_name' => 'required|string',
            'course_short_name' => 'required|string',
            'level_id' => 'required'
        ]);

        $course = Course::create([
            'name' => $request->course_name,
            'short_name' => $request->course_short_name,
            'level_id' => $request->level_id
        ]);

        return redirect()->route('admin.course.index')->with('success', 'Berhasil tambah Mata Pelajaran');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Course $course)
    {
        $levels = Level::all();
        return view('admin.course.edit', compact('course', 'levels'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Course $course)
    {
        $request->validate([
            'course_name' => 'required|string',
            'course_short_name' => 'required|string',
            'level_id' => 'required'
        ]);

        $course->name = $request->course_name;
        $course->short_name = $request->course_short_name;
        $course->level_id = $request->level_id;
        $course->save();
        
        return redirect()->route('admin.course.index')->with('success', 'Berhasil update Mata Pelajaran');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Course $course)
    {
        $course->delete();
        return redirect()->route('admin.course.index')->with('success', 'Berhasil hapus Mata Pelajaran');
    }
}
