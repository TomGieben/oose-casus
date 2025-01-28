<?php

namespace Tests\Unit;

use App\Enums\Day;
use App\Enums\Week;
use App\Models\Planning;
use App\Models\Course;
use App\Models\EducationElement;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class PlanningControllerTest extends TestCase
{
    use DatabaseTransactions;
    use WithFaker;

    public function testIndex()
    {
        $this->signIn();

        $response = $this->get(route('plannings.index'));

        $response->assertStatus(200);
        $response->assertViewIs('plannings.index');
        $response->assertViewHas('plannings');
    }

    public function testCreate()
    {
        $this->signIn();

        $response = $this->get(route('plannings.create'));

        if (!in_array($response->status(), [200, 302])) {
            return $this->fail('Failed to get resources index');
        }

        if ($response->status() === 302) {
            return $this->assertTrue(true);
        }

        $response->assertViewIs('plannings.create');
    }

    public function testStore()
    {
        $this->signIn();

        $startsAt = $this->faker->time('H:i');
        if (strtotime($startsAt) + 60 * 60 > strtotime('23:59')) {
            $startsAt = date('H:i', strtotime($startsAt . ' -1 hour'));
        }

        $endsAt = date('H:i', strtotime($startsAt . ' +1 hour'));

        $attributes = [
            'course_id' => Course::factory()->create()->id,
            'education_element_id' => EducationElement::factory()->create()->id,
            'week' => $this->faker->randomElement(Week::values()),
            'day' => $this->faker->randomElement(Day::values()),
            'starts_at' => $startsAt,
            'ends_at' => $endsAt,
        ];

        $response = $this->post(route('plannings.store'), $attributes);

        $response->assertRedirect(route('plannings.index'));
        $this->assertDatabaseHas('plannings', $attributes);
    }

    public function testEdit()
    {
        $this->signIn();

        $planning = Planning::factory()->create();

        $response = $this->get(route('plannings.edit', $planning));

        $response->assertStatus(200);
        $response->assertViewIs('plannings.edit');
        $response->assertViewHas('planning', $planning);
    }

    public function testUpdate()
    {
        $this->signIn();

        $planning = Planning::factory()->create();
        $startsAt = $this->faker->time('H:i');

        if (strtotime($startsAt) + 60 * 60 > strtotime('23:59')) {
            $startsAt = date('H:i', strtotime($startsAt . ' -1 hour'));
        }

        $endsAt = date('H:i', strtotime($startsAt . ' +1 hour'));

        $attributes = [
            'course_id' => Course::factory()->create()->id,
            'education_element_id' => EducationElement::factory()->create()->id,
            'week' => $this->faker->randomElement(Week::values()),
            'day' => $this->faker->randomElement(Day::values()),
            'starts_at' => $startsAt,
            'ends_at' => $endsAt,
        ];

        $response = $this->put(route('plannings.update', $planning), $attributes);

        $response->assertRedirect(route('plannings.index'));
        $this->assertDatabaseHas('plannings', $attributes);
    }

    public function testDestroy()
    {
        $this->signIn();

        $planning = Planning::factory()->create();

        $response = $this->delete(route('plannings.destroy', $planning));

        $response->assertRedirect(route('plannings.index'));
        $this->assertDatabaseMissing($planning);
    }
}
