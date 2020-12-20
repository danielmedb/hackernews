@extends('layouts.app')

@section('content')


{{-- <div class="row">
    <h4>Login</h4>
    <form method="post" action="">
        {{ csrf_field() }}

        <table>
            <tr>
                <td><label>Email</label></td>
                <td><input type="email" name="email"></td>
            </tr>
            <tr>
                <td><label>Password</label></td>
                <td><input type="password" name="password"></td>
            </tr>
            <tr>
                <td><input type="submit" name="login" class="btn btn-success" value="login"></td>
            </tr>
        </table>
    </form>
</div> --}}
@if (count($errors) > 0)
@foreach($errors->all() as $error)
{{ $error }}
@endforeach
@endif
<h4>Create account</h4>
<div class="row">
   
    <form method="post" action="{{ route('register') }}">
        @csrf
        <table>
            <tr>
                <td><label>Username</label></td>
                <td><input type="input" name="name"></td>
            </tr>
            <tr>
                <td><label>Email</label></td>
                <td><input type="email" name="email"></td>
            </tr>
            <td><label>Password</label></td>
            <td><input type="password" name="password"></td>
            <tr>
                <td><input type="submit" name="register" class="btn btn-success" value="Register"></td>
            </tr>
        </table>
    </form>

</div>

@endsection