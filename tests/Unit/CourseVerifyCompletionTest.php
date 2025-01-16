<?php

namespace Tests\Unit;

use App\Enums\Status;
use App\Models\Course;
use App\Models\EducationElement;
use App\Models\LearningObjective;
use App\Models\Planning;
use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\WithFaker;

class CourseVerifyCompletionTest extends TestCase
{
    use DatabaseTransactions;
    use WithFaker;

    private Course $course;
    private LearningObjective $objective1;
    private LearningObjective $objective2;

    protected function setUp(): void
    {
        parent::setUp();

        $this->course = Course::factory()->create(['status' => Status::Draft]);
        $this->objective1 = LearningObjective::factory()->create();
        $this->objective2 = LearningObjective::factory()->create();

        $this->course->learningObjectives()->attach([
            $this->objective1->id,
            $this->objective2->id
        ]);
    }

    public function test_verifies_completion_successfully(): void
    {
        $lesson = EducationElement::factory()->create([
            'type_class' => 'App\\EducationElements\\Lesson'
        ]);

        $lesson->learningObjectives()->attach([
            $this->objective1->id,
            $this->objective2->id
        ]);

        $test = EducationElement::factory()->create([
            'type_class' => 'App\\EducationElements\\Test'
        ]);

        $test->learningObjectives()->attach([
            $this->objective1->id,
            $this->objective2->id
        ]);

        Planning::factory()->create([
            'course_id' => $this->course->id,
            'education_element_id' => $lesson->id,
            'week' => 1,
            'day' => 1
        ]);

        Planning::factory()->create([
            'course_id' => $this->course->id,
            'education_element_id' => $test->id,
            'week' => 1,
            'day' => 2
        ]);

        $this->assertTrue($this->course->verifyCompletion());
        $this->assertEquals(Status::Plannable, $this->course->status);
    }

    public function test_fails_verification_with_missing_objectives(): void
    {
        $lesson = EducationElement::factory()->create([
            'type_class' => 'App\\EducationElements\\Lesson'
        ]);

        $lesson->learningObjectives()->attach([$this->objective1->id]);

        $test = EducationElement::factory()->create([
            'type_class' => 'App\\EducationElements\\Test'
        ]);

        $test->learningObjectives()->attach([$this->objective1->id]);

        Planning::factory()->create([
            'course_id' => $this->course->id,
            'education_element_id' => $lesson->id,
            'week' => 1,
            'day' => 1
        ]);

        Planning::factory()->create([
            'course_id' => $this->course->id,
            'education_element_id' => $test->id,
            'week' => 1,
            'day' => 2
        ]);

        $this->assertFalse($this->course->verifyCompletion());
        $this->assertEquals(Status::Draft, $this->course->status);
    }

    public function test_fails_verification_when_test_objectives_not_covered(): void
    {
        $lesson = EducationElement::factory()->create([
            'type_class' => 'App\\EducationElements\\Lesson'
        ]);

        $lesson->learningObjectives()->attach([$this->objective1->id]);

        $test = EducationElement::factory()->create([
            'type_class' => 'App\\EducationElements\\Test'
        ]);

        $test->learningObjectives()->attach([
            $this->objective1->id,
            $this->objective2->id
        ]);

        Planning::factory()->create([
            'course_id' => $this->course->id,
            'education_element_id' => $lesson->id,
            'week' => 1,
            'day' => 1
        ]);

        Planning::factory()->create([
            'course_id' => $this->course->id,
            'education_element_id' => $test->id,
            'week' => 1,
            'day' => 2
        ]);

        $this->assertFalse($this->course->verifyCompletion());
        $this->assertEquals(Status::Draft, $this->course->status);
    }

    public function test_fails_verification_with_wrong_sequence(): void
    {
        $lesson = EducationElement::factory()->create([
            'type_class' => 'App\\EducationElements\\Lesson'
        ]);
        $lesson->learningObjectives()->attach([
            $this->objective1->id,
            $this->objective2->id
        ]);

        $test = EducationElement::factory()->create([
            'type_class' => 'App\\EducationElements\\Test'
        ]);
        $test->learningObjectives()->attach([
            $this->objective1->id,
            $this->objective2->id
        ]);

        Planning::factory()->create([
            'course_id' => $this->course->id,
            'education_element_id' => $test->id,
            'week' => 1,
            'day' => 1
        ]);

        Planning::factory()->create([
            'course_id' => $this->course->id,
            'education_element_id' => $lesson->id,
            'week' => 1,
            'day' => 2
        ]);

        $this->assertFalse($this->course->verifyCompletion());
        $this->assertEquals(Status::Draft, $this->course->status);
    }
}
