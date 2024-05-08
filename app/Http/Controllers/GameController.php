<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\achievement;
use App\Models\game_ending;
use App\Models\game_process;
use App\Models\normal_event;
use App\Models\special_event;
use App\Models\talent;
use App\Models\achievement_event;
use App\Models\achievement_fins;
use App\Models\dead_event;

class GameController extends Controller
{
    
    public function main(){
        return view('main');
    }
    public function achievement(){
        return view('achievement');
    }
    public function post(){
        return view('post');
    }
    public function start(){
        return view('start');
    }
    
    public function finish(){
        return view('finish');
    }
    //注意dead event中的way指的是 哪像屬性(intelligence 之類的)
    public function run(Request $request){
        //基本資料
        $user_id = auth()->user()->id;
        $intelligence = $request->intelligence;
        $wealth = $request->wealth;
        $appearance = $request->appearance;
        $luck = $request->luck;
        $morality = $request->morality;
        $happiness =15;
        $talent = talent::find($request->talent_id);
        $month = 1;
        $alive = true;
        $accomplish_achievements = [];
        //加上talent數值
        
        $intelligence += $talent->intelligence;
        $wealth += $talent->wealth;
        $appearance += $talent->appearance;
        $luck += $talent->luck;
        $morality += $talent->morality;
        $happiness += $talent->happiness;
        
        //先確定清空資料 有問題不能正確清空資料 已解決
        $game_delete = game_process::where('user_id',$user_id)->delete();
        
        //跑每個月
        while($month<=48 && $alive==true){
            //死亡的部分
            $survive_rate = 100;
            $death_way = '';
            if($wealth<10){ //財富  低於10觸發 有3%因這個死亡
                $survive_rate = rand(1,100);
                if($survive_rate<=3){
                    $alive =false;
                    $death_way = dead_event::DIE_WEALTH;
                    $dieEvent = dead_event::where('way',$death_way)->get();
                    $randomDie = $dieEvent->random();
                    game_process::create([
                        'user_id'=>$user_id,
                        'month'=>$month,
                        'intelligence'=>$intelligence,
                        'appearance'=> $appearance,
                        'wealth'=> $wealth,
                        'luck'=>$luck,
                        'happiness'=>$happiness,
                        'morality'=>$morality,
                        'content'=>$randomDie->content,
                    ]);
                    break;
                }
                /*timlin: 
                我在這邊可以多寫一個else用來寫特定屬性的加分事件
                就是如果他沒有死掉，就50%會繼續做扣該屬性的事件 有個問題是:如果他的屬性都很平均，就必須用原本的隨機特殊事件做分數的變動
                
                我認為事件需要一點前應後果，假設他初始道德是2，那就算他沒有依此直接死亡，那也應該遵循他現在的過低的道德屬性來給他事件
                
                加分事件可以大致分成兩大項 
                1.因為某項屬性過低而執行的"特定數性加分事件"
                2.內容相較於前者更加隨機的"隨機加分事件"
                */
                
                else if(rand(1,10)<=5){     
                    //timlin:注意!! 我在這邊的name是加分事件的name對應到特定屬性 (像是intelligence)
                    $special_event = special_event::where('name',"wealth")->get(); //把加分事件的名字用屬性做區分 還沒想出更好的分類方式
                    $event = $special_event->random();
                    $intelligence = $intelligence + $event->intelligence;
                    $appearance = $appearance + $event->appearance;
                    $wealth = $wealth + $event->wealth;
                    $luck = $luck + $event->luck;
                    $happiness = $happiness + $event->happiness;
                    $morality = $morality + $event->morality;
                    game_process::create([
                    'user_id'=>$user_id,
                    'month'=>$month,
                    'intelligence'=>$intelligence,
                    'appearance'=> $appearance,
                    'wealth'=> $wealth,
                    'luck'=>$luck,
                    'happiness'=>$happiness,
                    'morality'=>$morality,
                    'content'=>$event->content,]);
                    $month+=1;
                    continue;
                    //timln:我改到這邊 試試看
                }
                
            }
            if($appearance<10){ //外貌  低於10觸發 有3%因這個死亡
                $survive_rate = rand(1,100);
                if($survive_rate<=3){
                    $alive =false;
                    $death_way = dead_event::DIE_APPEARANCE;
                    $dieEvent = dead_event::where('way',$death_way)->get();
                    $randomDie = $dieEvent->random();
                    game_process::create([
                        'user_id'=>$user_id,
                        'month'=>$month,
                        'intelligence'=>$intelligence,
                        'appearance'=> $appearance,
                        'wealth'=> $wealth,
                        'luck'=>$luck,
                        'happiness'=>$happiness,
                        'morality'=>$morality,
                        'content'=>$randomDie->content,
                    ]);
                    break;
                }
                else if(rand(1,10)<=5){     
                    
                    $special_event = special_event::where('name',"appearance")->get(); //把加分事件的名字用屬性做區分 還沒想出更好的分類方式
                    $event = $special_event->random();
                    $intelligence = $intelligence + $event->intelligence;
                    $appearance = $appearance + $event->appearance;
                    $wealth = $wealth + $event->wealth;
                    $luck = $luck + $event->luck;
                    $happiness = $happiness + $event->happiness;
                    $morality = $morality + $event->morality;
                    game_process::create([
                    'user_id'=>$user_id,
                    'month'=>$month,
                    'intelligence'=>$intelligence,
                    'appearance'=> $appearance,
                    'wealth'=> $wealth,
                    'luck'=>$luck,
                    'happiness'=>$happiness,
                    'morality'=>$morality,
                    'content'=>$event->content,]);//timln:我改到這邊 試試看
                    $month+=1;
                    continue;
                }
            }
            if($intelligence<10){ //智力  低於10觸發 有3%因這個死亡
                $survive_rate = rand(1,100);
                if($survive_rate<=3){
                    $alive =false;
                    $death_way = dead_event::DIE_INTELLIGENCE;
                    $dieEvent = dead_event::where('way',$death_way)->get();
                    $randomDie = $dieEvent->random();
                    game_process::create([
                        'user_id'=>$user_id,
                        'month'=>$month,
                        'intelligence'=>$intelligence,
                        'appearance'=> $appearance,
                        'wealth'=> $wealth,
                        'luck'=>$luck,
                        'happiness'=>$happiness,
                        'morality'=>$morality,
                        'content'=>$randomDie->content,
                    ]);
                    break;
                }
                else if(rand(1,10)<=5){     
                    
                    $special_event = special_event::where('name',"intelligence")->get(); //把加分事件的名字用屬性做區分 還沒想出更好的分類方式
                    $event = $special_event->random();
                    $intelligence = $intelligence + $event->intelligence;
                    $appearance = $appearance + $event->appearance;
                    $wealth = $wealth + $event->wealth;
                    $luck = $luck + $event->luck;
                    $happiness = $happiness + $event->happiness;
                    $morality = $morality + $event->morality;
                    game_process::create([
                    'user_id'=>$user_id,
                    'month'=>$month,
                    'intelligence'=>$intelligence,
                    'appearance'=> $appearance,
                    'wealth'=> $wealth,
                    'luck'=>$luck,
                    'happiness'=>$happiness,
                    'morality'=>$morality,
                    'content'=>$event->content,]);//timln:我改到這邊 試試看
                    $month+=1;
                    continue;
                }
            }
            if($morality<10){ //道德   低於10觸發 有3%因這個死亡
                $survive_rate = rand(1,100);
                if($survive_rate<=3){
                    $alive =false;
                    $death_way = dead_event::DIE_MORALITY;
                    $dieEvent = dead_event::where('way',$death_way)->get();
                    $randomDie = $dieEvent->random();
                    game_process::create([
                        'user_id'=>$user_id,
                        'month'=>$month,
                        'intelligence'=>$intelligence,
                        'appearance'=> $appearance,
                        'wealth'=> $wealth,
                        'luck'=>$luck,
                        'happiness'=>$happiness,
                        'morality'=>$morality,
                        'content'=>$randomDie->content,
                    ]);
                    break;
                }
                else if(rand(1,10)<=5){     
                    
                    $special_event = special_event::where('name',"morality")->get(); //把加分事件的名字用屬性做區分 還沒想出更好的分類方式
                    $event = $special_event->random();
                    $intelligence = $intelligence + $event->intelligence;
                    $appearance = $appearance + $event->appearance;
                    $wealth = $wealth + $event->wealth;
                    $luck = $luck + $event->luck;
                    $happiness = $happiness + $event->happiness;
                    $morality = $morality + $event->morality;
                    game_process::create([
                    'user_id'=>$user_id,
                    'month'=>$month,
                    'intelligence'=>$intelligence,
                    'appearance'=> $appearance,
                    'wealth'=> $wealth,
                    'luck'=>$luck,
                    'happiness'=>$happiness,
                    'morality'=>$morality,
                    'content'=>$event->content,]);//timln:我改到這邊 試試看
                    $month+=1;
                    continue;
                }
            }
            if($happiness<10){ //快樂  低於10觸發 有3%因這個死亡
                $survive_rate = rand(1,100);
                if($survive_rate<=3){
                    $alive =false;
                    $death_way = dead_event::DIE_HAPPINESS;
                    $dieEvent = dead_event::where('way',$death_way)->get();
                    $randomDie = $dieEvent->random();
                    game_process::create([
                        'user_id'=>$user_id,
                        'month'=>$month,
                        'intelligence'=>$intelligence,
                        'appearance'=> $appearance,
                        'wealth'=> $wealth,
                        'luck'=>$luck,
                        'happiness'=>$happiness,
                        'morality'=>$morality,
                        'content'=>$randomDie->content,
                    ]);
                    break;
                }
                else if(rand(1,10)<=5){     
                    
                    $special_event = special_event::where('name',"happiness")->get(); //把加分事件的名字用屬性做區分 還沒想出更好的分類方式
                    $event = $special_event->random();
                    $intelligence = $intelligence + $event->intelligence;
                    $appearance = $appearance + $event->appearance;
                    $wealth = $wealth + $event->wealth;
                    $luck = $luck + $event->luck;
                    $happiness = $happiness + $event->happiness;
                    $morality = $morality + $event->morality;
                    game_process::create([
                    'user_id'=>$user_id,
                    'month'=>$month,
                    'intelligence'=>$intelligence,
                    'appearance'=> $appearance,
                    'wealth'=> $wealth,
                    'luck'=>$luck,
                    'happiness'=>$happiness,
                    'morality'=>$morality,
                    'content'=>$event->content,]);//timln:我改到這邊 試試看
                    $month+=1;
                    continue;
                }
            }
            if($luck<10){ //運氣  低於10觸發 有3%因這個死亡
                $survive_rate = rand(1,100);
                if($survive_rate<=3){
                    $alive =false;
                    $death_way = dead_event::DIE_LUCK;
                    $dieEvent = dead_event::where('way',$death_way)->get();
                    $randomDie = $dieEvent->random();
                    game_process::create([
                        'user_id'=>$user_id,
                        'month'=>$month,
                        'intelligence'=>$intelligence,
                        'appearance'=> $appearance,
                        'wealth'=> $wealth,
                        'luck'=>$luck,
                        'happiness'=>$happiness,
                        'morality'=>$morality,
                        'content'=>$randomDie->content,
                    ]);
                    break;
                }
                else if(rand(1,10)<=5){     
                    
                    $special_event = special_event::where('name',"luck")->get(); //把加分事件的名字用屬性做區分 還沒想出更好的分類方式
                    $event = $special_event->random();
                    $intelligence = $intelligence + $event->intelligence;
                    $appearance = $appearance + $event->appearance;
                    $wealth = $wealth + $event->wealth;
                    $luck = $luck + $event->luck;
                    $happiness = $happiness + $event->happiness;
                    $morality = $morality + $event->morality;
                    game_process::create([
                    'user_id'=>$user_id,
                    'month'=>$month,
                    'intelligence'=>$intelligence,
                    'appearance'=> $appearance,
                    'wealth'=> $wealth,
                    'luck'=>$luck,
                    'happiness'=>$happiness,
                    'morality'=>$morality,
                    'content'=>$event->content,]);//timln:我改到這邊 試試看
                    $month+=1;
                    continue;
                }
            }
            if(rand(1,100) <= 2 ){//tumlin: 這便建議直接把意外事件改成幸運事件
                $alive = false;
                $death_way = dead_event::DIE_ACCIDENT;
                $dieEvent = dead_event::where('way',$death_way)->get();
                $randomDie = $dieEvent->random();
                game_process::create([
                    'user_id'=>$user_id,
                    'month'=>$month,
                    'intelligence'=>$intelligence,
                    'appearance'=> $appearance,
                    'wealth'=> $wealth,
                    'luck'=>$luck,
                    'happiness'=>$happiness,
                    'morality'=>$morality,
                    'content'=>$randomDie->content,
                ]);
                break;
            }
            //事件
            $event_kind = rand(1,100);
            if($event_kind<=60){
                $normal_event = normal_event::all();
                $event = $normal_event->random(); 
                game_process::create([
                    'user_id'=>$user_id,
                    'month'=>$month,
                    'intelligence'=>$intelligence,
                    'appearance'=> $appearance,
                    'wealth'=> $wealth,
                    'luck'=>$luck,
                    'happiness'=>$happiness,
                    'morality'=>$morality,
                    'content'=>$event->content,
                ]);
            }else if($event_kind>60 && $event_kind<=90){
                //timlin : 我在這邊把事件名稱改成random 要記得改資料庫不然跑不動
                $special_event = special_event::where('name','random')->get();
                $event = $special_event->random();
                $intelligence = $intelligence + $event->intelligence;
                $appearance = $appearance + $event->appearance;
                $wealth = $wealth + $event->wealth;
                $luck = $luck + $event->luck;
                $happiness = $happiness + $event->happiness;
                $morality = $morality + $event->morality;
                game_process::create([
                    'user_id'=>$user_id,
                    'month'=>$month,
                    'intelligence'=>$intelligence,
                    'appearance'=> $appearance,
                    'wealth'=> $wealth,
                    'luck'=>$luck,
                    'happiness'=>$happiness,
                    'morality'=>$morality,
                    'content'=>$event->content,
                ]);
            }else{
                $achievement_event = achievement_event::all();
                $event = $achievement_event->random();
                $intelligence = $intelligence + $event->intelligence;
                $appearance = $appearance + $event->appearance;
                $wealth = $wealth + $event->wealth;
                $luck = $luck + $event->luck;
                $happiness = $happiness + $event->happiness;
                $morality = $morality + $event->morality;
                game_process::create([
                    'user_id'=>$user_id,
                    'month'=>$month,
                    'intelligence'=>$intelligence,
                    'appearance'=> $appearance,
                    'wealth'=> $wealth,
                    'luck'=>$luck,
                    'happiness'=>$happiness ,
                    'morality'=>$morality,
                    'content'=>$event->content,
                ]);
                $accomplish_achievements[] = $event->achievement_id;
            }
            $month+=1;
        };
        //這個foreach有問題要修 已解決
        if(!empty($accomplish_achievements)){
            foreach($accomplish_achievements as $accomplish){
                achievement_fins::create([
                    'user_id'=> $user_id,
                    'achievement_id'=> $accomplish,
                ]);
            };
        }
        $game_processes = game_process::where('user_id',$user_id)->get();
        return view('monthlyevent',[//timlin:我在這裡牽到monthlyevent
            'game_processes' => $game_processes,
            'accomplish_achievements' => $accomplish_achievements,
        ]);
    }
    public function make_end(Request $request){
        //清process和ending資料
        $user_id = auth()->user()->id;
        $game_delete = game_process::where('user_id',$user_id)->delete();
        $end_delete = game_ending::where('user_id',$user_id)->delete();
        //準備ending
        $intelligence = $request->intelligence;
        $wealth = $request->wealth;
        $appearance = $request->appearance;
        $luck = $request->luck;
        $morality = $request->morality;
        $happiness = $request->happiness;
        $accomplish_achievements = $request->accomplish_achievements;
        game_ending::create([
            'user_id'=>$user_id,
            'intelligence'=>$intelligence,
            'appearance'=> $appearance,
            'wealth'=> $wealth,
            'luck'=>$luck,
            'happiness'=>$happiness,
            'morality'=>$morality,
            'achievements_id'=>$accomplish_achievements,
        ]);
        $end = game_ending::where('user_id',$user_id)->get();
        return view('liang的',[
            'end'=> $end,
        ]);
    }
}
//時間的優先級最高
/*time_type :
0 : 隨時都會發生
1 : 大一上會發生
2 : 大一寒假
3 : 大一下
4 : 大一升大二暑假
5 : 大二上
6 : 大二寒假
7 : 大二下
8 : 大二升大三暑假
9 : 大三上
10 : 大三寒假
11 : 大三下
12 : 大三升大四暑假
13 : 大四上
14 : 大四寒假
15 : 大四下
16 : 畢業
*/