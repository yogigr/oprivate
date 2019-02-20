<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PageController extends Controller
{
    public function index()
    {
    	$teachers = \App\User::where('role_id', 2)->get();
    	$students = \App\User::where('role_id', 3)->get();
    	$courses = \App\Course::get();
    	return view('admin.index', compact('teachers', 'students', 'courses'));
    }
}
