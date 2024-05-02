@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">報告長官</div>

                <div class="card-body">
                    點數加點畫面
                </div>
                <form action="{{route('run')}}" method="GET">
                    @csrf
                    <button id="start">開始</button>
                </form>

            </div>
        </div>
    </div>
</div>
@endsection
