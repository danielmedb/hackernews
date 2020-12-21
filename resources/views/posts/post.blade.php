@extends('layouts.app')

@section('content')



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

@if(isset($comments[0]))
    @foreach($comments as $comment)
        <div class="row d-flex justify-content-center mt-2">

            <div class="col-md-12">
                <div class="card p-3">
                    <div class="d-flex justify-content-between align-items-center">
                        <div class="user d-flex flex-row align-items-center">
                            <span>
                                <small>{{ $comment->comment }}</small>
                            </span>
                        </div>

                    </div>
                    <div class="action d-flex justify-content-between mt-2 align-items-center">
                        <div class="reply">
                            <small>{{ $comment->user->name }} |</small>
                            <small>Reply |</small>
                            <small>{{ $comment->created_at->diffForHumans() }}</small>
                            
                            @if(Auth::user()->id === $comment->user->id)
                            <div class="btn-group">
                                <form action="{{ route('editcomment', ['id' => $comment->id]) }}" method="post">
                                    @csrf

                                    <button class="btn btn-default btn-xs" type="submit">Edit</button>
                                </form>
                                
                                <form action="{{ route('deletecomment', ['id' => $comment->id]) }}" method="post">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-default btn-xs" type="submit">Delete</button>
                                </form>
                            </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
@else
    No comments
@endif
@endsection