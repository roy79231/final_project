<?php

namespace App\Http\Controllers\upLoadControllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\achievement_event;

class achievementEventUpLoadController extends Controller
{
    public function achievementEventUpLoader(){
        $postAchievement = achievement_event::all();
        return view('upLoader/achievementEventUpLoad', compact('postAchievement'));
    }

    public function achievementEventUpLoadStore(Request $request){
        // 創建新留言
        $request->validate([
            'name' => 'required|string',
            'content' => 'required|string',
            'intelligence' => 'required|integer',
            'wealth' => 'required|integer',
            'appearance' => 'required|integer',
            'luck' => 'required|integer',
            'morality' => 'required|integer',
            'happiness' => 'required|integer',
            'achievement_id' => 'required|integer'
        ]);//要求不為空

        $creat = new achievement_event();
        $creat->name = $request->name;
        $creat->content = $request->content;
        $creat->intelligence = $request->intelligence;
        $creat->wealth = $request->wealth;
        $creat->appearance = $request->appearance;
        $creat->luck = $request->luck;
        $creat->morality = $request->morality;
        $creat->happiness = $request->happiness;
        $creat->achievement_id = $request->achievement_id;
        $creat->save();

        return redirect()->route('achievementEventUpLoader');
    }

    public function achievementEventUpLoadDestroy($id){
        $destory = achievement_event::find($id);
        $destory->delete($id);

        return redirect()->route('achievementEventUpLoader');
    }

    public function achievementEventUpLoadEdit(Request $request ,$id){
        // 取得要編輯的資料和新的內容並更新內容
        $request->validate([
            'name' => 'required|string',
            'content' => 'required|string',
            'intelligence' => 'required|integer',
            'wealth' => 'required|integer',
            'appearance' => 'required|integer',
            'luck' => 'required|integer',
            'morality' => 'required|integer',
            'happiness' => 'required|integer',
            'achievement_id' => 'required|integer'
        ]);

        $edit = achievement_event::find($id);
        $edit->name = $request->name;
        $edit->content = $request->content;
        $edit->intelligence = $request->intelligence;
        $edit->wealth = $request->wealth;
        $edit->appearance = $request->appearance;
        $edit->luck = $request->luck;
        $edit->morality = $request->morality;
        $edit->happiness = $request->happiness;
        $edit->achievement_id = $request->achievement_id;
        $edit->save();

        return redirect()->route('achievementEventUpLoader');
    }
}