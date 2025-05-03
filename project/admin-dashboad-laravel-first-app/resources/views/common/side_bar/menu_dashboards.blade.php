<li class="nav-item">
    <a class="nav-link menu-link {{ request()->is('dashboard*') ? '' : 'collapsed' }}" href="#sidebarDashboards"
       data-bs-toggle="collapse" role="button" aria-expanded="{{ request()->is('dashboard*') ? 'true' : 'false' }}" aria-controls="sidebarDashboards">
        <i class="ri-dashboard-2-line"></i> <span data-key="t-dashboards">Dashboards</span>
    </a>
    <div class="collapse menu-dropdown {{ request()->routeIs('dashboard.*') ? 'show' : '' }}" id="sidebarDashboards">
        <ul class="nav nav-sm flex-column ">
            <li class="nav-item">
                <a href="{{ route('dashboard.showAnalyticDashboard') }}" class="nav-link {{ request()->routeIs('dashboard.showAnalyticDashboard') ? 'active' : '' }}" data-key="t-analytics">Analytics</a>
            </li>
            <li class="nav-item">
                <a href="{{ route('dashboard.showCrmDashboard') }}" class="nav-link {{ request()->routeIs('dashboard.showCrmDashboard') ? 'active' : '' }}" data-key="t-crm"> CRM </a>
            </li>
            <li class="nav-item">
                <a href="{{ route('dashboard.showEcommerceDashboard') }}" class="nav-link {{ request()->routeIs('dashboard.showEcommerceDashboard') ? 'active' : '' }}" data-key="t-ecommerce"> Ecommerce </a>
            </li>
            <li class="nav-item">
                <a href="{{ route('dashboard.showCryptoDashboard') }}" class="nav-link {{ request()->routeIs('dashboard.showCryptoDashboard') ? 'active' : '' }}" data-key="t-crypto"> Crypto</a>
            </li>
            <li class="nav-item">
                <a href="{{ route('dashboard.showProjectsDashboard') }}" class="nav-link {{ request()->routeIs('dashboard.showProjectsDashboard') ? 'active' : '' }}" data-key="t-projects">Projects </a>
            </li>
            <li class="nav-item">
                <a href="{{ route('dashboard.showNftDashboard') }}" class="nav-link {{ request()->routeIs('dashboard.showNftDashboard') ? 'active' : '' }}" data-key="t-nft"> NFT</a>
            </li>
            <li class="nav-item">
                <a href="{{ route('dashboard.showJobDashboard') }}" class="nav-link {{ request()->routeIs('dashboard.showJobDashboard') ? 'active' : '' }}" data-key="t-job">Job</a>
            </li>
        </ul>
    </div>
</li> <!-- end Dashboard Menu -->
