<?php

namespace Database\Factories;

use App\Models\Course;
use App\Models\User;
use App\Enums\Status;
use Illuminate\Database\Eloquent\Factories\Factory;

class CourseFactory extends Factory
{
    protected $model = Course::class;

    public function definition()
    {
        return [
            'teacher_id' => User::factory(),
            'status' => $this->faker->randomElement(Status::getValues()),
            'name' => $this->faker->word(),
        ];
    }
}
