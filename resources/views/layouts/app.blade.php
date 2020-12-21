<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hackerman</title>
  
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>
</head>

<body>
    <style>
        a {
            color: #000;
        }
    </style>
    <div class="container">
        <div class="row">
            <nav class="navbar navbar-expand-lg p-0 w-100" style="background-color: #ff6600; color: #000;">
                <ul class="navbar-nav mr-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="">Hacker news</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/posts">New</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/posts">Past</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/posts">Comments</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/posts">Ask</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('posts') }}">Show</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/newposts">Jobs</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('createpost') }}">Submit</a>
                    </li>
                </ul>

                @auth
                
                <a href="{{ route('userprofile') }}" class="pr-2">{{ auth()->user()->name }}</a> | <a href="{{ route('logout') }}" class="pl-2 pr-2"> Logout</a>
                @endauth
                 
                @guest

                <a href="{{ route('login') }}" class="pr-2">Login</a>
                <a href="{{ route('register') }}" class="pr-2">Register</a>
                @endguest

            </nav>
        </div>

        @yield('content')

    </div>


</body>

</html>