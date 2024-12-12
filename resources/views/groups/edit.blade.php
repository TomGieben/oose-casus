
@extends('layouts.app')

@section('content')

<div class="container my-5">
    <h2 class="text-center mb-4">{{ __('Edit Group') }}</h2>

    <form action="{{ route('groups.update', $group) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="number" class="form-label">{{ __('Number') }}</label>
            <input type="text" class="form-control" id="number" name="number" value="{{ old('number') ?? $group->number }}">
        </div>

        <div class="mb-3">
            <label for="students" class="form-label d-flex justify-content-between">
                <span>{{ __('Students') }}</span>
                <small class="text-muted">
                    {{ __('(Hold down the Ctrl (windows) or Command (Mac) button to select multiple options)') }}
                </small>
            </label>
            <select multiple class="form-control" id="students" name="students[]">
                @foreach ($students as $student)
                    <option value="{{ $student->id }}" {{ in_array($student->id, $group->students->pluck('id')->toArray()) ? 'selected' : '' }}>
                        {{ $student->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="d-flex justify-content-between">
            <a class="btn btn-light" href="{{ route('groups.index') }}">
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