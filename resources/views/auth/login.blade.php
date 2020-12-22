@extends('layouts.app')

@section('content')

<div class="row">
    @if (session('status'))
        {{ session('status') }}
    @endif

    <div class="login-page">
        <div class="form">
            <h4>Login</h4>
          <form class="login-form" action="{{ route('login') }}" method="post">
            @csrf
            <input type="email" name="email" placeholder="Email">
            <input type="password" name="password" placeholder="Password"/>
            <input type="submit" name="login" class="btn btn-success message" value="Login">
            <p class="message">Not registered? <a href="{{ route('register') }}">Create an account</a></p>
          </form>
        </div>
    </div>
   
</div>
<style>



@endsection