<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class normal_event extends Model
{
    use HasFactory;
    protected $fillable=[
        'name',
        'content',
        'time_type',
    ];
}
