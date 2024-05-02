@extends('layouts.app')
@section('content')
<style>
    body {
        font-family: Arial, sans-serif;
        background-color: #f8f9fa;
        color: #333;
        margin: 0;
        padding: 0;
    }
    .container {
        max-width: 1400px;
        margin: 20px auto;
        padding: 20px;
        background-color:beige;
        border-radius: 8px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }
    .month_number{
        background-color:beige;
        font-size: 30px; 
    
    }
    .main_area {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-top: 20px;
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
        width:600px;
    }
    .attribute_change{
        font-size: 30px;
        font-family: 'Courier New', Courier, monospace;
        text-align: center;
        width: 150px;
    }
    .month_move_last{
       
        display: flex;
        align-items: center;
        text-align: center;
        width: 100px;
    }
    
    .month_move_next{
        display: flex;
        align-items: center;
        text-align: center;
        width: 100px;
    }
</style>
<?php 
    $count_number=0;
    foreach ($game_processes as $attribute) {
        
        $month_number[$count_number]= $attribute->month;
        $intelligence [$count_number]= $attribute->intelligence;
        $weathly[$count_number] = $attribute->wealth;
        $handsome[$count_number] = $attribute->appearance;
        $luck[$count_number] = $attribute->luck;
        $ethical[$count_number] = $attribute->morality;
        $happiness[$count_number] = $attribute->happiness;
        $event[$count_number] = $attribute->content;
        $count_number+=1;
    }
    
?>
<script type="text/javascript">
    var count=0;
    var monthnumber=1;
    var monthintelligence=@json($intelligence);
    var totalmonth=@json($count_number);
    var monthweathly=@json($weathly);
    var monthhandsome=@json($handsome);
    var monthluck=@json($luck);
    var monthethical=@json($ethical);
    var monthhappy=@json($happiness);
    var monthcontent=@json($event);
</script>

<div class="container">
            <div class="month_number" id="months">
                <p>第 1 個月</p>
            </div>
            <div class="main_area">
                <div class="month_move_last">
                    <button style="font-size:24px" id="month_last">上一月</button>
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
                        快樂: <script>document.write(monthhappy[0])</script>
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
                    <button style="font-size:24px" id="month_next">下一月</button>
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
            document.getElementById("happy").innerHTML = "快樂: "+monthhappy[count];
            document.getElementById('content').innerHTML = monthcontent[count];

            document.getElementById("intelligencechange").innerHTML="";
            document.getElementById("wealthychange").innerHTML="";
            document.getElementById("handsomechange").innerHTML="";
            document.getElementById("luckchange").innerHTML="";
            document.getElementById("ethicalchange").innerHTML="";
            document.getElementById("happychange").innerHTML="";
            endEvent();
        }
        else{
            document.getElementById("months").innerHTML = "第 "+monthnumber+" 個月";
            document.getElementById("intelligence").innerHTML = "智力: "+monthintelligence[count];
            document.getElementById("wealthy").innerHTML = "財富: "+monthweathly[count];
            document.getElementById("handsome").innerHTML = "顏值: "+monthhandsome[count];
            document.getElementById("luck").innerHTML = "幸運: "+monthluck[count];
            document.getElementById("ethical").innerHTML = "道德: "+monthethical[count];
            document.getElementById("happy").innerHTML = "快樂: "+monthhappy[count];
            document.getElementById('content').innerHTML = monthcontent[count];
            if(monthintelligence[count]-monthintelligence[count-1]>=0){
                document.getElementById("intelligencechange").innerHTML="   +"+(monthintelligence[count]-monthintelligence[count-1]);
                document.getElementById("intelligencechange").style.color='green';
            }
            else{
                document.getElementById("intelligencechange").innerHTML="   "+(monthintelligence[count]-monthintelligence[count-1]);
                document.getElementById("intelligencechange").style.color='red';
            }
            if(monthweathly[count]-monthweathly[count-1]>=0){
                document.getElementById("wealthychange").innerHTML="   +"+(monthweathly[count]-monthweathly[count-1]);
                document.getElementById("wealthychange").style.color = 'green';
            }
            else{
                document.getElementById("wealthychange").innerHTML="   "+(monthweathly[count]-monthweathly[count-1]);
                document.getElementById("wealthychange").style.color = 'red';
            }
            if(monthhandsome[count]-monthhandsome[count-1]>=0){
                document.getElementById("handsomechange").innerHTML="   +"+(monthhandsome[count]-monthhandsome[count-1]);
                document.getElementById('handsomechange').style.color = 'green';
            }
            else{
                document.getElementById("handsomechange").innerHTML="   "+(monthhandsome[count]-monthhandsome[count-1]);
                document.getElementById('handsomechange').style.color='red';
            }
            if(monthluck[count]-monthluck[count-1]>=0){
                document.getElementById("luckchange").innerHTML="   +"+(monthluck[count]-monthluck[count-1]);
                document.getElementById('luckchange').style.color= 'green';
            }
            else{
                document.getElementById("luckchange").innerHTML="   "+(monthluck[count]-monthluck[count-1]);
                document.getElementById('luckchange').style.color = 'red';
            }
            if(monthethical[count]-monthethical[count-1]>=0){
                document.getElementById("ethicalchange").innerHTML="   +"+(monthethical[count]-monthethical[count-1]);
                document.getElementById('ethicalchange').style.color = 'green';
            }
            else{
                document.getElementById("ethicalchange").innerHTML="   "+(monthethical[count]-monthethical[count-1]);
                document.getElementById('ethicalchange').style.color = 'red';
            }
            if(monthhappy[count]-monthhappy[count-1]>=0){
                document.getElementById("happychange").innerHTML = "   +"+(monthhappy[count]-monthhappy[count-1]);
                document.getElementById('happychange').style.color = 'green';
            }
            else{
                document.getElementById('happychange').innerHTML = "   "+(monthhappy[count]-monthhappy[count-1]);
                document.getElementById('happychange').style.color = 'red';
            }
        }
    }

    document.getElementById("month_last").addEventListener("click", lastmonth);
    function lastmonth(){
        monthnumber-=1;
        count-=1;
        if(monthnumber<=0){
        alert("時光不能繼續回朔了");
        monthnumber=1;
        count=0;
        }
        else{
            document.getElementById("months").innerHTML = "第 "+monthnumber+" 個月";
            document.getElementById("intelligence").innerHTML = "智力: "+monthintelligence[count];
            document.getElementById("wealthy").innerHTML = "財富: "+monthweathly[count];
            document.getElementById("handsome").innerHTML = "顏值: "+monthhandsome[count];
            document.getElementById("luck").innerHTML = "幸運: "+monthluck[count];
            document.getElementById("ethical").innerHTML = "道德: "+monthethical[count];
            document.getElementById("happy").innerHTML = "快樂: "+monthhappy[count];
            document.getElementById('content').innerHTML = monthcontent[count];
            if(monthnumber!=1){
                if(monthintelligence[count]-monthintelligence[count-1]>=0){
                document.getElementById("intelligencechange").innerHTML="   +"+(monthintelligence[count]-monthintelligence[count-1]);
                document.getElementById("intelligencechange").style.color='green';
                }
                else{
                    document.getElementById("intelligencechange").innerHTML="   "+(monthintelligence[count]-monthintelligence[count-1]);
                    document.getElementById("intelligencechange").style.color='red';
                }
                if(monthweathly[count]-monthweathly[count-1]>=0){
                    document.getElementById("wealthychange").innerHTML="   +"+(monthweathly[count]-monthweathly[count-1]);
                    document.getElementById("wealthychange").style.color = 'green';
                }
                else{
                    document.getElementById("wealthychange").innerHTML="   "+(monthweathly[count]-monthweathly[count-1]);
                    document.getElementById("wealthychange").style.color = 'red';
                }
                if(monthhandsome[count]-monthhandsome[count-1]>=0){
                    document.getElementById("handsomechange").innerHTML="   +"+(monthhandsome[count]-monthhandsome[count-1]);
                    document.getElementById('handsomechange').style.color = 'green';
                }
                else{
                    document.getElementById("handsomechange").innerHTML="   "+(monthhandsome[count]-monthhandsome[count-1]);
                    document.getElementById('handsomechange').style.color='red';
                }
                if(monthluck[count]-monthluck[count-1]>=0){
                    document.getElementById("luckchange").innerHTML="   +"+(monthluck[count]-monthluck[count-1]);
                    document.getElementById('luckchange').style.color= 'green';
                }
                else{
                    document.getElementById("luckchange").innerHTML="   "+(monthluck[count]-monthluck[count-1]);
                    document.getElementById('luckchange').style.color = 'red';
                }
                if(monthethical[count]-monthethical[count-1]>=0){
                    document.getElementById("ethicalchange").innerHTML="   +"+(monthethical[count]-monthethical[count-1]);
                    document.getElementById('ethicalchange').style.color = 'green';
                }
                else{
                    document.getElementById("ethicalchange").innerHTML="   "+(monthethical[count]-monthethical[count-1]);
                    document.getElementById('ethicalchange').style.color = 'red';
                }
                if(monthhappy[count]-monthhappy[count-1]>=0){
                    document.getElementById("happychange").innerHTML = "   +"+(monthhappy[count]-monthhappy[count-1]);
                    document.getElementById('happychange').style.color = 'green';
                }
                else{
                    document.getElementById('happychange').innerHTML = "   "+(monthhappy[count]-monthhappy[count-1]);
                    document.getElementById('happychange').style.color = 'red';
                }
            }
            else{
                document.getElementById("intelligencechange").innerHTML="";
                
                document.getElementById("wealthychange").innerHTML="";
            
                document.getElementById("handsomechange").innerHTML="";
            
                document.getElementById("luckchange").innerHTML="";
    
                document.getElementById("ethicalchange").innerHTML="";

                document.getElementById("happychange").innerHTML="";
            }
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