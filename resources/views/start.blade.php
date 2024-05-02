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
                <form action="{{route('run')}}" method="POST">
                    @csrf
                    <textarea name="intelligence">1</textarea>
                    <textarea name="wealth">15</textarea>
                    <textarea name="appearance">15</textarea>
                    <textarea name="luck">15</textarea>
                    <textarea name="morality">15</textarea>
                    
                    <textarea name="talent_id">7</textarea>
                    <button type="submit">開始</button>

                </form>

            </div>
        </div>
    </div>
</div>
@endsection
