<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Comment;

class CommentController extends Controller
{
    //

    public function __construct()
    {
        $this->middleware(['auth']);
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

    public function destroy(Comment $comment)
    {
        
        
        $this->authorize('deleteComment', $comment);
        $comment->delete();
        return back()->with('success', 'Comment was successfully deleted');
    }

    public function savecomment($id)
    {
        dd($id);
    }
}
