<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'SOP HBT') }}</title>

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

        .or-brand-header {
            display: flex;
            align-items: center;
            gap: 12px;
            text-decoration: none;
            min-width: 0;
        }

        .or-header-logos {
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 6px 10px;
            border-radius: 16px;
            background: rgba(255, 255, 255, .96);
            border: 1px solid rgba(255, 255, 255, .22);
            box-shadow: 0 8px 20px rgba(0, 0, 0, .22);
            flex-shrink: 0;
        }

        .or-header-logo-gore {
            height: 42px;
            width: auto;
            object-fit: contain;
            display: block;
        }

        .or-header-logo-hbt {
            height: 40px;
            width: auto;
            object-fit: contain;
            display: block;
        }

        .or-header-divider {
            width: 1px;
            height: 32px;
            background: rgba(6, 18, 24, .18);
        }

        .or-header-title {
            display: flex;
            flex-direction: column;
            line-height: 1.15;
            min-width: 0;
        }

        .or-header-title-main {
            font-weight: 900;
            color: #2bd4c5;
            font-size: 14px;
            letter-spacing: .4px;
            white-space: nowrap;
        }

        .or-header-title-sub {
            color: rgba(234, 243, 248, .68);
            font-size: 11.5px;
            font-weight: 700;
            margin-top: 3px;
            white-space: nowrap;
        }

        .navbar-toggler {
            border-color: rgba(255, 255, 255, .18);
        }

        .navbar-toggler-icon {
            filter: invert(1);
            opacity: .85;
        }

        @media (max-width: 768px) {
            .or-header-logo-gore {
                height: 34px;
            }

            .or-header-logo-hbt {
                height: 32px;
            }

            .or-header-divider {
                height: 26px;
            }

            .or-header-title-main {
                font-size: 12px;
            }

            .or-header-title-sub {
                display: none;
            }

            .or-header-logos {
                padding: 5px 8px;
                gap: 8px;
            }
        }

        @media (max-width: 480px) {
            .or-header-title-main {
                display: none;
            }
        }
    </style>
</head>

<body>
    <div id="app">

        @if (!request()->routeIs('login') && !request()->routeIs('register'))

        <nav class="navbar navbar-expand-md or-navbar shadow-sm">
            <div class="container">

                <a href="{{ url('/home') }}" class="navbar-brand or-brand-header">
                    <div class="or-header-logos">
                        <img src="{{ asset('img/logogerencia.png') }}"
                             alt="Gobierno Regional La Libertad"
                             class="or-header-logo-gore">

                        <span class="or-header-divider"></span>

                        <img src="{{ asset('img/logo.png') }}"
                             alt="Hospital Belén de Trujillo"
                             class="or-header-logo-hbt">
                    </div>

                    <div class="or-header-title">
                        <span class="or-header-title-main">
                            HOSPITAL BELÉN DE TRUJILLO
                        </span>
                        <span class="or-header-title-sub">
                            Gobierno Regional La Libertad • Sala de Operaciones
                        </span>
                    </div>
                </a>

                <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarSupportedContent"
                    aria-controls="navbarSupportedContent"
                    aria-expanded="false"
                    aria-label="Alternar navegación">
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
                                   aria-haspopup="true"
                                   aria-expanded="false"
                                   v-pre>
                                    {{ Auth::user()->name }}
                                </a>

                                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item"
                                       href="{{ route('logout') }}"
                                       onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                        Cerrar sesión
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