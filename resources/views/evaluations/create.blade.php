
@extends('layouts.app')

@section('content')
<div class="container my-5">
    <h2 class="text-center mb-4">{{ __('Add Evaluation') }}</h2>

    <form action="{{ route('evaluations.store') }}" method="POST">
        @csrf

        <div class="mb-3">
            <label for="student_id" class="form-label">{{ __('Student') }}</label>
            <select class="form-control" id="student_id" name="student_id">
                @foreach($students as $student)
                    <option value="{{ $student->id }}">{{ $student->name }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label for="test_id" class="form-label">{{ __('Test') }}</label>
            <select class="form-control" id="test_id" name="test_id">
                @foreach($tests as $test)
                    <option value="{{ $test->id }}">{{ $test->name }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label for="execution_id" class="form-label">{{ __('Execution') }}</label>
            <select class="form-control" id="execution_id" name="execution_id">
                @foreach($executions as $execution)
                    <option value="{{ $execution->id }}">{{ $execution->name }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label for="grade" class="form-label">{{ __('Grade') }}</label>
            <input type="text" class="form-control" id="grade" name="grade" value="{{ old('grade') }}">
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