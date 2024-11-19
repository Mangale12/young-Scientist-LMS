<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class LoginController extends Controller
{
    use AuthenticatesUsers;

    /**
     * Create a new controller instance.
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    /**
     * Handle authenticated user after login.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  mixed  $user
     * @return \Illuminate\Http\Response|\Illuminate\Http\JsonResponse
     */
    protected function authenticated(Request $request, $user)
    {
        // Log the login event
        Log::channel('login_log')->info("User {$user->id} logged in successfully.");

        // Determine redirection URL based on user role
        $redirectUrl = $user->role === 'admin' 
            ? route('admin.index') 
            : route('user.dashboard');

        // If the request expects JSON (API request)
        if ($request->expectsJson()) {
            return response()->json([
                'success' => true,
                'message' => 'Login successful',
                'user' => [
                    'id' => $user->id,
                    'name' => $user->name,
                    'email' => $user->email,
                    'role' => $user->role,
                ],
                'redirect_url' => $redirectUrl,
            ]);
        }

        // For non-API requests, perform the standard redirect
        return redirect($redirectUrl);
    }

    /**
     * Handle login failure.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response|\Illuminate\Http\JsonResponse
     */
    protected function sendFailedLoginResponse(Request $request)
    {
        $message = 'Invalid credentials. Please try again.';

        // If the request expects JSON (API request)
        if ($request->expectsJson()) {
            return response()->json([
                'success' => false,
                'message' => $message,
            ], 401);
        }

        // For non-API requests, redirect back with errors
        return redirect()->back()
            ->withInput($request->only($this->username(), 'remember'))
            ->withErrors([$this->username() => $message]);
    }

    /**
     * Override the default logout method for JSON compatibility.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response|\Illuminate\Http\JsonResponse
     */
    public function logout(Request $request)
    {
        $this->guard()->logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        // If the request expects JSON (API request)
        if ($request->expectsJson()) {
            return response()->json([
                'success' => true,
                'message' => 'Logout successful',
            ]);
        }

        // For non-API requests, redirect to login page
        return redirect('/');
    }
}
