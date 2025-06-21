<li class="nav-item">
    <a class="nav-link menu-link {{ request()->is('timesheet*') ? '' : 'collapsed' }}" href="#sidebarTimekeeping" data-bs-toggle="collapse" role="button" aria-expanded="true" aria-controls="sidebarTimekeeping">
        <i class="ri-attachment-line"></i> <span data-key="t-timekeeping">{{ __('Chấm công') }}</span>
    </a>
    <div class="menu-dropdown collapse {{ request()->routeIs('timesheet*') ? 'show' : '' }}" id="sidebarTimekeeping">
        <ul class="nav nav-sm flex-column">
            <li class="nav-item">
                <a href="#" class="nav-link" data-key="t-overview-timekeeping">{{ __('Tổng quan') }}</a>
            </li>
            <li class="nav-item">
                <a href="#timekeeping" class="nav-link collapsed" data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="service-request" data-key="t-service-request">{{ __('Chấm công') }}</a>
                <div class="menu-dropdown collapse {{ request()->routeIs('timesheet.timekeeping*') ? 'show' : '' }}" id="timekeeping">
                    <ul class="nav nav-sm flex-column">
{{--                        <li class="nav-item">--}}
{{--                            <a href="{{ route('timesheet.timekeeping.showPageDetailedTimesheet') }}"--}}
{{--                               class="nav-link {{ request()->routeIs('timesheet.timekeeping.showPageDetailedTimesheet') ? 'active' : '' }}">--}}
{{--                                Bảng chấm công chi tiết--}}
{{--                            </a>--}}
{{--                        </li>--}}
                        <li class="nav-item">
                            <a href="{{ route('timesheet.timekeeping.showPageGeneralTimesheet') }}"
                               class="nav-link {{ request()->routeIs('timesheet.timekeeping.showPageGeneralTimesheet') ? 'active' : '' }}">
                                Bảng chấm công tổng hợp
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('timesheet.timekeeping.showPageTimekeepingData') }}"
                               class="nav-link {{ request()->routeIs('timesheet.timekeeping.showPageTimekeepingData') ? 'active' : '' }}">
                                Dữ liệu chấm công
                            </a>
                        </li>
                    </ul>
                </div>
            </li>
            <li class="nav-item">
                <a href="#service-request" class="nav-link collapsed" data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="service-request" data-key="t-service-request">{{ __('Quản lý đơn') }}</a>
                <div class="collapse menu-dropdown" id="service-request">
                    <ul class="nav nav-sm flex-column">
                        <li class="nav-item">
                            <a href="#" class="nav-link">Đơn xin nghỉ</a>
                        </li>
                        <li class="nav-item">
                            <a href="#" class="nav-link">Đơn xin cập nhật công</a>
                        </li>
                    </ul>
                </div>
            </li>
        </ul>
    </div>
</li>
