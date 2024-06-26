<?php

namespace App\Http\Controllers\upLoadControllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\special_event;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class specialEventUpLoadController extends Controller
{
    public function specialEventUpLoader(){
        $users = User::all();
        // if(Auth::user()->role !== User::ROLE_ADMIN){
        //     abort(403, '你是user 請你離開');
        //     return view('/');
        // }
        
        $postAchievement = special_event::all();
        return view('upLoader/specialEventUpLoad', compact('postAchievement'));
    }

    public function specialEventUpLoadStore(Request $request){
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
            'time_type'=>'required|string',
        ]);//要求不為空

        $creat = new special_event();
        $creat->name = $request->name;
        $creat->content = $request->content;
        $creat->intelligence = $request->intelligence;
        $creat->wealth = $request->wealth;
        $creat->appearance = $request->appearance;
        $creat->luck = $request->luck;
        $creat->morality = $request->morality;
        $creat->happiness = $request->happiness;
        $creat->time_type = $request->time_type;
        $creat->save();

        return redirect()->route('specialEventUpLoader');
    }

    public function specialEventUpLoadDestroy($id){
        $destory = special_event::find($id);
        $destory->delete($id);

        return redirect()->route('specialEventUpLoader');
    }

    public function specialEventUpLoadEdit(Request $request ,$id){
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
            'time_type'=>'required|string',
        ]);

        $edit = special_event::find($id);
        $edit->name = $request->name;
        $edit->content = $request->content;
        $edit->intelligence = $request->intelligence;
        $edit->wealth = $request->wealth;
        $edit->appearance = $request->appearance;
        $edit->luck = $request->luck;
        $edit->morality = $request->morality;
        $edit->happiness = $request->happiness;
        $edit->time_type = $request->time_type;
        $edit->save();

        return redirect()->route('specialEventUpLoader');
    }
}