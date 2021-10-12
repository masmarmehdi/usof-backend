<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\{
    Http\RedirectResponse,
    Http\Request,
    Support\Facades\Auth,
    Support\Facades\Validator
};

class UserController extends Controller
{
    public function index(){
        $users = User::all();
        return view('admin/users/show',compact('users'));
    }

    public function create(){
        return view('user.create');
    }

    public function store(Request $request){
        return User::create($request->all());
    }

    public function destroy($user_id): RedirectResponse
    {
        $user  = User::find($user_id);
        if($user){
            $user->delete();
            return redirect()->route('user.index')->with('success', 'User deleted successfully!');
        }
        return redirect()->route('user.index')->with('fail', 'User already deleted or does not exist in the first place!');
    }

    public function updateUserProfilePicture(Request $request)
    {
        $validation = Validator::make($request->all(),[
            'username' => 'string|min:2|max:30',
            'profilePicture' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $profilePicture = $request->file('profilePicture');

        if($validation) {
            $picture_name = Auth::user()->username . '.' . $profilePicture->getClientOriginalExtension();
            Image::make($profilePicture)->resize(600, 600)->save(public_path('/profile_pictures/' . $picture_name));
            User::where('id', Auth::id())->update([
                'profilePicture' => $picture_name,
            ]);
            return response()->json(['success' => 'Profile Picture updated successfully']);
        }
        return back()->with('fail', $validation->errors()->toJson());
    }

}
