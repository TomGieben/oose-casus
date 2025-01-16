<?php

namespace Tests\Unit;

use App\Models\Execution;
use App\Models\Course;
use App\Models\Classroom;
use App\Models\Group;
use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ExecutionControllerTest extends TestCase
{
    use DatabaseTransactions;
    use WithFaker;

    public function testIndex()
    {
        $this->signIn();

        $response = $this->get(route('executions.index'));

        $response->assertStatus(200);
        $response->assertViewIs('executions.index');
        $response->assertViewHas('executions');
    }

    public function testCreate()
    {
        $this->signIn();
        
        $response = $this->get(route('executions.create'));

        $response->assertStatus(200);
        $response->assertViewIs('executions.create');
    }

    public function testStore()
    {
        $this->signIn();
        
        $attributes = [
            'group_id' => Group::factory()->create()->id,
            'teacher_id' => User::factory()->create()->id,
            'classroom_id' => Classroom::factory()->create()->id,
            'course_id' => Course::factory()->create()->id,
            'date' => $this->faker->date(),
        ];

        $response = $this->post(route('executions.store'), $attributes);

        $response->assertRedirect(route('executions.index'));
        $response->assertSessionHas('success', __('Execution created successfully.'));
        $this->assertDatabaseHas('executions', $attributes);
    }

    public function testEdit()
    {
        $this->signIn();
        
        $execution = Execution::factory()->create();

        $response = $this->get(route('executions.edit', $execution));

        $response->assertStatus(200);
        $response->assertViewIs('executions.edit');
        $response->assertViewHas('execution', $execution);
    }

    public function testUpdate()
    {
        $this->signIn();
        
        $execution = Execution::factory()->create();
        $attributes = [
            'group_id' => Group::factory()->create()->id,
            'teacher_id' => User::factory()->create()->id,
            'classroom_id' => Classroom::factory()->create()->id,
            'course_id' => Course::factory()->create()->id,
            'date' => $this->faker->date(),
        ];

        $response = $this->put(route('executions.update', $execution), $attributes);

        $response->assertRedirect(route('executions.index'));
        $response->assertSessionHas('success', __('Execution updated successfully.'));
        $this->assertDatabaseHas('executions', $attributes);
    }

    public function testDestroy()
    {
        $this->signIn();
        
        $execution = Execution::factory()->create();

        $response = $this->delete(route('executions.destroy', $execution));

        $response->assertRedirect(route('executions.index'));
        $response->assertSessionHas('success', __('Execution deleted successfully.'));
        $this->assertDatabaseMissing($execution);
    }
}
