@extends('layouts.app')

@section('content')
  <div class="row">
    <div class="login-page">
        <div class="form">
            <h4>Login</h4>
          <form class="login-form" action="{{ route('login') }}" method="post">
            @csrf
            <input id="email" class="@error('email') is-invalid @enderror" required type="email" name="email" autocomplete="email" value="{{ old('email') }}" placeholder="Email" autofocus>
            <input type="password" name="password" placeholder="Password" required />
            <input type="submit" name="login" class="btn btn-success message" value="Login">
            <p class="message">Not registered? <a href="{{ route('register') }}">Create an account</a></p>
            <p class="message">Forgot your password? <a href="{{ route('resetpassword') }}">Reset password</a></p>
          </form>
          @if (session('status'))
            <div class="alert alert-danger mt-3">{{ session('status') }}</div>
          @endif
          @if (session('deleteduser'))
            <div class="alert alert-info mt-3">{{ session('deleteduser') }}</div>
          @endif
        </div>
    </div>
  </div>
  <style>
@endsection