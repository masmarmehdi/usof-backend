<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\{
    Category,
    User
};
use App\Models\Post;
use Illuminate\{
    Http\Request,
    Http\RedirectResponse,
    Support\Facades\Auth,
    Support\Facades\DB
};
use Image;


class AdminController extends Controller
{

    public function home(){
        $posts = Post::latest()->Paginate(10);
        $categories = Category::all();
        return view('admin/home', compact('posts', 'categories'));
    }

    public function adminProfile(){
        return view('admin.profile');
    }

    public function updateAdminProfile(Request $request): RedirectResponse
    {
        $validation = $request->validate([
            'username' => 'string|min:2|max:30',
            'profilePicture' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);
        $profilePicture = $request->file('profilePicture');

        if($validation) {
            $picture_name = Auth::user()->username . '.' . $profilePicture->getClientOriginalExtension();
            Image::make($profilePicture)->resize(600, 600)->save(public_path('/profile_pictures/' . $picture_name));
            User::where('id', Auth::id())->update([
                'username' => $request->input('username'),
                'profilePicture' => $picture_name,
            ]);
            return back()->with('success', 'Profile updated successfully');
        }
        return back()->with('fail', $validation->errors()->toJson());
    }
    public function userProfile($user_id){
        $user = User::find($user_id);
        return view('admin/users/profile', compact('user'));
    }

    public function updateUserProfile($user_id, Request $request){

        $user = User::find($user_id);
        DB::table('users')->where('id', $user->id)->update([
            'role' => $request->input('role')
        ]);
        return back()->with('success', 'Profile updated successfully');
    }
}
