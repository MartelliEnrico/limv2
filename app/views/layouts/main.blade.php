<!doctype html>
<html lang="en">
<head>
    @include('layouts.partials.head')
</head>
<body>

    <div class="navigation">
        <div class="container">
            <p>
                <a href="/">Lim Manager</a>
                <span class="right">
                    @if(Auth::check())
                    <a href="{{ url('logout') }}">Esci</a> da {{ Auth::user()->full_name }}
                    @else
                    <a href="{{ url('login') }}">Entra</a>
                    @endif
                </span>
            </p>
        </div>
    </div>

    <div class="container main">
        @if(Session::has('flash_message'))
        <div class="message">
            {{ Session::get('flash_message') }}
        </div>
        @endif

        @yield('content')
    </div>

    @include('layouts.partials.footer')

</body>
</html>