<?php

namespace Tests\Unit;

use App\Models\Group;
use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class GroupControllerTest extends TestCase
{
    use DatabaseTransactions;
    use WithFaker;

    public function testIndex()
    {
        $this->signIn();

        $response = $this->get(route('groups.index'));

        $response->assertStatus(200);
        $response->assertViewIs('groups.index');
        $response->assertViewHas('groups');
    }

    public function testCreate()
    {
        $this->signIn();
        
        $response = $this->get(route('groups.create'));

        $response->assertStatus(200);
        $response->assertViewIs('groups.create');
    }

    public function testStore()
    {
        $this->signIn();
        
        $attributes = [
            'number' => $this->faker->unique()->numberBetween(1, 100),
            'students' => User::factory()->count(3)->create()->pluck('id')->toArray(),
        ];

        $response = $this->post(route('groups.store'), $attributes);

        $response->assertRedirect(route('groups.index'));
        $response->assertSessionHas('success', __('Group created successfully.'));
        $this->assertDatabaseHas('groups', ['number' => $attributes['number']]);
    }

    public function testEdit()
    {
        $this->signIn();
        
        $group = Group::factory()->create();

        $response = $this->get(route('groups.edit', $group));

        $response->assertStatus(200);
        $response->assertViewIs('groups.edit');
        $response->assertViewHas('group', $group);
    }

    public function testUpdate()
    {
        $this->signIn();
        
        $group = Group::factory()->create();
        $attributes = [
            'number' => $this->faker->unique()->numberBetween(1, 100),
            'students' => User::factory()->count(3)->create()->pluck('id')->toArray(),
        ];

        $response = $this->put(route('groups.update', $group), $attributes);

        $response->assertRedirect(route('groups.index'));
        $response->assertSessionHas('success', __('Group updated successfully.'));
        $this->assertDatabaseHas('groups', ['number' => $attributes['number']]);
    }

    public function testDestroy()
    {
        $this->signIn();
        
        $group = Group::factory()->create();

        $response = $this->delete(route('groups.destroy', $group));

        $response->assertRedirect(route('groups.index'));
        $response->assertSessionHas('success', __('Group deleted successfully.'));
        $this->assertDatabaseMissing($group);
    }
}
