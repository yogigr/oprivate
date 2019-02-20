<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class RequireEducationalAchievement
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

        if ($teacher->educationals->count() == 0) {
            return redirect('teacher/profile#educational')->with('error', 'Belum isi riwayat pendidikan');
        }

        if ($teacher->achievements->count() == 0) {
            return redirect('teacher/profile#achievement')->with('error', 'Belum isi daftar penghargaan');
        }

        return $next($request);
    }
}
