<?php

namespace App\Http\Controllers;

use App\Enums\Day;
use App\Enums\Week;
use App\Models\Planning;
use App\Models\Course;
use App\Models\EducationElement;
use App\Users\Student;
use Illuminate\Http\Request;

class PlanningController extends Controller
{
    public function index()
    {
        $plannings = Planning::query()
            ->when(auth()->user()->isStudent(), function ($query) {
                return $query->whereHas('course.executions', function ($query) {
                    $query->whereIn('group_id', Student::find(auth()->id())->groups->pluck('id'));
                });
            })
            ->with(['course.executions'])
            ->orderBy('week', 'asc')
            ->orderBy('day', 'asc')
            ->orderBy('starts_at', 'asc')
            ->get()
            ->map(function ($planning) {
                $planning->execution_date = $planning?->course?->executions?->first()?->date ?? date('Y-m-d');
                return $planning;
            });

        return view('plannings.index', [
            'plannings' => $plannings
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

        return view('plannings.create', [
            'courses' => $courses,
            'educationElements' => $educationElements,
        ]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'course_id' => 'required|exists:courses,id',
            'education_element_id' => 'required|exists:education_elements,id',
            'week' => 'required|in:' . implode(',', Week::values()),
            'day' => 'required|in:' . implode(',', Day::values()),
            'starts_at' => 'required|date_format:H:i|before:ends_at',
            'ends_at' => 'required|date_format:H:i|after:starts_at',
        ]);

        Planning::create($validated);
        return redirect()->route('plannings.index');
    }


    public function edit(Planning $planning)
    {
        $courses = Course::all();
        $educationElements = EducationElement::all();

        return view('plannings.edit', [
            'planning' => $planning,
            'courses' => $courses,
            'educationElements' => $educationElements,
        ]);
    }

    public function update(Request $request, Planning $planning)
    {
        $validated = $request->validate([
            'course_id' => 'required|exists:courses,id',
            'education_element_id' => 'required|exists:education_elements,id',
            'week' => 'required|in:' . implode(',', Week::values()),
            'day' => 'required|in:' . implode(',', Day::values()),
            'starts_at' => 'required|date_format:H:i|before:ends_at',
            'ends_at' => 'required|date_format:H:i|after:starts_at',
        ]);

        $planning->update($validated);
        return redirect()->route('plannings.index');
    }

    public function destroy(Planning $planning)
    {
        $planning->delete();
        return redirect()->route('plannings.index');
    }
}
