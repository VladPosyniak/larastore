<?php

namespace larashop\Http\Controllers;

use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;
use larashop\Http\Requests;
use larashop\User;
use Illuminate\Support\Facades\Auth;
use Exception;

class SocialAuthController extends Controller
{

    public function redirect($provider)
    {
        return Socialite::driver($provider)->redirect();
    }

    public function callback($provider, Socialite $service)
    {
        // when facebook call us a with token
        try {
            $user = Socialite::driver($provider)->user();
        } catch (Exception $e) {
            return redirect(url('/login'));
        }

        $authUser = $this->findOrCreateUser($provider, $user);

        Auth::login($authUser, true);

        return redirect(url('/'));
    }

    private function findOrCreateUser($provider, $user)
    {
        if ($authUser = User::where('email', $user->email)->first()) {
            return $authUser;
        }

        return User::create([
            'name' => $user->name,
            'email' => $user->email,
            'vkontakte_id' => $user->id,
        ]);
    }
}
