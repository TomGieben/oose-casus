<?php

namespace App\Http\Controllers;

use App\Models\Group;
use App\Models\User;
use Illuminate\Http\Request;

class GroupController extends Controller
{
    public function index()
    {
        $groups = Group::all();

        return view('groups.index', [
            'groups' => $groups,
        ]);
    }

    public function create()
    {
        $students = User::where('role', 'student')->get();

        return view('groups.create', [
            'students' => $students,
        ]);
    }

    public function store(Request $request)
    {
        $attributes = $request->validate([
            'number' => 'required|max:10|unique:groups',
            'students' => 'required|array',
        ]);

        $group = Group::create($attributes);
        $group->students()->sync($attributes['students']);

        return redirect()->route('groups.index')->with('success', __('Group created successfully.'));
    }

    public function edit(Group $group)
    {
        $students = User::where('role', 'student')->get();

        return view('groups.edit', [
            'group' => $group,
            'students' => $students,
        ]);
    }

    public function update(Request $request, Group $group)
    {
        $attributes = $request->validate([
            'number' => 'required|max:10|unique:groups,number,' . $group->id,
            'students' => 'required|array',
        ]);

        $group->update($attributes);
        $group->students()->sync($attributes['students']);

        return redirect()->route('groups.index')->with('success', __('Group updated successfully.'));
    }

    public function destroy(Group $group)
    {
        $group->delete();

        return redirect()->route('groups.index')->with('success', __('Group deleted successfully.'));
    }
}
