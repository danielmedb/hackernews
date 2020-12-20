<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\User;
use App\Models\Comment;

class PostController extends Controller
{

    public function __construct()
    {
        $this->middleware(['auth']);
    }
    //
    public function index(Request $request)
    {

        $posts = post::all();
        // dd($posts);
        $comments = Post::where('post_id', '1')->count();

        return view('posts.index', [
            'posts' => $posts,
            'comments' => $comments
        ]);
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'body' => 'required'
        ]);

        $request->user()->posts()->create([
            'body' => $request->body
        ]);

        return back();
    }

    public function singlePost(Request $request, $id)
    {

        $post = Comment::findOrFail($id)->post;
        $comments = Post::findOrFail($id)->comments;

        return view('posts.post')->with([
            'post' => $post,
            'comments' => $comments
        ]);
    }
}
