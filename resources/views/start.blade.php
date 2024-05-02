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
                    <p id="intellengence">1</p>
                    <p id="wealth">10</p>
                    <p id="appearance">10</p>
                    <p id="luck">10</p>
                    <p id="morality">10</p>
                    <p id="happiness">10</p>
                </form>

            </div>
        </div>
    </div>
</div>
@endsection
