@extends('layouts.app')

@section('content')

<form action="{{ route('createpost') }}" method="post" class="mt-5">
    @csrf
    <div class="form-group">
        <label for="body">Title</label>
        <input type="text" class="form-control" id="body" name="body" placeholder="Title">
    </div>
    <div class="form-group">
        <label for="source">Source</label>
        <input type="text" class="form-control" id="source" name="source" placeholder="Source">
    </div>

    <button type="submit" class="btn btn-group-sm btn-dark">Post</button>
</form>

@endsection