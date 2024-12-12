@extends('layouts.app')

@section('content')

<div class="container my-5">
    <h2 class="text-center mb-4">{{ __('Add Execution') }}</h2>

    <form action="{{ route('executions.store') }}" method="POST">
        @csrf
        @method('POST')

        <div class="mb-3">
            <label for="group_id" class="form-label">{{ __('Group') }}</label>
            <select class="form-control" id="group_id" name="group_id">
                @foreach($groups as $group)
                    <option value="{{ $group->id }}">{{ $group->number }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label for="teacher_id" class="form-label">{{ __('Teacher') }}</label>
            <select class="form-control" id="teacher_id" name="teacher_id">
                @foreach($teachers as $teacher)
                    <option value="{{ $teacher->id }}">{{ $teacher->name }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label for="classroom_id" class="form-label">{{ __('Classroom') }}</label>
            <select class="form-control" id="classroom_id" name="classroom_id">
                @foreach($classrooms as $classroom)
                    <option value="{{ $classroom->id }}">{{ $classroom->number }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label for="course_id" class="form-label">{{ __('Course') }}</label>
            <select class="form-control" id="course_id" name="course_id">
                @foreach($courses as $course)
                    <option value="{{ $course->id }}">{{ $course->name }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label for="date" class="form-label">{{ __('Date') }}</label>
            <input type="date" class="form-control" id="date" name="date" value="{{ old('date') }}">
        </div>

        <div class="d-flex justify-content-between">
            <a class="btn btn-light" href="{{ route('executions.index') }}">
                <i class="fas fa-arrow-left"></i> 
                {{ __('Back') }}
            </a>
            <button type="submit" class="btn btn-success">
                <i class="fas fa-save"></i> 
                {{ __('Save') }}
            </button>
        </div>

    </form>
</div>

@endsection