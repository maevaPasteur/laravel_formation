    <!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
    <!-- Extra-js -->
    @yield('extra-js')

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body class="@yield('body-class')">
    <div id="app">

        <header>
            <nav>
                <ul>
                    <li>
                        <a href="{{ url('/') }}">Accueil</a>
                    </li>
                    @guest
                        <li>
                            <a class="btn yellow" href="{{ route('login') }}">{{ __('Login') }}</a>
                        </li>
                        @if (Route::has('register'))
                            <li>
                                <a class="btn dark" href="{{ route('register') }}">{{ __('Register') }}</a>
                            </li>
                        @endif
                    @else
                        @can('is-teacher')
                            <li>
                                <a class="btn" href="{{ route('formations.create') }}">Créer une formation</a>
                            </li>
                        @endcan
                        @can('is-admin')
                            <li>
                                <a class="btn" href="{{ route('classrooms.index') }}">Classrooms</a>
                            </li>
                            <li>
                                <a class="btn" href="{{ route('users.index') }}">Users</a>
                            </li>
                            <li>
                                <a class="btn darkBlue" href="{{ route('categories.index') }}">Categories</a>
                            </li>
                        @endcan
                        <li>
                            <a class="btn yellow" href="{{ route('profile.index') }}">Profil</a>
                        </li>
                        <li>
                            <a class="btn red" href="{{ route('logout') }}"
                               onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                {{ __('Logout') }}
                            </a>
                            <form action="{{ route('logout') }}" id="logout-form" method="POST" style="display: none;">
                                @csrf
                            </form>
                        </li>
                    @endguest
                </ul>
            </nav>
        </header>

        <main>
            @yield('content')
        </main>
    </div>
</body>
</html>
