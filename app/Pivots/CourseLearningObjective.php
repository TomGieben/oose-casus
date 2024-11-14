<?php

namespace App\Pivots;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\Pivot;

class CourseLearningObjective extends Pivot
{
    use HasFactory;

    protected $table = 'course_learning_objective';

    protected $fillable = [
        'course_id',
        'learning_objective_id',
    ];
}
