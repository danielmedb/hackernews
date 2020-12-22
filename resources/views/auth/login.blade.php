@extends('layouts.app')

@section('content')
<h4>Login</h4>
<div class="row">
    @if (session('status'))
        {{ session('status') }}
    @endif
   
    <form method="post" action="{{ route('login') }}">
        @csrf
        <table>
            <tr>

                <td><label>Email</label></td>
                <td><input type="email" name="email"></td>
            </tr>
            <td><label>Password</label></td>
            <td><input type="password" name="password"></td>
            <tr>
                <td><input type="submit" name="login" class="btn btn-success" value="Login"></td>
            </tr>
        </table>
    </form>

</div>
<style>



@endsection