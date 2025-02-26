
@extends('layouts.app')

@section('content')

<div class="container my-5">
    <h2 class="mb-4">{{ __('Plannings') }}</h2>

    @can('admin', 'teacher')
        <div class="d-flex justify-content-end mb-3">
            <a class="btn btn-secondary" href="{{ route('plannings.create') }}">
                <i class="fas fa-plus"></i> 
                {{ __('Add Planning') }}
            </a>
        </div>
    @endcan

    <table class="table table-striped">
        <thead class="table-light">
            <tr>
                <th scope="col">{{ __('Course') }}</th>
                <th scope="col">{{ __('Education element') }}</th>
                @can('student')
                    <th scope="col">{{ __('Date') }}</th>
                @endcan
                <th scope="col">{{ __('Week') }}</th>
                <th scope="col">{{ __('Day') }}</th>
                <th scope="col">{{ __('Starts At') }}</th>
                <th scope="col">{{ __('Ends At') }}</th>
                @can('admin', 'teacher')
                    <th scope="col">{{ __('Actions') }}</th>
                @endcan
            </tr>
        </thead>
        <tbody>
            @if ($plannings->isEmpty())
                <tr>
                    <td colspan="7" class="text-center">
                        {{ __('No plannings found') }}
                    </td>
                </tr>
            @endif
            @foreach ($plannings as $planning)
                <tr>
                    <th scope="row">{{ $planning->course->name }}</th>
                    <th scope="row">{{ $planning->educationElement->name }}</th>
                    <td>{{ $planning->execution_date }}</td>
                    <td>{{ $planning->week->label() }}</td>
                    <td>{{ $planning->day->label() }}</td>
                    <td>{{ $planning->starts_at->format('H:i') }}</td>
                    <td>{{ $planning->ends_at->format('H:i') }}</td>
                    @can('admin', 'teacher')
                        <td>
                            <a class="btn btn-sm btn-warning me-1" href="{{ route('plannings.edit', $planning) }}">
                                <i class="fas fa-edit"></i>
                            </a>
                            <x-delete-button :route="route('plannings.destroy', $planning)" small/>
                        </td>
                    @endcan
                </tr>
            @endforeach
        </tbody>
    </table>
</div>

@endsection