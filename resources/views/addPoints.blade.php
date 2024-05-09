@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row">
        <div class="col remaining-points">
            <!-- Left Content -->
            <div class="p-3">
                <h2>剩餘屬性點數: </h2>
                <ul>
                    <li id="intelligence">智力:
                        <button class="btn btn-danger decrement-btn">-</button>
                        <span class="quantity">0</span>
                        <button class="btn btn-success increment-btn">+</button>
                    </li>
                    <li id="wealth">財富:
                        <button class="btn btn-danger decrement-btn">-</button>
                        <span class="quantity">0</span>
                        <button class="btn btn-success increment-btn">+</button>
                    </li>
                    <li id="luck">運氣:
                        <button class="btn btn-danger decrement-btn">-</button>
                        <span class="quantity">0</span>
                        <button class="btn btn-success increment-btn">+</button>
                    </li>
                    <li id="morality">道德:
                        <button class="btn btn-danger decrement-btn">-</button>
                        <span class="quantity">0</span>
                        <button class="btn btn-success increment-btn">+</button>
                    </li>
                    <li id="appearance">顏值:
                        <button class="btn btn-danger decrement-btn">-</button>
                        <span class="quantity">0</span>
                        <button class="btn btn-success increment-btn">+</button>
                    </li>
                </ul>
            </div>
            <div id="reset" class="reset text-end">
                <button class="reset-btn btn-lg" id="reset-btn">歸零</button>
            </div>
        </div>
        <div class="col-auto">
            <div class="separator"></div>
        </div>
        <div class="col talent-choice">
            <div class="col">
                <!-- Right Content -->
                <div class="p-3">
                    <h2>選擇天賦: </h2>
                    <form id="talent-form">
                        @foreach ($talents as $talent)
                        <div class="form-check form-switch">
                            <input class="form-check-input" type="checkbox" id="flexSwitchCheck{{ $loop->index }}" value="{{ $talent }}">
                            <label class="form-check-label" for="flexSwitchCheck{{ $loop->index }}">{{ $talent }}</label>
                        </div>
                        @endforeach
                    </form>

                </div>
            </div>
            <div class="action-buttons">
                <button class="bet-btn">我是賭狗</button> <br>
                <button class="start-btn">開啟大學</button>
            </div>
        </div>

    </div>
</div>
@endsection
