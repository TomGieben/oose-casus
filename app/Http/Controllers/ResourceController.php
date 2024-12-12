<?php

namespace App\Http\Controllers;

use App\Models\Resource;
use App\Models\Course;
use App\Models\EducationElement;
use Illuminate\Http\Request;

class ResourceController extends Controller
{
    public function index()
    {
        $resources = Resource::with('course', 'educationElement')->get();
        return view('resources.index', [
            'resources' => $resources
        ]);
    }

    public function create()
    {
        $courses = Course::all();
        if ($courses->isEmpty()) {
            return redirect()->route('courses.create')->withErrors('You need to create a course first.');
        }

        $educationElements = EducationElement::all();
        if ($educationElements->isEmpty()) {
            return redirect()->route('education-elements.create')->withErrors('You need to create an education element first.');
        }

        return view('resources.create', [
            'courses' => $courses,
            'educationElements' => $educationElements,
        ]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'course_id' => 'required|exists:courses,id',
            'education_element_id' => 'required|exists:education_elements,id',
            'name' => 'required|string|max:255',
            'content' => 'required|string',
        ]);

        Resource::create($validated);
        return redirect()->route('resources.index');
    }

    public function edit(Resource $resource)
    {
        $courses = Course::all();
        $educationElements = EducationElement::all();

        return view('resources.edit', [
            'resource' => $resource,
            'courses' => $courses,
            'educationElements' => $educationElements,
        ]);
    }

    public function update(Request $request, Resource $resource)
    {
        $validated = $request->validate([
            'course_id' => 'required|exists:courses,id',
            'education_element_id' => 'required|exists:education_elements,id',
            'name' => 'required|string|max:255',
            'content' => 'required|string',
        ]);

        $resource->update($validated);
        return redirect()->route('resources.index');
    }

    public function destroy(Resource $resource)
    {
        $resource->delete();
        return redirect()->route('resources.index');
    }
}
