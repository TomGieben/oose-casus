@extends('layouts.app')

@section('content')

<div class="container my-5">
    <h2 class="mb-4">{{ __('Classrooms') }}</h2>

    <div class="d-flex justify-content-end mb-3">
        <a class="btn btn-secondary" href="{{ route('classrooms.create') }}">
            <i class="fas fa-plus"></i> 
            {{ __('Add Classroom') }}
        </a>
    </div>

    <table class="table table-striped">
        <thead class="table-light">
            <tr>
                <th scope="col">{{ __('Number') }}</th>
                <th scope="col">{{ __('Actions') }}</th>
            </tr>
        </thead>
        <tbody>
            @if ($classrooms->isEmpty())
                <tr>
                    <td colspan="2" class="text-center">
                        {{ __('No classrooms found') }}
                    </td>
                </tr>
            @endif
            @foreach ($classrooms as $classroom)
                <tr>
                    <th scope="row">{{ $classroom->number }}</th>
                    <td>
                        <a class="btn btn-sm btn-warning me-1" href="{{ route('classrooms.edit', $classroom) }}">
                            <i class="fas fa-edit"></i>
                        </a>
                        <x-delete-button :route="route('classrooms.destroy', $classroom)" small/>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>

@endsection