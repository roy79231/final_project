@extends('layouts.app')
@section('content')
<style>
    .container{
        background-color: beige;
    }
    .month_number{
        background-color:beige;
        font-size: 30px; 
    
    }
    .main_area{
        display: flex;
        background-color: beige;
    }
    .month_attribute{
        font-size: 30px;
        font-family:;
        text-align: center;
       
        width: 400px;
    }
    .month_content{
        text-align: center;
        font-size: 20px;
        width:400px;
    }
    .attribute_change{
        font-size: 30px;
        font-family: 'Courier New', Courier, monospace;
       
        width: 150px;
    }
    .month_move_last{
       
        display: flex;
        align-items: center;
        text-align: center;
        width: 100px;
        background-repeat: no-repeat;
        background-color: transparent;
        
    }
    
    .month_move_next{
        display: flex;
       
        align-items: center;
        text-align: center;
        width: 100px;
        
    }
    .month_move_skip{
       
        text-align: center;
        
    }
</style>
<script>
    var count=0;
    var monthintelligence=[9,0,15,7,6,9];
    var totalmonth=monthintelligence.length
    var monthnumber=1;
    var monthweathly=[9,8,7,6,5,4];
    var monthhandsome=[5,5,5,5,5,5];
    var monthluck=[6,4,1,9,7,0];
    var monthethical=[9,7,6,4,3,1];
    var monthhappy=Math.floor(Math.random()*10);
    var monthcontent=['你通過學測進入中央大學了，你非常興奮，你決定一定要充實大學生活。','吃我雞雞',"好吃雞雞","晚餐吃雞雞","吃你雞雞","亂吃雞雞"];

</script>
<div class="container">
    
            <div class="month_number" id="months">
                <p>第 1 個月</p>
            </div>
            <div class="main_area">
                <div class="month_move_last">
                    <div class="last">
                        
                        <button style="font-size:24px"><i class="fa fa-angle-left" id="month_last" style="font-size: 80px"></i></button>
                    </div>
                </div>
                <div class="month_attribute">
                    <p class="month_intelligence" id="intelligence">
                        智力: <script>document.write(monthintelligence[0])</script>
                    </p>
                    <p class="month_weathly" id="wealthy">
                        財富: <script>document.write(monthweathly[0])</script>
                    </p>
                    <p class="month_handsome" id="handsome">
                        顏值: <script>document.write(monthhandsome[0])</script>
                    </p>
                    <p class="month_luck" id="luck">
                        運氣: <script>document.write(monthluck[0])</script>
                    </p>
                    <p class="month_ethical" id="ethical">
                        道德: <script>document.write(monthethical[0])</script>
                    </p>
                    <p class="month_happy" id="happy">
                        快樂: <script>document.write(monthhappy)</script>
                    </p>
                </div>
                <div class="attribute_change">
                    <p class="intelligence_change" id="intelligencechange">
                    </p>
                    <p class="wealthy_change" id="wealthychange">
                    </p>
                    <p class="handsome_change" id="handsomechange">
                    </p>
                    <p class="luck_change" id="luckchange">
                    </p>
                    <p class="ethical_change" id="ethicalchange">
                    </p>
                    <p class="happy_change" id="happychange">
                    </p>
                </div>
                <div class="month_content" id="content">
                    <p>
                    <script>document.write(monthcontent[count])</script>
                    </p>
                </div>
                <div class="month_move_next">
                    <div class="next">
                        <button style="font-size:24px"><i class="fa fa-angle-right" id="month_next" style="font-size: 80px"></i></button>
                    </div>
                </div>
            </div>
            
            <div class="month_move_skip">
                <button id="month_skip">大學結局</button>
            </div>
        
</div>
<script>
    document.getElementById("month_next").addEventListener("click", nextmonth);
    function nextmonth(){
        monthnumber+=1;
        count+=1;
        if(monthnumber>totalmonth){
            monthnumber=1;
            count=0;
            document.getElementById("months").innerHTML = "第 "+monthnumber+" 個月";
            document.getElementById("intelligence").innerHTML = "智力: "+monthintelligence[count];
            document.getElementById("wealthy").innerHTML = "財富: "+monthweathly[count];
            document.getElementById("handsome").innerHTML = "顏值: "+monthhandsome[count];
            document.getElementById("luck").innerHTML = "幸運: "+monthluck[count];
            document.getElementById("ethical").innerHTML = "道德: "+monthethical[count];
            document.getElementById("happy").innerHTML = "快樂: "+monthhappy;
            document.getElementById('content').innerHTML = monthcontent[count];

            document.getElementById("intelligencechange").innerHTML="";
            document.getElementById("wealthychange").innerHTML="";
            document.getElementById("handsomechange").innerHTML="";
            document.getElementById("luckchange").innerHTML="";
            document.getElementById("ethicalchange").innerHTML="";
            endEvent();
        }
        else{
            document.getElementById("months").innerHTML = "第 "+monthnumber+" 個月";
            document.getElementById("intelligence").innerHTML = "智力: "+monthintelligence[count];
            document.getElementById("wealthy").innerHTML = "財富: "+monthweathly[count];
            document.getElementById("handsome").innerHTML = "顏值: "+monthhandsome[count];
            document.getElementById("luck").innerHTML = "幸運: "+monthluck[count];
            document.getElementById("ethical").innerHTML = "道德: "+monthethical[count];
            document.getElementById("happy").innerHTML = "快樂: "+monthhappy;
            document.getElementById('content').innerHTML = monthcontent[count];
            if(monthintelligence[count]-monthintelligence[count-1]>=0){
                document.getElementById("intelligencechange").innerHTML="  ( +"+(monthintelligence[count]-monthintelligence[count-1]+" )");
            }
            else{
                document.getElementById("intelligencechange").innerHTML="  ( "+(monthintelligence[count]-monthintelligence[count-1]+" )");
            }
            if(monthweathly[count]-monthweathly[count-1]>=0){
                document.getElementById("wealthychange").innerHTML="  ( +"+(monthweathly[count]-monthweathly[count-1]+" )");
            }
            else{
                document.getElementById("wealthychange").innerHTML="  ( "+(monthweathly[count]-monthweathly[count-1]+" )");
            }
            if(monthhandsome[count]-monthhandsome[count-1]>=0){
                document.getElementById("handsomechange").innerHTML="  ( +"+(monthhandsome[count]-monthhandsome[count-1]+" )");
            }
            else{
                document.getElementById("handsomechange").innerHTML="  ( "+(monthhandsome[count]-monthhandsome[count-1]+" )");
            }
            if(monthluck[count]-monthluck[count-1]>=0){
                document.getElementById("luckchange").innerHTML="  ( +"+(monthluck[count]-monthluck[count-1]+" )");
            }
            else{
                document.getElementById("luckchange").innerHTML="  ( "+(monthluck[count]-monthluck[count-1]+" )");
            }
            if(monthethical[count]-monthethical[count-1]>=0){
                document.getElementById("ethicalchange").innerHTML="  ( +"+(monthethical[count]-monthethical[count-1]+" )");
            }
            else{
                document.getElementById("ethicalchange").innerHTML="  ( "+(monthethical[count]-monthethical[count-1]+" )");
            }
        }
    }

    document.getElementById("month_last").addEventListener("click", lastmonth);
    function lastmonth(){
        monthnumber-=1;
        count-=1;
        if(monthnumber<=0){
        alert("時光不能繼續回朔了");
        }
        else{
            document.getElementById("months").innerHTML = "第 "+monthnumber+" 個月";
            document.getElementById("intelligence").innerHTML = "智力: "+monthintelligence[count];
            document.getElementById("wealthy").innerHTML = "財富: "+monthweathly[count];
            document.getElementById("handsome").innerHTML = "顏值: "+monthhandsome[count];
            document.getElementById("luck").innerHTML = "幸運: "+monthluck[count];
            document.getElementById("ethical").innerHTML = "道德: "+monthethical[count];
            document.getElementById("happy").innerHTML = "快樂: "+monthhappy;
        }
    }

    document.getElementById("month_skip").addEventListener('click',monthskip);
    function monthskip(){
        endEvent();
    }
    function endEvent(){
        //回傳數據，轉到下一頁
    }
</script>
@endsection