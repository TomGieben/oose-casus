<?php

namespace Tests\Unit;

use App\Models\Classroom;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ClassroomControllerTest extends TestCase
{
    use DatabaseTransactions;
    use WithFaker;

    public function testIndex()
    {
        $this->signIn();

        $response = $this->get(route('classrooms.index'));

        $response->assertStatus(200);
        $response->assertViewIs('classrooms.index');
        $response->assertViewHas('classrooms');
    }

    public function testCreate()
    {
        $this->signIn();
        
        $response = $this->get(route('classrooms.create'));

        $response->assertStatus(200);
        $response->assertViewIs('classrooms.create');
    }

    public function testStore()
    {
        $this->signIn();
        
        $attributes = ['number' => $this->faker->unique()->numberBetween(1, 100)];

        $response = $this->post(route('classrooms.store'), $attributes);

        $response->assertRedirect(route('classrooms.index'));
        $response->assertSessionHas('success', __('Classroom created successfully.'));
        $this->assertDatabaseHas('classrooms', $attributes);
    }

    public function testEdit()
    {
        $this->signIn();
        
        $classroom = Classroom::factory()->create();

        $response = $this->get(route('classrooms.edit', $classroom));

        $response->assertStatus(200);
        $response->assertViewIs('classrooms.edit');
        $response->assertViewHas('classroom', $classroom);
    }

    public function testUpdate()
    {
        $this->signIn();
        
        $classroom = Classroom::factory()->create();
        $attributes = ['number' => $this->faker->unique()->numberBetween(1, 100)];

        $response = $this->put(route('classrooms.update', $classroom), $attributes);

        $response->assertRedirect(route('classrooms.index'));
        $response->assertSessionHas('success', __('Classroom updated successfully.'));
        $this->assertDatabaseHas('classrooms', $attributes);
    }

    public function testDestroy()
    {
        $this->signIn();
        
        $classroom = Classroom::factory()->create();

        $response = $this->delete(route('classrooms.destroy', $classroom));

        $response->assertRedirect(route('classrooms.index'));
        $response->assertSessionHas('success', __('Classroom deleted successfully.'));
        $this->assertDatabaseMissing($classroom);
    }
}
