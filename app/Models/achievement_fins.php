<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class achievement_fins extends Model
{
    use HasFactory;
    protected $fillable=[
        'user_id',
        'achievement_id',
    ];
    protected $table = 'achievement_fins';

    public function achievement()
    {
        return $this->belongsTo(Achievement::class, 'achievement_id');
    }
}
