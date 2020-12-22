<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\User;
use App\Models\Comment;
use App\Models\vote;



class PostController extends Controller
{

    public function __construct()
    {
        $this->middleware(['auth']);
    }
    //
    public function index(Request $request)
    {

        // $posts = Post::with(['comments', 'votes', 'user.vote'])->get();
        $posts = Post::latest()->with(['comments', 'votes', 'user'])->get();
        return view('posts.index', [
            'posts' => $posts
        ]);
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'body' => 'required'
        ]);

        $request->user()->posts()->create($request->only('body'));

        return back();
    }

    public function destroy(Post $post)
    {
        $this->authorize('delete', $post);
       
        $post->delete();
        return back();
    }

    public function singlePost(Request $request, $id)
    {

        $post = Post::findOrFail($id);
        $comments = Comment::latest()->with(['post', 'user', 'post.comments'])->where('post_id', $id)->get();

        return view('posts.post')->with([
            'post' => $post,
            'comments' => $comments,

        ]);
    }
}
