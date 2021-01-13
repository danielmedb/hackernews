@extends('layouts.app')

@section('content')

<style>
    .changeProfilePicture{
        height: inherit;
        display: inline;
        position: absolute;
        bottom: 0;
        left: calc(50% - 20px);
    }
</style>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-12 col-lg-12 col-md-12 col-xl-12 mx-auto">
                <div class="my-4">
                    <ul class="nav nav-tabs mb-4" id="userprofile" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="home" aria-selected="false">Profile</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="posts-tab" data-toggle="tab" href="#posts" role="tab" aria-controls="posts" aria-selected="false">Posts</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="comments-tab" data-toggle="tab" href="#comments" role="tab" aria-controls="comments" aria-selected="false">Comments</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="votes-tab" data-toggle="tab" href="#votes" role="tab" aria-controls="votes" aria-selected="false">Votes</a>
                        </li>
                    </ul>
                    <div class="tab-content">
                        <div class="tab-pane fade show active" id="profile" role="tab" aria-labelledby="profile-tab">
                            
                            <div class="row mt-5">
                                <div class="col-md-6 text-center mb-5">
                                    <div class="avatar avatar-xl">
                                        <img src="{{ $user->profileimage ? asset('images/users/'.$user->profileimage.'') : asset('images/users/nopic.png') }}" alt="..." class="avatar-img rounded-circle" />
                                    </div>
                                    <div class="changeProfilePicture">
                                        <i class="fas fa-3x fa-images" data-toggle="modal" data-target="#exampleModal"></i>
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="row">
                                        <div class="col-md-7">
                                            <h4 class="mb-1">{{ $user->name }}</h4>
                                        </div>
                                    </div>
                                    <div class="row mt-4">
                                        <div class="col-md-12">
                                            <p class="text-muted">
                                                {{ $user->biography }}
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @if(session('credentials'))
                                <div class="alert alert-success"> {{ session('credentials') }}</div>
                            @endif
                            <hr class="my-4" />
                            <form method="post" action="{{ route('userprofile.store', $user) }}">
                                @csrf
                                <div class="form-row">
                                    <div class="form-group col-md-6">
                                        <label for="name">Displayname</label>
                                        <input type="text" id="name" name="name" class="form-control" value="{{ $user->name }}" required="required" />
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="email">Email</label>
                                        <input type="email" id="email" name="email" class="form-control" value="{{ $user->email }}" required="required" />
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="biography">Biography</label>
                                    <textarea id="biography" name="biography" cols="40" rows="4" class="form-control" >{{ $user->biography }}</textarea>  
                                </div>
                                <hr class="my-4" />
                                <div class="row mb-4">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="password">New Password</label>
                                            <input type="password" class="form-control" id="password" name="password" />
                                        </div>
                                        <div class="form-group">
                                            <label for="confirmpassword">Confirm Password</label>
                                            <input type="password" class="form-control" id="confirmpassword" name="confirm_password" />
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <p class="mb-2">Password requirements</p>
                                        <p class="small text-muted mb-2">To create a new password, you have to meet all of the following requirements:</p>
                                        <ul class="small text-muted pl-4 mb-0">
                                            <li>Minimum 6 character</li>
                                            <li>Can’t be the same as a previous password</li>
                                        </ul>
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
                                </div>
                                <button type="submit" class="btn btn-primary">Save Change</button>
                            </form>
                        </div>
                        <div class="tab-pane fade" id="posts" role="tab" aria-labelledby="posts-tab">
                            <table class="table table-hover">
                                <thead style="white-space: nowrap;">
                                    <th>#</th>
                                    <th>Title</th>
                                    <th>Creator</th>
                                    <th>Source</th>
                                    <th>Created date</th>
                                </thead>
                                @foreach($info->posts AS $post)
                                    <tr>
                                        <td>
                                            <a href="{{ route('posts.edit', $post) }}"> 
                                                <i class="far fa-edit"></i>
                                            </a>
                                        </td>
                                        <td>{{ $post->body }}</td>
                                        <td>{{ $post->user->name }}</td>
                                        <td>{{ $post->source }}</td>
                                        <td>{{ $post->created_at->format('Y-m-d') }}</td>
                                    </tr>
                                @endforeach
                            </table>
                        </div>
                        <div class="tab-pane fade" id="comments" role="tab" aria-labelledby="comments-tab">
                            <table class="table table-hover">
                                <thead style="white-space: nowrap;">
                                    <th>#</th>
                                    <th>Creator</th>
                                    <th>Comment</th>
                                    <th>Post</th>
                                    <th>Created date</th>
                                </thead>
                                @foreach($info->comments AS $comment)
                                    <tr>
                                        <td>
                                            <a href="{{ route('posts.edit', $comment) }}"> 
                                                <i class="far fa-edit"></i>
                                            </a>
                                        </td>
                                        <td>{{ $post->user->name }}</td>
                                        <td>{{ $comment->comment }}</td>
                                        <td>{{ $comment->post->body }}</td>
                                        <td>{{ $comment->created_at->format('Y-m-d') }}</td>
                                    </tr>
                                @endforeach
                            </table>
                        </div>
                        <div class="tab-pane fade" id="votes" role="tab" aria-labelledby="votes-tab">
                            <table class="table table-hover">
                                <thead style="white-space: nowrap;">
                                    <th>#</th>
                                    <th>Creator</th>
                                    <th>Post</th>
                                    <th>Created date</th>
                                </thead>
                                @foreach($info->vote AS $vote)
                                    <tr>
                                        <td>
                                            <a href="{{ route('posts.show', $vote->post->id) }}"> 
                                                <i class="far fa-edit"></i>
                                            </a>
                                        </td>
                                        <td>{{ $vote->user->name }}</td>
                                        <td>{{ $vote->post->body }}</td>
                                        <td>{{ $vote->created_at->format('Y-m-d') }}</td>
                                    </tr>
                                @endforeach
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Change profile image</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form role="form" enctype="multipart/form-data" action="{{ route('userprofile.image.upload', $user) }}" method="POST">
                <div class="modal-body">
                    @csrf
                    <input type="file" name="image">
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Upload</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection

