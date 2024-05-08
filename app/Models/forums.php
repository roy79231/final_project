<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class forums extends Model
{
    use HasFactory;

    protected $table ='forums';
    protected $fillable=[
        'content',
        'inputer',
    ];
}