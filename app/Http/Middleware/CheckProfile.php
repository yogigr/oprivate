<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class CheckProfile
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $user = Auth::user();

        if (!$user->isAdmin()) {
            if (is_null($user->profile)) {
                if ($user->isTeacher()) {
                    return redirect('teacher/profile#profile')->with('error', 'Silahkan lengkapi data profile dulu');
                } else {
                    return redirect('/student/profile#profile')->with('error', 'Silahkan lengkapi data profile dulu');
                }
            }

            if (is_null($user->address)) {
                if ($user->isTeacher()) {
                    return redirect('teacher/profile#address')->with('error', 'Silahkan lengkapi data Alamat');
                } else {
                    return redirect('/student/profile#address')->with('error', 'Silahkan lengkapi data Alamat');
                }
            }

            if (is_null($user->geolocation)) {
                if ($user->isTeacher()) {
                    return redirect('teacher/profile#geolocation')->with('error', 'Silahkan lengkapi data lokasi');
                } else {
                    return redirect('/student/profile#geolocation')->with('error', 'Silahkan lengkapi data lokasi');
                }
            }

            if (is_null($user->contact)) {
                if ($user->isTeacher()) {
                    return redirect('teacher/profile#contact')->with('error', 'Silahkan lengkapi data kontak');
                } else {
                    return redirect('/student/profile#contact')->with('error', 'Silahkan lengkapi data kontak');
                }
            }
        }
        
        return $next($request);
    }
}
