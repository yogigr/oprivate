<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Day;
use App\Time;

class ProfileController extends Controller
{
    public function index(User $user)
    {
    	$days = Day::orderBy('id', 'asc')->get();
    	$times = Time::orderBy('id', 'asc')->get();
    	return view('profile.show.index', compact('user', 'days', 'times'));
    }
}
