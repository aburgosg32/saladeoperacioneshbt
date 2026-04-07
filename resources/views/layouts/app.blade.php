<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Hospital Belén de Trujillo') }}</title>

    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">

    @vite(['resources/sass/app.scss', 'resources/js/app.js'])

    <style>
        body {
            background: #061218;
            color: #eaf3f8;
        }

        .or-navbar {
            background: linear-gradient(90deg, #061218, #0a1d28);
            border-bottom: 1px solid rgba(255, 255, 255, .08);
        }

        .or-navbar .navbar-brand {
            color: #2bd4c5;
            font-weight: 700;
        }

        .or-navbar .navbar-brand:hover {
            color: #39d98a;
        }

        .or-navbar .nav-link {
            color: rgba(234, 243, 248, .8);
            font-size: 14px;
        }

        .or-navbar .nav-link:hover {
            color: #2bd4c5;
        }

        .or-navbar .dropdown-menu {
            background: #0a1d28;
            border: 1px solid rgba(255, 255, 255, .08);
        }

        .or-navbar .dropdown-item {
            color: #eaf3f8;
        }

        .or-navbar .dropdown-item:hover {
            background: #102c3a;
            color: #2bd4c5;
        }
    </style>

</head>

<body>

    <div id="app">

        {{-- OCULTAR NAVBAR EN LOGIN Y REGISTER --}}
        @if (!request()->routeIs('login') && !request()->routeIs('register'))

        <nav class="navbar navbar-expand-md or-navbar shadow-sm">

            <div class="container">

                <a href="{{ url('/home') }}" class="navbar-brand d-flex align-items-center">
                    <img src="{{ asset('img/logo.png') }}"
                        alt="Logo"
                        style="height:35px; margin-right:10px;">

                    <span style="font-weight:800; color:#2bd4c5;">
                        HOSPITAL BELÉN DE TRUJILLO
                    </span>
                </a>

                <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarSupportedContent">

                    <span class="navbar-toggler-icon"></span>

                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">

                    <ul class="navbar-nav me-auto">

                        <li class="nav-item">
                            <a class="nav-link" href="/home">Dashboard</a>
                        </li>

                    </ul>

                    <ul class="navbar-nav ms-auto">

                        @guest

                        @if (Route::has('login'))
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('login') }}">Login</a>
                        </li>
                        @endif

                        @if (Route::has('register'))
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('register') }}">Register</a>
                        </li>
                        @endif

                        @else

                        <li class="nav-item dropdown">

                            <a id="navbarDropdown"
                                class="nav-link dropdown-toggle"
                                href="#"
                                role="button"
                                data-bs-toggle="dropdown"
                                v-pre>

                                {{ Auth::user()->name }}

                            </a>

                            <div class="dropdown-menu dropdown-menu-end">

                                <a class="dropdown-item"
                                    href="{{ route('logout') }}"
                                    onclick="event.preventDefault();
document.getElementById('logout-form').submit();">

                                    Logout

                                </a>

                                <form id="logout-form"
                                    action="{{ route('logout') }}"
                                    method="POST"
                                    class="d-none">

                                    @csrf

                                </form>

                            </div>

                        </li>

                        @endguest

                    </ul>

                </div>

            </div>

        </nav>

        @endif

        <main class="py-4">
            @yield('content')
        </main>

    </div>

</body>

</html>