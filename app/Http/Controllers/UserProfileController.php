<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class UserProfileController extends Controller
{

    public function __construct()
    {
        $this->middleware(['auth']);
    }

    public function index()
    {
        $user = User::find(auth()->id());
        return view('userprofile')->with('user', $user);
    }

    public function usersposts(Request $request)
    {
        $posts = $request->user()->posts()->get();
        return view('userposts')->with('posts', $posts);
    }
}
