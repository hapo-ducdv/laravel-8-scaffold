<?php

namespace App\Http\Controllers;

use Laravel\Socialite\Facades\Socialite;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Exception;

class FacebookController extends Controller
{
    public function redirectToFacebook()
    {
        return Socialite::driver('facebook')->redirect();
    }

    public function handleFacebookCallback()
    {
        try {
            $user = Socialite::driver('facebook')->user();
            $findUser = User::where('email', $user->email)->first();

            if ($findUser) {
                $findUser->update([
                    'facebook_id' => $user->id,
                ]);

                Auth::login($findUser);

                return redirect()->route('home');
            } else {
                $createUser = User::create([
                    'fullname' => $user->name,
                    'email' => $user->email,
                    'facebook_id' => $user->id,
                    'password' => bcrypt('@123456')
                ]);

                Auth::login($createUser);

                return redirect()->route('home');
            }
        } catch (Exception $exception) {
            dd($exception->getMessage());
        }
    }
}
