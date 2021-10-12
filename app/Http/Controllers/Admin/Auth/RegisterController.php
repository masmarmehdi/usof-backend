<?php

namespace App\Http\Controllers\Admin\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\{
    Auth\Events\Registered,
    Http\Request,
    Support\Facades\Validator
};

class RegisterController extends Controller
{
    public function register(){
        return view('auth.register');
    }
    public function registerCheck(Request $request) {

        $validator = Validator::make($request->all(), [
            'username' => 'required|min:2|unique:users',
            'name' => 'required|string|max:30',
            'email' => 'required|string|email|unique:users',
            'password' => 'required|string|confirmed|min:8',
            'password_confirmation' => 'required',
        ]);

        if($validator->fails()){
            return response()->json($validator->errors()->toJson(), 400);
        }
        $user = User::create(array_merge(
            $validator->validated(),
            ['password' => bcrypt($request->password)]
        ));
        event(new Registered($user));
        return redirect()->route('auth.login')->with('success', 'You are successfully registered please log in');

    }
}
