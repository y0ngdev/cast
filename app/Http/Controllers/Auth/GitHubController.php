<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Laravel\Socialite\Facades\Socialite;

class GitHubController extends Controller
{
    //
    public function redirectToGithub()
    {
        try {
            return Socialite::driver('github')->redirect();
        } catch (Exception) {

            return redirect('/login');
        }
    }

    public function handleGithubCallback()
    {
        $S_user = Socialite::driver('github')->user();

        $user = User::where([
            'provider' => 'github',
            'provider_id' => $S_user->getId(),
        ])->first();

        if (! $user) {

            $validator = Validator::make(
                ['email' => $S_user->getEmail()],
                ['email', 'email,unique:users'],
                ['email.unique', "Couldn't Log in. Did you use a different login method?"]
            );

            if ($validator->fails()) {
                return redirect('/login')->withErrors($validator);
            }

            $user = User::updateOrCreate([
                'provider' => 'github',
                'provider_id' => $S_user->getId(),
                'name' => $S_user->getName(),
                'username' => $this->generateUniqueUsername($S_user->getNickname()),
                'email' => $S_user->getEmail(),
                'avatar' => $S_user->getAvatar(),
                'email_verified_at' => now(),
                'github' => 'https://github.com/'.$S_user->getNickname(),

            ]);

        }
        // $user->token

        Auth::login($user);

        return redirect('/');

    }

    public function generateUniqueUsername($desiredUsername)
    {
        $baseUsername = Str::slug($desiredUsername, '_');
        $username = $baseUsername;
        $counter = 1;

        while (User::where('username', $username)->exists()) {
            $username = "{$baseUsername}_{$counter}";
            $counter++;
        }

        return $username;
    }
}
