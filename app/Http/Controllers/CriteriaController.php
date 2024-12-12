<?php

namespace App\Http\Controllers;

use App\Models\Criteria;
use Illuminate\Http\Request;

class CriteriaController extends Controller
{
    public function index()
    {
        $criterias = Criteria::all();

        return view('criteria.index', [
            'criterias' => $criterias,
        ]);
    }

    public function create()
    {
        return view('criteria.create');
    }

    public function store(Request $request)
    {
        $attributes = $request->validate([
            'name' => 'required',
            'description' => 'required',
        ]);

        Criteria::create($attributes);

        return redirect()->route('criteria.index')->with('success', __('Criteria created successfully'));
    }

    public function edit(Criteria $criterion)
    {
        return view('criteria.edit', [
            'criterion' => $criterion,
        ]);
    }

    public function update(Request $request, Criteria $criterion)
    {
        $attributes = $request->validate([
            'name' => 'required',
            'description' => 'required',
        ]);

        $criterion->update($attributes);

        return redirect()->route('criteria.index')->with('success', __('Criteria updated successfully'));
    }

    public function destroy(Criteria $criterion)
    {
        $criterion->delete();

        return redirect()->route('criteria.index')->with('success', __('Criteria deleted successfully'));
    }
}
