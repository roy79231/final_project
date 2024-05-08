<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class achievement extends Model
{
    use HasFactory;
    protected $fillable=[
        'name',
        'content'
    ];
    
        protected $table = 'achievements';
    
        // Define any other relationships or attributes as needed
    
}

