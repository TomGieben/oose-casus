<li class="nav-item dropdown">
    <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
        {{ Auth::user()->name }}
    </a>

    <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
        <a class="dropdown-item" href="{{ route('classrooms.index') }}">
            <i class="fas fa-chalkboard-teacher"></i>
            {{ __('Classrooms') }}
        </a>

        <a class="dropdown-item" href="{{ route('courses.index') }}">
            <i class="fas fa-book"></i>
            {{ __('Courses') }}
        </a>

        <a class="dropdown-item" href="{{ route('criteria.index') }}">
            <i class="fas fa-list"></i>
            {{ __('Criteria') }}
        </a>

        <a class="dropdown-item" href="{{ route('education-elements.index') }}">
            <i class="fas fa-graduation-cap"></i>
            {{ __('Education Elements') }}
        </a>

        <a class="dropdown-item" href="{{ route('evaluation.index') }}">
            <i class="fas fa-poll"></i>
            {{ __('Evaluation') }}
        </a>

        <a class="dropdown-item" href="{{ route('executions.index') }}">
            <i class="fas fa-tasks"></i>
            {{ __('Executions') }}
        </a>

        <a class="dropdown-item" href="{{ route('groups.index') }}">
            <i class="fas fa-users"></i>
            {{ __('Groups') }}
        </a>

        <a class="dropdown-item" href="{{ route('learning-objectives.index') }}">
            <i class="fas fa-bullseye"></i>
            {{ __('Learning Objectives') }}
        </a>

        <a class="dropdown-item" href="{{ route('planning.index') }}">
            <i class="fas fa-calendar-alt"></i>
            {{ __('Planning') }}
        </a>

        <a class="dropdown-item" href="{{ route('resources.index') }}">
            <i class="fas fa-book-open"></i>
            {{ __('Resources') }}
        </a>

        <a class="dropdown-item" href="{{ route('users.index') }}">
            <i class="fas fa-users"></i>
            {{ __('Users') }}
        </a>

        <a class="dropdown-item border-top" href="{{ route('logout') }}"
           onclick="event.preventDefault();
                         document.getElementById('logout-form').submit();">
            <i class="fas fa-sign-out-alt"></i>
            {{ __('Logout') }}
        </a>

        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
            @csrf
        </form>
    </div>
</li>
