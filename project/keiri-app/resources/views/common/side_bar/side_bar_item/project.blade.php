<li class="nav-item">
    <a class="nav-link menu-link {{ request()->is('projects*') ? '' : 'collapsed' }}" href="#sidebarProjectManagement" data-bs-toggle="collapse" role="button" aria-expanded="true" aria-controls="sidebarProjectManagement">
        <i class="ri-suitcase-line"></i> <span data-key="t-salary">{{ __('Project Management') }}</span>
    </a>
    <div class="menu-dropdown collapse {{ request()->routeIs('project*') ? 'show' : '' }}" id="sidebarProjectManagement">
        <ul class="nav nav-sm flex-column">
            <li class="nav-item">
                <a href="{{ route('project.showProjectList') }}" class="nav-link {{ request()->routeIs('project.showProjectList') ? 'active' : '' }}">
                    {{ __('Project List') }}
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ route('project.showCreateProject') }}" class="nav-link {{ request()->routeIs('project.showCreateProject') ? 'active' : '' }}">
                    {{ __('Create Project') }}
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ route('project.showProjectAssignment') }}" class="nav-link {{ request()->routeIs('project.showProjectAssignment') ? 'active' : '' }}">
                    {{ __('Project Assignment') }}
                </a>
            </li>
        </ul>
    </div>
</li>
