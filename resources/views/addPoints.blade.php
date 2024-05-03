@extends('layouts.app')

@section('content')
<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container-fluid">
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item me-2">
                    <a class="nav-link active" aria-current="page" href="index.html">主頁</a>
                </li>
                <li class="nav-item me-2">
                    <a class="nav-link active" href="#">討論區</a>
                </li>

                <li class="nav-item me-2">
                    <a class="nav-link active" href="#">成就</a>
                </li>
            </ul>
            <ul class="navbar-nav ms-auto">
                <li class="nav-item">
                    <a class="nav-link active" href="#">使用者</a>
                </li>
            </ul>
        </div>
    </div>
</nav>

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
                    <li id="reset" class="text-end">
                        <button class="btn reset-btn" id="reset-btn">歸零</button>
                    </li>
                </ul>
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
                        <div class="form-check form-switch">
                            <input class="form-check-input" type="checkbox" id="flexSwitchCheckDefault">
                            <label class="form-check-label" for="flexSwitchCheckDefault">二一體質</label>
                        </div>
                        <div class="form-check form-switch">
                            <input class="form-check-input" type="checkbox" id="flexSwitchCheckChecked">
                            <label class="form-check-label" for="flexSwitchCheckChecked">偷竊慣犯</label>
                        </div>
                        <div class="form-check form-switch">
                            <input class="form-check-input" type="checkbox" id="flexSwitchCheckDisabled">
                            <label class="form-check-label" for="flexSwitchCheckDisabled">天生學霸</label>
                        </div>
                        <div class="form-check form-switch">
                            <input class="form-check-input" type="checkbox" id="flexSwitchCheckCheckedDisabled">
                            <label class="form-check-label" for="flexSwitchCheckDefault">香米門神</label>
                        </div>
                    </form>
                </div>
            </div>
            <div class="action-buttons">
                <button class="btn bet-btn btn">我是賭狗</button> <br>
                <button class="btn start-btn">開啟大學</button>
            </div>
        </div>

    </div>
</div>
@endsection
