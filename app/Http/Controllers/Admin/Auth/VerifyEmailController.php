<?php

namespace App\Http\Controllers\Admin\Auth;

use App\Http\Controllers\Controller;

use Illuminate\{
    Foundation\Auth\EmailVerificationRequest,
    Http\Request,
    Http\RedirectResponse
};

class VerifyEmailController extends Controller
{
    public function verifyEmail(){
        return view('auth.verify');
    }

    public function __invoke(Request $request): RedirectResponse
    {
        $request->user()->sendEmailVerificationNotification();
        return back()->with('resent', 'Verification link sent!');
    }

    public function verificationVerify(EmailVerificationRequest $request){

        $request->fulfill();

        return redirect('/');
    }
}
