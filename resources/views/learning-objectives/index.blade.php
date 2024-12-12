
@extends('layouts.app')

@section('content')

<div class="container my-5">
    <h2 class="mb-4">{{ __('Learning Objectives') }}</h2>

    <div class="d-flex justify-content-end mb-3">
        <a class="btn btn-secondary" href="{{ route('learning-objectives.create') }}">
            <i class="fas fa-plus"></i> 
            {{ __('Add Learning Objective') }}
        </a>
    </div>

    <table class="table table-striped">
        <thead class="table-light">
            <tr>
                <th scope="col">{{ __('Name') }}</th>
                <th scope="col">{{ __('Description') }}</th>
                <th scope="col">{{ __('Actions') }}</th>
            </tr>
        </thead>
        <tbody>
            @if ($learningObjectives->isEmpty())
                <tr>
                    <td colspan="3" class="text-center">
                        {{ __('No learning objectives found') }}
                    </td>
                </tr>
            @endif
            @foreach ($learningObjectives as $learningObjective)
                <tr>
                    <th scope="row">{{ $learningObjective->name }}</th>
                    <td>{{ $learningObjective->description }}</td>
                    <td>
                        <a class="btn btn-sm btn-warning me-1" href="{{ route('learning-objectives.edit', $learningObjective) }}">
                            <i class="fas fa-edit"></i>
                        </a>
                        <x-delete-button :route="route('learning-objectives.destroy', $learningObjective)" small/>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>

@endsection