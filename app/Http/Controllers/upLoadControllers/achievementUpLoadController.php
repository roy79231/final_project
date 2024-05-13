<?php

namespace App\Http\Controllers\upLoadControllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\achievement;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class achievementUpLoadController extends Controller
{
    public function achievementUpLoader(){
        $users = User::all();
        if(Auth::user()->role !== User::ROLE_ADMIN){
            abort(403, '你是user 請你離開');
            return view('/');
        }
        
        $postAchievement = achievement::all();
        return view('upLoader/achievementUpLoad', compact('postAchievement'));
    }

    public function upLoadStore(Request $request){
        // 創建新留言
        $request->validate([
            'name' => 'required|string',
            'content' => 'required|string',
        ]);//要求不為空

        $creat = new achievement();
        $creat->name = $request->name;
        $creat->content = $request->content;
        $creat->save();

        return redirect()->route('achievementUpLoader');
    }

    public function upLoadDestroy($id){
        $destory = achievement::find($id);
        $destory->delete($id);

        return redirect()->route('achievementUpLoader');
    }

    public function upLoadEdit(Request $request ,$id){
        // 取得要編輯的資料和新的內容並更新內容
        $request->validate([
            'name' => 'required|string',
            'content' => 'required|string',
        ]);

        $edit = achievement::find($id);
        $edit->name = $request->name;
        $edit->content = $request->content;
        $edit->save();

        return redirect()->route('achievementUpLoader');
    }
}