<?php

namespace Database\Factories;

use App\Models\Planning;
use App\Models\Course;
use App\Models\EducationElement;
use App\Enums\Day;
use App\Enums\Week;
use Illuminate\Database\Eloquent\Factories\Factory;

class PlanningFactory extends Factory
{
    protected $model = Planning::class;

    public function definition()
    {
        return [
            'course_id' => Course::factory(),
            'education_element_id' => EducationElement::factory(),
            'week' => $this->faker->randomElement(Week::values()),
            'day' => $this->faker->randomElement(Day::values()),
            'starts_at' => $this->faker->time('H:i'),
            'ends_at' => $this->faker->time('H:i'),
        ];
    }
}
