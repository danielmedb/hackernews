@extends('layouts.app')
@section('content')

<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 mt-5">
    <form action="{{ route('posts.comments.update', [$post, $comment]) }}" method="post" class="" style="display: inline;">
        @csrf
        @method('PUT')
        <div class="form-group col-12">
            <label for="body">Comment</label>
            <textarea class="form-control" cols="20" rows="5" id="comment" name="comment" placeholder="Comment">{{ $comment->comment }}</textarea>
        </div>
        <button type="submit" class="btn btn-group-sm btn-info ml-3">Update comment</button>
    </form>
    @can('deleteComment', $comment)
    <form method="post" class="" style="display: inline;" action="{{ route('posts.comments.destroy', [$post, $comment]) }}">
        @csrf
        @method('DELETE')
        <button type="submit" class="btn btn-group-sm btn-danger float-right mr-3">Delete comment</button>
    </form>   
@endcan   
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
</div>

@endsection