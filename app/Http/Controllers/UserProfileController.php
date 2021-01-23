<?php

namespace App\Http\Controllers;

use App\Models\Following;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Post;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use App\Rules\MatchOldPassword;

class UserProfileController extends Controller
{

    public function __construct()
    {
        $this->middleware(['auth']);
    }

    public function index()
    {
        $user = User::findOrFail(auth()->id());
        $info = User::with(['comments', 'posts', 'vote'])->findOrFail(auth()->id());
        return view('userprofile', [
            'user' => $user,
            'info' => $info
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
            'email' => [
                'required',
                Rule::unique('users')->ignore($user->id),
            ],
            'name' => [
                'required',
                Rule::unique('users')->ignore($user->id),
            ],
            'biography' => 'max:300',
            'password' => 'nullable|min:6',
            'confirm_password' => 'same:password'

        ]);
        if ($request->password != null) {
            $password = Hash::make($request->password);
            $request->request->add(['password' => $password]);
        } else {
            $request->request->remove('password');
            $request->request->remove('confirm_password');
        }

        $request->user()->update($request->all());


        return back()->with('credentials', 'Your credentials has been updated.');
    }

    public function profileimageupdate(Request $request, User $user)
    {

        $this->authorize('editProfile', $user);

        $this->validate($request, [
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048'
        ]);

        $randomNumber = rand(1, 20000000000);
        $imageName = $randomNumber . '.' . $request->image->extension();

        $request->image->move(public_path('images/users'), $imageName);

        $request->user()->update([
            'profileimage' => $imageName
        ]);

        return back()
            ->with('success', 'You have successfully upload image.')
            ->with('image', $imageName);
    }

    public function deleteuser(Request $request, User $user)
    {
        $this->authorize('deleteUser', $user);
        $user->delete();
        $request->session()->invalidate();

        return redirect()->route('login')->with('deleteduser', 'All your information has been deleted.');
    }

    public function follow(Request $request, User $user)
    {
        $request->user()->following()->create([
            'user_id'  => $request->user()->id,
            'following_id' => $user->id,
        ]);

        return back();
    }

    public function unFollow(Request $request, User $user)
    {
        $request->user()->following()->where('following_id', $user->id)->delete();
        return back();
    }
}
