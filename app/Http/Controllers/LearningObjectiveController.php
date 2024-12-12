<?php

namespace App\Http\Controllers;

use App\Models\LearningObjective;
use Illuminate\Http\Request;

class LearningObjectiveController extends Controller
{
    public function index()
    {
        $learningObjectives = LearningObjective::all();

        return view('learning-objectives.index', [
            'learningObjectives' => $learningObjectives,
        ]);
    }

    public function create()
    {
        return view('learning-objectives.create');
    }

    public function store(Request $request)
    {
        $attributes = $request->validate([
            'name' => 'required',
            'description' => 'required',
        ]);

        LearningObjective::create($attributes);

        return redirect()->route('learning-objectives.index')->with('success', __('Learning Objective created successfully'));
    }

    public function edit(LearningObjective $learningObjective)
    {
        return view('learning-objectives.edit', [
            'learningObjective' => $learningObjective,
        ]);
    }

    public function update(Request $request, LearningObjective $learningObjective)
    {
        $attributes = $request->validate([
            'name' => 'required',
            'description' => 'required',
        ]);

        $learningObjective->update($attributes);

        return redirect()->route('learning-objectives.index')->with('success', __('Learning Objective updated successfully'));
    }

    public function destroy(LearningObjective $learningObjective)
    {
        $learningObjective->delete();

        return redirect()->route('learning-objectives.index')->with('success', __('Learning Objective deleted successfully'));
    }
}
