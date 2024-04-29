<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class game_ending extends Model
{
    use HasFactory;
    protected $fillable=[
        'user_id',
        'achievements_id',
        'intelligence',
        'wealth',
        'appearance',
        'luck',
        'morality',
        'happiness',
    ];
}
