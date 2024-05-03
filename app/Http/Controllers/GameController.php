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
        
        //先確定清空資料 有問題不能正確清空資料
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
            }
            if(rand(1,100) <= 2 ){
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
                $rand_range = normal_event::all()->count();
                $event_id = rand(1,$rand_range);
                $event = normal_event::find($event_id);
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
                $rand_range = special_event::all()->count();
                $event_id = rand(1,$rand_range);
                $event = special_event::find($event_id);
                game_process::create([
                    'user_id'=>$user_id,
                    'month'=>$month,
                    'intelligence'=>$intelligence + $event->intelligence,
                    'appearance'=> $appearance + $event->appearance,
                    'wealth'=> $wealth + $event->wealth,
                    'luck'=>$luck + $event->luck,
                    'happiness'=>$happiness + $event->happiness,
                    'morality'=>$morality + $event->morality,
                    'content'=>$event->content,
                ]);
            }else{
                $rand_range = achievement_event::all()->count();
                $event_id = rand(1,$rand_range);
                $event = achievement_event::find($event_id);
                game_process::create([
                    'user_id'=>$user_id,
                    'month'=>$month,
                    'intelligence'=>$intelligence + $event->intelligence,
                    'appearance'=> $appearance + $event->appearance,
                    'wealth'=> $wealth + $event->wealth,
                    'luck'=>$luck + $event->luck,
                    'happiness'=>$happiness + $event->happiness,
                    'morality'=>$morality + $event->morality,
                    'content'=>$event->content,
                ]);
                $accomplish_achievements[] = $event->achievement_id;
            }
            $month+=1;
        };
        //這個foreach有問題要修
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
