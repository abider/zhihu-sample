<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Styles -->
    <link href="/css/app.css" rel="stylesheet">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/css/bootstrap.min.css">
    <style>
        a:hover, .btn-link:hover { text-decoration: none }
    </style>
    @yield('css')

    <!-- Scripts -->
    <script>
        window.Laravel = {!! json_encode([
            'csrfToken' => csrf_token(),
            'apiToken' => auth()->check() ? auth()->user()->api_token : ''
        ]) !!};
    </script>
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-toggleable-md navbar-light bg-faded form-group">
            <div class="container">
            <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <a class="navbar-brand" href="{{ url('/') }}">
                {{ config('app.name', 'Laravel') }}
            </a>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav mr-auto">
                    <li class="nav-item active">
                        <a class="nav-link" href="{{ route('questions.index') }}">全部提问 <span class="sr-only">(current)</span></a>
                    </li>
                </ul>
                @if (auth()->check())
                    <div class="form-inline my-2 my-lg-0">
                        <button class="btn btn-outline-primary my-2 my-sm-0" type="button">
                            {{ auth()->user()->name }}
                        </button>
                        <form action="{{ route('logout') }}" method="POST">
                            {!! csrf_field() !!}
                            <button type="submit" href="{{ route('logout') }}" class="btn btn-link my-2 my-sm-0">
                                退出登陆
                            </button>
                        </form>
                    </div>
                @else
                    <a href="{{ route('login') }}" class="btn btn-link">
                        登陆
                    </a>
                    <a href="{{ route('register') }}" class="btn btn-link">
                        注册
                    </a>
                @endif
            </div>
            </div>
        </nav>

        <div class="container">
            @include('flash::message')
            @yield('content')
        </div>
    </div>

    <!-- Scripts -->
    <script src="{{ asset('/js/app.js') }}"></script>
    <script src="https://code.jquery.com/jquery-3.1.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/tether/1.4.0/js/tether.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/js/bootstrap.min.js"></script>
    @yield('js')

</body>
</html>
