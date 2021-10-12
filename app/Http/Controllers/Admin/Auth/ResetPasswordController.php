<?php

namespace App\Http\Controllers\Admin\Auth;

use App\Http\Controllers\Controller;
use Illuminate\{
    Http\Request,
    Support\Facades\Password,
    Auth\Events\PasswordReset,
    Support\Facades\Hash,
    Support\Str,
    Http\RedirectResponse
};


class ResetPasswordController extends Controller
{

    public function resetPassword($token)
    {
        return view('auth.reset-password', ['token' => $token]);
    }
    public function checkResetPassword(Request $request): RedirectResponse
    {
        $request->validate([
            'token' => 'required',
            'email' => 'required|email',
            'password' => 'required|min:8|confirmed',
        ]);

        $status = Password::reset(
            $request->only('email', 'password', 'password_confirmation', 'token'),
            function ($user, $password) {
                $user->forceFill([
                    'password' => Hash::make($password)
                ])->setRememberToken(Str::random(60));

                $user->save();

                event(new PasswordReset($user));
            }
        );

        return $status === Password::PASSWORD_RESET
            ? redirect()->route('auth.login')->with('status', __($status))
            : back()->withErrors(['email' => [__($status)]]);
    }

}
