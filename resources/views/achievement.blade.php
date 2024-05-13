<!-- achievement.blade.php -->

@extends('layouts.app')

@section('content')
<body style="background-color: #f5deb3;">
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            
            <div class="card">
                <div class="card-header text-center" style="background-color: #ecbd97; color: #070707; font-weight: bold;">解鎖成就</div>

                <div class="card-body" style="background-color: #ecbd97;">
                    @if($achievements->isEmpty())
                        <div class="text-center" style="color: #fff;">你還沒有達成任何成就</div>
                    @else
                        <ul class="list-unstyled">
                            @foreach($achievements as $achievementFin)
                                @if($achievementFin->achievement)
                                    <li class="mb-3">
                                        <div style="background-color: #fff; padding: 10px; border-radius: 5px;">
                                            <i class="bi bi-award" style="color: #ecbd97;"></i> 
                                            <span style="color: #000;">{{ $achievementFin->achievement->name }} - {{ $achievementFin->achievement->content }} - {{ date('Y-m-d') }}</span>
                                        </div>
                                    </li>
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
