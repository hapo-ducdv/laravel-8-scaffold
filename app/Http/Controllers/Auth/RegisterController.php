<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\RegisterRequest;
use App\Models\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    use RegistersUsers;

    public function __construct()
    {
        $this->middleware('guest');
    }

    protected function create($data)
    {
        return User::create([
            'username' => $data['username'],
            'email' => $data['email'],
            'role' => 0,
            'password' => Hash::make($data['password_confirmation']),
        ]);
    }

    public function register(RegisterRequest $request)
    {
        if ($this->create($request)) {
            return redirect('/')->with('success', 'The new account created successfully! Let is login!');
        } else {
            return back()->with('error', 'Error Register');
        }
    }
}
