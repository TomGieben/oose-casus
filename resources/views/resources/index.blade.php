@extends('layouts.app')

@section('content')

<div class="container my-5">
    <h2 class="mb-4">{{ __('Resources') }}</h2>

    <div class="d-flex justify-content-end mb-3">
        <a class="btn btn-secondary me-2" href="{{ route('resources.create') }}">
            <i class="fas fa-plus"></i> 
            {{ __('Add Resource') }}
        </a>
    </div>

    <table class="table table-striped table-responsive">
        <thead class="table-light">
            <tr>
                <th scope="col">{{ __('Course') }}</th>
                <th scope="col">{{ __('Education element') }}</th>
                <th scope="col">{{ __('Name') }}</th>
                <th scope="col" class="limited-width">{{ __('Content') }}</th>
                <th scope="col">{{ __('Actions') }}</th>
            </tr>
        </thead>
        <tbody>
            @if ($resources->isEmpty())
                <tr>
                    <td colspan="5" class="text-center">
                        {{ __('No resources found') }}
                    </td>
                </tr>
            @endif
            @foreach ($resources as $resource)
                <tr>
                    <th scope="row">{{ $resource->course->name }}</th>
                    <th scope="row">{{ $resource->educationElement->name }}</th>
                    <td scope="row">{{ $resource->name }}</td>
                    <td scope="row" class="limited-width">{{ $resource->content }}</td>
                    <td scope="row">
                        <a class="btn btn-sm btn-warning me-1" href="{{ route('resources.edit', $resource) }}">
                            <i class="fas fa-edit"></i>
                        </a>
                        <x-delete-button :route="route('resources.destroy', $resource)" small/>
                        <div class="dropdown d-inline">
                            <button class="btn btn-sm btn-secondary dropdown-toggle" type="button" id="exportDropdown{{ $resource->id }}" data-bs-toggle="dropdown" aria-expanded="false">
                                {{ __('Export') }}
                            </button>
                            <ul class="dropdown-menu" aria-labelledby="exportDropdown{{ $resource->id }}">
                                <li><a class="dropdown-item" href="{{ route('resources.export', ['resource' => $resource->id, 'type' => 'pdf']) }}">{{ __('Export as PDF') }}</a></li>
                                <li><a class="dropdown-item" href="{{ route('resources.export', ['resource' => $resource->id, 'type' => 'word']) }}">{{ __('Export as Word') }}</a></li>
                                <li><a class="dropdown-item" href="{{ route('resources.export', ['resource' => $resource->id, 'type' => 'csv']) }}">{{ __('Export as CSV') }}</a></li>
                            </ul>
                        </div>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>

@endsection