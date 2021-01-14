<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Comment;
use App\Models\Post;
use App\Models\User;

class CommentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Post $post)
    {
        $this->validate($request, [
            'comment' => 'required'
        ]);

        $request->user()->comments()->create([
            'comment' => $request->comment,
            'post_id' => $post->id
        ]);

        return back();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post, comment $comment)
    {
        return view('posts.comments.edit', compact('post', 'comment'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Post $post, comment $comment)
    {
        $this->validate($request, [
            'comment' => 'required|min:1'
        ]);

        $comment->update([
            'comment' => $request->comment
        ]);
        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post, Comment $comment)
    {
        $this->authorize('deleteComment', $comment);

        /* Delete all comments only if its the original post. Not an reply. */
        if ($comment->reply_to == null) {
            Comment::where('id', $comment->id)->delete();
        }

        $comment->delete($comment->id);

        return redirect()->route('posts.show', $post)->with('success', 'Comment was successfully deleted');
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


    public function replyStore(Request $request, Comment $comment)
    {
        $this->validate($request, [
            'comment' => 'required|min:1'
        ]);

        $request->user()->comments()->create(
            [
                'comment' => $request->comment,
                'post_id' => $comment->post_id,
                'reply_to' => $comment->id
            ]
        );
        return redirect()->route('posts.show', $comment->post_id);
    }
}
