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
use App\Models\game_endings;
use App\Models\User;

class GameController extends Controller
{
    //
    public function main(){
        return view('main');
    }
    public function achievement(Request $request)
    {
    // 檢索已解鎖的成就
    $unlockedAchievements = achievement_fins::where('user_id', $request->user()->id)
        ->with('achievement')
        ->get();

    // 檢索尚未解鎖的成就
    $lockedAchievements = achievement::whereNotIn('id', $unlockedAchievements->pluck('achievement_id'))
        ->get();
    
    
    // 傳遞成就數據給視圖
    return view('achievement', [
        'unlockedAchievements' => $unlockedAchievements,
        'lockedAchievements' => $lockedAchievements
    ]);
    
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
        $intelligence = intval($request->intelligence);
        $wealth = intval($request->wealth);
        $appearance = intval($request->appearance);
        $luck = intval($request->luck);
        $morality = intval($request->morality);
        $talent_id = intval($request->talent);
        $happiness = 0;
        $talent = talent::where('id',$talent_id)->first();     
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
        $end_delete = game_ending::where('user_id',$user_id)->delete();
        //跑每個月
        while($month<=48 && $alive==true){
            //死亡的部分
            $survive_rate = 100;
            $death_way = '';
            $dead_event = [];
            $extend_event = [];

            if($month==1){
                game_process::create([
                    'user_id'=>$user_id,
                    'month'=>$month,
                    'intelligence'=>$intelligence,
                    'appearance'=> $appearance,
                    'wealth'=> $wealth,
                    'luck'=>$luck,
                    'happiness'=>$happiness,
                    'morality'=>$morality,
                    'content'=>"恭喜你!
                    在經歷了殘酷的學測和分科後，你成功進到中央大學了(你很棒棒!)
                    你決定在這開始璀璨的大學生活(自我評語:我的未來是一片光明阿哈哈哈哈)。",
                    'achievement_id'=>-1,
                ]);
                $month += 1;
                continue;
            }

            if($wealth<8){
                $dead_event[] = "wealth";
                $extend_event[] = "wealth";
            }
            if($appearance<8){
                $dead_event[] = "appearance";
                $extend_event[] = "appearance";
            } 
            if($intelligence<8){
                $dead_event[] = "intelligence";
                $extend_event[] = "intelligence";
            }
            if($morality<8){
                $dead_event[] = "morality";
                $extend_event[] = "morality";
            }
            if($happiness<8){
                $dead_event[] = "happiness";
                $extend_event[] = "happiness";
            }
            if($luck<8){
                $dead_event[] = "luck";
                $extend_event[] = "luck";
            }
            $survive_rate = rand(1,100);
            $dead_cnt = count($dead_event);
            $dead_rate = $dead_cnt*3;

            //死亡機率大於存活機率 就會往下跑switch case
            if($survive_rate < $dead_rate){
                $alive = false;
                $wayToDie = rand(0,$dead_cnt-1);
                switch($wayToDie){
                    case 0:
                        $death_way = $dead_event[0];
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
                    case 1:
                        $death_way = $dead_event[1];
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
                    case 2:
                        $death_way = $dead_event[2];
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
                    case 3:
                        $death_way = $dead_event[3];
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
                    case 4:
                        $death_way = $dead_event[4];
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
                    case 5:
                        $death_way = $dead_event[5];
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
                    case 6:
                        $death_way = $dead_event[6];
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
                break;
            }

            //因為某種屬性過低 雖然沒有死 卻有相應的事件發生
            $cnt = count($extend_event);
            $extend_event_rate = (1-1/2**$cnt)*0.75*100;      //相應事件發生的機率 : (所有屬性過低的事件中至少發生一個相應事件的機率)*0.75
            if(rand(1,100) < $extend_event_rate){
                $extend_event_way = rand(0,$cnt-1);
                switch($extend_event_way){
                    case 0:
                        $special_event = special_event::where('name', $extend_event[0])->get(); //把加分事件的名字用屬性做區分 還沒想出更好的分類方式
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
                        break;
                    case 1:
                        $special_event = special_event::where('name', $extend_event[1])->get();
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
                        break;
                    case 2:
                        $special_event = special_event::where('name', $extend_event[2])->get(); 
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
                        break;
                    case 3:
                        $special_event = special_event::where('name', $extend_event[3])->get(); 
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
                        break;
                    case 4:
                        $special_event = special_event::where('name', $extend_event[4])->get(); 
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
                        break;
                    case 5:
                        $special_event = special_event::where('name', $extend_event[5])->get();
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
                        break;
                }
                continue;
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
                    'intelligence'=>$intelligence,
                    'appearance'=> $appearance,
                    'wealth'=> $wealth,
                    'luck'=>$luck,
                    'happiness'=>$happiness,
                    'morality'=>$morality,
                    'content'=>$event->content,
                    'achievement_id'=>-1,
                ]);

            }else{
                $rand_range = achievement_event::all()->count();
                $event_id = rand(1,$rand_range);
                $event = achievement_event::find($event_id);
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
                    'achievement_id'=>$event->achievement_id,//timlin新增
                ]);
                array_push($accomplish_achievements ,$event->achievement_id);
                
            }
            $month+=1;
        };
        //這個foreach有問題要修 已解決
        if(!empty($accomplish_achievements)){
            for($i=0;$i<count($accomplish_achievements);$i++){
                // 检查是否存在相同的记录
                $existing_record = achievement_fins::where('user_id', $user_id)
                ->where('achievement_id', $accomplish_achievements[$i])
                ->first();
                if(!$existing_record){
                    achievement_fins::create([
                        'user_id'=> $user_id,
                        'achievement_id'=> $accomplish_achievements[$i],
                    ]);
                }                
            };
        }
        if($intelligence>100){ //值還沒想出來 就先用100拉:P
            $existing_record = achievement_fins::where('user_id', $user_id)
                ->where('achievement_id',1)
                ->first();
            if(!$existing_record){
                achievement_fins::create([
                    'user_id'=> $user_id,
                    'achievement_id'=> 1,
                ]);
            }
        }
        if($intelligence<-100){
            $existing_record = achievement_fins::where('user_id', $user_id)
                ->where('achievement_id',2)
                ->first();
            if(!$existing_record){
                achievement_fins::create([
                    'user_id'=> $user_id,
                    'achievement_id'=> 2,
                ]);
            }
        }
        if($wealth>100){
            $existing_record = achievement_fins::where('user_id', $user_id)
                ->where('achievement_id',3)
                ->first();
            if(!$existing_record){
                achievement_fins::create([
                    'user_id'=> $user_id,
                    'achievement_id'=> 3,
                ]);
            }
        }
        if($wealth<-100){
            $existing_record = achievement_fins::where('user_id', $user_id)
                ->where('achievement_id',4)
                ->first();
            if(!$existing_record){
                achievement_fins::create([
                    'user_id'=> $user_id,
                    'achievement_id'=> 4,
                ]);
            }
        }
        if($appearance>100){
            $existing_record = achievement_fins::where('user_id', $user_id)
                ->where('achievement_id',5)
                ->first();
            if(!$existing_record){
                achievement_fins::create([
                    'user_id'=> $user_id,
                    'achievement_id'=> 5,
                ]);
            }
        }
        if($appearance<-100){
            $existing_record = achievement_fins::where('user_id', $user_id)
                ->where('achievement_id',6)
                ->first();
            if(!$existing_record){
                achievement_fins::create([
                    'user_id'=> $user_id,
                    'achievement_id'=> 6,
                ]);
            }
        }
        if($luck>100){
            $existing_record = achievement_fins::where('user_id', $user_id)
                ->where('achievement_id',7)
                ->first();
            if(!$existing_record){
                achievement_fins::create([
                    'user_id'=> $user_id,
                    'achievement_id'=> 7,
                ]);
            }
        }
        if($luck<-100){
            $existing_record = achievement_fins::where('user_id', $user_id)
                ->where('achievement_id',8)
                ->first();
            if(!$existing_record){
                achievement_fins::create([
                    'user_id'=> $user_id,
                    'achievement_id'=> 8,
                ]);
            }
        }
        if($morality>100){
            $existing_record = achievement_fins::where('user_id', $user_id)
                ->where('achievement_id',9)
                ->first();
            if(!$existing_record){
                achievement_fins::create([
                    'user_id'=> $user_id,
                    'achievement_id'=> 9,
                ]);
            }
        }
        if($morality<-100){
            $existing_record = achievement_fins::where('user_id', $user_id)
                ->where('achievement_id',10)
                ->first();
            if(!$existing_record){
                achievement_fins::create([
                    'user_id'=> $user_id,
                    'achievement_id'=> 10,
                ]);
            }
        }
        if($happiness>100){
            $existing_record = achievement_fins::where('user_id', $user_id)
                ->where('achievement_id',11)
                ->first();
            if(!$existing_record){
                achievement_fins::create([
                    'user_id'=> $user_id,
                    'achievement_id'=> 11,
                ]);
            }
        }
        if($happiness<-100){
            $existing_record = achievement_fins::where('user_id', $user_id)
                ->where('achievement_id',12)
                ->first();
            if(!$existing_record){
                achievement_fins::create([
                    'user_id'=> $user_id,
                    'achievement_id'=> 12,
                ]);
            }
        }
        $game_processes = game_process::where('user_id',$user_id)->get();
        $achievement = achievement::all();
        game_ending::create([
            'user_id'=>$user_id,
            'intelligence'=>$intelligence,
            'wealth'=>$wealth,
            'appearance'=>$appearance,
            'luck'=>$luck,
            'morality'=>$morality,
            'happiness'=>$happiness,
        ]);
        return view('monthlyevent',[
            'game_processes' => $game_processes,
            'accomplish_achievements' => $accomplish_achievements,
            'achievement' =>$achievement,
        ]);
    }
    public function finish(){
        //清process和ending資料
        $user_id = auth()->user()->id;
        $end = game_ending::where('user_id',$user_id)->delete();

        //$last_month = game_process::where('user_id',$user_id)->max('month');
        $make_end = game_process::where('user_id', $user_id)
        ->orderBy('month', 'desc')
        ->first();

        //準備ending
        //dd($make_end);
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
        $end = game_ending::where('user_id',$user_id)->first();
        // dd($end);
        return view('finish2',[
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
