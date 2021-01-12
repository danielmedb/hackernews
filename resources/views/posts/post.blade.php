@extends('layouts.app')

@section('content')


<meta name="csrf-token" content="{{ csrf_token() }}" />

<span class="upvote mr-2">
    @if(!$post->likedBy(auth()->user() ))
    <form method="post" action="{{ route('posts.likes', $post) }}">
        @csrf
        <button class="btn-vote" name="vote" value="up" style="background-color: #f7fafc"><img src="{{ asset('images/arrow_up.png') }}" style="width: 10px;" /></button>
    </form>
    @else
    <form method="post" action="{{ route('posts.likes', $post) }}">
        @csrf
        @method('DELETE')
        <button class="btn-vote" name="vote" value="down" style="background-color: #f7fafc"><img src="{{ asset('images/arrow_up.png') }}" class="rotateimg180" style="width: 10px;" /></button>
        
    </form>
    @endif    
<span class="">{{ $post->body }}</span>
<small>Created by: {{ $post->user->name}}</small>


<small> | {{ $post->votes->count()  }} {{ Str::plural('vote', $post->votes->count())  }} </small>

<form method="post" action="{{ route('posts.comments.store', $post) }}">
    @csrf
    <div class="form-group row">
        <div class="col-lg-6 col-md-10 col-sm-12">
            <textarea id="comment" name="comment" cols="40" rows="4" class="form-control"></textarea>
        </div>
    </div>
    <div class="form-group row">
        <div class="col-6">
            <button name="submit" type="submit" class="btn btn-dark btn-sm">Add comment</button>
        </div>
    </div>
</form>
@if (session('success'))
<div class="col-lg-6 col-md-10 col-sm-12 resetmessage alert alert-success mt-3">{{ session('success') }}</div>
@endif  


@forelse($comments as $comment)
    <article class="row d-flex justify-content-center mt-2">
        <div class="col-md-12 m-3">
                <div class="d-flex justify-content-between align-items-center">
                    <div class="user d-flex flex-row align-items-center postcomment" data-comment='{{ $comment->id }}'>
                        <span>
                            {{ $comment->comment }}
                        </span>
                    </div>
                </div>
                <div class="action d-flex justify-content-between mt-2 align-items-center">
                    <div class="reply">
                        <small>{{ $comment->user->name }} |</small>
                        <small><a href="{{ route('reply', $comment->id, $comment->id) }}">Reply</a> |</small>
                        <small>{{ $comment->created_at->diffForHumans() }}</small>
                        
                        @if(Auth::user()->id === $comment->user->id)
                            @can('editcomment', $comment)
                                <small>| <a href="{{ route('posts.comments.edit', [$post, $comment]) }}">Edit</a></small>
                            @endcan
                        @endif
                    </div>
                </div>
        </div>
        @if ( $comment->replies )
            @foreach($comment->replies as $reply)
                <div class="col-12 ml-5">
                    <div class="d-flex justify-content-between align-items-center">
                        <div class="user d-flex flex-row align-items-center postcomment" data-comment='{{ $reply->id }}'>
                            <span>
                                {{ $reply->comment }}
                            </span>
                        </div>
                    </div>
                    <div class="action d-flex justify-content-between mt-2 align-items-center">
                        <div class="reply">
                            <small>{{ $reply->user->name }} |</small>
                            <small>{{ $reply->created_at->diffForHumans() }}</small>
                            @if(Auth::user()->id === $reply->user->id)
                                @can('editcomment', $reply)
                                    {{-- <small> | <a href="{{ route('edit.comment', $reply) }}">Edit</a></small> --}}
                                @endcan
                            @endif
                        </div>
                    </div>
                </div>
            @endforeach   
        @endif         
    </article>
@empty
    No comments
@endforelse
@endsection