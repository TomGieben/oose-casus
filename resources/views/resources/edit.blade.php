@extends('layouts.app')

@section('content')

<div class="container my-5">
    <h2 class="text-center mb-4">{{ __('Edit Resource') }}</h2>

    <form action="{{ route('resources.update', $resource) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="course_id" class="form-label">{{ __('Course') }}</label>
            <select class="form-control" id="course_id" name="course_id" onchange="toggleSelection('course_id', 'education_element_id')" @if(!$resource->course_id) disabled @endif>
                <option value="">{{ __('No Course selected') }}</option>
                @foreach ($courses as $course)
                    <option value="{{ $course->id }}" {{ $course->id == $resource->course_id ? 'selected' : '' }}>
                        {{ $course->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label for="education_element_id" class="form-label">{{ __('Education element') }}</label>
            <select class="form-control" id="education_element_id" name="education_element_id" onchange="toggleSelection('education_element_id', 'course_id')" @if(!$resource->education_element_id) disabled @endif>
                <option value="">{{ __('No Education element selected') }}</option>
                @foreach ($educationElements as $educationElement)
                    <option value="{{ $educationElement->id }}" {{ $educationElement->id == $resource->education_element_id ? 'selected' : '' }}>
                        {{ $educationElement->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label for="name" class="form-label">{{ __('Name') }}</label>
            <input type="text" class="form-control" id="name" name="name" value="{{ old('name') ?? $resource->name }}">
        </div>

        <div class="mb-3">
            <label for="content" class="form-label">{{ __('Content') }}</label>
            <textarea class="form-control" id="content" name="content">{{ old('content') ?? $resource->content }}</textarea>
        </div>

        <div class="d-flex justify-content-between">
            <a class="btn btn-light" href="{{ route('resources.index') }}">
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

<script>
    function toggleSelection(selectedId, otherId) {
        const selectedElement = document.getElementById(selectedId);
        const otherElement = document.getElementById(otherId);
        if (selectedElement.value) {
            otherElement.disabled = true;
        } else {
            otherElement.disabled = false;
        }
    }
</script>

@endsection