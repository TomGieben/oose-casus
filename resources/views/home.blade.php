@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-4 col-12">
            <a href="{{ route('courses.index') }}" class="card mb-3 shadow-sm text-decoration-none">
                <div class="card-body bg-primary text-white">
                    <i class="fas fa-book"></i>
                    {{ __('Courses') }}
                </div>
            </a>
        </div>
        <div class="col-md-4 col-12">
            <a href="{{ route('executions.index') }}" class="card mb-3 shadow-sm text-decoration-none">
                <div class="card-body bg-success text-white">
                    <i class="fal fa-tasks"></i>
                    {{ __('Executions') }}
                </div>
            </a>
        </div>
        <div class="col-md-4 col-12">
            <a href="{{ route('groups.index') }}" class="card mb-3 shadow-sm text-decoration-none">
                <div class="card-body bg-info text-white">
                    <i class="fas fa-users"></i>
                    {{ __('Groups') }}
                </div>
            </a>
        </div>
        <div class="col-md-4 col-12">
            <a href="{{ route('education-elements.index') }}" class="card mb-3 shadow-sm text-decoration-none">
                <div class="card-body bg-warning text-white">
                    <i class="fal fa-graduation-cap"></i>
                    {{ __('Education Elements') }}
                </div>
            </a>
        </div>
        <div class="col-md-4 col-12">
            <a href="{{ route('criteria.index') }}" class="card mb-3 shadow-sm text-decoration-none">
                <div class="card-body bg-danger text-white">
                    <i class="fal fa-list"></i>
                    {{ __('Criteria') }}
                </div>
            </a>
        </div>
        <div class="col-md-4 col-12">
            <a href="{{ route('evaluation.index') }}" class="card mb-3 shadow-sm text-decoration-none">
                <div class="card-body bg-secondary text-white">
                    <i class="fal fa-poll"></i>
                    {{ __('Evaluation') }}
                </div>
            </a>
        </div>
        <div class="col-md-4 col-12">
            <a href="{{ route('learning-objectives.index') }}" class="card mb-3 shadow-sm text-decoration-none">
                <div class="card-body bg-dark text-white">
                    <i class="fal fa-bullseye"></i>
                    {{ __('Learning Objectives') }}
                </div>
            </a>
        </div>
        <div class="col-md-4 col-12">
            <a href="{{ route('plannings.index') }}" class="card mb-3 shadow-sm text-decoration-none">
                <div class="card-body bg-light text-dark">
                    <i class="fal fa-calendar-alt"></i>
                    {{ __('Planning') }}
                </div>
            </a>
        </div>
        <div class="col-md-4 col-12">
            <a href="{{ route('resources.index') }}" class="card mb-3 shadow-sm text-decoration-none">
                <div class="card-body bg-primary text-white">
                    <i class="fal fa-book-open"></i>
                    {{ __('Resources') }}
                </div>
            </a>
        </div>
        <div class="col-md-4 col-12">
            <a href="{{ route('users.index') }}" class="card mb-3 shadow-sm text-decoration-none">
                <div class="card-body bg-success text-white">
                    <i class="fal fa-users"></i>
                    {{ __('Users') }}
                </div>
            </a>
        </div>
    </div>
</div>
@endsection
