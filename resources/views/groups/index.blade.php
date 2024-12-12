
@extends('layouts.app')

@section('content')

<div class="container my-5">
    <h2 class="mb-4">{{ __('Groups') }}</h2>

    <div class="d-flex justify-content-end mb-3">
        <a class="btn btn-secondary" href="{{ route('groups.create') }}">
            <i class="fas fa-plus"></i> 
            {{ __('Add Group') }}
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
            @if ($groups->isEmpty())
                <tr>
                    <td colspan="2" class="text-center">
                        {{ __('No groups found') }}
                    </td>
                </tr>
            @endif
            @foreach ($groups as $group)
                <tr>
                    <th scope="row">{{ $group->number }}</th>
                    <td>
                        <a class="btn btn-sm btn-warning me-1" href="{{ route('groups.edit', $group) }}">
                            <i class="fas fa-edit"></i>
                        </a>
                        <x-delete-button :route="route('groups.destroy', $group)" small/>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>

@endsection