<?php

use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\ConfirmablePasswordController;
use App\Http\Controllers\Auth\EmailVerificationNotificationController;
use App\Http\Controllers\Auth\EmailVerificationPromptController;
use App\Http\Controllers\Auth\NewPasswordController;
use App\Http\Controllers\Auth\PasswordController;
use App\Http\Controllers\Auth\PasswordResetLinkController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\Auth\VerifyEmailController;
use App\Models\User;
use Illuminate\Support\Facades\Route;
use Laravel\Socialite\Facades\Socialite;

Route::middleware('guest')->group(function (): void {

    Route::get('/auth/github/redirect', function () {

        try {
            return Socialite::driver('github')->redirect();
        } catch (Exception $e) {
            return redirect('/login');
        }

    });

    Route::get('/auth/github/callback', function () {
        $S_user = Socialite::driver('github')->user();

        $user = User::where([
            'provider' => 'github',
            'provider_id' => $S_user->getId(),
        ])->first();

        if (!$user) {

            $validator = Validator::make(
                ['email' => $S_user->getEmail()],
                ['email', 'email,unique:users'],
                ['email.unique', "Couldn't Log in. Did you use a different login method?"]
            );

            if($validator->fails()){
                return redirect('/login')->withErrors($validator);
            }
            $user = User::create([
                'provider' => 'github',
                'provider_id' => $S_user->getId(),
                'name' => $S_user->getName(),
                'email' => $S_user->getEmail(),
                'avatar' => $S_user->getAvatar(),
                'email_verified_at' => now(),

            ]);

        }
        dd($S_user->getName(), $S_user->getId(), $S_user->getEmail(), $S_user->getAvatar(), $S_user->getNickname());
        // $user->token

        Auth::login($user);

        return redirect('/');
    });

    Route::get('register', [RegisteredUserController::class, 'create'])
        ->name('register');

    Route::post('register', [RegisteredUserController::class, 'store']);

    Route::get('login', [AuthenticatedSessionController::class, 'create'])
        ->name('login');

    Route::post('login', [AuthenticatedSessionController::class, 'store']);

    Route::get('forgot-password', [PasswordResetLinkController::class, 'create'])
        ->name('password.request');

    Route::post('forgot-password', [PasswordResetLinkController::class, 'store'])
        ->name('password.email');

    Route::get('reset-password/{token}', [NewPasswordController::class, 'create'])
        ->name('password.reset');

    Route::post('reset-password', [NewPasswordController::class, 'store'])
        ->name('password.store');
});

Route::middleware('auth')->group(function (): void {
    Route::get('verify-email', EmailVerificationPromptController::class)
        ->name('verification.notice');

    Route::get('verify-email/{id}/{hash}', VerifyEmailController::class)
        ->middleware(['signed', 'throttle:6,1'])
        ->name('verification.verify');

    Route::post('email/verification-notification', [EmailVerificationNotificationController::class, 'store'])
        ->middleware('throttle:6,1')
        ->name('verification.send');

    Route::get('confirm-password', [ConfirmablePasswordController::class, 'show'])
        ->name('password.confirm');

    Route::post('confirm-password', [ConfirmablePasswordController::class, 'store']);

    Route::put('password', [PasswordController::class, 'update'])->name('password.update');

    Route::post('logout', [AuthenticatedSessionController::class, 'destroy'])
        ->name('logout');
});
