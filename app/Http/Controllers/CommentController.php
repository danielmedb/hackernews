<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

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
}
