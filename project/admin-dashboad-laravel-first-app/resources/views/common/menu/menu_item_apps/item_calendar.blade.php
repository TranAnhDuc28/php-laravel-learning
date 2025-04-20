<li class="nav-item">
    <a href="#sidebarCalendar" class="nav-link {{ request()->is('apps/calendar*') ? '' : 'collapsed' }}"
       data-bs-toggle="collapse" role="button" aria-expanded="{{ request()->is('apps/calendar*') ? 'true' : 'false' }}" aria-controls="sidebarCalendar" data-key="t-calender">
        Calendar
    </a>
    <div class="collapse menu-dropdown {{ request()->routeIs('app.calendar.*') ? 'show' : '' }}" id="sidebarCalendar">
        <ul class="nav nav-sm flex-column">
            <li class="nav-item">
                <a href="{{ route('app.calendar.main') }}" class="nav-link {{ request()->routeIs('app.calendar.main') ? 'active' : '' }}" data-key="t-main-calender">Main Calender</a>
            </li>
            <li class="nav-item">
                <a href="{{ route('app.calendar.monthGrid') }}" class="nav-link {{ request()->routeIs('app.calendar.monthGrid') ? 'active' : '' }}" data-key="t-month-grid">Month Grid</a>
            </li>
        </ul>
    </div>
</li>
