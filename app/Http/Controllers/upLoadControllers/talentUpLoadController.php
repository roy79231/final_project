<?php

namespace App\Http\Controllers\upLoadControllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\talent;

class talentUpLoadController extends Controller
{
    public function talentUpLoader(){
        $postAchievement = talent::all();
        return view('upLoader/talentUpLoad', compact('postAchievement'));
    }

    public function talentUpLoadStore(Request $request){
        // 創建新留言
        $request->validate([
            'name' => 'required|string',
            'intelligence' => 'required|integer',
            'wealth' => 'required|integer',
            'appearance' => 'required|integer',
            'luck' => 'required|integer',
            'morality' => 'required|integer',
            'happiness' => 'required|integer',
        ]);//要求不為空

        $creat = new talent();
        $creat->name = $request->name;
        $creat->intelligence = $request->intelligence;
        $creat->wealth = $request->wealth;
        $creat->appearance = $request->appearance;
        $creat->luck = $request->luck;
        $creat->morality = $request->morality;
        $creat->happiness = $request->happiness;
        $creat->save();

        return redirect()->route('talentUpLoader');
    }

    public function talentUpLoadDestroy($id){
        $destory = talent::find($id);
        $destory->delete($id);

        return redirect()->route('talentUpLoader');
    }

    public function talentUpLoadEdit(Request $request ,$id){
        // 取得要編輯的資料和新的內容並更新內容
        $request->validate([
            'name' => 'required|string',
            'intelligence' => 'required|integer',
            'wealth' => 'required|integer',
            'appearance' => 'required|integer',
            'luck' => 'required|integer',
            'morality' => 'required|integer',
            'happiness' => 'required|integer',
        ]);

        $edit = talent::find($id);
        $edit->name = $request->name;
        $edit->intelligence = $request->intelligence;
        $edit->wealth = $request->wealth;
        $edit->appearance = $request->appearance;
        $edit->luck = $request->luck;
        $edit->morality = $request->morality;
        $edit->happiness = $request->happiness;
        $edit->save();

        return redirect()->route('talentUpLoader');
    }
}