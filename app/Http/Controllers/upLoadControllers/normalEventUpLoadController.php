<?php

namespace App\Http\Controllers\upLoadControllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\normal_event;

class normalEventUpLoadController extends Controller
{
    public function normalEventUpLoader(){
        $postAchievement = normal_event::all();
        return view('upLoader/normalEventUpLoad', compact('postAchievement'));
    }

    public function normalEventUpLoadStore(Request $request){
        // 創建新留言
        $request->validate([
            'name' => 'required|string',
            'content' => 'required|string',
        ]);//要求不為空

        $creat = new normal_event();
        $creat->name = $request->name;
        $creat->content = $request->content;
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
        ]);

        $edit = normal_event::find($id);
        $edit->name = $request->name;
        $edit->content = $request->content;
        $edit->save();

        return redirect()->route('normalEventUpLoader');
    }
}