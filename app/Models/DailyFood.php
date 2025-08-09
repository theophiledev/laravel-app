<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DailyFood extends Model
{
    protected $table = 'daily_food';

    protected $fillable = [
        'food_name',
        'date',
    ];

    protected $casts = [
        'date' => 'date',
    ];
}
