<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Enums\Status;
use App\Models\LearningObjective;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CourseController extends Controller
{
    public function index()
    {
        $courses = Course::all();
        return view('courses.index', [
            'courses' => $courses,
        ]);
    }

    public function create()
    {
        $learningObjectives = LearningObjective::all();

        return view('courses.create', [
            'learningObjectives' => $learningObjectives,
        ]);
    }

    public function store(Request $request)
    {
        $attributes = $request->validate([
            'name' => 'required|unique:courses,name',
            'learning_objectives' => 'required|array|min:1',
        ]);

        $course = new Course([
            'teacher_id' => Auth::id(),
            'name' => $attributes['name'],
            'status' =>  Status::Draft,
        ]);

        if ($course->save()) {
            $course->learningObjectives()->sync($attributes['learning_objectives']);

            return redirect()->route('courses.index')->with('success', 'Course created successfully.');
        } else {
            return redirect()->route('courses.create')->with('error', 'Failed to create course.');
        }
    }

    public function edit(Course $course)
    {
        $learningObjectives = LearningObjective::all();

        return view('courses.edit', [
            'course' => $course,
            'learningObjectives' => $learningObjectives,
        ]);
    }

    public function update(Request $request, Course $course)
    {
        $attributes = $request->validate([
            'name' => 'required|unique:courses,name,' . $course->id,
            'learning_objectives' => 'required|array|min:1',
        ]);

        $course->name = $attributes['name'];
        $course->status = Status::Draft;

        $course->learningObjectives()->sync($attributes['learning_objectives']);

        if ($course->save()) {
            return redirect()->route('courses.index')->with('success', 'Course updated successfully.');
        } else {
            return redirect()->route('courses.edit', $course)->with('error', 'Failed to update course.');
        }
    }

    public function destroy(Course $course)
    {
        if ($course->delete()) {
            return redirect()->route('courses.index')->with('success', 'Course deleted successfully.');
        } else {
            return redirect()->route('courses.index')->with('error', 'Failed to delete course.');
        }
    }

    public function complete(Course $course)
    {
        if ($course->verifyCompletion()) {
            return redirect()->route('courses.index')->with('success', 'Course completed successfully.');
        } else {
            return redirect()->route('courses.index')->with('error', 'Failed to complete course, there are still incomplete learning objectives.');
        }
    }
}
