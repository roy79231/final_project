@extends('layouts.app')

<style>
    html, body {
        margin: 0;
        padding: 0;
        width: 100%;
        height: 100%;
        overflow: hidden; /* 禁止滚动 */
    }
    .navbar {
        z-index: 1000; /* 確保導覽列位於最上層 */
    }

    ul {
        list-style-type: none; /* Remove the default bullet */
        padding-left: 0; /* Remove any default padding */
    }
    .justify-content-center {
        display: flex;
        justify-content: center;
        align-items: center;
        width: 100%;
        height: 100%;
        position: relative;
        text-align: center;
    }

    .justify-content-center::before {
        content: "";
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: url('{{ asset('_25d6b211-50e8-4220-8a01-9fed3ba11c67.jpg') }}') no-repeat center center fixed;
        background-size: cover;
        opacity: 0.35; /* Set the opacity for the background image */
        z-index: -1; /* Ensure the background image stays behind the content */
    }

    p {
        font-size: 32px;
        font-family: Arial, sans-serif;
        font-weight: bold;
        color: #333;
        text-shadow: 2px 2px #fff;
        margin: 20px 0;
    }

    .play-btn-container {
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
    }

    .play-btn {
        color:white;
        width: 100px;
        height: 100px;
        font-size: 2em;
        border-radius: 50%;
        background-color: #0d6efd;
        border: none;
        transition: background-color 0.3s ease, transform 0.3s ease;
        margin-top: 20px; /* Add some margin to separate the button from the text */
    }

    .play-btn:hover {
        background-color: #0b5ed7;
        transform: scale(1.1);
        animation: pulse 1s infinite;
    }

    @keyframes pulse {
        0% {
            transform: scale(1);
        }
        50% {
            transform: scale(1.1);
        }
        100% {
            transform: scale(1);
        }
    }

    .cursor {
        height: auto;
        max-height: 60px; /* Adjust the maximum height as needed */
        display: block;
        margin: 0 auto; /* Center the image */
        position: absolute;
        top: 60%;
        left: 53%;
        transform: translate(-50%, -10%); /* Center the image horizontally and adjust vertically */
        animation: moveCursor 2s linear infinite;
    }

    @keyframes moveCursor {
        0%, 100% {
            transform: translate(-50%, -10%) translateX(-20px) translateY(-10px);
        }
        50% {
            transform: translate(-50%, -10%) translateX(20px) translateY(10px);
        }
    }

</style>

@section('content')
<div class="full-page-container">
    <div class="justify-content-center">
        <div class="text-center">
            <p style="font-size: 5em">這中央我是一秒也不想待了</p>
            <a href="{{ route('addPoints') }}">
                <button class="play-btn" id="play-btn">PLAY</button>
            </a>
        </div>
        <img class="cursor" src=" {{ asset('cursor.png') }} " alt="cursor">
    </div>
</div>

@endsection
