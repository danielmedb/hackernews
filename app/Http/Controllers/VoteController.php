<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class VoteController extends Controller
{

    public function __construct()
    {
        $this->middleware(['auth']);
    }
    public function store(Request $request, Post $post)
    {

        if ($post->likedBy($request->user())) {
            return response(null, 409);
        }

        $post->votes()->create([
            'user_id'  => $request->user()->id,
            'vote' => $request->vote,
            'post_id' => $request->id
        ]);

        return back();
    }
    public function destroy(Request $request, Post $post)
    {
        $request->user()->vote()->where('post_id', $post->id)->delete();
        return back();
    }
}
