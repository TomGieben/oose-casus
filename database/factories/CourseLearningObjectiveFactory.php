<?php

namespace Database\Factories;

use App\Models\Course;
use App\Models\LearningObjective;
use App\Pivots\CourseLearningObjective;
use Illuminate\Database\Eloquent\Factories\Factory;

class CourseLearningObjectiveFactory extends Factory
{
    protected $model = CourseLearningObjective::class;

    public function definition()
    {
        return [
            'course_id' => Course::factory(),
            'learning_objective_id' => LearningObjective::factory(),
        ];
    }
}
