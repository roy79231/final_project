<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class dead_event extends Model
{
    const DIE_WEALTH =  'wealth';
    const DIE_APPEARANCE = 'appearance';
    const DIE_INTELLENGENCE = 'intelligence';
    const DIE_MORALITY = 'morality';
    const DIE_HAPPINESS = 'happiness';
    const DIE_LUCK = 'luck';
    const DIE_ACCIDENT = 'accident';

    use HasFactory;
    protected $fillable=[
        'name',
        'content',
        'wayOne',
        'wayTwo',
    ];
}