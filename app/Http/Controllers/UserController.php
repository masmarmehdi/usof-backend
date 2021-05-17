<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\models\User;

class UserController extends Controller
{
    public function showUsers(){
        $user  = User::all();
        if($user){
            return User::all();
        }
        return response()->json(['message' => 'No users yet'], 404);
    }

    public function store(Request $request)
    {
        return User::create($request->all());
    }
    
    public function createUser(Request $request){
        $user = User::create($request->all());
        return response()->json($user, 201);
    }

    public function showUser($id)
    {
        $user = User::find($id);
        if($user){
            return response()->json($user, 200);
        }
        return response()->json(['message' => 'User not found'], 404);
    }

    public function updateUser($id, Request $request){
        $user = User::find($id);
        if($user){
            $user->update($request->all());
            return response()->json($user, 200);
        }
        return response()->json(['message' => 'User not found'], 404);
    }

    public function deleteUser($id, Request $request){
        $user = User::find($id);
        $user->delete();
        return response()->json(null, 204);
    }
}
