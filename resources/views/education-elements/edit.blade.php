
@extends('layouts.app')

@section('content')

<div class="container my-5">
    <h2 class="text-center mb-4">{{ __('Edit Education Element') }}</h2>

    <form action="{{ route('education-elements.update', $educationElement) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="name" class="form-label">{{ __('Name') }}</label>
            <input type="text" class="form-control" id="name" name="name" value="{{ old('name') ?? $educationElement->name }}">
        </div>

        <div class="mb-3">
            <label for="type_class" class="form-label">{{ __('Type') }}</label>
            <select class="form-control" id="type_class" name="type_class">
                @foreach ($types as $type)
                    <option value="{{ $type->value }}" @selected($type->value == old('type_class', $educationElement->type_class->value))>
                        {{ $type->label() }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label for="learning_objectives" class="form-label d-flex justify-content-between">
                <span>{{ __('Learning Objectives') }}</span>
                <small class="text-muted">
                    {{ __('(Hold down the Ctrl (windows) or Command (Mac) button to select multiple options)') }}
                </small>
            </label>
            <select multiple class="form-control" id="learning_objectives" name="learning_objectives[]">
                @foreach ($learningObjectives as $learningObjective)
                    <option value="{{ $learningObjective->id }}"
                        {{ in_array($learningObjective->id, old('learning_objectives') ?? $educationElement->learningObjectives->pluck('id')->toArray()) ? 'selected' : '' }}>
                        {{ $learningObjective->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="d-flex justify-content-between">
            <a class="btn btn-light" href="{{ route('education-elements.index') }}">
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