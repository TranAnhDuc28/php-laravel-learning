<div class="app-menu navbar-menu">
    <!-- LOGO -->
    <div class="navbar-brand-box">
        <!-- Dark Logo-->
        <a href="{{ route('pages.dashboard') }}" class="logo logo-dark">
            <span class="logo-sm">
                <img src="{{ asset('build/images/logo.png') }}" alt="" height="40">
            </span>
            <span class="logo-lg">
                <img src="{{ asset('build/images/logo-full.png') }}" alt="" height="45">
            </span>
        </a>

        <!-- Light Logo-->
        <a href="{{ route('pages.dashboard') }}" class="logo logo-light">
            <span class="logo-sm">
                <img src="{{ asset('build/images/logo.png') }}" alt="" height="40">
            </span>
            <span class="logo-lg">
                <img src="{{ asset('build/images/logo-full.png') }}" alt="" height="45">
            </span>
        </a>
        <button type="button" class="btn btn-sm p-0 fs-20 header-item float-end btn-vertical-sm-hover" id="vertical-hover">
            <i class="ri-record-circle-line"></i>
        </button>
    </div>

    <div id="scrollbar">
        <div class="container-fluid">
            <ul class="navbar-nav" id="navbar-nav">
                <li class="menu-title"><span data-key="t-menu">Menu</span></li>
                <li class="nav-item">
                    <a href="{{ route('pages.dashboard') }}" id="dashboard" class="nav-link menu-link {{ request()->routeIs('pages.dashboard') ? 'active' : '' }}">
                        <i class="ri-dashboard-2-line"></i> <span data-key="t-dashboard">{{ __('Dashboard') }}</span>
                    </a>
                </li>
{{--                @if(Auth::user()->isAdmin())--}}
                    @include('common.side_bar.admin_side_bar')
{{--                @elseif(Auth::user()->isManager())--}}
                    {{--        @include('common.side_bar.hr_side_bar')--}}
{{--                @elseif(Auth::user()->isHr())--}}
                    {{--        @include('common.side_bar.manager_side_bar')--}}
{{--                @else()--}}
                    {{--        @include('common.side_bar.employee_side_bar')--}}
{{--                @endif--}}
            </ul>
        </div>
    </div>
</div>

<div class="vertical-overlay"></div>
