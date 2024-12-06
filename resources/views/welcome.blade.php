<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Laravel</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

    <script src="{{ asset('js/app.js') }}" defer></script>
    <script src="{{ asset('js/jquery.js') }}" defer></script>
    <script src="{{ asset('js/main.js') }}" defer></script>

    <!-- Styles -->
</head>

<body class="antialiased">
    <nav class="navbar navbar-expand-lg  bg-light shadow-sm">
        <div class="container col-md-11">
            @guest
            <a class="navbar-brand" href="{{ url('/') }}">NovelBook</a>
        @else
            @auth
                @if (Auth::user()->sRole == 'admin')
                    <a class="navbar-brand" href="{{ url('/') }}">NovelBook - Admin</a>
                @elseif (Auth::user()->sRole == 'author')
                    <a class="navbar-brand" href="{{ url('/') }}">NovelBook - Author</a>
                @else
                    <a class="navbar-brand" href="{{ url('/') }}">NovelBook</a>
                @endif
            @endauth
        @endguest
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    @if (Route::has('login'))
                        @auth
                            @if (Auth::user()->sRole == 'admin')
                                <li class="nav-item dropdown">
                                    <a class="nav-link dropdown-toggle" href="#" role="button"
                                        data-bs-toggle="dropdown" aria-expanded="false">
                                        Quản lý thể loại
                                    </a>
                                    <ul class="dropdown-menu dropdown-menu-lg-end">
                                        <li><a class="dropdown-item" href="{{route('Categories.create')}}">Thêm thể loại</a></li>
                                        <li><a class="dropdown-item" href="{{route('Categories.index')}}">Danh sách thể loại</a></li>
                                        <!-- <li>
                                                        <hr class="dropdown-divider">
                                                    </li>
                                                    <li><a class="dropdown-item" href="#">Something else here</a></li> -->
                                    </ul>
                                </li>
                            @endif
                        @endauth
                    @endif
                </ul>

                <form class="d-flex" role="search">
                    <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
                    <button class="btn btn-outline-success" type="submit">Search</button>
                </form>
                <ul class="navbar-nav mb-2 mb-lg-0">
                    <li class="navbar-nav ms-auto">
                        <!-- Authentication Links -->
                        @guest
                            @if (Route::has('login'))
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                        </li>
                        @endif

                        @if (Route::has('register'))
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                            </li>
                        @endif
                    @else
                        <li class="nav-item dropdown">
                            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"
                                data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                {{ Auth::user()->name }}
                            </a>

                            <div class="dropdown-menu dropdown-menu-lg-end dropdown-menu dropdown-menu-lg-end-end" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="{{ route('logout') }}"
                                    onclick="event.preventDefault();
                                                 document.getElementById('logout-form').submit();">
                                    {{ __('Logout') }}
                                </a>

                                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                    @csrf
                                </form>

                                <a class="dropdown-item" href="{{ route('home') }}">Trang cá nhân</a>
                            </div>
                        </li>
                    @endguest
                    </li>
                </ul>
            </div>
        </div>
    </nav>
</body>

</html>
