@extends('layouts.app')

@section('content')
<div class="row mt-5">
    <div class="col-md-3 pl-0">
        <img src="{{ asset('images/db.jpg') }}" data-vote="" class="rounded-circle mb-3 img-thumbnail" />
        <div class="list-group ">
            <a href="#" class="list-group-item list-group-item-action active">User Management</a>
            <a href="{{ route('userspost') }}" class="list-group-item list-group-item-action">Posts</a>
            <a href="#" class="list-group-item list-group-item-action">Comments</a>
        </div>
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
                        <form>
                            <div class="form-group row">
                                <label for="username" class="col-4 col-form-label">Username</label>
                                <div class="col-8">
                                    <input id="username" name="username" value="{{ $user->name }}" placeholder="Username" class="form-control here" required="required" type="text">
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
                                    <textarea id="biography" name="biography" cols="40" rows="4" class="form-control"></textarea>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="newpass" class="col-4 col-form-label">New Password</label>
                                <div class="col-8">
                                    <input id="newpass" name="newpass" placeholder="New Password" class="form-control here" type="text">
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="offset-4 col-8">
                                    <button name="submit" type="submit" class="btn btn-primary">Update my profile</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>
@endsection

