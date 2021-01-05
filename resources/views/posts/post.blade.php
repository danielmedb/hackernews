@extends('layouts.app')

@section('content')


<meta name="csrf-token" content="{{ csrf_token() }}" />

<span class="upvote mr-2"><img src="{{ asset('images/arrow_up.png') }}" style="width: 10px;" /></span><span class="">{{ $post->body }}</span>
<small>Created by: {{ $post->user->name}}</small>

<form method="post">
    @csrf
    <div class="form-group row">
        <div class="col-6">
            <textarea id="comment" name="comment" cols="40" rows="4" class="form-control"></textarea>
        </div>
    </div>
    <div class="form-group row">
        <div class="col-8">
            <button name="submit" type="submit" class="btn btn-light btn-sm">Add comment</button>
        </div>
    </div>
</form>


@forelse($comments as $comment)

        <div class="row d-flex justify-content-center mt-2">

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
                            <div class="btn-group">
                                @can('editcomment', $comment)
                                    <button class="btn btn-default btn-xs btn-editComment" data-edit="{{ $comment->id }}" type="submit">Edit</button> 
                                @endcan
                                @can('deletecomment', $comment)
                                    <form method="post" action="{{ route('deletecomment', $comment) }}">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-default btn-xs" type="submit">Delete</button>
                                    </form>
                                @endcan
                            </div>
                            @endif
                        </div>
                    </div>
            </div>
        </div>

@empty
    No comments
@endforelse
@endsection