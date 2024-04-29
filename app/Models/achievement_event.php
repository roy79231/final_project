<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class achievement_event extends Model
{
    use HasFactory;
    protected $fillable=[
        'name',
        'content',
        'intelligence',
        'wealth',
        'appearance',
        'luck',
        'morality',
        'happiness',
        'achievement_id'
    ];
}
