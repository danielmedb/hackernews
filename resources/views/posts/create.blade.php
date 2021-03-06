@extends('layouts.app')

@section('content')

    <form action="{{ route('posts.store') }}" method="post" class="mt-5">
        @csrf
        <div class="form-group col-lg-6 col-md-10 col-sm-12">
            <label for="body">Body</label>
            <textarea class="form-control" cols="20" rows="5" id="body" name="body" placeholder="Body"></textarea>
        </div>
        <div class="form-group col-lg-6 col-md-10 col-sm-12">
            <label for="source">Source</label>
            <input type="text" class="form-control" id="source" name="source" placeholder="Source">
        </div>

        <button type="submit" class="btn btn-group-sm btn-dark ml-3 pl-5 pr-5">Post</button>
    </form>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

@endsection