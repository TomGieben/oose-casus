<?php

namespace App\Http\Controllers;

use App\Enums\Role;
use App\Models\Execution;
use App\Models\Course;
use App\Models\Classroom;
use App\Models\Group;
use App\Models\User;
use Illuminate\Http\Request;

class ExecutionController extends Controller
{
    public function index()
    {
        $executions = Execution::all();

        return view('executions.index', [
            'executions' => $executions,
        ]);
    }

    public function create()
    {
        $courses = Course::all();
        $classrooms = Classroom::all();
        $groups = Group::all();
        $teachers = User::where('role', Role::Teacher)->get();

        return view('executions.create', [
            'courses' => $courses,
            'classrooms' => $classrooms,
            'groups' => $groups,
            'teachers' => $teachers,
        ]);
    }

    public function store(Request $request)
    {
        $attributes = $request->validate([
            'group_id' => 'required|exists:groups,id',
            'teacher_id' => 'required|exists:users,id',
            'classroom_id' => 'required|exists:classrooms,id',
            'course_id' => 'required|exists:courses,id',
            'date' => 'required|date',
        ]);

        Execution::create($attributes);

        return redirect()->route('executions.index')->with('success', __('Execution created successfully.'));
    }

    public function edit(Execution $execution)
    {
        $courses = Course::all();
        $classrooms = Classroom::all();
        $groups = Group::all();
        $teachers = User::where('role', Role::Teacher)->get();

        return view('executions.edit', [
            'execution' => $execution,
            'courses' => $courses,
            'classrooms' => $classrooms,
            'groups' => $groups,
            'teachers' => $teachers,
        ]);
    }

    public function update(Request $request, Execution $execution)
    {
        $attributes = $request->validate([
            'group_id' => 'required|exists:groups,id',
            'teacher_id' => 'required|exists:users,id',
            'classroom_id' => 'required|exists:classrooms,id',
            'course_id' => 'required|exists:courses,id',
            'date' => 'required|date',
        ]);

        $execution->update($attributes);

        return redirect()->route('executions.index')->with('success', __('Execution updated successfully.'));
    }

    public function destroy(Execution $execution)
    {
        $execution->delete();

        return redirect()->route('executions.index')->with('success', __('Execution deleted successfully.'));
    }
}
