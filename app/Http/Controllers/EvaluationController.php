<?php

namespace App\Http\Controllers;

use App\EducationElements\Test;
use App\Enums\Role;
use App\Models\Evaluation;
use App\Models\User;
use App\Models\EducationElement;
use App\Models\Execution;
use Illuminate\Http\Request;

class EvaluationController extends Controller
{
    public function index()
    {
        $evaluations = Evaluation::query()
            ->when(auth()->user()->isStudent(), function ($query) {
                return $query->where('student_id', auth()->id());
            })
            ->get();

        return view('evaluations.index', [
            'evaluations' => $evaluations,
        ]);
    }

    public function create()
    {
        $students = User::where('role', Role::Student)->get();
        $tests = EducationElement::where('type_class', Test::class)->get();
        $executions = Execution::all();

        return view('evaluations.create', [
            'students' => $students,
            'tests' => $tests,
            'executions' => $executions,
        ]);
    }

    public function store(Request $request)
    {
        $attributes = $request->validate([
            'student_id' => 'required|exists:users,id',
            'test_id' => 'required|exists:education_elements,id',
            'execution_id' => 'required|exists:executions,id',
            'grade' => 'required|numeric',
        ]);

        Evaluation::create($attributes);

        return redirect()->route('evaluations.index')->with('success', __('Evaluation created successfully.'));
    }

    public function edit(Evaluation $evaluation)
    {
        $students = User::where('role', Role::Student)->get();
        $tests = EducationElement::where('type_class', Test::class)->get();
        $executions = Execution::all();

        return view('evaluations.edit', [
            'evaluation' => $evaluation,
            'students' => $students,
            'tests' => $tests,
            'executions' => $executions,
        ]);
    }

    public function update(Request $request, Evaluation $evaluation)
    {
        $attributes = $request->validate([
            'student_id' => 'required|exists:users,id',
            'test_id' => 'required|exists:education_elements,id',
            'execution_id' => 'required|exists:executions,id',
            'grade' => 'required|numeric',
        ]);

        $evaluation->update($attributes);

        return redirect()->route('evaluations.index')->with('success', __('Evaluation updated successfully.'));
    }

    public function destroy(Evaluation $evaluation)
    {
        $evaluation->delete();

        return redirect()->route('evaluations.index')->with('success', __('Evaluation deleted successfully.'));
    }
}
