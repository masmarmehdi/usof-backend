<?php

namespace App\Http\Controllers\Api;
use App\Http\Controllers\Controller;
use Illuminate\{
    Http\Request,
    Http\JsonResponse,
    Support\Facades\Auth
};
use App\models\User;
use Intervention\Image\Facades\Image;

class UserController extends Controller
{

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
        if(Auth::user()->role == 'admin'){

            $user = User::create(array_merge(
                $request->all(),
                ['password' => bcrypt($request->input('password'))]
            ));
            return response()->json($user, 201);
        }

        return response()->json(['message' => 'Only admins can access to this place'], 200);
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
        if(Auth::user()->role == 'admin'){

            $user = User::find($id);
            if($user){
                $user->update($request->all());
                return response()->json($user, 200);
            }
            return response()->json(['message' => 'User not found'], 404);
        }

        return response()->json(['message' => 'Only admins can access to this place'], 200);
    }

    public function destroy($id)
    {
        if(Auth::user()->role == 'admin'){
            $user = User::find($id);
            if($user){
                $user->delete();
                return redirect()->route('user.index')->with('success', 'User deleted successfully!');
            }
            return redirect()->route('user.index')->with('fail', 'User does not even exist to be removed!');
        }

        return response()->json(['message' => 'Only admins can accesss to this place'], 200);
    }

    public function updateProfilePicture(Request $request): JsonResponse
    {
        $validation = $request->validate([
            'profilePicture' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);
        $profilePicture = $request->file('profilePicture');
        if($request->hasFile('profilePicture')){
            if($validation) {
                $profilePicture_name = Auth::user()->username . '.' . $profilePicture->getClientOriginalExtension();
                Image::make($profilePicture)->resize(100, 100)->save(public_path('profile_pictures/' . $profilePicture_name));
                User::where('id', Auth::id())->update([
                    'profilePicture' => $profilePicture_name
                ]);
                return response()->json(['success' => 'Profile Picture uploaded successfully']);
            }
            return response()->json(['fail' => 'Invalid extension']);
        }
        return response()->json(['fail', 'something went wrong.. Please try again later.']);
    }

}
