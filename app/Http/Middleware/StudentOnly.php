<?php

namespace App\Http\Middleware;

use Closure;
use Auth;

class StudentOnly
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
        if (!$user->isStudent()) {
            if ($user->isAdmin()) {
                return redirect('admin');
            }
            return redirect('teacher');
        }
        return $next($request);
    }
}
