<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\CourseResource;
use App\Models\Course;
use Illuminate\Http\Request;

class CourseController extends Controller
{
    public function index(Request $request)
    {
        $perPage = 10;
        $courses = Course::query()
            ->with([
                'executions',
                'teacher',
                'resources',
                'plannings',
                'learningObjectives',
            ])
            ->whereIsPlannable()
            ->paginate($perPage);

        return CourseResource::collection($courses);
    }
}
