<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\talent;

class TalentController extends Controller
{
    public function showForm()
    {
        $talents = talent::all();
        $talents_len = count($talents);
        return view('addPoints', ['talents' => $talents,'talents_len'=>$talents_len]);
    }
}
