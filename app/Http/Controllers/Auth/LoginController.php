<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;
use App\User;
use Socialite;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function socialLogin($provider)
    {
        return Socialite::driver($provider)->redirect();
    }

    public function handleSocialCallback($provider)
    {
        $userSocial = Socialite::driver($provider)->user();
        $user = User::where('email', $userSocial->getEmail())->first();
        if ($user) {
            Auth::login($user);
            return redirect($this->redirectTo());
        } else {
            return view('auth.register', [
                'email' => $userSocial->getEmail(),
                'name' => $userSocial->getName()
            ]);
        }
    }

    public function redirectTo()
    {
        if (Auth::user()->isAdmin()) {
            return 'admin';
        } elseif (Auth::user()->isTeacher()) {
            return 'teacher';
        } elseif (Auth::user()->isStudent()) {
            return 'student';
        }
    }

    /**
     * Log the user out of the application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function logout(Request $request)
    {
        $this->guard()->logout();

        $request->session()->invalidate();

        return redirect('/login');
    }
}
