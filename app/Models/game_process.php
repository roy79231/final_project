<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class game_process extends Model
{
    use HasFactory;
    protected $fillable=[
        'user_id',
        'month',
        'intelligence',
        'wealth',
        'appearance',
        'luck',
        'morality',
        'happiness',
        'content',
        'achievement_id',//timlin新增
    ];
    
}
