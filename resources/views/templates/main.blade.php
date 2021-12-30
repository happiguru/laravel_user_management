<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        
        <meta name="csrf-token" content="{{  csrf_token() }}" >
        <title>{{ config('app.name', 'User Management System')}}</title>


        <!-- Styles -->
       <link href="{{ asset('css/app.css') }}" rel="stylesheet">
       
       <!-- JS -->

       <script src="{{ asset('js/app.js') }}" defer></script>
    </head>
    <body>
        <nav class="navbar navbar-expand-lg">
            <div class="container">
                <a class="navbar-brand" href="/">{{ config('app.name', 'User Management System')}}</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
                </button>
                
                <div class="form-inline my-2 my-lg-0">
                    @if (Route::has('login'))
                        <div>
                            @auth
                                <a href="{{ url('/home') }}">Home</a>
                                <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Logout</a>
                                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                    @csrf
                                </form>
                            @else
                                <a href="{{ route('login') }}">Log in</a>

                                @if (Route::has('register'))
                                    <a href="{{ route('register') }}">Register</a>
                                @endif
                            @endauth
                        </div>
                    @endif
                </div>
            </div>
        </nav>
        @can('logged-in')
        <nav class="navbar sub-nav navbar-expand-lg">
            <div class="container">
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                        <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="/">Home</a>
                        </li>
                        @can('is-admin')
                        <li class="nav-item">
                        <a class="nav-link" href="{{ route('admin.users.index') }}">User</a>
                        </li>
                        @endcan
                    </ul>
                </div>
            </div>
        </nav>
        @endcan
        <main class="container">
            @include('partials.alerts')
            @yield('content')
        </main>
    </body>
</html>
