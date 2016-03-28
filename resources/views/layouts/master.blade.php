<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Bookmarks</title>
    <link href="{{ asset('assets/vendor/bootstrap/dist/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/vendor/bootswatch/paper/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/vendor/startbootstrap-simple-sidebar/css/simple-sidebar.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/vendor/tag-it/css/jquery.tagit.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/vendor/fontawesome/css/font-awesome.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/vendor/animate-css/animate.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/app/style.css') }}" rel="stylesheet">
    <script src="{{ asset('assets/vendor/jquery/dist/jquery.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/jquery-ui/jquery-ui.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/bootstrap/dist/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/tag-it/js/tag-it.min.js') }}"></script>
    <script src="{{ asset('assets/app/script.js') }}"></script>
</head>
<body {{ Request::is('dashboard') ? 'class="dashboard"' : ""}} >
    <nav class="navbar navbar-default navbar-fixed-top">
        <div class="container-fluid">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-navbar-collapse">
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="{{ route('homepage') }}"><i class="fa fa-bookmark"></i>Bookmarks</a>
            </div>
            <div class="collapse navbar-collapse" id="app-navbar-collapse">
                @if (Auth::guest())
                <ul class="nav navbar-nav navbar-right">
                    <li><a href="{{ url('/login') }}">Login</a></li>
                    <li><a href="{{ url('/register') }}">Register</a></li>
                </ul>
                @else
                <ul class="nav navbar-nav">
                    <li><a href="{{ route('dashboard') }}">Dashboard</a></li>
                </ul>
                <ul class="nav navbar-nav navbar-right account">
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                            <i class="fa fa-user"></i><span class="caret"></span>
                        </a>
                        <ul class="dropdown-menu" role="menu">
                            <li><a href="{{ url('/logout') }}"><i class="fa fa-sign-out"></i>Logout</a></li>
                        </ul>
                    </li>
                </ul>
                @endif
            </div>
        </div>
    </nav>
    @yield('content')
</body>
</html>
