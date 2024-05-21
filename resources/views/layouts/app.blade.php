<?php
use App\Models\User;
?>
<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">

    <!-- CSS-->
    <!-- timlin:ˇ我把這邊註解掉了-->
    {{-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-F3w7mX95PdgyTmZZMECAngseQB83DfGTowi0iMjiWaeVhAn4FJkqJByhZMI3AhiU" crossorigin="anonymous">
    <link href="{{ asset('style.css') }}" rel="stylesheet"> --}}

    <!-- Scripts -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

    <!--箭頭-->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
    <!--User按鈕-->
    <style>
        .nav-item {
            border: 2px solid black;
            border-radius: 2px;
        }
        .nav-link {
            background-color: rgba(168, 81, 6, 0.675) !important;
        }
        .container {
            background-color: #f6f4e8;
        }
        .navColor {
            background-color: #f6f4e8;
        }
        .appFix {
            position: fixed;
            width: 100%;
            height: 60px;
        }
        .mainType {
            padding-top: 60px;
        }
    </style>
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light navColor shadow-sm appFix">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    主頁
                </a>
                <?php $user = Auth::user()?>
                @if($user)
                <a class="navbar-brand" href="{{ route('achievement',Auth::user()->id) }}">
                    成就
                </a>
                @endif
                <a class="navbar-brand" href="{{ route('forumindex') }}">
                    討論區
                </a>
                <?php $user = Auth::user()?>
                @if(($user && $user->role == User::ROLE_ADMIN))
                    <a class="navbar-brand" href="{{ route('talentUpLoader') }}">
                        資料庫
                    </a>
                @endif

                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>


                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav me-auto">

                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ms-auto">
                        <!-- Authentication Links -->
                        @guest
                            @if (Route::has('login'))
                                <li class="nav-item me-2">
                                    <a class="nav-link" href="{{ route('login') }}">{{ __('登入') }}</a>
                                </li>
                            @endif

                            @if (Route::has('register'))
                                <li class="nav-item me-2">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('註冊') }}</a>
                                </li>
                            @endif
                        @else
                            <li class="nav-item dropdown nav-item">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }}
                                </a>

                                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                    <?php $user = Auth::user()?>
                                    @if(($user && $user->role == User::ROLE_ADMIN))
                                        <a class="dropdown-item me-2" href="{{ route('index') }}">
                                            AdminControll
                                        </a>
                                    @endif

                                    <a class="dropdown-item me-2" href="{{ route('logout') }}"
                                        onclick="event.preventDefault();
                                        document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        <main class="mainType">
            @yield('content')
        </main>
    </div>
</body>
</html>
