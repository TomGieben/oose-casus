
@extends('layouts.app')

@section('content')

<div class="container my-5">
    <h2 class="mb-4">{{ __('Education Elements') }}</h2>

    <div class="d-flex justify-content-end mb-3">
        <a class="btn btn-secondary" href="{{ route('education-elements.create') }}">
            <i class="fas fa-plus"></i> 
            {{ __('Add Education Element') }}
        </a>
    </div>

    <table class="table table-striped">
        <thead class="table-light">
            <tr>
                <th scope="col">{{ __('Name') }}</th>
                <th scope="col">{{ __('Type') }}</th>
                <th scope="col">{{ __('Actions') }}</th>
            </tr>
        </thead>
        <tbody>
            @if ($educationElements->isEmpty())
                <tr>
                    <td colspan="3" class="text-center">
                        {{ __('No education elements found') }}
                    </td>
                </tr>
            @endif
            @foreach ($educationElements as $educationElement)
                <tr>
                    <th scope="row">{{ $educationElement->name }}</th>
                    <td>{{ $educationElement->type_class->label() }}</td>
                    <td>
                        <a class="btn btn-sm btn-warning me-1" href="{{ route('education-elements.edit', $educationElement) }}">
                            <i class="fas fa-edit"></i>
                        </a>
                        <x-delete-button :route="route('education-elements.destroy', $educationElement)" small/>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>

@endsection