<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class GameController extends Controller
{
    //
    public function main(){
        return view('main');
    }
    public function achievement(){
        return view('achievement');
    }
    public function post(){
        return view('post');
    }
    public function start(){
        return view('start');
    }
    public function event(){
        return view('monthlyevent');
    }
    public function finish(){
        return view('finish');
    }
}
