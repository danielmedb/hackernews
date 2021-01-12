@extends('layouts.app')
@section('content')

@foreach($posts as $post)
    <div class="row" style="background-color: #eaeaea;">
        <div class="rank pr-1 pl-2">{{ ($posts->currentPage()-1) * $posts->perPage() + $loop->index + 1 }}.</div>
        <div class="vote pr-1">
            @if(!$post->likedBy(auth()->user() ))
            <form method="post" action="{{ route('posts.likes', $post) }}">
                @csrf
                <button class="btn-vote" name="vote" value="up"><img src="{{ asset('images/arrow_up.png') }}" style="width: 10px;" /></button>
            </form>
            @else
            <form method="post" action="{{ route('posts.likes', $post) }}">
                @csrf
                @method('DELETE')
                <button class="btn-vote" name="vote" value="down"><img src="{{ asset('images/arrow_up.png') }}" class="rotateimg180" style="width: 10px;" /></button>
                
            </form>
            @endif
        
        </div>
        
        <div class="title col-10 pl-0"><a href="{{ $post->source }}">{{ $post->body }}</a>
            <span class="text-muted small">( {{ $post->source }})</span>
        </div>
        <div class="col-12 under text-muted small pl-4"> 
            {{ $post->votes->count()  }} 
            {{ Str::plural('vote', $post->votes->count())  }} 
            | By {{ $post->user->name }} {{ $post->created_at->diffForHumans() }} 
            | <a href="{{ route('posts.show', $post) }}">
                {{ $post->comments->count() }} {{ Str::plural('comment', $post->comments->count()) }}
            </a>
            @can('editPost', $post)
                | <a href="{{ route('posts.edit', $post) }}">Edit</a>
            @endcan
        </div>
       
    </div>
@endforeach

{{ $posts->links() }}

@endsection