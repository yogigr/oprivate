<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class RequireTeacherSettings
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
        $teacher = Auth::user();

        if (is_null($teacher->price) || is_null($teacher->course_id)) {
            return redirect('teacher/setting')->with('error', 'Tarif dan Mata Pelajaran belum ditentukan');
        }

        return $next($request);
    }
}
