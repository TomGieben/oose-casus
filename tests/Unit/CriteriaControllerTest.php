<?php

namespace Tests\Unit;

use App\Models\Criteria;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class CriteriaControllerTest extends TestCase
{
    use DatabaseTransactions;
    use WithFaker;

    public function testIndex()
    {
        $this->signIn();

        $response = $this->get(route('criteria.index'));

        $response->assertStatus(200);
        $response->assertViewIs('criteria.index');
        $response->assertViewHas('criterias');
    }

    public function testCreate()
    {
        $this->signIn();
        
        $response = $this->get(route('criteria.create'));

        $response->assertStatus(200);
        $response->assertViewIs('criteria.create');
    }

    public function testStore()
    {
        $this->signIn();
        
        $attributes = [
            'name' => $this->faker->word,
            'description' => $this->faker->sentence,
        ];

        $response = $this->post(route('criteria.store'), $attributes);

        $response->assertRedirect(route('criteria.index'));
        $response->assertSessionHas('success', __('Criteria created successfully'));
        $this->assertDatabaseHas('criterias', $attributes);
    }

    public function testEdit()
    {
        $this->signIn();
        
        $criterion = Criteria::factory()->create();

        $response = $this->get(route('criteria.edit', $criterion));

        $response->assertStatus(200);
        $response->assertViewIs('criteria.edit');
        $response->assertViewHas('criterion', $criterion);
    }

    public function testUpdate()
    {
        $this->signIn();
        
        $criterion = Criteria::factory()->create();
        $attributes = [
            'name' => $this->faker->word,
            'description' => $this->faker->sentence,
        ];

        $response = $this->put(route('criteria.update', $criterion), $attributes);

        $response->assertRedirect(route('criteria.index'));
        $response->assertSessionHas('success', __('Criteria updated successfully'));
        $this->assertDatabaseHas('criterias', $attributes);
    }

    public function testDestroy()
    {
        $this->signIn();
        
        $criterion = Criteria::factory()->create();

        $response = $this->delete(route('criteria.destroy', $criterion));

        $response->assertRedirect(route('criteria.index'));
        $response->assertSessionHas('success', __('Criteria deleted successfully'));
        $this->assertDatabaseMissing($criterion);
    }
}
