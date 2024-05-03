@extends('layouts.app')

@section('content')
<div class="container">
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container-fluid">
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item me-2">
                        <a class="nav-link active" aria-current="page" href="#">主頁</a>
                    </li>
                    <li class="nav-item me-2">
                        <a class="nav-link active" href="#">討論區</a>
                    </li>

                    <li class="nav-item me-2">
                        <a class="nav-link active" href="#">成就</a>
                    </li>
                </ul>
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link active" href="#">登入</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <div class="container centered-container">
        <div class="row justify-content-center">
            <div class="col-md-6 text-center">
                <p>這中央我是一秒也不想待了</p>
                <a href="{{route('addPoints')}}">
                    <button class="btn btn-primary" id="play-btn">PLAY</button>
                </a>
            </div>
        </div>
    </div>
</div>
@endsection
