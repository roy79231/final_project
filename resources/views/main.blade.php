@extends('layouts.app')

<style>
    .navbar {
        border-bottom: 1px solid #ddd;
    }

    ul {
        list-style-type: none; /* Remove the default bullet */
        padding-left: 0; /* Remove any default padding */
    }

    .nav-pills .nav-link {
        border-radius: 2px;
    }

    .justify-content-end .nav-link {
        color: black !important;
    }

    .navbar-light .navbar-nav .nav-link {
        color: rgba(0, 0, 0);
    }

    .justify-content-center {
        display: flex;
        justify-content: center;
        align-items: center;
        height: 100vh;
        background: radial-gradient(circle at center, rgb(248, 202, 149), rgb(245, 187, 120), rgb(247, 174, 89)) !important;
    }

    .text-center {
        width: 50%;
    }

    p {
        font-size: 32px;
        font-family: Arial, sans-serif;
        font-weight: bold;
    }

    .btn {
        width: 105px;
        height: 70px;
        font-size: 1.5rem !important;
    }
</style>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-F3w7mX95PdgyTmZZMECAngseQB83DfGTowi0iMjiWaeVhAn4FJkqJByhZMI3AhiU" crossorigin="anonymous">


@section('content')
<div class="container">
    <div class="container-main centered-container">
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