@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-12 border-bottom mb-3">
            <h2>{{ __('Home') }}</h2>
            <p class="lead">
                {{ __('Welcome :user, to the Learning Management System!', ['user' => e(Auth::user()->name)]) }}
            </p>            
        </div>
        @can('admin', 'teacher')
            <div class="col-md-4 col-12">
                <a href="{{ route('courses.index') }}" class="card mb-3 shadow-sm text-decoration-none">
                    <div class="card-body bg-primary text-white rounded">
                        <i class="fas fa-book"></i>
                        {{ __('Courses') }}
                    </div>
                </a>
            </div>
        @endcan
        @can('admin', 'teacher')
            <div class="col-md-4 col-12">
                <a href="{{ route('executions.index') }}" class="card mb-3 shadow-sm text-decoration-none">
                    <div class="card-body bg-success text-white rounded">
                        <i class="fal fa-tasks"></i>
                        {{ __('Executions') }}
                    </div>
                </a>
            </div>
        @endcan
        @can('admin', 'teacher')
            <div class="col-md-4 col-12">
                <a href="{{ route('groups.index') }}" class="card mb-3 shadow-sm text-decoration-none">
                    <div class="card-body bg-info text-white rounded">
                        <i class="fas fa-users"></i>
                        {{ __('Groups') }}
                    </div>
                </a>
            </div>
        @endcan
        @can('admin', 'teacher')
            <div class="col-md-4 col-12">
                <a href="{{ route('education-elements.index') }}" class="card mb-3 shadow-sm text-decoration-none">
                    <div class="card-body bg-warning text-white rounded">
                        <i class="fal fa-graduation-cap"></i>
                        {{ __('Education Elements') }}
                    </div>
                </a>
            </div>
        @endcan
        @can('admin', 'teacher')
            <div class="col-md-4 col-12">
                <a href="{{ route('classrooms.index') }}" class="card mb-3 shadow-sm text-decoration-none">
                    <div class="card-body bg-danger text-white rounded">
                        <i class="fal fa-chalkboard"></i>
                        {{ __('Classrooms') }}
                    </div>
                </a>
            </div>
        @endcan
        @can('*')
            <div class="col-md-4 col-12">
                <a href="{{ route('evaluations.index') }}" class="card mb-3 shadow-sm text-decoration-none">
                    <div class="card-body bg-secondary text-white rounded">
                        <i class="fal fa-poll"></i>
                        {{ __('Evaluation') }}
                    </div>
                </a>
            </div>
        @endcan
        @can('admin', 'teacher')
            <div class="col-md-4 col-12">
                <a href="{{ route('learning-objectives.index') }}" class="card mb-3 shadow-sm text-decoration-none">
                    <div class="card-body bg-dark text-white rounded">
                        <i class="fal fa-bullseye"></i>
                        {{ __('Learning Objectives') }}
                    </div>
                </a>
            </div>
        @endcan
        @can('*')
            <div class="col-md-4 col-12">
                <a href="{{ route('plannings.index') }}" class="card mb-3 shadow-sm text-decoration-none">
                    <div class="card-body bg-light text-dark rounded">
                        <i class="fal fa-calendar-alt"></i>
                        {{ __('Planning') }}
                    </div>
                </a>
            </div>
        @endcan
        @can('*')
            <div class="col-md-4 col-12">
                <a href="{{ route('resources.index') }}" class="card mb-3 shadow-sm text-decoration-none">
                    <div class="card-body bg-primary text-white rounded">
                        <i class="fal fa-book-open"></i>
                        {{ __('Resources') }}
                    </div>
                </a>
            </div>
        @endcan
        @can('admin')
            <div class="col-md-4 col-12">
                <a href="{{ route('users.index') }}" class="card mb-3 shadow-sm text-decoration-none">
                    <div class="card-body bg-success text-white rounded">
                        <i class="fal fa-users"></i>
                        {{ __('Users') }}
                    </div>
                </a>
            </div>
        @endcan
    </div>
</div>
@endsection
