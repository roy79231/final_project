<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class special_event extends Model
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
    ];
}
