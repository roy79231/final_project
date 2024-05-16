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
use App\Models\User;

class GameController extends Controller
{
    //
    public function main(){
        return view('main');
    }
    public function achievement(Request $request) {
        // 檢索已解鎖的成就
        $unlockedAchievements = achievement_fins::where('user_id', $request->user()->id)
            ->with('achievement')
            ->get();
    
        // 檢索尚未解鎖的成就
        $lockedAchievements = achievement::whereNotIn('id', $unlockedAchievements->pluck('achievement_id'))
            ->get();
    
        // 將已解鎖的成就和尚未解鎖的成就合併，使已解鎖的成就顯示在最上面
        $achievements = $unlockedAchievements->merge($lockedAchievements);
    
        // 傳遞成就數據給視圖
        return view('achievement', ['achievements' => $achievements]);
    }

    public function post(){
        return view('post');
    }
    public function start(Request $request){
        return view('start');
    }
    
    public function addPoints(){
        return view('addPoints');
    }

    public function run(Request $request){
        //基本資料
        $user_id = auth()->user()->id;
        $intelligence = $request->intelligence;
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
                    'content'=>$event->content,
                    'achievement_id'=>-1//timlin新增
                ]);
                    $month+=1;
                    continue;
                    
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
                        'achievement_id'=>-1
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
                    'content'=>$event->content,
                    'achievement_id'=>-1
                ]);
                    $month+=1;
                    
                    continue;
                }
            }
            if($intelligence<10){ //智力  低於10觸發 有3%因這個死亡
                $survive_rate = rand(1,100);
                if($survive_rate<=3){
                    $alive =false;
                    $death_way = 'intelligence';
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
                        'achievement_id'=>-1
                    ]);
                    
                    break;
                }
                else if(rand(1,10)<=5){

                    $special_event = special_event::where('name',"intelligence")->get(); //把加分事件的名字用屬性做區分 
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
                    'achievement_id'=>-1
                ]);
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
                        'achievement_id'=>-1
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
                    'content'=>$event->content,
                    'achievement_id'=>-1,
                ]);
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
                        'achievement_id'=>-1
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
                    'content'=>$event->content,
                    'achievement_id'=>-1,
                ]);
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
                        'achievement_id'=>-1,
                    ]);
                    
                    break;
                }
                else if(rand(1,10)<=5){

                    $special_event = special_event::where('name',"luck")->get(); //把加分事件的名字用屬性做區分 
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
                    'achievement_id'=>-1,
                ]);
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
                    'achievement_id'=>-1,
                ]);
                
                break;
            }
            //事件
            $event_kind = rand(1,100);
            if($event_kind<=60){
                //大一下~大四上
                if(($month>=7 && $month<=11) || ($month>=13 && $month<=17) || ($month>=19 && $month<=23) || ($month>=25 && $month<=29) || ($month>=31 && $month<=35) || ($month>=37 && $month<=41)){
                    $normal_event = normal_event::where('time_type','0')->get();
                }
                //大一上
                else if($month>=1 && $month<=5){
                    $normal_event = normal_event::where('time_type','1')->get();
                }
                //畢業前
                else if($month>=43 && $month<=47){
                    $normal_event = normal_event::where('time_type','2')->get();
                }
                //寒假
                else if($month == 6 || $month == 18 || $month == 30 || $month == 42){
                    $normal_event = normal_event::where('time_type','3')->get();
                }
                //暑假
                else if($month == 12 || $month == 24 || $month == 36){
                    $normal_event = normal_event::where('time_type','4')->get();
                }
                //畢業
                else if($month == 48){
                    $normal_event = normal_event::where('time_type','5')->get();
                }
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
                    'achievement_id'=>-1,//timlin新增
                ]);
                
            }else if($event_kind>60 && $event_kind<=90){
                //大一下~大四上
                if(($month>=7 && $month<=11) || ($month>=13 && $month<=17) || ($month>=19 && $month<=23) || ($month>=25 && $month<=29) || ($month>=31 && $month<=35) || ($month>=37 && $month<=41)){
                    $special_event = special_event::where('time_type','0')->where('name','random')->get();
                }
                //大一上
                else if($month>=1 && $month<=5){
                    $special_event = special_event::where('time_type','1')->where('name','random')->get();
                }
                //畢業前
                else if($month>=43 && $month<=47){
                    $special_event = special_event::where('time_type','2')->where('name','random')->get();
                }
                //寒假
                else if($month == 6 || $month == 18 || $month == 30 || $month == 42){
                    $special_event = special_event::where('time_type','3')->where('name','random')->get();
                }
                //暑假
                else if($month == 12 || $month == 24 || $month == 36){
                    $special_event = special_event::where('time_type','4')->where('name','random')->get();
                }
                //畢業
                else if($month == 48){
                    $special_event = special_event::where('time_type','5')->where('name','random')->get();
                }
                //timlin : 我在這邊把事件名稱改成random 要記得改資料庫不然跑不動
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
                    'intelligence'=>$intelligence + $event->intelligence,
                    'appearance'=> $appearance + $event->appearance,
                    'wealth'=> $wealth + $event->wealth,
                    'luck'=>$luck + $event->luck,
                    'happiness'=>$happiness + $event->happiness,
                    'morality'=>$morality + $event->morality,
                    'content'=>$event->content,
                    'achievement_id'=>-1,
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
                    'achievement_id'=>$event->achievement_id,//timlin新增
                ]);
                array_push($accomplish_achievements ,$event->achievement_id);
            }
        };
        //這個foreach有問題要修 已解決
        if(!empty($accomplish_achievements)){
            for($i=0;$i<count($accomplish_achievements);$i++){
                
                    achievement_fins::create([
                        'user_id'=> $user_id,
                        'achievement_id'=> $accomplish_achievements[$i],
                    ]);
                
            };
        }
        $game_processes = game_process::where('user_id',$user_id)->get();
        return view('monthlyevent',[
            'game_processes' => $game_processes,
            'accomplish_achievements' => $accomplish_achievements,
        ]);
    }
    public function finish(){
        //清process和ending資料
        $user_id = auth()->user()->id;
        $last_month = game_process::where('user_id',$user_id)->latest('created_at')->value('month');
        $make_end = game_process::where('user_id',$user_id)->where('month',$last_month)->get();
        $game_delete = game_process::where('user_id',$user_id)->delete();
        $end_delete = game_ending::where('user_id',$user_id)->delete();
        //準備ending
        $intelligence = $make_end->intelligence;
        $wealth = $make_end->wealth;
        $appearance = $make_end->appearance;
        $luck = $make_end->luck;
        $morality = $make_end->morality;
        $happiness = $make_end->happiness;
        $accomplish_achievements = $make_end->accomplish_achievements;
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
        return view('finish',[
            'end'=> $end,
        ]);
    }
}
//時間的優先級最高
/*time_type :
0 : 其他(大一下~大四上)
1 : 大一上(入學)
2 : 大四下(畢業前)(如果不想讓他們畢業可以在這裡操作)
3 : 寒假(全部一起)
4 : 暑假(全部一起)
5 : 畢業
6 : 大岩壁
*/