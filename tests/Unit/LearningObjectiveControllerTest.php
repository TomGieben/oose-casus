<?php

namespace Tests\Unit;

use App\Models\LearningObjective;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class LearningObjectiveControllerTest extends TestCase
{
    use DatabaseTransactions;
    use WithFaker;

    public function testIndex()
    {
        $this->signIn();

        $response = $this->get(route('learning-objectives.index'));

        $response->assertStatus(200);
        $response->assertViewIs('learning-objectives.index');
        $response->assertViewHas('learningObjectives');
    }

    public function testCreate()
    {
        $this->signIn();
        
        $response = $this->get(route('learning-objectives.create'));

        $response->assertStatus(200);
        $response->assertViewIs('learning-objectives.create');
    }

    public function testStore()
    {
        $this->signIn();
        
        $attributes = [
            'name' => $this->faker->word,
            'description' => $this->faker->sentence,
        ];

        $response = $this->post(route('learning-objectives.store'), $attributes);

        $response->assertRedirect(route('learning-objectives.index'));
        $response->assertSessionHas('success', __('Learning Objective created successfully'));
        $this->assertDatabaseHas('learning_objectives', $attributes);
    }

    public function testEdit()
    {
        $this->signIn();
        
        $learningObjective = LearningObjective::factory()->create();

        $response = $this->get(route('learning-objectives.edit', $learningObjective));

        $response->assertStatus(200);
        $response->assertViewIs('learning-objectives.edit');
        $response->assertViewHas('learningObjective', $learningObjective);
    }

    public function testUpdate()
    {
        $this->signIn();
        
        $learningObjective = LearningObjective::factory()->create();
        $attributes = [
            'name' => $this->faker->word,
            'description' => $this->faker->sentence,
        ];

        $response = $this->put(route('learning-objectives.update', $learningObjective), $attributes);

        $response->assertRedirect(route('learning-objectives.index'));
        $response->assertSessionHas('success', __('Learning Objective updated successfully'));
        $this->assertDatabaseHas('learning_objectives', $attributes);
    }

    public function testDestroy()
    {
        $this->signIn();
        
        $learningObjective = LearningObjective::factory()->create();

        $response = $this->delete(route('learning-objectives.destroy', $learningObjective));

        $response->assertRedirect(route('learning-objectives.index'));
        $response->assertSessionHas('success', __('Learning Objective deleted successfully'));
        $this->assertDatabaseMissing($learningObjective);
    }
}
