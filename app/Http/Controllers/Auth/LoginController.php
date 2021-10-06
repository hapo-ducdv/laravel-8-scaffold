<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Auth;

class LoginController extends Controller
{
    use AuthenticatesUsers;

    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    protected function attemptLogin($data)
    {
        $loginData = ['username' => $data['username'], 'password' => $data['pwd']];
        $remember = ($data['remember'] == config('app.remember')) ? true : false;

        return Auth::attempt($loginData, $remember);
    }

    public function login(LoginRequest $request)
    {
        if ($this->attemptLogin($request)) {
            return back()->with('success', 'Login successfully!');
        } else {
            return back()->with('error', 'Incorrect account or password');
        }
    }

    public function logout()
    {
        $username = Auth::user()->username;

        Auth::logout();

        return redirect('/')->with('success', 'You are logged out of '. $username);
    }
}
