
@extends('layouts.app')

@section('content')

<div class="container my-5">
    <h2 class="text-center mb-4">{{ __('Edit Learning Objective') }}</h2>

    <form action="{{ route('learning-objectives.update', $learningObjective) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="name" class="form-label">{{ __('Name') }}</label>
            <input type="text" class="form-control" id="name" name="name" value="{{ old('name') ?? $learningObjective->name }}">
        </div>

        <div class="mb-3">
            <label for="description" class="form-label">{{ __('Description') }}</label>
            <textarea class="form-control" id="description" name="description" rows="3">{{ old('description') ?? $learningObjective->description }}</textarea>
        </div>

        <div class="d-flex justify-content-between">
            <a class="btn btn-light" href="{{ route('learning-objectives.index') }}">
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