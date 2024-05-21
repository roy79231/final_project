@extends('layouts.app')

@section('content')
    <div class="finishContainer">
        <div class="finishBoxContainer1">
            <div class="finishCenterColumn">
                <p class="finishTitle2">
                    Your Score: 69
                </p>
            </div>
        </div>
        <div class="finishBoxContainer2">
            <div class="finishBox1">
                <p class="finishTitle1">
                    智商: 69
                </p>
            </div>
            <div class="finishBox2">
                <p class="finishTitle1">
                    顏值: 69
                </p>
            </div>
            <div class="finishBoxIcon">
                <div class="finishCenterRow">
                    <div class="finishIcon">
                        <i class="bi bi-emoji-dizzy"></i>
                    </div>
                </div>
            </div>
            <div class="finishBox2">
                <p class="finishTitle1">
                    道德: 69
                </p>
            </div>
        </div>
        <div class="finishBoxContainer3">
            <div class="finishBox2">
                <p class="finishTitle1">
                    幸運: 69
                </p>
            </div>
            <div class="finishBox4">
                <p class="finishTitle1">
                    財富: 69
                </p>
            </div>
            <div class="finishBox1">
                <p class="finishTitle1">
                    快樂: 69
                </p>
            </div>
            <div class="finishBox3">
                <a class="finishRetry " href="{{ route('addPoints')}}">
                    重新入學
                    <i class="bi bi-book"></i>
                </a>
            </div>
        </div>
    </div>
@endsection

<style>
    .finishContainer {
        display: flex; /* 設置為彈性容器 */
        /*justify-content: space-between;  將子元素分佈在容器中，保持相等間距 */
        flex-direction: column; /* 將子元素在水平軸上從左到右排列 */
        /*flex-wrap: wrap;要換行*/
        height: 100%;
    }

    .finishBoxContainer1 {
        display: flex;
        flex-direction: row; /* 將子元素在垂直軸上從左到右排列 */
        justify-content: center;
        width: 100%;
        height: 40%;
    }
    .finishBoxContainer2 {
        display: flex;
        flex-direction: row; /* 將子元素在垂直軸上從左到右排列 */
        width: 100%;
        height: 30%;
    }
    .finishBoxContainer3 {
        display: flex;
        flex-direction: row; /* 將子元素在垂直軸上從左到右排列 */
        width: 100%;
        height: 30%;
    }

    .finishBox1 {
        display: flex;
        flex-direction: column;
        height: 100%;
        width: 25%;
        background-color: #e3dcd2;
        padding: 30px;
        justify-content: start;
    }
    .finishBox2 {
        display: flex;
        flex-direction: column;
        height: 100%;
        width: 25%;
        background-color: #c3a6a0;
        padding: 30px;
        justify-content: start;
    }
    .finishBox3 {
        display: flex;
        flex-direction: column;
        height: 100%;
        width: 25%;
        background-color: #013328;
        padding: 30px;
        justify-content: start;
    }
    .finishBox4 {
        display: flex;
        flex-direction: column;
        height: 100%;
        width: 25%;
        background-color: #a15c38;
        padding: 30px;
        justify-content: start;
    }
    .finishBoxIcon {
        display: flex;
        flex-direction: column;
        height: 100%;
        width: 25%;
        background-color: #013328;
        padding: 30px;
        justify-content: center;
    }

    .finishTitle1 {
        color: black;
        font-size: 40px;  /* 文字大小 */
    }
    .finishTitle2 {
        color: black;
        font-size: 80px;  /* 文字大小 */
    }
    .finishRetry {
        color: white;
        font-size: 40px;  /* 文字大小 */
        text-decoration: none;
    }
    .finishIcon {
        color: white;
        font-size: 100px;
    }

    .finishCenterRow {
        display: flex;
        flex-direction: row;
        justify-content: center;
    }
    .finishCenterColumn {
        display: flex;
        flex-direction: column;
        justify-content: center;
    }
</style>