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
use App\Models\User;


class GameController extends Controller
{
    //
    public function main(){
        return view('main');
    }
    public function achievement(Request $request){
        // Retrieve achievements for the given user_id
        
        $achievements = achievement_fins::where('user_id', $request->user()->id)->with('achievement')->get();
        // Pass achievements data to the view
        return view('achievement', ['achievements' => $achievements]);    
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
    public function run(Request $request){
        //基本資料
        $user_id = auth()->user()->id;
        $intellengence = $request->intellengence;
        $wealth = $request->wealth;
        $appearance = $request->appearance;
        $luck = $request->luck;
        $morality = $request->morality;
        $happiness = $request->happiness;
        $talent = talent::find($request->talent_id);
        $month = 1;
        $alive = true;
        $accomplish_achievements = [];
        //加上talent數值
        $intellengence += $talent->intellengence;
        $wealth += $talent->wealth;
        $appearance += $talent->appearance;
        $luck += $talent->luck;
        $morality += $talent->morality;
        $happiness += $talent->happiness;
        //先確定清空資料
        $game_delete = game_process::where('user_id',$user_id)->get();
        $game_delete->delete();
        //跑每個月
        while($month<=48 && $alive==true){
            //死亡的部分
            $survive_rate = 100;
            $death_way = '';
            if($wealth<10){ //財富  低於10觸發 有3%因這個死亡
                $survive_rate = rand(1,100);
                if($survive_rate<=3){
                    $alive =false;
                    $death_way = 'wealth';
                }
            }
            if($appearance<10){ //外貌  低於10觸發 有3%因這個死亡
                $survive_rate = rand(1,100);
                if($survive_rate<=3){
                    $alive =false;
                    $death_way = 'appearance';
                }
            }
            if($intellengence<10){ //智力  低於10觸發 有3%因這個死亡
                $survive_rate = rand(1,100);
                if($survive_rate<=3){
                    $alive =false;
                    $death_way = 'intellengence';
                }
            }
            if($morality<10){ //道德   低於10觸發 有3%因這個死亡
                $survive_rate = rand(1,100);
                if($survive_rate<=3){
                    $alive =false;
                    $death_way = 'morality';
                }
            }
            if($happiness<10){ //快樂  低於10觸發 有3%因這個死亡
                $survive_rate = rand(1,100);
                if($survive_rate<=3){
                    $alive =false;
                    $death_way = 'happiness';
                }
            }
            if($luck<10){ //運氣  低於10觸發 有3%因這個死亡
                $survive_rate = rand(1,100);
                if($survive_rate<=3){
                    $alive =false;
                    $death_way = 'luck';
                }
            }
            if(rand(1,100) <= 2 ){
                $alive = false;
                $death_way = 'accident';
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
                    'intellengence'=>$intellengence,
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
                    'intellengence'=>$intellengence + $event->intellengence,
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
                    'intellengence'=>$intellengence + $event->intellengence,
                    'appearance'=> $appearance + $event->appearance,
                    'wealth'=> $wealth + $event->wealth,
                    'luck'=>$luck + $event->luck,
                    'happiness'=>$happiness + $event->happiness,
                    'morality'=>$morality + $event->morality,
                    'content'=>$event->content,
                ]);
                $accomplish_achievements = $event->achievement_id;
            }
        };
        foreach($accomplish_achievements as $accomplish){
            achievement_fins::create([
                'user_id'=> $user_id,
                'achievement_id'=> $accomplish,
            ]);
        };
        $game_processes = game_process::where('user_id',$user_id)->get();
        return view('tim的',[
            'game_processes' => $game_processes,
            'accomplish_achievements' => $accomplish_achievements,
        ]);
    }
    public function make_end(Request $request){
        //清process和ending資料
        $user_id = auth()->user()->id;
        $game_delete = game_process::where('user_id',$user_id)->get();
        $game_delete->delete();
        $end_delete = game_ending::where('user_id',$user_id)->get();
        $end_delete->delete();
        //準備ending
        $intellengence = $request->intellengence;
        $wealth = $request->wealth;
        $appearance = $request->appearance;
        $luck = $request->luck;
        $morality = $request->morality;
        $happiness = $request->happiness;
        $accomplish_achievements = $request->accomplish_achievements;
        game_ending::create([
            'user_id'=>$user_id,
            'intellengence'=>$intellengence,
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
