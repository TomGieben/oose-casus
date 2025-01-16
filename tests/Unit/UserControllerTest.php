<?php

namespace Tests\Unit;

use App\Models\User;
use App\Enums\Role;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

class UserControllerTest extends TestCase
{
    use DatabaseTransactions;
    use WithFaker;

    public function testIndex()
    {
        $this->signIn();

        $response = $this->get(route('users.index'));

        $response->assertStatus(200);
        $response->assertViewIs('users.index');
        $response->assertViewHas('users');
    }

    public function testCreate()
    {
        $this->signIn();
        
        $response = $this->get(route('users.create'));

        $response->assertStatus(200);
        $response->assertViewIs('users.create');
    }

    public function testStore()
    {
        $this->signIn();
        
        $attributes = [
            'name' => $this->faker->name,
            'email' => $this->faker->unique()->safeEmail,
            'password' => $password = $this->faker->password(16, 60),
            'password_confirmation' => $password,
            'role' => $this->faker->randomElement(Role::values()),
        ];

        $response = $this->post(route('users.store'), $attributes);

        $response->assertRedirect(route('users.index'));
        $response->assertSessionHas('success', __('User created successfully.'));
        $this->assertDatabaseHas('users', ['email' => $attributes['email']]);
    }

    public function testEdit()
    {
        $this->signIn();
        
        $user = User::factory()->create();

        $response = $this->get(route('users.edit', $user));

        $response->assertStatus(200);
        $response->assertViewIs('users.edit');
        $response->assertViewHas('user', $user);
    }

    public function testUpdate()
    {
        $this->signIn();
        
        $user = User::factory()->create();
        $attributes = [
            'name' => $this->faker->name,
            'email' => $this->faker->unique()->safeEmail,
            'password' => $password = $this->faker->password(16, 60),
            'password_confirmation' => $password,
            'role' => $this->faker->randomElement(Role::values()),
        ];

        $response = $this->put(route('users.update', $user), $attributes);

        $response->assertRedirect(route('users.index'));
        $response->assertSessionHas('success', __('User updated successfully.'));
        $this->assertDatabaseHas('users', ['email' => $attributes['email']]);
    }

    public function testDestroy()
    {
        $this->signIn();
        
        $user = User::factory()->create();

        $response = $this->delete(route('users.destroy', $user));

        $response->assertRedirect(route('users.index'));
        $response->assertSessionHas('success', __('User deleted successfully.'));
        $this->assertDatabaseMissing($user);
    }
}
