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
        .navColor {
            background-color: #e3dcd2;
        }
        .navbar {
            width: 100%;
            position: fixed;
        }
        .appNavCenterBox {
            display: flex;
            flex-direction: column;
            justify-content: center;
        }
        .appNavBox {
            display: flex;
            flex-direction: row;
            justify-content: center;
            background-color: #013328;
            border-radius: 20px;
            height: 45px;
            width: 100px;
        }
        .appNavBox:hover {
            background-color: #a15c38;
        }
        .navTitle {
            color: #e3dcd2;
            font-size: 25px;
            text-decoration: none;
        }
        .navTitle:hover {
            color: #e3dcd2;
            font-size: 28px;
        }
        .navTitle2 {
            color: black;
            font-size: 30px;
        }
        .mainType {
            padding-top: 80px;
        }
        li.nav-item.dropdown::marker {
            content: '';
        }
    </style>
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light navColor shadow-sm">
            <div class="container">
                <a class="navbar-brand navTitle" href="{{ url('/') }}">
                    <div class="appNavBox">
                        <div class="appNavCenterBox">
                            主頁
                        </div>
                    </div>
                </a>
                <?php $user = Auth::user()?>
                @if($user)
                <a class="navbar-brand navTitle" href="{{ route('achievement',Auth::user()->id) }}">
                    <div class="appNavBox">
                        <div class="appNavCenterBox">
                            成就
                        </div>
                    </div>
                </a>
                @endif
                <a class="navbar-brand navTitle" href="{{ route('forumindex') }}">
                    <div class="appNavBox">
                        <div class="appNavCenterBox">
                            討論區
                        </div>
                    </div>
                </a>
                <?php $user = Auth::user()?>
                @if(($user && $user->role == User::ROLE_ADMIN))
                <li class="nav-item dropdown">
                <a class="navTitle dropdown" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                    <div class="appNavBox">
                        <div class="appNavCenterBox">
                            資料庫
                        </div>
                    </div>
                    <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item me-2" href="{{ route('talentUpLoader') }}">
                            天賦羅
                        </a>
                        <a class="dropdown-item me-2" href="{{ route('specialEventUpLoader') }}">
                            加分事件
                        </a>
                        <a class="dropdown-item me-2" href="{{ route('normalEventUpLoader') }}">
                            一般事件
                        </a>
                        <a class="dropdown-item me-2" href="{{ route('achievementEventUpLoader') }}">
                            成就事件
                        </a>
                        <a class="dropdown-item me-2" href="{{ route('achievementUpLoader') }}">
                            成就條件
                        </a>
                        <a class="dropdown-item me-2" href="{{ route('deadUpLoader') }}">
                            死亡事件
                        </a>
                    </div>
                </a>
                </li>
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
                                    <a class="nav-link navTitle2" href="{{ route('login') }}">{{ __('登入') }}</a>
                                </li>
                            @endif

                            @if (Route::has('register'))
                                <li class="nav-item me-2">
                                    <a class="nav-link navTitle2" href="{{ route('register') }}">{{ __('註冊') }}</a>
                                </li>
                            @endif
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link navTitle2 dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
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
    <audio id="background-audio" style="display: none;" loop>
        <source src="{{ asset('調皮可愛-Main-version.mp3') }}" type="audio/mpeg">
       
    </audio>

    <script>
    document.addEventListener("DOMContentLoaded", function() {
        var audio = document.getElementById("background-audio");
        
        audio.volume = 0.15;
        // Check if there's a saved position in localStorage
        var savedTime = localStorage.getItem("audioCurrentTime");
        if (savedTime !== null) {
            audio.currentTime = savedTime;
        }

        // Play the audio
        audio.play();

        // Save the current time periodically
        setInterval(function() {
            localStorage.setItem("audioCurrentTime", audio.currentTime);
        }, 1000);

        // Save the current time before the page is unloaded
        window.addEventListener("beforeunload", function() {
            localStorage.setItem("audioCurrentTime", audio.currentTime);
        });
    });
    </script>
</body>
</html>
