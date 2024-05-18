<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TalentController extends Controller
{
    public function showForm()
    {
        $talents = DB::table('talents')->limit(4);
        //->inRandomOrder()->limit(4)->pluck('name')
        return view('addPoints', ['talents' => $talents]);
    }
}
