@extends('layouts.app')
@section('content')

<form action="" method="post" class="mt-5">
    @csrf
    <div class="form-group col-4">
        <label for="body">Title</label>
        <textarea class="form-control" cols="20" rows="5" id="body" name="body" placeholder="Title">{{ $post->body }}</textarea>
    </div>
    <div class="form-group col-4">
        <label for="source">Source</label>
        <input type="text" class="form-control" id="source" name="source" placeholder="Source" value="{{ $post->source }}">
    </div>

    <button type="submit" class="btn btn-group-sm btn-dark ml-3">Update post</button>
</form>

@can('delete', $post)
    <form method="post" action="{{ route('posts.destroy', $post) }}">
        @csrf
        @method('DELETE')
        <button type="submit">Delete</button>
    </form>   
@endcan   


@endsection