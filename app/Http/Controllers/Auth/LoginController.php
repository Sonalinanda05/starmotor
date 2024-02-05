<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    use AuthenticatesUsers;

    protected $redirectTo;

    public function __construct()
    {
        $this->middleware('guest')->except('logout');
        $this->redirectTo = RouteServiceProvider::HOME;
    }

    public function login(Request $request)
    {
        $this->validateLogin($request);

        // Perform your custom login logic here
        if ($this->attemptLogin($request)) {
            // Check user role and redirect accordingly
            if (Auth::check() && Auth::user()->role_id == 1) {
                return redirect()->route('admin.dashboard');
            } elseif (Auth::check() && Auth::user()->role_id == 2) {
                return redirect()->route('user.home');
            } else {
                return redirect()->route('home');
            }
        }

        // If login fails, redirect back with errors
        return $this->sendFailedLoginResponse($request);
    }
}
