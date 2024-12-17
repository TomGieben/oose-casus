<?php

namespace Tests\Unit;

use App\Enums\EducationElementType;
use App\Models\EducationElement;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class EducationElementControllerTest extends TestCase
{
    use DatabaseTransactions;
    use WithFaker;

    public function testIndex()
    {
        $this->signIn();

        $response = $this->get(route('education-elements.index'));

        $response->assertStatus(200);
        $response->assertViewIs('education-elements.index');
        $response->assertViewHas('educationElements');
    }

    public function testCreate()
    {
        $this->signIn();

        $response = $this->get(route('education-elements.create'));

        $response->assertStatus(200);
        $response->assertViewIs('education-elements.create');
    }

    public function testStore()
    {
        $this->signIn();

        $attributes = [
            'name' => $this->faker->word,
            'type_class' => EducationElementType::values()[array_rand(EducationElementType::values())],
        ];

        $response = $this->post(route('education-elements.store'), $attributes);

        $response->assertRedirect(route('education-elements.index'));
        $this->assertDatabaseHas('education_elements', $attributes);
    }

    public function testEdit()
    {
        $this->signIn();

        $educationElement = EducationElement::factory()->create();

        $response = $this->get(route('education-elements.edit', $educationElement));

        $response->assertStatus(200);
        $response->assertViewIs('education-elements.edit');
        $response->assertViewHas('educationElement', $educationElement);
    }

    public function testUpdate()
    {
        $this->signIn();

        $educationElement = EducationElement::factory()->create();
        $attributes = [
            'name' => $this->faker->word,
            'type_class' => EducationElementType::values()[array_rand(EducationElementType::values())],
        ];

        $response = $this->put(route('education-elements.update', $educationElement), $attributes);

        $response->assertRedirect(route('education-elements.index'));
        $this->assertDatabaseHas('education_elements', $attributes);
    }

    public function testDestroy()
    {
        $this->signIn();

        $educationElement = EducationElement::factory()->create();

        $response = $this->delete(route('education-elements.destroy', $educationElement));

        $response->assertRedirect(route('education-elements.index'));
        $this->assertDatabaseMissing($educationElement);
    }
}
