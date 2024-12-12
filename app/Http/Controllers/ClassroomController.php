<?php

namespace App\Http\Controllers;

use App\Models\Classroom;
use Illuminate\Http\Request;

class ClassroomController extends Controller
{
    public function index()
    {
        $classrooms = Classroom::all();

        return view('classrooms.index', [
            'classrooms' => $classrooms,
        ]);
    }

    public function create()
    {
        return view('classrooms.create');
    }

    public function store(Request $request)
    {
        $attributes = $request->validate([
            'number' => 'required|unique:classrooms',
        ]);

        Classroom::create($attributes);

        return redirect()->route('classrooms.index')->with('success', __('Classroom created successfully.'));
    }

    public function edit(Classroom $classroom)
    {
        return view('classrooms.edit', [
            'classroom' => $classroom,
        ]);
    }

    public function update(Request $request, Classroom $classroom)
    {
        $attributes = $request->validate([
            'number' => 'required|unique:classrooms,number,' . $classroom->id,
        ]);

        $classroom->update($attributes);

        return redirect()->route('classrooms.index')->with('success', __('Classroom updated successfully.'));
    }

    public function destroy(Classroom $classroom)
    {
        $classroom->delete();

        return redirect()->route('classrooms.index')->with('success', __('Classroom deleted successfully.'));
    }
}
