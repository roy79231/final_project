@extends('layouts.app')

@section('content')
    <div class="finishContainerThr">
        <div class="finishBoxThr1">
            <div class="finishInnerBox1">
                <div class="finishCenterBox">
                    <div class="finishTxtDie">
                        @if($graduate)
                            畢業 
                        @else
                            沒畢業
                        @endif
                    </div>
                </div>
            </div>
            <div class="finishInnerBox2">
                <div class="finishCenterBox">
                    <div class="finishTxtScore">
                        Your Score: 69
                    </div>
                </div>
                <div class="finishCenterBox">
                    <div class="finishTxtScore2">
                        你是智慧的結晶，你是文明的瑰寶，你是人類的獨苗，你是上帝的遺珠，你是最後的希望，你是電你是光你是唯一的神話
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
                    智商: 
                </div>
                <div class="finishTxtRight">
                    你是傻逼，嗚嗚嗚
                </div>
                <div class="finishTxtRight">
                    道德: 
                </div>
                <div class="finishTxtRight">
                    你是傻逼，嗚嗚嗚
                </div>
                <div class="finishTxtRight">
                    幸運: 
                </div>
                <div class="finishTxtRight">
                    你是傻逼，嗚嗚嗚
                </div>
            </div>
            <div class="finishInnerBox5">
                <div class="finishTxtRight">
                    財富: 
                </div>
                <div class="finishTxtRight">
                    你是傻逼，嗚嗚嗚
                </div>
                <div class="finishTxtRight">
                    顏值: 
                </div>
                <div class="finishTxtRight">
                    你是傻逼，嗚嗚嗚
                </div>
                <div class="finishTxtRight">
                    快樂: 
                </div>
                <div class="finishTxtRight">
                    你是傻逼，嗚嗚嗚
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