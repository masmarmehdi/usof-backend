<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\models\User;
use Illuminate\Support\Facades\Auth;
use DB;
use File;
use Validator;
class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->user = Auth::user(Auth::getToken());
    }

    public function index()
    {
        $user = User::all();
        if($user){
            return User::all();
        }
        return response()->json(['message' => 'No users yet'], 404);
    }

    public function store(Request $request)
    {
        if($this->user->role == 'admin'){

            $user = User::create($request->all());
            return response()->json($user, 201);
        }
        
        return response()->json(['message' => 'Only admins can accesss to this place'], 200);
    }

    public function show($id)
    {
        if (User::find($id) === null)
            return response([
                'message' => 'User does not exist'
            ], 404);

        return User::find($id);
    }

    public function update(Request $request, $id)
    {
        if($this->user->role == 'admin'){
    
            $user = User::find($id);
            if($user){
                $user->update($request->all());
                return response()->json($user, 200);
            }
            return response()->json(['message' => 'User not found'], 404);
        }

        return response()->json(['message' => 'Only admins can accesss to this place'], 200);
    }

    public function destroy($id)
    {
        if($this->user->role == 'admin'){
            $user = User::find($id);
            $user->delete();
            return response()->json(null, 204);
        }

        return response()->json(['message' => 'Only admins can accesss to this place'], 200);
    }

    public function uploadProfilePicture(Request $request){
        $profilePicture = $request->file('profilePicture');
        if($profilePicture){
            $fileName = $this->user->username . '.png';
            $profilePicture = $request->file('profilePicture')->store('public');
            $profilePicture1 = $request->file('profilePicture')->move(public_path('/'), $fileName);
            $this->user->profilePicture  = url('/' . $fileName);
            DB::update('update users set profilePicture = ? where id = ?', [url('/' . $fileName),$this->user->id]);
            return response()->json([
                'message' => 'Profile picture uploaded successfully',
                'user' => $this->user
            ], 200);
        }
        return response()->json('error', 404);
    }

}
