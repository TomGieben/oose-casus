<?php

namespace App\Http\Controllers;

use App\Models\EducationElement;
use App\Enums\EducationElementType;
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
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'type_class' => 'required|in:' . implode(',', EducationElementType::values()),
        ]);

        EducationElement::create($request->all());

        return redirect()->route('education-elements.index');
    }


    public function edit(EducationElement $educationElement)
    {
        return view('education-elements.edit', [
            'educationElement' => $educationElement,
            'types' => EducationElementType::asArray(),
        ]);
    }

    public function update(Request $request, EducationElement $educationElement)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'type_class' => 'required|in:' . implode(',', EducationElementType::values()),
        ]);

        $educationElement->update($request->all());

        return redirect()->route('education-elements.index');
    }

    public function destroy(EducationElement $educationElement)
    {
        $educationElement->delete();

        return redirect()->route('education-elements.index');
    }
}
