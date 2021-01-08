@extends('layouts.app')

@section('content')

<div class="row">
    <div class="login-page">
        <div class="form">
            <h4>Reset your password</h4>
          <form class="login-form" action="{{ route('reset.store', $token) }}" method="post">
            @csrf
            <input type="password" name="password" class="mt-4" placeholder="Password" required />
            <input type="submit" name="reset" class="btn btn-success" value="Reset password">
          </form>
          @if (session('success'))
            <div class="resetmessage alert alert-success mt-3">{{ session('success') }}</div>
          @endif
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
</div>

@endsection