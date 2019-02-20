<?php

namespace App\Http\Middleware;

use Closure;
use Auth;

class TeacherOnly
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
        if (!$user->isTeacher()) {
            if ($user->isAdmin()) {
                return redirect('admin');
            }
            return redirect('student');
        }
        return $next($request);
    }
}
