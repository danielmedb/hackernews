@extends('layouts.app')

@section('content')
<div class="row mt-5">
    <div class="col-md-3 pl-0">
        <img src="{{ asset('images/db.jpg') }}" data-vote="" class="rounded-circle mb-3 img-thumbnail" />
        <div class="list-group ">
            <a href="#" class="list-group-item list-group-item-action">User Management</a>
            <a href="{{ route('userspost') }}" class="list-group-item list-group-item-action active">Posts</a>
            <a href="#" class="list-group-item list-group-item-action">Comments</a>
        </div>
    </div>
    <div class="col-md-9 pr-0">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-12">
                        <h4>Your Posts</h4>
                        <hr>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                       @foreach($posts as $post)
                        {{ $post->body }}<br><br>
                       @endforeach
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>
@endsection


