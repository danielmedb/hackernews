@extends('layouts.app')

@section('content')
<div class="row mt-5">
    <div class="col-md-3 text-center">
        <img src="{{ $user->profileimage ? asset('images/'.$user->profileimage.'') : asset('images/nopic.png') }}" class="rounded-circle mb-3 img-thumbnail" style="max-height: 250px;"  />
        {{-- <div class="list-group">
            <a href="#" class="list-group-item list-group-item-action active">User Management</a>
            <a href="{{ route('userspost') }}" class="list-group-item list-group-item-action">Posts</a>
            <a href="#" class="list-group-item list-group-item-action">Comments</a>
        </div> --}}
    </div>


    <div class="col-md-9 pr-0">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-12">
                        <h4>Your Profile</h4>
                        <hr>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif        
                    @if (session('credentials'))
                        <div class="alert alert-success">
                            {{ session('credentials') }}
                        </div>
                    @endif                
                        <form method="post" action="{{ route('userprofile.store', $user) }}">
                            @csrf
                            <div class="form-group row">
                                <label for="username" class="col-4 col-form-label">Username</label>
                                <div class="col-8">
                                    <input id="name" name="name" value="{{ $user->name }}" placeholder="Username" class="form-control here" required="required" type="text">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="email" class="col-4 col-form-label">Email</label>
                                <div class="col-8">
                                    <input id="email" name="email" placeholder="Email" value="{{ $user->email }}" class="form-control here" required="required" type="text">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="biography" class="col-4 col-form-label">Biography</label>
                                <div class="col-8">
                                    <textarea id="biography" name="biography" cols="40" rows="4" class="form-control" >{{ $user->biography }}</textarea>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="offset-4 col-8">
                                    <button name="submit" type="submit" class="btn btn-primary">Update my profile</button>
                                </div>
                            </div>
                        </form>
                        <form action="{{ route('userprofile.image.upload', $user) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            
                            <div class="form-group row mt-5">
                                <label for="image" class="col-4 col-form-label">Update profile picture</label>
                                <div class="col-8">
                                    <input type="file" name="image" class="form-control p-0" style="border: 0px;">
                                </div>
                     
                                <div class="offset-4 col-8 mt-1">
                                    <button type="submit" class="btn btn-success">Upload</button>
                                </div>
                     
                            </div>
                        </form>
                    </div>
                </div>

            </div>
        </div>
        <div class="card mt-5">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-12">
                        <h4>Change password</h4>
                        <hr>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        @if (session('status'))
                            <div class="alert alert-success">
                                {{ session('status') }}
                            </div>
                        @endif
                        <form method="post" action="{{ route('userprofile.password', $user) }}">
                            @csrf
                            <div class="form-group row">
                                <label for="password" class="col-4 col-form-label">New Password</label>
                                <div class="col-8">
                                    <input id="password" name="password" placeholder="New Password" class="form-control here" type="text">
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="offset-4 col-8">
                                    <button name="submit" type="submit" class="btn btn-primary">Change password</button>
                                </div>
                            </div>
                          
                        </form>
                    </div>
                </div>
            </div>
        </div>        
        <div class="card mt-5">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-12">
                        <h4>Delete my account</h4>
                        <hr>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        @if (session('status'))
                            <div class="alert alert-success">
                                {{ session('status') }}
                            </div>
                        @endif
                        @can('deleteUser', $user)
                        <form method="post" action="{{ route('userprofile.user.delete', $user) }}">
                            @csrf
                            <div class="form-group row">
                                    <button name="submit" type="submit" class="btn btn-danger ml-3">Delete my account, This action cannot be undon!</button>
                                </div>
                            </div>
                        </form>
                        @endcan
                    </div>
                </div>

            </div>
        </div>                
    </div>
</div>
@endsection

