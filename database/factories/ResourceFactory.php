<?php

namespace Database\Factories;

use App\Models\Resource;
use App\Models\Course;
use App\Models\EducationElement;
use Illuminate\Database\Eloquent\Factories\Factory;

class ResourceFactory extends Factory
{
    protected $model = Resource::class;

    public function definition()
    {
        return [
            'course_id' => Course::factory(),
            'education_element_id' => EducationElement::factory(),
            'name' => $this->faker->word,
            'content' => $this->faker->paragraph,
        ];
    }
}
