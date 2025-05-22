<li class="nav-item">
    <a class="nav-link menu-link {{ request()->is('demo') ? '' : 'collapsed' }}" href="#sidebarReport" data-bs-toggle="collapse" role="button" aria-expanded="true" aria-controls="sidebarReport">
        <i class="ri-file-chart-line"></i> <span>{{ __('Report') }}</span>
    </a>
    <div class="menu-dropdown collapse {{ request()->routeIs('project.report*') ? 'show' : '' }}" id="sidebarReport">
        <ul class="nav nav-sm flex-column">
            <li class="nav-item">
                <a href="{{ route('project.report.showProjectReport1') }}" class="nav-link {{ request()->routeIs('project.report.showProjectReport1') ? 'active' : '' }}">{{ __('Monthly Payment Request') }}</a>
            </li>
            <li class="nav-item">
                <a href="{{ route('project.report.showProjectReport2') }}" class="nav-link {{ request()->routeIs('project.report.showProjectReport2') ? 'active' : '' }}">{{ __('Project Payment Request') }}</a>
            </li>
        </ul>
    </div>
</li>

