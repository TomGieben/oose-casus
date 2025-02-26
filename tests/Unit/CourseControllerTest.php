<?php

namespace Tests\Unit;

use App\Models\Course;
use App\Models\LearningObjective;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class CourseControllerTest extends TestCase
{
    use DatabaseTransactions;
    use WithFaker;

    public function testIndex()
    {
        $this->signIn();

        $response = $this->get(route('courses.index'));

        $response->assertStatus(200);
        $response->assertViewIs('courses.index');
        $response->assertViewHas('courses');
    }

    public function testCreate()
    {
        $this->signIn();
        
        $response = $this->get(route('courses.create'));

        $response->assertStatus(200);
        $response->assertViewIs('courses.create');
    }

    public function testStore()
    {
        $this->signIn();
        
        $learningObjectives = LearningObjective::factory()->count(rand(1, 3))->create()->pluck('id')->toArray();
        $attributes = [
            'name' => $this->faker->unique()->word,
            'learning_objectives' => $learningObjectives,
        ];

        $response = $this->post(route('courses.store'), $attributes);

        $response->assertRedirect(route('courses.index'));
        $response->assertSessionHas('success', 'Course created successfully.');
        $this->assertDatabaseHas('courses', [
            'name' => $attributes['name'],
        ]);
    }

    public function testEdit()
    {
        $this->signIn();
        
        $course = Course::factory()->create();

        $response = $this->get(route('courses.edit', $course));

        $response->assertStatus(200);
        $response->assertViewIs('courses.edit');
        $response->assertViewHas('course', $course);
    }

    public function testUpdate()
    {
        $this->signIn();
        
        $course = Course::factory()->create();
        $learningObjectives = LearningObjective::factory()->count(rand(1, 3))->create()->pluck('id')->toArray();
        $attributes = [
            'name' => $this->faker->unique()->word,
            'learning_objectives' => $learningObjectives,
        ];

        $response = $this->put(route('courses.update', $course), $attributes);

        $response->assertRedirect(route('courses.index'));
        $response->assertSessionHas('success', 'Course updated successfully.');
        $this->assertDatabaseHas('courses', [
            'name' => $attributes['name'],
        ]);
    }

    public function testDestroy()
    {
        $this->signIn();
        
        $course = Course::factory()->create();

        $response = $this->delete(route('courses.destroy', $course));

        $response->assertRedirect(route('courses.index'));
        $response->assertSessionHas('success', 'Course deleted successfully.');
        $this->assertDatabaseMissing($course);
    }
}
