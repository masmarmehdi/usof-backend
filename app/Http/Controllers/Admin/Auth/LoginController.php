<?php

namespace App\Http\Controllers\Admin\Auth;

use App\Http\Controllers\Controller;
use Illuminate\{
    Http\Request,
    Support\Facades\Auth,
    Support\Facades\Validator,
    Http\RedirectResponse
};
use App\Models\User;


class LoginController extends Controller
{
    public function login(){
        return view('auth.login');
    }

    public function loginCheck(Request $request): RedirectResponse
    {
        $validation = Validator::make($request->all(),[
            'username' => 'required',
            'email' => 'required|email',
            'password' => 'required|string|min:8'
        ]);
        $user = User::where('email', $request->input('email'));
        $auth_check = Auth::attempt($validation->validated());

        if($validation->fails()){
            return redirect()->route('auth.login')->with('fail', $validation->errors()->toJson());
        }
        if($user){
                if($auth_check){
                    $request->session()->regenerate();
                    return redirect()->route('homepage')->with('success', 'logged in successfully');
                }
            return redirect()->route('auth.login')->with('fail', 'Incorrect password or username!');
        }
        return redirect()->route('auth.login')->with('fail', 'User does not exist in ou database, please feel free to register.');
    }

}
