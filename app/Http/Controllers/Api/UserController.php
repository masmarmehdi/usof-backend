<?php

namespace App\Http\Controllers\Api;
use App\Http\Controllers\Controller;
use App\Models\Post;
use Illuminate\{Http\Request, Http\JsonResponse, Support\Facades\Auth, Support\Facades\Validator};
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
        if(Auth::user()->role  == 'admin'){

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
    public function userUpdate(Request $request){
        $user = Auth::id() ? User::find(Auth::id()) : User::find($request->input('user_id'));
        if($user){
            $user->update($request->all());
            return response()->json(['success' => 'User data updated successfully!', 'user' => $user], 200);
        }
        return response()->json(['error' => 'No such user']);
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
        $user = User::find($request->input('user_id'));
        $username = $user->username;
        $profilePicture = $request->file('profilePicture');

        $validation = Validator::make($request->all(),[
            'profilePicture' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);
        if($validation->fails()){
            return response()->json(['error' => $validation->errors()]);
        }
        if($request->hasFile('profilePicture')){
                $profilePicture_name = $username . '.' . $profilePicture->getClientOriginalExtension();
                Image::make($profilePicture)->save(public_path('profile_pictures/' . $profilePicture_name));
                User::where('id', Auth::id() ? Auth::id() : $request->input('user_id'))->update([
                    'profilePicture' => $profilePicture_name
                ]);
                return response()->json(['success' => 'Profile Picture uploaded successfully', 'user' => $user]);
        }
        return response()->json(['fail', 'something went wrong.. Please try again later.']);
    }

    public function showUserPosts($user_id){
        $user = User::find($user_id);
        if($user){
            $user_posts = Post::where('user_id', $user_id)->get();
            if($user_posts->isEmpty()){
                return response()->json(['error' => $user->username ." still didn't publish a post yet..." ]);

            }
            return response()->json($user_posts);

        }
        return response()->json(['error' => "User id doesn't exist in our database"]);
    }

}
