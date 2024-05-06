@extends('layouts.app')

@section('content')
<div class="container">
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
