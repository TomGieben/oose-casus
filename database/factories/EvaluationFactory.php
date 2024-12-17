<?php

namespace Database\Factories;

use App\Models\Evaluation;
use App\Models\User;
use App\Models\EducationElement;
use App\Models\Execution;
use Illuminate\Database\Eloquent\Factories\Factory;

class EvaluationFactory extends Factory
{
    protected $model = Evaluation::class;

    public function definition()
    {
        return [
            'student_id' => User::factory(),
            'test_id' => EducationElement::factory(),
            'execution_id' => Execution::factory(),
            'grade' => $this->faker->randomFloat(2, 0, 10),
        ];
    }
}
