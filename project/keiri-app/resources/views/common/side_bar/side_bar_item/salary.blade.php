<li class="nav-item">
    <a class="nav-link menu-link {{ request()->is('demo') ? '' : 'collapsed' }}" href="#sidebarSalary" data-bs-toggle="collapse" role="button" aria-expanded="true" aria-controls="sidebarSalary">
        <i class="ri-money-dollar-box-line"></i> <span data-key="t-salary">{{ __('Tiền lương') }}</span>
    </a>
    <div class="menu-dropdown collapse {{ request()->routeIs('demo') ? 'show' : '' }}" id="sidebarSalary">
        <ul class="nav nav-sm flex-column">
            <li class="nav-item">
                <a href="#" class="nav-link" data-key="t-overview-salary">{{ __('Tổng quan') }}</a>
            </li>
        </ul>
    </div>
</li>
