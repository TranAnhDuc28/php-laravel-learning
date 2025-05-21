<li class="nav-item">
    <a class="nav-link menu-link {{ request()->is('employees*') ? '' : 'collapsed' }}" href="#sidebarEmployee" data-bs-toggle="collapse" role="button" aria-expanded="true" aria-controls="sidebarEmployee">
        <i class="ri-user-3-line"></i> <span data-key="t-employees">{{ __('Human Resources') }}</span>
    </a>
    <div class="menu-dropdown collapse {{ request()->routeIs('employee*') ? 'show' : '' }}" id="sidebarEmployee">
        <ul class="nav nav-sm flex-column">
            <li class="nav-item">
                <a href="{{ route('employee.showEmployeeList') }}" class="nav-link {{ request()->routeIs('employee.showEmployeeList') ? 'active' : '' }}">
                    {{ __('Employee List') }}
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ route('employee.showCreateEmployee') }}" class="nav-link {{ request()->routeIs('employee.showCreateEmployee') ? 'active' : '' }}">
                    {{ __('Create Employee') }}
                </a>
            </li>
        </ul>
    </div>
</li>
