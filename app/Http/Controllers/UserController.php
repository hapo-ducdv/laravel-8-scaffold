<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Http\Requests\UserRequest;
use Auth;

class UserController extends Controller
{
    public function show()
    {
        if (isset(Auth::user()->id)) {
            $user = User::find(Auth::user()->id);

            return view('profile', compact('user'));
        } else {
            return redirect('/')->with('error', 'Please login first');
        }
    }

    public function update(UserRequest $request)
    {
        $user = User::find(Auth::user()->id);

        if ($request['avatar']) {
            $avatar = time() . '.' . $request->file('avatar')->extension();
            $request->file('avatar')->move(storage_path('app/public/users'), $avatar);
            $user = $user->update(['avatar' => $avatar]);
        } else {
            $user = $user->update([
                'fullname' => $request['update_fullname'],
                'email' => $request['update_email'],
                'birthday' => $request['update_birthday'],
                'phone' => $request['update_phone'],
                'address' => $request['update_address'],
                'intro' => $request['update_intro']
            ]);
        }

        if ($user) {
            return back()->with('success', 'Successful update');
        } else {
            return back()->with('error', 'Fail update');
        }
    }
}
