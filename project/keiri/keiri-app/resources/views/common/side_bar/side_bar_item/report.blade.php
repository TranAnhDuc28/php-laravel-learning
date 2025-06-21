<li class="nav-item">
    <a class="nav-link menu-link {{ request()->is('reports') ? '' : 'collapsed' }}" href="#sidebarReport" data-bs-toggle="collapse" role="button" aria-expanded="true" aria-controls="sidebarReport">
        <i class="ri-file-chart-line"></i> <span>{{ __('Report') }}</span>
    </a>
    <div class="menu-dropdown collapse {{ request()->routeIs('report*') ? 'show' : '' }}" id="sidebarReport">
        <ul class="nav nav-sm flex-column">
            <li class="nav-item">
                <a href="{{ route('report.showMonthlyPaymentRequest') }}" class="nav-link {{ request()->routeIs('report.showMonthlyPaymentRequest') ? 'active' : '' }}">{{ __('Monthly Payment Request') }}</a>
            </li>
            <li class="nav-item">
                <a href="{{ route('report.showProjectPaymentRequest') }}" class="nav-link {{ request()->routeIs('report.showProjectPaymentRequest') ? 'active' : '' }}">{{ __('Project Payment Request') }}</a>
            </li>
        </ul>
    </div>
</li>

