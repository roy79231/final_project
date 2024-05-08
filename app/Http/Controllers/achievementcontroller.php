<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\achievement_fins;

class achievementcontroller extends Controller
{
    
    public function showAchievements($user_id)
    {
        // Retrieve achievements for the given user_id
        $achievements = achievement_fins::where('user_id', $user_id)->get();
        
        // Pass achievements data to the view
        return view('achievement', ['achievements' => $achievements]);
    }
}