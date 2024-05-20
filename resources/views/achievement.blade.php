@extends('layouts.app')

@section('content')
<p style="text-align: center;"></p>
<p style="text-align: center;"></p>
<p style="text-align: center;"></p>
<p style="text-align: center;"></p>
<p style="text-align: center;"></p>

<body style="background-color: #f5deb3;">

    <div class="row justify-content-center">
        <div class="col-md-8">
            
            <div class="card">
                <div class="card-header text-center" style="background-color: #ecbd97; color: #070707; font-weight: bold;">解鎖成就</div>

                <div class="card-body" style="background-color: #ecbd97;">
                    @if($unlockedAchievements->isEmpty() && $lockedAchievements->isEmpty())
                        <div class="text-center" style="color: #fff;">你還沒有達成任何成就</div>
                    @else
                        <div style="max-height: 400px; overflow-y: auto;">
                            <ul class="list-unstyled">
                                {{-- 遍歷已解鎖的成就 --}}
                                @foreach($unlockedAchievements as $achievement)
                                    <li class="mb-3">
                                        <div style="background-color: #fff; padding: 10px; border-radius: 5px;">
                                            <i class="bi bi-award" style="color: #ecbd97;"></i> 
                                            <span style="color: #000;">{{ $achievement->achievement->name }} - {{ $achievement->achievement->content }} - {{ $achievement->updated_at->format('Y-m-d') }}</span>
                                        </div>
                                    </li>
                                @endforeach
                                <p style="text-align: center;">---------------------尚未完成成就------------------------</p>
                                {{-- 遍歷尚未解鎖的成就 --}}
                                @foreach($lockedAchievements as $achievement)
                                    <li class="mb-3">
                                        <div style="background-color: #fff; padding: 10px; border-radius: 5px;">
                                            <i class="bi bi-clipboard2-x" style="color: #ecbd97;"></i> 
                                            <span style="color: #000;">{{ $achievement->name }} - {{ $achievement->content }}</span>
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

</body>
@endsection