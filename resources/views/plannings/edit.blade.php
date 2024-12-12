
@extends('layouts.app')

@section('content')

<div class="container my-5">
    <h2 class="text-center mb-4">{{ __('Edit Planning') }}</h2>

    <form action="{{ route('plannings.update', $planning) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="course_id" class="form-label">{{ __('Course') }}</label>
            <select class="form-control" id="course_id" name="course_id">
                @foreach ($courses as $course)
                    <option value="{{ $course->id }}" {{ $course->id == $planning->course_id ? 'selected' : '' }}>
                        {{ $course->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label for="education_element_id" class="form-label">{{ __('Education element') }}</label>
            <select class="form-control" id="education_element_id" name="education_element_id">
                @foreach ($educationElements as $educationElement)
                    <option value="{{ $educationElement->id }}" {{ $educationElement->id == $planning->education_element_id ? 'selected' : '' }}>
                        {{ $educationElement->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label for="week" class="form-label">{{ __('Week') }}</label>
            <select class="form-control" id="week" name="week">
                @foreach (App\Enums\Week::asArray() as $week)
                    <option value="{{ $week->value }}">{{ $week->label() }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label for="day" class="form-label">{{ __('Day') }}</label>
            <select class="form-control" id="day" name="day">
                @foreach (App\Enums\Day::asArray() as $day)
                    <option value="{{ $day->value }}">{{ $day->label() }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label for="starts_at" class="form-label">{{ __('Starts At') }}</label>
            <input type="time" class="form-control" id="starts_at" name="starts_at" value="{{ old('starts_at') ?? $planning->starts_at->format('H:i') }}">
        </div>

        <div class="mb-3">
            <label for="ends_at" class="form-label">{{ __('Ends At') }}</label>
            <input type="time" class="form-control" id="ends_at" name="ends_at" value="{{ old('ends_at') ?? $planning->ends_at->format('H:i') }}">
        </div>

        <div class="d-flex justify-content-between">
            <a class="btn btn-light" href="{{ route('plannings.index') }}">
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