@extends('layouts.app')

@section('content')


<meta name="csrf-token" content="{{ csrf_token() }}" />

<span class="upvote mr-2">
    <img src="{{ asset('images/arrow_up.png') }}" style="width: 10px;" />
</span>
<small>{{ $comment->user->name }} {{ $comment->created_at->diffForHumans() }} |</small>
<span class="small">On: {{ $post->body }}</span>
    <div class="row d-flex justify-content-center mt-2">
        <div class="col-md-12 m-3">
            <div class="d-flex justify-content-between align-items-center">
                <div class="user d-flex flex-row align-items-center postcomment" data-comment='{{ $comment->id }}'>
                    <span>
                        {{ $comment->comment }}
                    </span>
                </div>
            </div>
            
        </div>
    </div>

    <form method="post" action="{{ route('reply.store', $comment) }}">
        @csrf
        <div class="form-group row">
            <div class="col-6">
                <textarea id="comment" name="comment" cols="40" rows="4" class="form-control"></textarea>
            </div>
        </div>
        <div class="form-group row">
            <div class="col-8">
                <button name="submit" type="submit" class="btn btn-dark pl-3 pr-3">Reply</button>
                <a href="{{ route('posts.show', $post) }}" class="btn btn-info ml-3">Back to post</a>
            </div>
        </div>
    </form>
@endsection