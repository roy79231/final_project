@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
                <div class="card">
                <div class="card-header">報告長官</div>
                    <div class="card-body">
                        主頁
                        <a href="{{route('start')}}">遊戲開始</a>
                        <a href="{{route('finish')}}">結算畫面</a>
                    </div>
            </div>
        </div>
    </div>
</div>
@endsection
