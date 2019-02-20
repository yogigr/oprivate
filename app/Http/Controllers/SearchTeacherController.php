<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Course;
use App\User;
use App\Rating;

class SearchTeacherController extends Controller
{
    public function index()
    {
    	if (request()->ajax()) {
            /*
            $teachers = User::where('role_id', 2);
    		if (request('course_id')) {
                $teachers = $teachers->where('course_id', request('course_id'));
                if (request('order_by')) {
                    $teachers = $this->ordering($teachers, request('order_by'));
                } 
            } else {
                if (request('order_by')) {
                    $teachers = $this->ordering($teachers, request('order_by'));
                } 
            }
            */

            $teachers = User::where('role_id', 2)->where('name', 'like', '%'.request('name').'%');

            //course
            if (request('course_id')) {
                $teachers = $teachers->where('course_id', request('course_id'));
            }

            //gender
            if (request('gender')) {
                $teachers = $teachers->whereHas('profile', function($query){
                    $query->where('sex', request('gender'));
                });
            }

            //min age
            if (request('min_age')) {
                $birth_date = now()->subYear(request('min_age'));
                $teachers = $teachers->whereHas('profile', function($query) use ($birth_date){
                    $query->where('birth_date', '<=', $birth_date);
                });
            }

            //max age
            if (request('max_age')) {
                $birth_date = now()->subYear(request('max_age'));
                 $teachers = $teachers->whereHas('profile', function($query) use ($birth_date){
                    $query->where('birth_date', '>=', $birth_date);
                });
            }

            //ordering
            $this->ordering($teachers, request('order_by'));

    		return response()->json($teachers->get());
    	}

    	return view('search.index');
    }

    public function show(User $teacher)
    {
        return view('search.teacher', compact('teacher'));
    }

    public function rate(Request $request, User $teacher)
    {
        Rating::create([
            'user_id' => $teacher->id,
            'rating' => $request->rate
        ]);

        //rating
        $count = $teacher->ratings()->count();
        $sum = $teacher->ratings()->sum('rating');
        $teacher->rated = round($sum/$count);
        $teacher->save();

        return back()->with('success', 'Berhasil memberi bintang');
    }

    private function ordering($teachers, $request)
    {
        switch ($request) {
            case 'highest_price':
                $teachers = $teachers->orderBy('price', 'desc');
                break;
            case 'lowest_price':
                $teachers = $teachers->orderBy('price', 'asc');
                break;
            case 'highest_rate':
                $teachers = $teachers->orderBy('rated', 'desc');
                break;
            case 'lowest_rate':
                $teachers = $teachers->orderBy('rated', 'asc');
                break;
            default:
                $teachers = $teachers->orderBy('created_at', 'desc');
                break;
        }
        return $teachers;
    }

}
