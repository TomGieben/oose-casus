<li class="nav-item dropdown">
    <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"
        aria-haspopup="true" aria-expanded="false" v-pre>
        {{ Auth::user()->name }}
    </a>

    <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
        <a class="dropdown-item @if (Route::currentRouteName() == 'home') active @endif" href="{{ route('home') }}">
            <i class="fas fa-home"></i>
            {{ __('Home') }}
        </a>

        <a class="dropdown-item @if (Route::has('classrooms.*')) active @endif" href="{{ route('classrooms.index') }}">
            <i class="fas fa-chalkboard-teacher"></i>
            {{ __('Classrooms') }}
        </a>

        <a class="dropdown-item @if (Route::has('courses.*')) active @endif" href="{{ route('courses.index') }}">
            <i class="fas fa-book"></i>
            {{ __('Courses') }}
        </a>

        <a class="dropdown-item @if (Route::has('criteria.*')) active @endif" href="{{ route('criteria.index') }}">
            <i class="fas fa-list"></i>
            {{ __('Criteria') }}
        </a>

        <a class="dropdown-item @if (Route::has('education-elements.*')) active @endif"
            href="{{ route('education-elements.index') }}">
            <i class="fas fa-graduation-cap"></i>
            {{ __('Education Elements') }}
        </a>

        <a class="dropdown-item @if (Route::has('evaluation.*')) active @endif"
            href="{{ route('evaluation.index') }}">
            <i class="fas fa-poll"></i>
            {{ __('Evaluation') }}
        </a>

        <a class="dropdown-item @if (Route::has('executions.*')) active @endif"
            href="{{ route('executions.index') }}">
            <i class="fas fa-tasks"></i>
            {{ __('Executions') }}
        </a>

        <a class="dropdown-item @if (Route::has('groups.*')) active @endif" href="{{ route('groups.index') }}">
            <i class="fas fa-users"></i>
            {{ __('Groups') }}
        </a>

        <a class="dropdown-item @if (Route::has('learning-objectives.*')) active @endif"
            href="{{ route('learning-objectives.index') }}">
            <i class="fas fa-bullseye"></i>
            {{ __('Learning Objectives') }}
        </a>

        <a class="dropdown-item @if (Route::has('planning.*')) active @endif" href="{{ route('planning.index') }}">
            <i class="fas fa-calendar-alt"></i>
            {{ __('Planning') }}
        </a>

        <a class="dropdown-item @if (Route::has('resources.*')) active @endif"
            href="{{ route('resources.index') }}">
            <i class="fas fa-book-open"></i>
            {{ __('Resources') }}
        </a>

        <a class="dropdown-item @if (Route::has('roles.*')) active @endif" href="{{ route('users.index') }}">
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
