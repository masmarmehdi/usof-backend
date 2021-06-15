<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Validator;


class AuthController extends Controller
{
    // Get a JWT via given credentials.
    public function login(Request $request){
    	$validator = Validator::make($request->all(), [
            'username' => 'required|min:2',
            'email' => 'required|email',
            'password' => 'required|string|min:6',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        if (! $token = auth()->attempt($validator->validated())) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        return $this->createNewToken($token);
    }

    // Register a User.
    public function register(Request $request) {
        $validator = Validator::make($request->all(), [
            'username' => 'required|min:2',
            'name' => 'required|string|max:30',
            'email' => 'required|string|email|unique:users',
            'password' => 'required|string|confirmed|min:8',
            'password_confirmation' => 'required'
        ]);

        if($validator->fails()){
            return response()->json($validator->errors()->toJson(), 400);
        }

        $user = User::create(array_merge(
                    $validator->validated(),
                    ['password' => bcrypt($request->password)]
                ));

        return response()->json([
            'message' => $request->name .' you are successfully registered!',
            'user' => $user
        ], 201);
    }


    
    // Log the user out (Invalidate the token).
    public function logout() {
        auth()->logout();
        return response()->json(['message' => 'User successfully signed out']);
    }

    // Refresh the token.
    public function refresh() {
        return $this->createNewToken(auth()->refresh());
    }

    
    // Get the authenticated User.
    public function userProfile() {
        // if($token){
            return response()->json(auth()->user());
        // }
        // return response()->json(['message' => 'unauthenticated']);
    }

    // Get the token array structure.
    protected function createNewToken($token){
        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => auth()->factory()->getTTL() * 60,
            'user' => auth()->user()
        ]);
    }

}
