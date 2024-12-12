@extends('layouts.app')

@section('content')
    <div class="container my-5">
        <h2 class="text-center mb-4">{{ __('Add Course') }}</h2>

        <form action="{{ route('courses.store') }}" method="POST">
            @csrf
            @method('POST')

            <div class="mb-3">
                <label for="name" class="form-label">{{ __('Course Name') }}</label>
                <input type="text" class="form-control" id="name" name="name" value="{{ old('name') }}" required>
            </div>

            <div class="d-flex justify-content-between">
                <a class="btn btn-light" href="{{ route('courses.index') }}">
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
