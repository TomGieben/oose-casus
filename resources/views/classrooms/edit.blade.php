@extends('layouts.app')

@section('content')

<div class="container my-5">
    <h2 class="text-center mb-4">{{ __('Edit Classroom') }}</h2>

    <form action="{{ route('classrooms.store') }}" method="POST">
        @csrf
        @method('POST')

        <div class="mb-3">
            <label for="number" class="form-label">{{ __('Number') }}</label>
            <input type="text" class="form-control" id="number" name="number" value="{{ old('number') ?? $classroom->number }}">
        </div>

        <div class="d-flex justify-content-between">
            <a class="btn btn-light" href="{{ route('classrooms.index') }}">
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