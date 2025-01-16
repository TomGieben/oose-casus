<?php

namespace Tests\Unit;

use App\Models\Resource;
use App\Models\Course;
use App\Models\EducationElement;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ResourceControllerTest extends TestCase
{
    use DatabaseTransactions;
    use WithFaker;

    public function testIndex()
    {
        $this->signIn();

        $response = $this->get(route('resources.index'));

        $response->assertStatus(200);
        $response->assertViewIs('resources.index');
        $response->assertViewHas('resources');
    }

    public function testCreate()
    {
        $this->signIn();
        
        $response = $this->get(route('resources.create'));

        $response->assertStatus(200);
        $response->assertViewIs('resources.create');
    }

    public function testStore()
    {
        $this->signIn();
        
        $attributes = [
            'course_id' => Course::factory()->create()->id,
            'education_element_id' => EducationElement::factory()->create()->id,
            'name' => $this->faker->word,
            'content' => $this->faker->paragraph,
        ];

        $response = $this->post(route('resources.store'), $attributes);

        $response->assertRedirect(route('resources.index'));
        $this->assertDatabaseHas('resources', $attributes);
    }

    public function testEdit()
    {
        $this->signIn();
        
        $resource = Resource::factory()->create();

        $response = $this->get(route('resources.edit', $resource));

        $response->assertStatus(200);
        $response->assertViewIs('resources.edit');
        $response->assertViewHas('resource', $resource);
    }

    public function testUpdate()
    {
        $this->signIn();
        
        $resource = Resource::factory()->create();
        $attributes = [
            'course_id' => Course::factory()->create()->id,
            'education_element_id' => EducationElement::factory()->create()->id,
            'name' => $this->faker->word,
            'content' => $this->faker->paragraph,
        ];

        $response = $this->put(route('resources.update', $resource), $attributes);

        $response->assertRedirect(route('resources.index'));
        $this->assertDatabaseHas('resources', $attributes);
    }

    public function testDestroy()
    {
        $this->signIn();
        
        $resource = Resource::factory()->create();

        $response = $this->delete(route('resources.destroy', $resource));

        $response->assertRedirect(route('resources.index'));
        $this->assertDatabaseMissing($resource);
    }
}
