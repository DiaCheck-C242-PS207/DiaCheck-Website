<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Predictions extends Model
{
    protected $fillable = [
        'user_id',
        'gender',
        'age',
        'hypertension',
        'heart_disease',
        'bmi',
        'HbA1c_level',
        'blood_glucose_level',
        'prediction',
        'probability',
        'message'
    ];
}
