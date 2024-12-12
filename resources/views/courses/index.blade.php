@extends('layouts.app')

@section('content')

<div class="container my-5">
    <h2 class="mb-4">{{ __('Courses') }}</h2>

    <div class="d-flex justify-content-end mb-3">
        <a class="btn btn-secondary" href="{{ route('courses.create') }}">
            <i class="fas fa-plus"></i> 
            {{ __('Add New Course') }}
        </a>
    </div>

    <table class="table table-striped">
        <thead class="table-light">
            <tr>
                <th scope="col">{{ __('Name') }}</th>
                <th scope="col">{{ __('Status') }}</th>
                <th scope="col">{{ __('Actions') }}</th>
            </tr>
        </thead>
        <tbody>
            @if ($courses->isEmpty())
                <tr>
                    <td colspan="3" class="text-center">
                        {{ __('No courses found') }}
                    </td>
                </tr>
            @endif
            @foreach ($courses as $course)
                <tr>
                    <th scope="row">{{ $course->name }}</th>
                    <th scope="row">{{ $course->status }}</th>
                    <td>
                        <a class="btn btn-sm btn-warning me-1" href="{{ route('courses.edit', $course) }}">
                            <i class="fas fa-edit"></i>
                        </a>
                        <x-delete-button :route="route('courses.destroy', $course)" small/>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>

@endsection