@extends('layouts.app')

@section('content')




<div class="login-page col-12">
    <div class="form">
        <h4>Register new account</h4>
      <form class="login-form" action="{{ route('register') }}" method="post">
        @csrf
        <input type="input" name="name" placeholder="Displayname">
        <input type="email" name="email" placeholder="Email">
        <input type="password" name="password" placeholder="Password">
        <input type="submit" name="register" class="btn btn-success message" value="Register">
        <p class="message">Already have an account? <a href="{{ route('login') }}">Login</a></p>
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
    </div>
</div>

@endsection