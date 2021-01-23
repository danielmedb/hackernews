<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\CommentLike;
use Illuminate\Http\Request;

class CommentLikeController extends Controller
{

    public function __construct()
    {
        $this->middleware(['auth']);
    }


    public function store(Request $request, Comment $comment)
    {
        if ($comment->likedBy($request->user())) {
            return response(null, 409);
        }

        $comment->commentLikes()->create([
            'user_id'  => $request->user()->id,
            'vote' => $request->vote,
            'comment_id' => $request->id
        ]);

        return back();
    }

    public function destroy(Request $request, Comment $comment)
    {
        $request->user()->commentLike()->where('comment_id', $comment->id)->delete();
        return back();
    }
}
