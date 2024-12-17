<?php

namespace Database\Factories;

use App\Models\Execution;
use App\Models\Group;
use App\Models\User;
use App\Models\Classroom;
use App\Models\Course;
use Illuminate\Database\Eloquent\Factories\Factory;

class ExecutionFactory extends Factory
{
    protected $model = Execution::class;

    public function definition()
    {
        return [
            'group_id' => Group::factory(),
            'teacher_id' => User::factory(),
            'classroom_id' => Classroom::factory(),
            'course_id' => Course::factory(),
            'date' => $this->faker->dateTime(),
        ];
    }
}
