@extends('layouts.app')

@section('content')
    <?php
        $finishIntelligence = ["中央大學店", "普普通通", "資優生", "炸魚電神"];
        $finishAppearance = ["中央哥布林", "普普通通", "早餐店阿姨覺得你很帥", "皎如玉樹臨風起"];
        $finishMorality = ["我爸是警察", "普普通通", "喜提一張好人卡", "你站在道德制高點"];
        $finishLuck = ["你的臉超級黑", "普普通通", "心想事成", "神眷者"];
        $finishWealth = ["公園是我家", "普普通通", "家境小康", "隱形亞洲富豪"];
        $finishHappiness = ["憂鬱青年", "普普通通", "你很快樂", "浪味仙~快樂似神仙~"];
        $finishScore = ["你揮一揮衣袖，輕輕的走了，沒有在中央大學留下任何痕跡也沒有帶走什麼", 
                        "你在這段時光留下了一抹屬於你的色彩，或許對其他人來說無足輕重，但這會成為你心中的一筆濃墨", 
                        "你在中央劃下了重重的一刀，", 
                        "你是智慧的結晶，你是文明的瑰寶，你是人類的獨苗，你是上帝的遺珠，你是最後的希望，你是電你是光你是唯一的神話"
                        ];
    ?>

    <div class="finishContainerThr">
        <div class="finishBoxThr1">
            <div class="finishInnerBox1">
                <div class="finishCenterBox">
                    <div class="finishTxtDie">
                        @if($graduate)
                            畢業 
                        @else
                            你從中央高歌離席了
                        @endif
                    </div>
                </div>
            </div>
            <div class="finishInnerBox2">
                <div class="finishCenterBox">
                    <div class="finishTxtScore">
                        <?php $total = $end->intelligence + $end->appearance + $end->morality + $end->luck + $end->wealth + $end->happiness; ?>
                        Your Score: {{ $total }}
                    </div>
                </div>
                <div class="finishCenterBox">
                    <div class="finishTxtScore2">
<<<<<<< HEAD
                        @if ($total <= 25)
                            {{ $finishScore[0] }}
                        @elseif ($total <= 35)
                            {{ $finishScore[1] }}
                        @elseif ($total <= 45)
=======
                        @if ($total <= 5)
                            {{ $finishScore[0] }}
                        @elseif ($total <= 10)
                            {{ $finishScore[1] }}
                        @elseif ($total <= 15)
>>>>>>> 6929c79200c520264fb4e12f3648dfd71c57dbc4
                            {{ $finishScore[2] }}
                        @else
                            {{ $finishScore[3] }}
                        @endif
                    </div>
                </div>
            </div>
            <a class="finishInnerBox3 finishTxtRe" href="{{ route('addPoints')}}">        
                <div class="finishCenterBox">
                    <div class>
                        重新入學
                        <i class="bi bi-book"></i>
                    </div>
                </div>
            </a>
        </div>
        <div class="finishBoxThr2">
            <div class="finishInnerBox4">
                <div class="finishTxtRight">
                    智商: {{ $end->intelligence }}
                </div>
                <div class="finishTxtRight">
                    @if ($end->intelligence <= 8)
                        {{ $finishIntelligence[0] }}
                    @elseif ($end->intelligence <= 16)
                        {{ $finishIntelligence[1] }}
                    @elseif ($end->intelligence <= 24)
                        {{ $finishIntelligence[2] }}
                    @else
                        {{ $finishIntelligence[3] }}
                    @endif
                </div>
                <div class="finishTxtRight">
                    道德: {{ $end->morality }}
                </div>
                <div class="finishTxtRight">
                    @if ($end->morality <= 8)
                        {{ $finishMorality[0] }}
                    @elseif ($end->morality <= 16)
                        {{ $finishMorality[1] }}
                    @elseif ($end->morality <= 24)
                        {{ $finishMorality[2] }}
                    @else
                        {{ $finishMorality[3] }}
                    @endif
                </div>
                <div class="finishTxtRight">
                    幸運: {{ $end->luck }}
                </div>
                <div class="finishTxtRight">
                    @if ($end->luck <= 8)
                        {{ $finishLuck[0] }}
                    @elseif ($end->luck <= 16)
                        {{ $finishLuck[1] }}
                    @elseif ($end->luck <= 24)
                        {{ $finishLuck[2] }}
                    @else
                        {{ $finishLuck[3] }}
                    @endif
                </div>
            </div>
            <div class="finishInnerBox5">
                <div class="finishTxtRight">
                    財富: {{ $end->wealth }}
                </div>
                <div class="finishTxtRight">
                    @if ($end->wealth <= 8)
                        {{ $finishWealth[0] }}
                    @elseif ($end->wealth <= 16)
                        {{ $finishWealth[1] }}
                    @elseif ($end->wealth <= 24)
                        {{ $finishWealth[2] }}
                    @else
                        {{ $finishWealth[3] }}
                    @endif
                </div>
                <div class="finishTxtRight">
                    顏值: {{ $end->appearance }}
                </div>
                <div class="finishTxtRight">
                    @if ($end->appearance <= 8)
                        {{ $finishAppearance[0] }}
                    @elseif ($end->intelligence <= 16)
                        {{ $finishAppearance[1] }}
                    @elseif ($end->appearance <= 24)
                        {{ $finishAppearance[2] }}
                    @else
                        {{ $finishAppearance[3] }}
                    @endif
                </div>
                <div class="finishTxtRight">
                    快樂: {{ $end->happiness }}
                </div>
                <div class="finishTxtRight">
                    @if ($end->happiness <= 6)
                        {{ $finishHappiness[0] }}
                    @elseif ($end->happiness <= 16)
                        {{ $finishHappiness[1] }}
                    @elseif ($end->happiness <= 24)
                        {{ $finishHappiness[2] }}
                    @else
                        {{ $finishHappiness[3] }}
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection

<style>
    .finishContainerThr {
        display: flex; /* 設置為彈性容器 */
        /*justify-content: space-between;  將子元素分佈在容器中，保持相等間距 */
        flex-direction: column;
        flex-wrap: wrap;/*要換行*/
        height: 93%;
        width: 100%;
        background-color: #f6f4e8;
    }

    .finishBoxThr1 {
        display: flex;
        flex-direction: column;
        height: 100%;
        width: 50%;
    }
    .finishBoxThr2 {
        display: flex;
        flex-direction: column;
        height: 100%;
        width: 50%;
    }

    .finishInnerBox1 {
        display: flex;
        justify-content: center;
        flex-direction: column;
        height: 20%;
        margin: 0px 5px 5px 0px; /* 設置間距，順序是上、右、下、左 */
        background-color: #e3dcd2;
    }
    .finishInnerBox2 {
        display: flex;
        justify-content: center;
        flex-direction: column;
        height: 70%;
        margin: 5px 5px 5px 0px;
        background-color: #013328;
    }
    .finishInnerBox3 {
        display: flex;
        flex-direction: column;
        justify-content: center;
        height: 10%;
        margin: 5px 5px 0px 0px;
        background-color: #a15c38;
    }
    .finishInnerBox4 {
        display: flex;
        justify-content: center;
        flex-direction: column;
        height: 50%;
        margin: 0px 0px 5px 5px;
        background-color: #e3dcd2;
    }
    .finishInnerBox5 {
        display: flex;
        justify-content: center;
        flex-direction: column;
        height: 50%;
        margin: 5px 0px 0px 5px;
        background-color: #e3dcd2;
    }
    .finishCenterBox {
        display: flex;
        flex-direction: row;
        justify-content: center;
    }
    .finishTxtScore {
        font-size: 50px;
        color: #e3dcd2;
        padding: 5px 25px 0px 25px;
    }
    .finishTxtScore2 {
        font-size: 30px;
        color: #e3dcd2;
        padding: 0px 40px;
    }
    .finishTxtRe {
        color: #e3dcd2;
        font-size: 30px;
        text-decoration: none;
    }
    .finishTxtRe:hover {
        font-size: 33px;
    }
    .finishTxtRight {
        font-size: 25px;
        padding: 3px 20px;
    }
    .finishTxtDie {
        font-size: 35px;
    }
</style>