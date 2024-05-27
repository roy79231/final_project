@extends('layouts.app')

@section('content')
    <?php
        $finishIntelligence = ["中央大學店", "普普通通", "資優生", "炸魚電神"];
        $finishAppearance = ["中央哥布林", "Banana", "Cherry", "Date"];
        $finishMorality = ["Apple", "Banana", "Cherry", "Date"];
        $finishLuck = ["Apple", "Banana", "Cherry", "Date"];
        $finishWealth = ["Apple", "Banana", "Cherry", "Date"];
        $finishHappiness = ["Apple", "Banana", "Cherry", "Date"];
    ?>

    <div class="finishContainerTwo">
        <div class="finishBoxContainerTwo1">
            <div class="finishBoxTwo1">
                <div class="finishBoxTwo3">
                    <p class="finishTitleTwo3">
                        智商: {{ $end->intelligence }}
                    </p>
                    <p class="finishTitleTwo3">
                        @if ($end->intelligence <= 5)
                            {{ $finishIntelligence[0] }}
                        @elseif ($end->intelligence <= 10)
                            {{ $finishIntelligence[1] }}
                        @elseif ($end->intelligence <= 15)
                            {{ $finishIntelligence[2] }}
                        @else
                            {{ $finishIntelligence[3] }}
                        @endif
                    </p>
                    </br>
                    <p class="finishTitleTwo3">
                        顏值: {{ $end->appearance }}
                    </p>
                    <p class="finishTitleTwo3">
                        你是傻逼，嗚嗚嗚嗚嗚嗚嗚嗚嗚嗚嗚
                    </p>
                    </br>
                    <p class="finishTitleTwo3">
                        道德: {{ $end->morality }}
                    </p>
                    <p class="finishTitleTwo3">
                        你是傻逼，嗚嗚嗚嗚嗚嗚嗚嗚嗚嗚嗚
                    </p>
                </div>
                <div class="finishBoxTwo4">
                    <p class="finishTitleTwo3">
                        幸運: {{ $end->luck }}
                    </p>
                    <p class="finishTitleTwo3">
                        你是傻逼，嗚嗚嗚嗚嗚嗚嗚嗚嗚嗚嗚
                    </p>
                    </br>
                    <p class="finishTitleTwo3">
                        財富: {{ $end->wealth }}
                    </p>
                    <p class="finishTitleTwo3">
                        你是傻逼，嗚嗚嗚嗚嗚嗚嗚嗚嗚嗚嗚
                    </p>
                    </br>
                    <p class="finishTitleTwo3">
                        快樂: {{ $end->happiness }}
                    </p>
                    <p class="finishTitleTwo3">
                        你是傻逼，嗚嗚嗚嗚嗚嗚嗚嗚嗚嗚嗚
                    </p>
                </div>
            </div>
            <div class="finishBoxTwo2">
                <p class="finishTitleTwo3">
                    總評: 你是傻逼，嗚嗚嗚嗚嗚嗚嗚嗚嗚嗚嗚
                </p>
            </div>
        </div>
        <div class="finishBoxContainerTwo2">
            <div class="finishBoxTwoCenter">
                <p class="finishTitleTwo1 ">
                    <?php
                        $total = $end->intelligence + $end->appearance + $end->morality + $end->luck + $end->wealth + $end->happiness;
                    ?>
                    Your Score: {{ $total }}
                </p>
            </div>
        </div>
        <div class="finishBoxContainerTwo3">
            <div class="finishBoxTwoCenter">
                <a class="finishTitleTwo2 " href="{{ route('addPoints')}}">
                    重新入學
                    <i class="bi bi-book"></i>
                </a>
            </div>
        </div>
    </div>
@endsection

<style>
    .finishContainerTwo {
        display: flex; /* 設置為彈性容器 */
        /*justify-content: space-between;  將子元素分佈在容器中，保持相等間距 */
        flex-direction: column;
        flex-wrap: wrap;/*要換行*/
        background-color: #f6f4e8;
        height: 93%;
        padding: 20px;
    }

    .finishBoxContainerTwo1 {
        display: flex;
        flex-direction: row;
        width: 100%;
        height: 70%;
        background-color: #e59a59;
    }
    .finishBoxContainerTwo2 {
        display: flex;
        flex-direction: row;
        width: 100%;
        height: 15%;
        background-color: #f6f4e8;
        justify-content: center;
    }
    .finishBoxContainerTwo3 {
        display: flex;
        flex-direction: row;
        width: 100%;
        height: 15%;
        padding: 20px;
        background-color: #bacec1;
        justify-content: flex-end;
    }
    .finishBoxTwo1 {
        display: flex;
        flex-direction: row;
        height: 100%;
        width: 70%;
        background-color: #e59560;
        padding: 30px;
    }
    .finishBoxTwo2 {
        display: flex;
        flex-direction: column-reverse;
        height: 100%;
        width: 30%;
        background-color: #bacec1;
        padding: 30px;
    }
    .finishBoxTwo3 {
        display: flex;
        flex-direction: column;
        height: 100%;
        width: 50%;
        padding: 30px;
    }
    .finishBoxTwo4 {
        display: flex;
        flex-direction: column;
        height: 100%;
        width: 50%;
        padding: 30px;
    }
    .finishBoxTwoCenter {
        display: flex;
        flex-direction: column;
        justify-content: center;
    }
    .finishTitleTwo1 {
        color: #e59560;
        font-size: 60px;  /* 文字大小 */
    }
    .finishTitleTwo2 {
        color: white;
        font-size: 60px;  /* 文字大小 */
        text-decoration: none;
    }
    .finishTitleTwo2:hover {
        color: #e59560;
    }
    .finishTitleTwo3 {
        color: black;
        font-size: 30px;  /* 文字大小 */
    }
</style>