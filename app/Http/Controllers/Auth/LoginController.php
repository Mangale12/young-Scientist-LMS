<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class LoginController extends Controller
{
    use AuthenticatesUsers;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    /**
     * The user has been authenticated.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  mixed  $user
     * @return \Illuminate\Http\Response
     */
    protected function authenticated(Request $request, $user)
    {
        Log::channel('login_log')->info('Testing custom log channel.');
        // Redirect based on user role
        return redirect()->route('admin.index'); // Redirect for admin users

        if ($user->role === 'admin') {
            return redirect()->route('admin.index'); // Redirect for admin users
        }

        return redirect()->route('user.dashboard'); // Redirect for regular users
    }
}
