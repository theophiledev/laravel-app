<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FoodTaken extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'food_taken';

    protected $fillable = [
        'student_id',
        'payment_amount',
        'meal_cost',
        'times_taken',
        'times_remaining',
    ];

    /**
     * Get the student that owns this food taken record.
     */
    public function student()
    {
        return $this->belongsTo(User::class, 'student_id');
    }
}
