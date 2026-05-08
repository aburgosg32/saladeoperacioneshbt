<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'SOP HBT') }}</title>

    <link rel="icon" type="image/x-icon" href="{{ asset('favicon.ico') }}">

    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">

    @vite(['resources/sass/app.scss', 'resources/js/app.js'])

    <style>
        body {
            background: #eef4f2;
            color: #20313a;
        }

        .or-navbar {
            position: relative;
            z-index: 9999;

            background:
                linear-gradient(180deg,
                    rgba(255, 255, 255, .96),
                    rgba(248, 251, 250, .92));
            border-bottom: 1px solid rgba(25, 64, 72, .10);
            box-shadow: 0 8px 24px rgba(35, 64, 70, .08);
            backdrop-filter: blur(14px);
        }

        .or-navbar .navbar-brand {
            color: #17313b;
            font-weight: 800;
        }

        .or-navbar .navbar-brand:hover {
            color: #13a889;
        }

        .or-navbar .nav-link {
            color: #465a62;
            font-size: 14px;
            font-weight: 700;
        }

        .or-navbar .nav-link:hover {
            color: #13a889;
        }

        .or-navbar .dropdown {
            position: relative;
        }

        .or-navbar .dropdown-menu {
            background: #ffffff;
            border: 1px solid rgba(25, 64, 72, .10);
            border-radius: 14px;
            box-shadow: 0 12px 32px rgba(35, 64, 70, .14);
            overflow: hidden;

            z-index: 10000;
            min-width: 190px;
            margin-top: 10px;
            padding: 8px;
        }

        .or-navbar .dropdown-menu-end {
            right: 0;
            left: auto;
        }

        .or-navbar .dropdown-item {
            color: #20313a;
            font-size: 13px;
            font-weight: 700;
            border-radius: 10px;
            padding: 10px 12px;
            white-space: nowrap;
            transition: .2s ease;
        }

        .or-navbar .dropdown-item:hover {
            background: rgba(53, 200, 159, .10);
            color: #13a889;
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
            background: #ffffff;
            border: 1px solid rgba(25, 64, 72, .10);
            box-shadow: 0 8px 20px rgba(35, 64, 70, .10);
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
            background: rgba(25, 64, 72, .16);
        }

        .or-header-title {
            display: flex;
            flex-direction: column;
            line-height: 1.15;
            min-width: 0;
        }

        .or-header-title-main {
            font-weight: 900;
            color: #17313b;
            font-size: 14px;
            letter-spacing: .4px;
            white-space: nowrap;
        }

        .or-header-title-sub {
            color: #6f7f86;
            font-size: 11.5px;
            font-weight: 700;
            margin-top: 3px;
            white-space: nowrap;
        }

        .navbar-toggler {
            border-color: rgba(25, 64, 72, .16);
        }

        .navbar-toggler-icon {
            filter: none;
            opacity: .85;
        }

        main.py-4 {
            padding-top: 0 !important;
            padding-bottom: 0 !important;
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

        <nav class="navbar navbar-expand-md or-navbar">

            <div class="container">

                <a href="{{ route('home') }}"
                    class="navbar-brand or-brand-header">

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

                <button class="navbar-toggler"
                    type="button"
                    data-bs-toggle="collapse"
                    data-bs-target="#navbarSupportedContent"
                    aria-controls="navbarSupportedContent"
                    aria-expanded="false"
                    aria-label="Alternar navegación">

                    <span class="navbar-toggler-icon"></span>

                </button>

                <div class="collapse navbar-collapse"
                    id="navbarSupportedContent">

                    <ul class="navbar-nav me-auto">

                        <li class="nav-item">
                            <a class="nav-link"
                                href="{{ route('home') }}">
                                Menu Principal
                            </a>
                        </li>

                    </ul>

                    <ul class="navbar-nav ms-auto">

                        @guest

                        @if (Route::has('login'))
                        <li class="nav-item">
                            <a class="nav-link"
                                href="{{ route('login') }}">
                                Login
                            </a>
                        </li>
                        @endif

                        @if (Route::has('register'))
                        <li class="nav-item">
                            <a class="nav-link"
                                href="{{ route('register') }}">
                                Register
                            </a>
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

                            <div class="dropdown-menu dropdown-menu-end"
                                aria-labelledby="navbarDropdown">

                                <a class="dropdown-item"
                                    href="{{ route('logout') }}"
                                    onclick="event.preventDefault();
                                    document.getElementById('logout-form').submit();">

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