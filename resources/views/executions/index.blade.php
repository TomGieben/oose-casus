
@extends('layouts.app')

@section('content')

<div class="container my-5">
    <h2 class="mb-4">{{ __('Executions') }}</h2>

    <div class="d-flex justify-content-end mb-3">
        <a class="btn btn-secondary" href="{{ route('executions.create') }}">
            <i class="fas fa-plus"></i> 
            {{ __('Add Execution') }}
        </a>
    </div>

    <table class="table table-striped">
        <thead class="table-light">
            <tr>
                <th scope="col">{{ __('Group') }}</th>
                <th scope="col">{{ __('Teacher') }}</th>
                <th scope="col">{{ __('Classroom') }}</th>
                <th scope="col">{{ __('Course') }}</th>
                <th scope="col">{{ __('Date') }}</th>
                <th scope="col">{{ __('Actions') }}</th>
            </tr>
        </thead>
        <tbody>
            @if ($executions->isEmpty())
                <tr>
                    <td colspan="6" class="text-center">
                        {{ __('No executions found') }}
                    </td>
                </tr>
            @endif
            @foreach ($executions as $execution)
                <tr>
                    <td>{{ $execution->group->number }}</td>
                    <td>{{ $execution->teacher->name }}</td>
                    <td>{{ $execution->classroom->number }}</td>
                    <td>{{ $execution->course->name }}</td>
                    <td>{{ $execution->date->format('Y-m-d') }}</td>
                    <td>
                        <a class="btn btn-sm btn-warning me-1" href="{{ route('executions.edit', $execution) }}">
                            <i class="fas fa-edit"></i>
                        </a>
                        <x-delete-button :route="route('executions.destroy', $execution)" small/>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>

@endsection