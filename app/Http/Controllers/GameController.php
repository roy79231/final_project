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
    
    public function finish(){
        return view('finish');
    }
}
