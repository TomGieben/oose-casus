@extends('layouts.app')

@section('content')

<div class="container my-5">
    <h2 class="mb-4">{{ __('Criteria') }}</h2>

    <div class="d-flex justify-content-end mb-3">
        <a class="btn btn-secondary" href="{{ route('criteria.create') }}">
            <i class="fas fa-plus"></i> 
            {{ __('Add Criteria') }}
        </a>
    </div>

    <table class="table table-striped">
        <thead class="table-light">
            <tr>
                <th scope="col">{{ __('Name') }}</th>
                <th scope="col">{{ __('description') }}</th>
                <th scope="col">{{ __('Actions') }}</th>
            </tr>
        </thead>
        <tbody>
            @if ($criterias->isEmpty())
                <tr>
                    <td colspan="3" class="text-center">
                        {{ __('No criteria found') }}
                    </td>
                </tr>
            @endif
            @foreach ($criterias as $criteria)
                <tr>
                    <th scope="row">{{ $criteria->name }}</th>
                    <td>{{ $criteria->getLimitedDescription() }}</td>
                    <td>
                        <a class="btn btn-sm btn-warning me-1" href="{{ route('criteria.edit', $criteria) }}">
                            <i class="fas fa-edit"></i>
                        </a>
                        <x-delete-button :route="route('criteria.destroy', $criteria)" small/>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>

@endsection