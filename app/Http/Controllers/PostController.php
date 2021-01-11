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

        $posts = Post::latest()->with(['comments', 'votes', 'user'])->paginate(30);
        return view('posts.index', compact('posts'));
    }

    public function editpost(Post $post)
    {
        $this->authorize('editPost', $post);
        return view('posts.edit')->with('post', $post);
    }

    public function updatePost(Request $request, Post $post)
    {
        $this->authorize('editPost', $post);
        $this->validate($request, [
            'body' => 'required|min:1|max:150',
            'source' => 'required|url'
        ]);

        $post->update($request->all());

        return back();
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

    public function topVotedPosts()
    {
        $posts = Post::withCount(['votes'])->with(['comments', 'user'])->orderByDesc('votes_count')->paginate(30);
        return view('posts.index', [
            'posts' => $posts
        ]);
    }

    public function mostComments()
    {
        $posts = Post::withCount(['comments'])->with(['votes', 'user'])->orderByDesc('comments_count')->paginate(30);

        return view('posts.index', compact('posts'));
    }

    public function singlePost(Request $request, $id)
    {
        $post = Post::findOrFail($id);
        $comments = Comment::latest()->with(['user', 'post.replyComments'])->where([
            ['post_id', '=', $id],
            ['reply_to', '=', null]
        ])->get();

        return view('posts.post', compact('post', 'comments'));
    }
}
