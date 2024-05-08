<!-- achievement.blade.php -->

@extends('layouts.app')

@section('content')
<body style="background-color: #f5deb3;">
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <h1 style="text-align: center;">你的成就</h1> 
            <div class="card">
                <div class="card-header">成就</div>

                <div class="card-body" style="background-color: #d8c49f;">
                    @if($achievements->isEmpty())
                        你沒有成就
                    @else
                        <ul>
                            @foreach($achievements as $achievementFin)
                            @if($achievementFin->achievement)
                            <li>{{ $achievementFin->achievement->name }} - {{ $achievementFin->achievement->content }}</li>
                            @endif
                            @endforeach
                        </ul>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
</body>
@endsection