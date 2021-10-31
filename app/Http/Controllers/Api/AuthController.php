<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Auth\Events\{
    PasswordReset,
    Registered,
};
use Illuminate\Http\{
    JsonResponse,
    Request
};
use Illuminate\Support\{
    Facades\Auth,
    Facades\Password,
    Facades\Validator,
    Str
};
use App\Models\User;

class AuthController extends Controller
{
    public function login(Request $request): JsonResponse
    {
        $validation = Validator::make($request->all(),[
            'username' => 'required|string',
            'email' => 'required|email',
            'password' => 'required|string',
        ]);
        $auth_check = Auth::attempt($validation->validated());
        $user = User::where('email', $request->input('email'))->first();
        if($user){
            if ($auth_check) {
                $request->session()->regenerate();
                return  response()->json(['user' => Auth::user()]);
            }else{
                return response()->json(['error' => 'username or password is incorrect!']);
            }
        }
        return response()->json(['error' => 'This email was not found in our database, please feel free to register.']);

    }
    public function register(Request $request): JsonResponse
    {
        $validation = Validator::make($request->all(), [
            'username' => 'required|string|unique:users|min:2|max:30',
            'name' => 'required|string|max:40',
            'email' => 'required|string|email|unique:users',
            'password' => 'required|string|confirmed|min:8',
        ]);
        if($validation->fails()){
            return response()->json(['error' => $validation->errors()]);
        }

        $user = User::create(array_merge(
            $validation->validated(),
            ['password' => bcrypt($request->password)]
        ));
        if($user){
            event(new Registered($user));
            return response()->json(['success' => 'User created successfully. Please verify your email before after logging in. An email has been sent to you!']);
        }
        return response()->json(['error' => 'Something went wrong! Try again.']);
    }

    public function logout(Request $request): JsonResponse
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        if(!Auth::user()){
            return response()->json(['success' => 'logged out successfully!']);
        }else{
            return response()->json(['error' => 'Something went wrong!']);
        }
    }

    function forgotPassword(Request $request): array
    {
        $request->validate(['email' => 'required|email']);

        $status = Password::sendResetLink(
            $request->only('email')
        );

        return $status === Password::RESET_LINK_SENT
            ? (['success' => __($status)])
            : (['fail' => __($status)]);
    }
    function resetPassword(Request $request, $token): array
    {
        $request->validate([
            'token' => 'required',
            'email' => 'email',
            'password' => 'required|min:8|confirmed',
        ]);

        $status = Password::reset(
            array_merge($request->only('email', 'password', 'password_confirmation'), ['token' => $token]),
            function ($user, $password) {
                $user->forceFill([
                    'password' => bcrypt($password)
                ])->setRememberToken(Str::random(60));
                $user->save();
                event(new PasswordReset($user));
            }
        );
        return $status === Password::PASSWORD_RESET
            ? (['success' => __($status)])
            : (['email' => [__($status)]]);
    }
    public function userProfile(): JsonResponse
    {
        return response()->json(['user-profile' => Auth::user()]);
    }
}
