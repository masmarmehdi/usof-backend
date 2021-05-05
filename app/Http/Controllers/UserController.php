<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
// use Illuminate\Support\Facades\Request;
use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{
    public function index()
    {
       return view('registration');
    }
    public function store(){
        // $user = new User();
        // $user->name = Request::get('name');
        // $user->email = Request::get('email');
        // $user->password = Request::get('password');
        // $name = $this->request->input('name');
        // $email = $this->request->input('email');
        // $password = $this->request->input('password');
        $input = request()->all();
        User::create($input);
        return view('login');
    }
    public function login(){
        return view('login');
    }
    public function check(Request $request){
            if ($request->isMethod('post')){
                // do anything in 'post request';
                $input = request()->all();
                $email = User::where('email',$input['email'])->value('email');
                $password = User::where('id',8)->value('password');
                if ($input['email'] == $email){
                    if($input['password'] == $password){
                        return view('home');
                    }
                    else{
                        return 'Incorrect Password';
                    }
                }
                else{
                    return 'incorrect Email';
                }
            }
            else if($request->isMethod('get')){
                // do anything in 'get request';
                return view('welcome');
            }
    }
    public function show(){
        return User::all();
    }
}
