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
                    <th scope="row">{{ $resource->course?->name }}</th>
                    <th scope="row">{{ $resource->educationElement?->name }}</th>
                    <td scope="row">{{ $resource->name }}</td>
                    <td scope="row" class="limited-width">{{ $resource->content }}</td>
                    <td scope="row">
                        <a class="btn btn-sm btn-warning me-1" href="{{ route('resources.edit', $resource) }}">
                            <i class="fas fa-edit"></i>
                        </a>
                        <x-delete-button :route="route('resources.destroy', $resource)" small/>
                        <x-exporter-dropdown :resource="$resource"/>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>

@endsection