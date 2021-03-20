<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Laravel</title>
        <!-- CSS only -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
        @stack('css')
    </head>
    <body class="antialiased">
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <div class="hidden fixed top-0 right-0 px-6 py-4 sm:block">
                        @auth
                            <a href="{{ url('/welcome') }}" class="text-sm text-gray-700 underline">Home</a>
                            <a href="{{ route('license') }}" class="text-sm text-gray-700 underline">License</a>
                            <a href="{{ route('check.license') }}" class="text-sm text-gray-700 underline">Check License</a>
                            <a href="{{ route('logout') }}" class="text-sm text-gray-700 underline">Logout</a>
                        @else
                        <a href="{{ route('login') }}" class="text-sm text-gray-700 underline">Log in</a>
    
                        @if (Route::has('register'))
                            <a href="{{ route('register') }}" class="ml-4 text-sm text-gray-700 underline">Register</a>
                        @endif
                        @endauth
                    </div>
                    <div class="col-md-6">
                        <div class="main-content">
                            @yield('content')
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @stack('script')
    </body>
</html>
