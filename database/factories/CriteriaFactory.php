<?php

namespace Database\Factories;

use App\Models\Criteria;
use Illuminate\Database\Eloquent\Factories\Factory;

class CriteriaFactory extends Factory
{
    protected $model = Criteria::class;

    public function definition()
    {
        return [
            'name' => $this->faker->word(),
            'description' => $this->faker->sentence(),
        ];
    }
}
