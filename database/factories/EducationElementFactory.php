<?php

namespace Database\Factories;

use App\Models\EducationElement;
use App\Enums\EducationElementType;
use Illuminate\Database\Eloquent\Factories\Factory;

class EducationElementFactory extends Factory
{
    protected $model = EducationElement::class;

    public function definition()
    {
        return [
            'type_class' => $this->faker->randomElement(EducationElementType::values()),
            'name' => $this->faker->word(),
            'description' => $this->faker->sentence(),
        ];
    }
}
