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

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">

                <a class="navbar-brand" href="{{ url('/') }}">
                    <img  alt="{{ config('app.name', 'Home') }}"
                          title="{{ config('app.name', 'Home') }}"
                          height="25"
                          class="d-inline-block align-text-top"
                          src="/logo.jpg"/>
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav me-auto">
                        <li class="nav-item">
                            <a class="nav-link {{ Request::routeIs('wikipages.*') ? 'active' : '' }}" href="{{ route('wikipages.index') }}">
                                {{ __('wikipages.index') }}
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ Request::routeIs('points.*') ? 'active' : '' }}"  href="{{ route('points.index') }}">
                                {{ __('points.index') }}
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ Request::routeIs('products.*') ? 'active' : '' }}"  href="{{ route('products.index') }}">
                                {{ __('products.index') }}
                            </a>
                        </li>

                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ms-auto">


                        <!-- Authentication Links -->
                        @guest
                            @if (Route::has('login'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('login') }}">{{ __('auth.login') }}</a>
                                </li>
                            @endif

                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('auth.register') }}</a>
                                </li>
                            @endif
                        @else
                            <li class="nav-item dropdown">
                                <span class="px-1">
                                    {{ Auth::user()->name }}
                                </span>
                                <span class="px-1">
                                    {{ Auth::user()->email }}
                                </span>
                                <span class="px-1">
                                    {{ Auth::user()->role->title }}
                                </span>
                                <span class="px-1">
                                    |
                                </span>

                                <a class="ps-1 pe-3" href="{{ route('order.index') }}">{{ __('orders.index') }}</a>

                                <a class="ps-1 pe-3"  href="{{ route('admin') }}">
                                    {{ __('auth.admin') }}
                                </a>
                                <a class="ps-1 pe-3"  href="{{ route('logout') }}"
                                   onclick="event.preventDefault();
                                    document.getElementById('logout-form').submit();">
                                    {{ __('auth.logout') }}
                                </a>
                                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                    @csrf
                                </form>
                            </li>
                        @endguest

                        <span class="px-1">
                                    |
                                </span>
                            <a class="ps-1 pe-3" href="{{ route('basket.index') }}">{{ __('basket.index') }}
                                @if ($app->basket->total() > 0)
                                    <span class="badge bg-danger" title="{{ number_format($app->basket->total(), 2, '.', ' ') }}">
                                        {{ count($app->basket->contents()) }}
                                    </span>
                                @endif
                            </a>
                    </ul>
                </div>
            </div>
        </nav>

        <main class="py-4">
            @yield('content')
        </main>

        <div class="container">
            <div class="row">
                <div class="col-6 col-md-2 mb-3">
                    <h5>{{ __('points.index') }}</h5>
                    <ul class="nav flex-column">
                        <li class="nav-item mb-2">
                            <a class="nav-link p-0 text-muted" href="{{ route('wikipages.index') }}">
                                {{ __('wikipages.index') }}
                            </a>
                        </li>
                        <li class="nav-item mb-2">
                            <a class="nav-link p-0 text-muted"  href="{{ route('points.index') }}">
                                {{ __('points.index') }}
                            </a>
                        </li>
                        <li class="nav-item mb-2">
                            <a class="nav-link p-0 text-muted"  href="{{ route('products.index') }}">
                                {{ __('products.index') }}
                            </a>
                        </li>
                    </ul>
                </div>
                <div class="col-6 col-md-2 mb-3">
                    <h5>{{ trans_choice('points.city', 2) }}</h5>
                    <ul class="nav flex-column">
                        @foreach ($app->pointsCities as $link)
                            <li class="nav-item mb-2"><a class="nav-link p-0 text-muted" href="{{ route('points.index', ['city' => $link->title]) }}">
                                {{ $link->title }}</span>
                            </a></li>
                        @endforeach
                    </ul>
                </div>
                <div class="col-6 col-md-2 mb-3">
                    <h5>{{ trans_choice('points.type', 2) }}</h5>
                    <ul class="nav flex-column">
                        @foreach ($app->pointsTypes as $link)
                            <li class="nav-item mb-2"><a class="nav-link p-0 text-muted" href="{{ route('points.index', ['type' => $link->title]) }}">
                                {{ $link->title }} </span>
                            </a></li>
                        @endforeach
                    </ul>
                </div>
                <div class="col-6 col-md-2 mb-3">
                    <h5>{{ trans_choice('products.category', 2) }}</h5>
                    <ul class="nav flex-column">
                        @foreach ($app->productsCategories as $link)
                            <li class="nav-item mb-2"><a class="nav-link p-0 text-muted" href="{{ route('products.index', ['Product[category]' =>$link->slug]) }}">
                                #{{ $link->title }}
                            </a></li>
                        @endforeach
                    </ul>
                </div>

                <div class="col-6 col-md-4 mb-3">
                    <form>
                        <h5>{{ __('alert.subscribe') }}</h5>
                        <p>{{ __('alert.digest') }}.</p>
                        <div class="d-flex flex-column flex-sm-row w-100 gap-2">
                            <label for="newsletter1" class="visually-hidden">Email address</label>
                            <input id="newsletter1" type="text" class="form-control" placeholder="Email address">
                            <button class="btn btn-primary" type="button">Subscribe</button>
                        </div>
                    </form>
                </div>
            </div>

            <div class="d-flex justify-content-between py-4 mt-4 border-top">
                <p>© {{ date('Y') }} R/R Company, Inc. All rights reserved.</p>
                <ul class="list-unstyled d-flex">
                    <li class="ms-3"><a class="link-dark" href="#"><svg class="bi" width="24" height="24"><use xlink:href="#twitter"></use></svg></a></li>
                    <li class="ms-3"><a class="link-dark" href="#"><svg class="bi" width="24" height="24"><use xlink:href="#instagram"></use></svg></a></li>
                    <li class="ms-3"><a class="link-dark" href="#"><svg class="bi" width="24" height="24"><use xlink:href="#facebook"></use></svg></a></li>
                </ul>
                <div></div>
            </div>
        </div>

    </div>
</body>
</html>
