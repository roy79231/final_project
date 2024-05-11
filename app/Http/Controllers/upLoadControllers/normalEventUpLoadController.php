<?php

namespace App\Http\Controllers\upLoadControllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\normal_event;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class normalEventUpLoadController extends Controller
{
    public function normalEventUpLoader(){
        /*$users = User::all();
        if(Auth::user()->role !== User::ROLE_ADMIN){
            abort(403, '你是user 請你離開');
            return view('/');
        }
        return view('control',['users'=>$users]);
        $postAchievement = achievement_event::all();*/

        $postAchievement = normal_event::all();
        return view('upLoader/normalEventUpLoad', compact('postAchievement'));
    }

    public function normalEventUpLoadStore(Request $request){
        // 創建新留言
        $request->validate([
            'name' => 'required|string',
            'content' => 'required|string',
            'time_type'=>'required|integer'//timlin修改 從time_type改成integer 不確定對不對
        ]);//要求不為空

        $creat = new normal_event();
        $creat->name = $request->name;
        $creat->content = $request->content;
        $creat->time_type = $request->time_type;
        $creat->save();

        return redirect()->route('normalEventUpLoader');
    }

    public function normalEventUpLoadDestroy($id){
        $destory = normal_event::find($id);
        $destory->delete($id);

        return redirect()->route('normalEventUpLoader');
    }

    public function normalEventUpLoadEdit(Request $request ,$id){
        // 取得要編輯的資料和新的內容並更新內容
        $request->validate([
            'name' => 'required|string',
            'content' => 'required|string',
            'time_type'=>'required|integer'//timlin修改 從time_type改成integer
        ]);

        $edit = normal_event::find($id);
        $edit->name = $request->name;
        $edit->content = $request->content;
        $edit->time_type = $request->time_type;
        $edit->save();

        return redirect()->route('normalEventUpLoader');
    }
}