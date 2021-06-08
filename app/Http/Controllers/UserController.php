<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\models\User;
use Illuminate\Support\Facades\Auth;

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

    public function store(RegisterRequest $request)
    {
        $user = User::create($request->all());
        return response()->json($user, 201);;
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
        $validator = Validator::make($request->all(), [
            'username' => 'string|unique',
            'name' => 'string|max30',
            'email' => 'email|unique',
            'password' => 'min:8|confirmed',
            'role' => 'alpha|in:user,admin'
        ]);

        if($validator->fails()){
            return response()->json($validator->errors()->toJson(), 400);
        }
        
        $user = User::find($id);
        if($user){
            $user->update($request->all());
            return response()->json($user, 200);
        }
        return response()->json(['message' => 'User not found'], 404);
    }

    public function destroy($id)
    {
        $user = User::find($id);
        $user->delete();
        return response()->json(null, 204);
    }


    public function profilePicture(Request $request){
        return response()->download(public_path('defaultpp.png'), 'Profile Picture');
    }

    public function uploadProfilePicture(Request $request){
        $user = User::find(Auth::user(Auth::getToken())->id);
        $fileName = $this->user->username . '.png';
        $path = $request->file('profilePicture')->move(public_path('/'), $fileName);
        
        $user->update([
            'profilePicture' => $path
        ]);
        return response()->json([
            'message' => 'Profile picture uploaded successfully',
            'url' => url('/' . $fileName)], 200);
    }

}
