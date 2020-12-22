@extends('layouts.app')

@section('content')


@foreach($posts as $post)

<div class="row" style="background-color: #eaeaea;">
    <div class="rank pr-2">{{ $post->id }}.</div>
    <div class="vote pr-2">
        @if(!$post->likedBy(auth()->user() ))
        <form method="post" action="{{ route('posts.likes', $post) }}">
            @csrf
            <button name="vote" value="up"><img src="{{ asset('images/arrow_up.png') }}" style="width: 10px;" /></button>
        </form>
        @else
        <form method="post" action="{{ route('posts.likes', $post) }}">
            @csrf
            @method('DELETE')
            <button name="vote" value="down"><img src="{{ asset('images/arrow_up.png') }}" style="width: 10px;" /></button>
            
        </form>
        @endif
        @can('delete', $post)
        <form method="post" action="{{ route('posts.destroy', $post) }}">
            @csrf
            @method('DELETE')
            <button type="submit">Delete</button>
        </form>   
        @endcan   
    </div>
    
    <div class="title col-lg-10 pl-0"><a href="/post/{{$post->id}}">{{ $post->body }}</a>
        <span class="text-muted small">( {{ $post->source }})</span>
    </div>
    <div class="under text-muted small pl-4"> {{ $post->votes->count() }} By {{ $post->user->name }} {{ $post->created_at }} | <a href="/post/{{$post->id}}">{{ $post->comments->count() }} comments</a></div>

</div>

@endforeach

@endsection