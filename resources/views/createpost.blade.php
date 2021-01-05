@extends('layouts.app')

@section('content')

    <form action="{{ route('createpost') }}" method="post" class="mt-5">
        @csrf
        <div class="form-group col-4">
            <label for="body">Title</label>
            <textarea class="form-control" cols="20" rows="5" id="body" name="body" placeholder="Title"></textarea>
        </div>
        <div class="form-group col-4">
            <label for="source">Source</label>
            <input type="text" class="form-control" id="source" name="source" placeholder="Source">
        </div>

        <button type="submit" class="btn btn-group-sm btn-dark">Post</button>
    </form>

@endsection