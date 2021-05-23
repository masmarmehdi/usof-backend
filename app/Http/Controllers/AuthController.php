<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class AuthController extends Controller
{
    public function __construct(){
        $this->middleware('auht:api', ['except' => ['login', 'register']]);
    }

    public function login(Request $request){

        $validator = Validator::make($request->all(), [
            'username' => 'required|min:2',
            'email' => 'required|email',
            'password' => 'required|min:8'
        ]);
        if($validator->fails()){
            return response()->json($validator->errors(), 400);
        }

        $token_validity = (24 * 60);

        $this->guard()->factory()->setTTL($token_validity);

        if(!$token = $this->guard()->attempt($validator->validated())){
            return response()->json(['error' => 'Unauthorized'], 401);
        }
        return $this->respondWithToken($token);
    }
    public function register(Request $request){
        $validator = Validator::make($request->all(),[
            'username' => 'required|min:2',
            'name' => 'required|min:2',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:8'
        ]);
        if($validator->fails()){
            return response()->json($validator->errors(), 400);
        }

        $user = User::create($request->all());

        return response()->json(['message' => 'You are successfully registered!', 'user' => $user], 201);
    }
    public function logout(){
        $this->guard()->logout();
        return response()->json(['message' => 'User logged out successfully']);
    }
    public function profile(Request $request){
        return response()->json($this->guard()->user());
    }
    public function refresh(Request $request){
        return response()->json($this->guard()->user());
    }

    protected function respondWithToken($token)
    {
        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => auth()->factory()->getTTL() * 60
        ]);
    }
    public function guard(){
        return Auth::guard();
    }
}
