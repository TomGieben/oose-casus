
@extends('layouts.app')

@section('content')

<div class="container my-5">
    <h2 class="mb-4">{{ __('Evaluations') }}</h2>

    @can('admin', 'teacher')
        <div class="d-flex justify-content-end mb-3">
            <a class="btn btn-secondary" href="{{ route('evaluations.create') }}">
                <i class="fas fa-plus"></i> 
                {{ __('Add Evaluation') }}
            </a>
        </div>
    @endcan

    <table class="table table-striped">
        <thead class="table-light">
            <tr>
                <th scope="col">{{ __('Student') }}</th>
                <th scope="col">{{ __('Test') }}</th>
                <th scope="col">{{ __('Execution') }}</th>
                <th scope="col">{{ __('Grade') }}</th>
                @can('admin', 'teacher')
                    <th scope="col">{{ __('Actions') }}</th>
                @endcan
            </tr>
        </thead>
        <tbody>
            @if ($evaluations->isEmpty())
                <tr>
                    <td colspan="5" class="text-center">
                        {{ __('No evaluations found') }}
                    </td>
                </tr>
            @endif
            @foreach ($evaluations as $evaluation)
                <tr>
                    <td>{{ $evaluation->student->name }}</td>
                    <td>{{ $evaluation->test->name }}</td>
                    <td>{{ $evaluation->execution->name }}</td>
                    <td>{{ $evaluation->grade }}</td>
                    @can('admin', 'teacher')
                        <td>
                            <a class="btn btn-sm btn-warning me-1" href="{{ route('evaluations.edit', $evaluation) }}">
                                <i class="fas fa-edit"></i>
                            </a>
                            <x-delete-button :route="route('evaluations.destroy', $evaluation)" small/>
                        </td>
                    @endcan
                </tr>
            @endforeach
        </tbody>
    </table>
</div>

@endsection