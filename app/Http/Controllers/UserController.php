<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Http\Requests\UserRequest;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function show(User $user)
    {
        if ($user['id'] == Auth::user()->id) {
            return view('profile', compact('user'));
        } else {
            return 'You do not have access to this page. Please check your account';
        }
    }

    public function update(UserRequest $request, User $user)
    {
        if ($request['avatar']) {
            $user->updateAvatar($request, $user);

            return back()->with('success', 'Successful update');
        } else {
            $user->updateInfo($request, $user);

            return back()->with('success', 'Successful update');
        }
    }
}
