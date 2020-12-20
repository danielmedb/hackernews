<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CreatePostController extends Controller
{

    public function __construct()
    {
        $this->middleware(['auth']);
    }

    public function index()
    {
        return view('createpost');
    }

    public function store(Request $request)
    {

        $this->validate($request, [
            'body' => 'required|max:200',
            'source' => 'required'
        ]);

        $request->user()->posts()->create([
            'body' => $request->body,
            'source' => $request->source
        ]);

        return redirect('posts');
    }
}
