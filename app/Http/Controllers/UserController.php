<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
// use Illuminate\Support\Facades\Request;
use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{
    public function __construct(Request $request) {
        $this->request = $request;
    }
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
    public function check(){
        $input = request()->all();
        $email = User::where('email',$input['email'])->value('email');
        $password = User::where('password',$input['password'])->value('password');
        echo bcrypt($input['password']);
        // if ($input['email'] == $email){
        //     if(bcrypt($input['password']) == $password){
        //         return view('welcome');
        //     }
        //     else{
        //         return 'Incorrect Password';
        //     }
        // }
        // else{
        //     return 'incorrect Email';
        // }
    }
    public function show(){
        return User::all();
    }
}
