<?php

namespace App\Http\Controllers\upLoadControllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\dead_event;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class deadUpLoadController extends Controller
{
    public function deadUpLoader(){
        /*$users = User::all();
        if(Auth::user()->role !== User::ROLE_ADMIN){
            abort(403, '你是user 請你離開');
            return view('/');
        }
        return view('control',['users'=>$users]);
        $postAchievement = achievement_event::all();
        */

        $postAchievement = dead_event::all();
        return view('upLoader/deadEventUpLoad', compact('postAchievement'));
    }

    public function deadUpLoadStore(Request $request){
        // 創建新留言
        $request->validate([
            'name' => 'required|string',
            'content' => 'required|string',
            'way' => 'required|string',
        ]);//要求不為空

        $creat = new dead_event();
        $creat->name = $request->name;
        $creat->content = $request->content;
        $creat->way = $request->way;
        $creat->save();

        return redirect()->route('deadUpLoader');
    }

    public function deadUpLoadDestroy($id){
        $destory = dead_event::find($id);
        $destory->delete($id);

        return redirect()->route('deadUpLoader');
    }

    public function deadUpLoadEdit(Request $request ,$id){
        // 取得要編輯的資料和新的內容並更新內容
        $request->validate([
            'name' => 'required|string',
            'content' => 'required|string',
            'way' => 'required|string',
        ]);

        $edit = dead_event::find($id);
        $edit->name = $request->name;
        $edit->content = $request->content;
        $edit->way = $request->way;
        $edit->save();

        return redirect()->route('deadUpLoader');
    }
}