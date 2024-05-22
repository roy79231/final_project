@extends('layouts.app')

@section('content')
<style>
    .custom-card {
        background-color: #ebcd96;
        border: 2px solid rgb(123, 119, 119);
        padding: 15px;
        border-radius: 5px;
    }
</style>
<p style="text-align: center; font-size: 20px;"></p>


<body style="background-color: #f5deb3; font-size: 20px;">

    <div class="row justify-content-center">
        <div class="col-md-8">
            
            
                <div  style=" color: #070707; font-weight: bold; font-size: 60px;text-align: center;">解鎖成就</div>
                
                <div class="custom-card" style="background-color: #ecbd97; font-size: 20px; min-height: 600px;">
                    @if($unlockedAchievements->isEmpty() && $lockedAchievements->isEmpty())
                        <div class="text-center" style="color: #fff; font-size: 30px;">你還沒有達成任何成就</div>
                    @else
                        <div style="max-height: 600px; overflow-y: auto; font-size: 20px;">
                            <ul class="list-unstyled" style="font-size: 20px;">
                                {{-- 遍歷已解鎖的成就 --}}
                                @foreach($unlockedAchievements as $achievement)
                                    <li class="mb-3" style="font-size: 30px;">
                                        <div style="background-color: #fff; padding: 10px; border-radius: 5px; font-size: 30px;">
                                            <i class="bi bi-award" style="color: #ecbd97; font-size: 24px;"></i> 
                                            <span style="color: #000; font-size: 33px;">{{ $achievement->achievement->name }} - {{ $achievement->achievement->content }} - {{ $achievement->updated_at->format('Y-m-d') }}</span>
                                        </div>
                                    </li>
                                @endforeach
                                <p style="text-align: center; font-size: 30px;">------------------------尚未解鎖的成就------------------------</p>
                                {{-- 遍歷尚未解鎖的成就 --}}
                                @foreach($lockedAchievements as $achievement)
                                    <li class="mb-3" style="font-size: 33px;">
                                        <div style="background-color: #fff; padding: 10px; border-radius: 5px; font-size: 20px;">
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

</body>
@endsection
