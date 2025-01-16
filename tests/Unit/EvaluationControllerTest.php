<?php

namespace Tests\Unit;

use App\Models\Evaluation;
use App\Models\User;
use App\Models\EducationElement;
use App\Models\Execution;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class EvaluationControllerTest extends TestCase
{
    use DatabaseTransactions;
    use WithFaker;

    public function testIndex()
    {
        $this->signIn();

        $response = $this->get(route('evaluations.index'));

        $response->assertStatus(200);
        $response->assertViewIs('evaluations.index');
        $response->assertViewHas('evaluations');
    }

    public function testCreate()
    {
        $this->signIn();
        
        $response = $this->get(route('evaluations.create'));

        $response->assertStatus(200);
        $response->assertViewIs('evaluations.create');
    }

    public function testStore()
    {
        $this->signIn();
        
        $attributes = [
            'student_id' => User::factory()->create()->id,
            'test_id' => EducationElement::factory()->create()->id,
            'execution_id' => Execution::factory()->create()->id,
            'grade' => $this->faker->randomFloat(2, 0, 10),
            'comment' => $this->faker->text,
        ];

        $response = $this->post(route('evaluations.store'), $attributes);

        $response->assertRedirect(route('evaluations.index'));
        $response->assertSessionHas('success', __('Evaluation created successfully.'));
        $this->assertDatabaseHas('evaluations', $attributes);
    }

    public function testEdit()
    {
        $this->signIn();
        
        $evaluation = Evaluation::factory()->create();

        $response = $this->get(route('evaluations.edit', $evaluation));

        $response->assertStatus(200);
        $response->assertViewIs('evaluations.edit');
        $response->assertViewHas('evaluation', $evaluation);
    }

    public function testUpdate()
    {
        $this->signIn();
        
        $evaluation = Evaluation::factory()->create();
        $attributes = [
            'student_id' => User::factory()->create()->id,
            'test_id' => EducationElement::factory()->create()->id,
            'execution_id' => Execution::factory()->create()->id,
            'grade' => $this->faker->randomFloat(2, 0, 10),
            'comment' => $this->faker->text,
        ];

        $response = $this->put(route('evaluations.update', $evaluation), $attributes);

        $response->assertRedirect(route('evaluations.index'));
        $response->assertSessionHas('success', __('Evaluation updated successfully.'));
        $this->assertDatabaseHas('evaluations', $attributes);
    }

    public function testDestroy()
    {
        $this->signIn();
        
        $evaluation = Evaluation::factory()->create();

        $response = $this->delete(route('evaluations.destroy', $evaluation));

        $response->assertRedirect(route('evaluations.index'));
        $response->assertSessionHas('success', __('Evaluation deleted successfully.'));
        $this->assertDatabaseMissing($evaluation);
    }
}
