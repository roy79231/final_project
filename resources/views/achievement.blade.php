@extends('layouts.app')

@section('content')
<style>
    body {
        position: relative;
        font-size: 20px;
        margin: 0;
        padding: 0;
        height: 100%;
    }

    .background-overlay {
        position: fixed; /* Use fixed to cover the entire viewport */
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: url('{{ asset('_25d6b211-50e8-4220-8a01-9fed3ba11c67.jpg') }}') no-repeat center center fixed;
        background-size: cover;
        opacity: 0.35; /* Adjust the opacity value as needed */
        z-index: -2;
    }

    .custom-card {
        background-color: #ebcd96;
        border: 8px solid rgb(123, 119, 119);
        padding: 20px;
        border-radius: 50px;
    }

    .content-container {
        position: relative;
        z-index: 0;
    }
</style>

<div class="background-overlay"></div>

<div class="content-container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <p style="text-align: center;"></p>
            <div style="color: #070707; font-weight: bold; font-size: 60px; text-align: center;">解鎖成就</div>

            <div class="custom-card" style="background-color: #ecbd97; font-size: 20px;">
                @if($unlockedAchievements->isEmpty() && $lockedAchievements->isEmpty())
                    <div class="text-center" style="color: #fff; font-size: 30px;">你還沒有達成任何成就</div>
                @else
                    <div style="max-height: 600px; overflow-y: auto; font-size: 20px;">
                        <ul class="list-unstyled" style="font-size: 20px;">
                            <p style="text-align: center; font-size: 30px;">-----------------------<i class="bi bi-unlock"></i>已解鎖的成就------------------------</p>
                            {{-- 遍歷已解鎖的成就 --}}
                            @foreach($unlockedAchievements as $achievement)
                                <li class="mb-3" style="font-size: 30px;">
                                    <div style="background-color: #fff; padding: 10px; border-radius: 20px; font-size: 30px;">
                                        <i class="bi bi-award" style="color: #ecbd97; font-size: 24px;"></i> 
                                        <span style="color: #000; font-size: 33px;">{{ $achievement->achievement->name }} - {{ $achievement->achievement->content }} - {{ $achievement->updated_at->format('Y-m-d') }}</span>
                                    </div>
                                </li>
                            @endforeach
                            <p style="text-align: center; font-size: 30px;">-----------------------<i class="bi bi-lock"></i>尚未解鎖的成就------------------------</p>
                            {{-- 遍歷尚未解鎖的成就 --}}
                            @foreach($lockedAchievements as $achievement)
                                <li class="mb-3" style="font-size: 33px;">
                                    <div style="background-color: #fff; padding: 10px; border-radius: 20px; font-size: 20px;">
                                        <i class="bi bi-clipboard2-x" style="color: #ecbd97; font-size: 24px;"></i> 
                                        <span style="color: #000; font-size: 33px;">{{ $achievement->name }} - {{ $achievement->content }}</span>
                                    </div>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection
