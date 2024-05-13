@extends('layouts.app')

@section('content')
<div class="container">
    <div class="boxRight">
        <p>
            結算頁面
        </p>
        <p>
            智力 : {{ $end->intelligence }}
        </p>
        <p>
            財富 : {{ $end->wealth }}
        </p>
        <p>
            顏值 : {{ $end->appearance}}
        </p>
        <p>
            運氣 : {{ $end->luck }}
        </p>
        <p>
            道德 : {{ $end->morality }}
        </p>
        <p>
            快樂 : {{ $end->happiness }}
        </p>
    </div>
    <div class="boxLeft">
        <?php
            $total = $end->intelligence + $end->wealth + $end->appearance + $end->luck + $end->morality + $end->happiness;
        ?>

        <p>
            總評 : {{ $total }}
        </p>
        <br>
        <p>
            gg
        </p>
    </div>
</div>
@endsection

<style>
    .container {
        display: flex; /* 將容器設置為彈性容器 */
        justify-content: space-between; /* 將子元素分佈在容器中，保持相等間距 */
        flex-direction: row; /* 將子元素在水平軸上從左排列 */
        height: 80%;
    }
  
    .boxRight {
        display: flex;
        flex-direction: column;
        width: 49%;
        background-color: #ccc;
        padding: 20px;
        justify-content: space-between; /* 將子元素分佈在容器中，保持相等間距 */
        font-size: 20px;  /* 文字大小 */
    }

    .boxLeft {
        display: flex;
        flex-direction: column;
        width: 49%;
        background-color: #ccc;
        padding: 20px;
        font-size: 20px;  /* 文字大小 */
    }
  </style>