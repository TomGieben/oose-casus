<li class="nav-item dropdown">
    <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"
        aria-haspopup="true" aria-expanded="false" v-pre>
        {{ Auth::user()->name }}
    </a>

    <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
        <a class="dropdown-item @if (Route::currentRouteName() == 'home') active @endif" href="{{ route('home') }}">
            <i class="fal fa-home"></i>
            {{ __('Home') }}
        </a>

        <a class="dropdown-item @if (Route::is('classrooms.*')) active @endif" href="{{ route('classrooms.index') }}">
            <i class="fal fa-chalkboard-teacher"></i>
            {{ __('Classrooms') }}
        </a>

        <a class="dropdown-item @if (Route::is('courses.*')) active @endif" href="{{ route('courses.index') }}">
            <i class="fal fa-book"></i>
            {{ __('Courses') }}
        </a>

        <a class="dropdown-item @if (Route::is('criteria.*')) active @endif" href="{{ route('criteria.index') }}">
            <i class="fal fa-list"></i>
            {{ __('Criteria') }}
        </a>

        <a class="dropdown-item @if (Route::is('education-elements.*')) active @endif"
            href="{{ route('education-elements.index') }}">
            <i class="fal fa-graduation-cap"></i>
            {{ __('Education Elements') }}
        </a>

        <a class="dropdown-item @if (Route::is('evaluation.*')) active @endif"
            href="{{ route('evaluation.index') }}">
            <i class="fal fa-poll"></i>
            {{ __('Evaluation') }}
        </a>

        <a class="dropdown-item @if (Route::is('executions.*')) active @endif"
            href="{{ route('executions.index') }}">
            <i class="fal fa-tasks"></i>
            {{ __('Executions') }}
        </a>

        <a class="dropdown-item @if (Route::is('groups.*')) active @endif" href="{{ route('groups.index') }}">
            <i class="fal fa-users"></i>
            {{ __('Groups') }}
        </a>

        <a class="dropdown-item @if (Route::is('learning-objectives.*')) active @endif"
            href="{{ route('learning-objectives.index') }}">
            <i class="fal fa-bullseye"></i>
            {{ __('Learning Objectives') }}
        </a>

        <a class="dropdown-item @if (Route::is('plannings.*')) active @endif" href="{{ route('plannings.index') }}">
            <i class="fal fa-calendar-alt"></i>
            {{ __('Planning') }}
        </a>

        <a class="dropdown-item @if (Route::is('resources.*')) active @endif"
            href="{{ route('resources.index') }}">
            <i class="fal fa-book-open"></i>
            {{ __('Resources') }}
        </a>

        <a class="dropdown-item @if (Route::is('roles.*')) active @endif" href="{{ route('users.index') }}">
            <i class="fal fa-users"></i>
            {{ __('Users') }}
        </a>

        <a class="dropdown-item border-top" href="{{ route('logout') }}"
            onclick="event.preventDefault();
                         document.getElementById('logout-form').submit();">
            <i class="fal fa-sign-out-alt"></i>
            {{ __('Logout') }}
        </a>

        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
            @csrf
        </form>
    </div>
</li>
