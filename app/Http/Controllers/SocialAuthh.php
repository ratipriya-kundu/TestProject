<?php

namespace App\Http\Controllers;
use Laravel\Socialite\Facades\Socialite;

use Illuminate\Http\Request;

class SocialAuthh extends Controller
{
    public function twitter() {
        return Socialite::driver('twitter')->redirect();
    }

    public function twitterResponse() {
        $user=Socialite::driver('twitter')->user();
        dd($user);
    }
}
