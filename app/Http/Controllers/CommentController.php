<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Comment;
use App\Models\Post;
use App\Models\User;

class CommentController extends Controller
{
    //

    public function __construct()
    {
        $this->middleware(['auth']);
    }

    public function commentUpdate(Request $request, Comment $comment)
    {
        $this->validate($request, [
            'comment' => 'required|min:1'
        ]);

        $comment->update([
            'comment' => $request->comment
        ]);
        return back();
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'comment' => 'required'
        ]);

        $request->user()->comments()->create([
            'comment' => $request->comment,
            'post_id' => $request->id
        ]);

        return back();
    }

    public function edit(Comment $comment)
    {
        return view(
            'posts.editComment',
            [
                'comment' => $comment
            ]
        );
    }

    public function destroy(Comment $comment)
    {
        $this->authorize('deleteComment', $comment);
        $comment->delete();
        return back()->with('success', 'Comment was successfully deleted');
    }

    public function reply(Comment $comment)
    {
        $comment = Comment::find($comment->id);
        $post = Post::find($comment->post_id);

        return view('posts.reply', [
            'comment' => $comment,
            'post' => $post
        ]);
    }


    public function replyStore(Request $request)
    {
        $this->validate($request, [
            'comment' => 'required|min:1'
        ]);

        $request->user()->comments()->create([
            'comment' => $request->comment,
            'post_id' => $request->postId,
            'reply_to' => $request->replyTo
        ]);
        return redirect('/post/' . $request->postId . '');
    }
}
