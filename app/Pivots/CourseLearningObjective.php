<?php

namespace App\Pivots;

use App\Models\Course;
use App\Models\LearningObjective;
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

    public function course()
    {
        return $this->belongsTo(Course::class);
    }

    public function learningObjective()
    {
        return $this->belongsTo(LearningObjective::class);
    }
}
