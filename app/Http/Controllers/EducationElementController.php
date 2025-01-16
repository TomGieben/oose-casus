<?php

namespace App\Http\Controllers;

use App\Models\EducationElement;
use App\Enums\EducationElementType;
use App\Models\LearningObjective;
use Illuminate\Http\Request;

class EducationElementController extends Controller
{
    public function index()
    {
        $educationElements = EducationElement::all();
        
        return view('education-elements.index', [
            'educationElements' => $educationElements,
        ]);
    }

    public function create()
    {
        return view('education-elements.create', [
            'types' => EducationElementType::asArray(),
            'learningObjectives' => LearningObjective::all(),
        ]);
    }

    public function store(Request $request)
    {
        $attributes = $request->validate([
            'name' => 'required|string|max:255',
            'type_class' => 'required|in:' . implode(',', EducationElementType::values()),
            'learning_objectives' => 'required|array|min:1',
        ]);

        $educationElement = EducationElement::create([
            'name' => $attributes['name'],
            'type_class' => $attributes['type_class'],
        ]);
        
        $educationElement->learningObjectives()->sync($attributes['learning_objectives']);

        return redirect()->route('education-elements.index')
            ->with('success', __('Education element created successfully. Do you want to <a href=":route">add resources</a> to it?', [
                'route' => route('resources.create') . '?education_element_id=' . $educationElement->id,
            ]));
    }


    public function edit(EducationElement $educationElement)
    {
        return view('education-elements.edit', [
            'educationElement' => $educationElement,
            'types' => EducationElementType::asArray(),
            'learningObjectives' => LearningObjective::all(),
        ]);
    }

    public function update(Request $request, EducationElement $educationElement)
    {
        $attributes = $request->validate([
            'name' => 'required|string|max:255',
            'type_class' => 'required|in:' . implode(',', EducationElementType::values()),
            'learning_objectives' => 'required|array|min:1',
        ]);

        $educationElement->learningObjectives()->sync($attributes['learning_objectives']);

        $educationElement->update([
            'name' => $attributes['name'],
            'type_class' => $attributes['type_class'],
        ]);

        return redirect()->route('education-elements.index')
            ->with('success', __('Education element updated successfully. Do you want to <a href=":route">add resources</a> to it?', [
                'route' => route('resources.create') . '?education_element_id=' . $educationElement->id,
            ]));
    }

    public function destroy(EducationElement $educationElement)
    {
        $educationElement->delete();

        return redirect()->route('education-elements.index');
    }
}
