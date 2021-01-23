<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\User;
use App\Models\Comment;
use App\Models\Following;
use App\Models\vote;
use Illuminate\Support\Facades\Auth;

class PageController extends Controller
{

    /* Sort posts after most vostes */
    public function mostVotes()
    {
        $posts = Post::withCount(['votes'])->with(['comments', 'user'])->orderByDesc('votes_count')->paginate(30);
        return view('posts.index', compact('posts'));
    }

    /* Sort posts after most comments */
    public function mostComments()
    {
        $posts = Post::withCount(['comments'])->with(['votes', 'user'])->orderByDesc('comments_count')->paginate(30);

        return view('posts.index', compact('posts'));
    }

    /* Sort posts after the ones who the user follows */
    public function following()
    {
        $following = Auth::user()->following;
        $posts = $following->map(function ($item) {
            return User::find($item["following_id"])->posts;
        })->flatten();

        return view('posts.index', compact('posts'));
    }


    /* Show specific post */
    public function post($id)
    {
        $post = Post::findOrFail($id);
        $comments = Comment::latest()->with(['user', 'post.replyComments'])->where([
            ['post_id', '=', $id],
            ['reply_to', '=', null]
        ])->get();

        return view('posts.post', compact('post', 'comments'));
    }
}
