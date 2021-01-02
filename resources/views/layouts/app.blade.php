<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hackernews</title>
    <link rel="stylesheet" href="{{ URL::asset('css/style.css') }}">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js" integrity="sha384-LtrjvnR4Twt/qOuYxE721u19sVFLVSA4hf/rRt6PrZTmiPltdZcI7q7PXQBYTKyf" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>
</head>

<body>
    <style>
        a {
            color: #000;
        }
    </style>
    <div class="container-fluid">
        <div class="row mobile-row justify-content-md-center">
            <div class="col-lg-10 col-md-12 col-sm-12 col-xl-10 p-0">
                <nav class="navbar navbar-expand-lg p-0" style="background-color: #ff6600; color: #000;">
                    <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#navbarCollapse">
                        <div class="line line-1"></div>
                        <div class="line line-2"></div>
                        <div class="line line-3"></div>
                    </button>
                    <div class="collapse navbar-collapse pl-2" id="navbarCollapse">
                        <ul class="navbar-nav mr-auto">
                            <li class="nav-item">
                                <a class="nav-link" href="">Hacker news</a> 
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="/posts">New</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('topVotes') }}">Top</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('topComments') }}">Comments</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('posts') }}">Show</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('createpost') }}">Submit</a>
                            </li>
                        </ul>
                        <div class="mobile-nav-user">
                            @auth
                                <a href="{{ route('userprofile') }}" class="pr-2">{{ auth()->user()->name }}</a> | <a href="{{ route('logout') }}" class="pl-2 pr-2"> Logout</a>
                            @endauth
                            @guest
                                <a href="{{ route('login') }}" class="pr-2">Login</a>
                                <a href="{{ route('register') }}" class="pr-2">Register</a>
                            @endguest
                        </div>
                    </div>
                </nav>
            </div>
        </div>
        <div class="row justify-content-md-center">
            <div class="col-lg-10 col-md-12 col-sm-12 col-xl-10 pr-3 pl-3">
                @yield('content')
            </div>
        </div>
    </div>

    <script src="{{ URL::asset('js/scripts.js') }}"></script>
</body>

</html>