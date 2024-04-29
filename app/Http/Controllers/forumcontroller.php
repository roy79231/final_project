<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class forumcontroller extends Controller
{
    public function forumindex(){
        return view('forum');
    }


public function forumcreate(Request $request){//Requset 接收傳過來的資料
    $content = $request->content;//從物件request指向content屬性
    $inputer = $request->inputer;
    forums::create(['content'=>$content,'inputer'=>$inputer]);
    //修改post資料庫 把'inputer'的資料傳給 inputer
    $posts =forums::all();
    return view('forum',['posts'=>$posts]);//
}
public function forumchange(Request $request,$id){
    $change=$request->content;
    $post=forums::find($id);
    $post->content = $change;
    $post->save();//處存資料庫動作
    $posts =forums::all();
    return view('tim_comment',['posts'=>$posts]);
}
public function timdelete($id){
    $post=forums::find($id);
    $post->delete();
    $posts =forums::all();
    return view('tim_comment',['posts'=>$posts]);
}
}