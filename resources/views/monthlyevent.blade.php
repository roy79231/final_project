@extends('layouts.app')
@section('content')
<style>
    /* body {
        font-family: Arial, sans-serif;
        background-color: #f8f9fa;
        color: #333;
        margin: 0;
        padding: 0;
       
    }  */
    .timlincontainer {
        font-family:;
        max-width: 1400px;
        margin: 20px auto;
        padding: 20px;
        background-color:rgb(237, 218, 191);
        border-radius: 15px;
        box-shadow: 0 0 10px rgba(0, 0, 0,0.7);
    }
    .link-buttom{
        /*底線*/
        width: 100%;
        height:2px;
        border-top: solid #0b0b0b 2px;
    }
    .month_number{
        background-color:rgb(237, 218, 191);
        font-size: 30px; 
        padding-left: 100px;
        
    }
    .main_area {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-top: 20px;
    }
    .month_attribute{
        font-size: 30px;
        text-align:left ;
        width: 350px;
        padding-left: 150px;
    }
    .attribute_change{
        font-size: 30px;
        text-align: center;
        width: 150px;
        padding-right: 20px;
    }
    .month_content{
        text-align: center;
        font-size: 20px;
        font-family: Arial, Helvetica, sans-serif;
        width:550px;
        padding-right:20px: 
    }
    .triangle-button-left {
        border-color: transparent #e1b33f transparent transparent;
        border-style: solid solid solid solid;
        border-width: 50px;
        background-color: transparent;
        /* 設定 width、height 可更好理解原理 */
        height: 0px;
        width: 0px;

    }
    .triangle-button-left:hover{
        border-color: transparent #f4b311 transparent transparent;
        border-style: solid solid solid solid;
        border-width: 50px;
        background-color: transparent;
    }
    .triangle-button-right {
        border-color: transparent transparent transparent  #e1b33f;
        border-style: solid solid solid solid;
        border-width: 50px;
        background-color: transparent;
        /* 設定 width、height 可更好理解原理 */
        height: 0px;
        width: 0px;

    }
    .triangle-button-right:hover{
        border-color: transparent transparent transparent  #f4b311 ;
        border-style: solid solid solid solid;
        border-width: 50px;
        background-color: transparent;
    } 
    .footer{
        display: flex;
    }
    .month_move_skip{
        text-align: end;
        padding-right:20px; 
        height:30px;
    }
    input{
        text-align: center;
        font-size:25px;
        border:0;
        background-color:#ddb143;
        color: #fff;
        border-radius: 40px;
        cursor: pointer;
    }
    input:hover{
        color:#ddb143;
        background-color:#fff;
        border:2px solid;
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
        $achievement_id[$count_number] = $attribute->achievement_id;
        $count_number+=1;
    }
    //dd($achievement);
    $achievement_content=[];
    for($i=0;$i<$count_number;$i++){
        $flag = 0;
        foreach($achievement as $detail){
            if($detail->id == $achievement_id[$i] ){
                $achievement_content[$i]=$detail->name;
                $flag = 1;
                break;
            }
        }
        if($flag==0){
            $achievement_content[$i]="雞雞";
        }
    }
    //dd($achievement_content);
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
    var achievement_content = @json($achievement_content);
    var achievement_id = @json($achievement_id);
    
</script>

<div class="timlincontainer">
            <div class="month_number" id="months">
                <p>第 1 個月</p>
            </div>
            <div class="link-buttom"></div>

            <div class="main_area">
                <div class="month_move_last" >
                    <button style="font-size:24px" class="triangle-button-left" id="month_last"></button>
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
                    <button style="font-size:30px" class="triangle-button-right" id="month_next"></button>
                </div>
                
            </div>
            
            <div class="month_move_skip">
                <form action="{{ route("finish") }}" method="GET">
                    @csrf
                    <input type="submit" value="跳過嗎?" name="month_skip">
                </form>
            </div>
            
</div>
<script>
    document.getElementById("month_next").addEventListener("click", nextmonth);
    function nextmonth(){
        monthnumber+=1;
        count+=1;
        if(monthnumber<=totalmonth){
            document.getElementById("months").innerHTML = "第 "+monthnumber+" 個月";
            document.getElementById("intelligence").innerHTML = "智力:     "+monthintelligence[count];
            document.getElementById("wealthy").innerHTML = "財富:     "+monthweathly[count];
            document.getElementById("handsome").innerHTML = "顏值:     "+monthhandsome[count];
            document.getElementById("luck").innerHTML = "幸運:     "+monthluck[count];
            document.getElementById("ethical").innerHTML = "道德:     "+monthethical[count];
            document.getElementById("happy").innerHTML = "快樂:     "+monthhappy[count];
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
            if(achievement_content[count]!="雞雞"){
                setTimeout(3000);
                alert("觸發成就:"+achievement_content[count]);
            }
        }
        else if(monthnumber>totalmonth){
                //導向結算頁面
            
                window.location.href='/final_project/public/index.php/finish';
                
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
            document.getElementById("intelligence").innerHTML = "智力:     "+monthintelligence[count];
            document.getElementById("wealthy").innerHTML = "財富:     "+monthweathly[count];
            document.getElementById("handsome").innerHTML = "顏值:     "+monthhandsome[count];
            document.getElementById("luck").innerHTML = "幸運:     "+monthluck[count];
            document.getElementById("ethical").innerHTML = "道德:     "+monthethical[count];
            document.getElementById("happy").innerHTML = "快樂:     "+monthhappy[count];
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
</script>
@endsection