<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/admin.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>
    <div>
        <header class="navbar navbar-dark sticky-top bg-dark flex-md-nowrap p-0 shadow">
            <a class="navbar-brand col-md-3 col-lg-2 me-0 px-3" href="/">Сайт</a>
            <a class="navbar-brand col-md-3 col-lg-2 me-0 px-3" href="#">Панель управления</a>
            <button class="navbar-toggler position-absolute d-md-none collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#sidebarMenu" aria-controls="sidebarMenu" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="navbar-nav">
                <div class="nav-item text-nowrap">
                    <span class="px-1 text-white">
                        {{ Auth::user()->name }}
                    </span>
                    <span class="px-1 text-white">
                        {{ Auth::user()->email }}
                    </span>
                    <span class="px-1 text-white">
                        {{ Auth::user()->role->title }}
                    </span>
                    <span class="px-1 text-white">
                        |
                    </span>
                    <a class="ps-1 pe-3 text-white"  href="{{ route('logout') }}"
                        onclick="event.preventDefault();
                        document.getElementById('logout-form').submit();">
                        {{ __('auth.logout') }}
                    </a>

                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                        @csrf
                    </form>

                </div>
            </div>
        </header>
        @if (Auth::check())
            @php
                $user_auth_data = [
                    'isLoggedin' => true,
                    'user' =>  Auth::user()
                ];
            @endphp
        @else
            @php
                $user_auth_data = [
                    'isLoggedin' => false
                ];
            @endphp
        @endif
        <script>
            window.Laravel = JSON.parse(atob('{{ base64_encode(json_encode($user_auth_data)) }}'));
        </script>

        <div id="admin" class="container-fluid">
            @yield('content')
        </div>
    </div>
</body>
</html>
