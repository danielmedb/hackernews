@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-12 col-lg-10 col-xl-8 mx-auto">
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
                                        <img src="{{ $user->profileimage ? asset('images/'.$user->profileimage.'') : asset('images/nopic.png') }}" alt="..." class="avatar-img rounded-circle" />
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
                                        <label for="oldpassword">Old Password</label>
                                        <input type="password" class="form-control" id="oldpassword" />
                                    </div>
                                    <div class="form-group">
                                        <label for="password">New Password</label>
                                        <input type="password" class="form-control" id="password" />
                                    </div>
                                    <div class="form-group">
                                        <label for="confirmpassword">Confirm Password</label>
                                        <input type="password" class="form-control" id="confirmpassword" />
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
                        </div>
                        <div class="tab-pane fade" id="posts" role="tab" aria-labelledby="posts-tab"></div>
                        <div class="tab-pane fade" id="comments" role="tab" aria-labelledby="comments-tab"></div>
                        <div class="tab-pane fade" id="votes" role="tab" aria-labelledby="votes-tab"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    

    {{-- <div class="col-md-9 pr-0">
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
</div> --}}
@endsection

