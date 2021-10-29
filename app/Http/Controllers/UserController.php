<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Http\Requests\UserRequest;
use Auth;

class UserController extends Controller
{
    public function show()
    {
        $user = User::find(Auth::user()->id);

        return view('users.profile', compact('user'));
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
