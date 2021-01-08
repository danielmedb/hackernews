@extends('layouts.app')
@section('content')

<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 mt-5">
    <form action="{{ route('posts.edit', $post) }}" method="post" class="" style="display: inline;">
        @csrf
        <div class="form-group col-12">
            <label for="body">Title</label>
            <textarea class="form-control" cols="20" rows="5" id="body" name="body" placeholder="Title">{{ $post->body }}</textarea>
        </div>
        <div class="form-group col-12">
            <label for="source">Source</label>
            <input type="text" class="form-control" id="source" name="source" placeholder="Source" value="{{ $post->source }}">
        </div>

        <button type="submit" class="btn btn-group-sm btn-info ml-3">Update post</button>
    </form>

    @can('delete', $post)
        <form method="post" class="" style="display: inline;" action="{{ route('posts.destroy', $post) }}">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-group-sm btn-danger float-right mr-3">Delete post</button>
        </form>   
    @endcan   
</div>

@endsection