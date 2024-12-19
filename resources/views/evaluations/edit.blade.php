@extends('layouts.app')

@section('content')

<div class="container my-5">
    <h2 class="text-center mb-4">{{ __('Edit Evaluation') }}</h2>

    <form action="{{ route('evaluations.update', $evaluation) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="student_id" class="form-label">{{ __('Student') }}</label>
            <select class="form-control" id="student_id" name="student_id">
                @foreach($students as $student)
                    <option value="{{ $student->id }}" {{ $student->id == $evaluation->student_id ? 'selected' : '' }}>{{ $student->name }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label for="test_id" class="form-label">{{ __('Test') }}</label>
            <select class="form-control" id="test_id" name="test_id">
                @foreach($tests as $test)
                    <option value="{{ $test->id }}" {{ $test->id == $evaluation->test_id ? 'selected' : '' }}>{{ $test->name }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label for="execution_id" class="form-label">{{ __('Execution') }}</label>
            <select class="form-control" id="execution_id" name="execution_id">
                @foreach($executions as $execution)
                    <option value="{{ $execution->id }}" {{ $execution->id == $evaluation->execution_id ? 'selected' : '' }}>{{ $execution->name }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label for="grade" class="form-label">{{ __('Grade') }}</label>
            <input type="text" class="form-control" id="grade" name="grade" value="{{ old('grade') ?? $evaluation->grade }}">
        </div>

        <div class="mb-3">
            <label for="comment" class="form-label">{{ __('Comment') }}</label>
            <textarea class="form-control" id="comment" name="comment" rows="3">{{ old('comment') ?? $evaluation->comment }}</textarea>
        </div>

        <div class="d-flex justify-content-between">
            <a class="btn btn-light" href="{{ route('evaluations.index') }}">
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