
@extends('layouts.app')

@section('content')

<div class="container my-5">
    <h2 class="mb-4">{{ __('Users') }}</h2>

    <div class="d-flex justify-content-end mb-3">
        <a class="btn btn-secondary" href="{{ route('users.create') }}">
            <i class="fas fa-plus"></i> 
            {{ __('Add User') }}
        </a>
    </div>

    <table class="table table-striped">
        <thead class="table-light">
            <tr>
                <th scope="col">{{ __('Name') }}</th>
                <th scope="col">{{ __('Email') }}</th>
                <th scope="col">{{ __('Role') }}</th>
                <th scope="col">{{ __('Actions') }}</th>
            </tr>
        </thead>
        <tbody>
            @if ($users->isEmpty())
                <tr>
                    <td colspan="4" class="text-center">
                        {{ __('No users found') }}
                    </td>
                </tr>
            @endif
            @foreach ($users as $user)
                <tr>
                    <th scope="row">{{ $user->name }}</th>
                    <td>{{ $user->email }}</td>
                    <td>{{ $user->role->value }}</td>
                    <td>
                        <a class="btn btn-sm btn-warning me-1" href="{{ route('users.edit', $user) }}">
                            <i class="fas fa-edit"></i>
                        </a>
                        <x-delete-button :route="route('users.destroy', $user)" small/>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>

@endsection