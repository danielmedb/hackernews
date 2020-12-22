<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Illuminate\Validation\Rule;

class UserProfileController extends Controller
{

    public function __construct()
    {
        $this->middleware(['auth']);
    }

    public function index()
    {
        $user = User::findOrFail(auth()->id());
        $images = \File::allFiles(public_path('images/'.auth()->id()));
      
        // return view('userprofile')->with('user')->get();

        // $posts = Post::latest()->with(['comments', 'votes', 'user'])->get();
        return view('userprofile', [
            'user' => $user,
            'images' => $images
        ]);
    }

    public function usersposts(Request $request)
    {
        $posts = $request->user()->posts()->get();
        return view('userposts')->with('posts', $posts);
    }

    public function store(Request $request, User $user)
    {
        $this->authorize('editProfile', $user);

        $this->validate($request, [
            'name' => 'required',
            Rule::unique('users')->ignore($user->name, 'name'),
            'email' => 'required', 'email',
            Rule::unique('users')->ignore($user->email, 'email')
        ]);

        $request->user()->update([
            'name' => $request->name,
            'email' => $request->email,
            
        ]);
            return back()->with('credentials', 'Your credentials has been updated.');
    }

    public function changepassword(Request $request, User $user)
    {
        $this->authorize('editProfile', $user);
        $this->validate($request, [
            'password' => 'required|min:6'
        ]);
        $request->user()->update([
            'password' => Hash::make($request->password)
            
        ]);
        return back()->with('status', 'Password has been updated');
    }

    public function profileimageupdate(Request $request, User $user)
    {
        $this->authorize('editProfile', $user);
        $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048'
        ]);
        
        $imageName = time().'.'.$request->image->extension();  
     
        $request->image->move(public_path('images/'.$user->id), $imageName);
    
        return back()
            ->with('success','You have successfully upload image.')
            ->with('image',$imageName);         
    }
}
