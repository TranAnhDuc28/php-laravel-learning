{{--<div class="row">--}}
{{--    <a href="{{ route('check_in_out.index') }}" class="btn btn-secondary">--}}
{{--        View Check In/Out History--}}
{{--    </a>--}}
{{--</div>--}}

<!-- Overlay để làm tối background khi menu hiện ra -->
<div class="overlay" id="overlay"></div>

<!-- Menubar -->
<div class="sidebar bg-skyblue-custom" id="sidebar">
    <div class="sidebar-header">
        <button type="button" class="btn-close" id="closeSidebar"></button>
    </div>
    <div class="sidebar-content" style="height: 100vh;overflow-y: auto;padding-bottom: 80px;">
        <!-- Nội dung menu-->
        <ul class="nav flex-column">
            <li class="nav-item">
                <a href="{{ route('dashboard') }}"
                   class="btn {{ Route::is('dashboard') ? 'btn-info' : 'btn-primary' }}">
                    Dashboard
                </a>
            </li>
            @if(auth()->user()->isAd())
                @include('components.menus.admin-menu')
            @elseif(auth()->user()->isPu())
                @include('components.menus.pu-menu')
            @elseif(auth()->user()->isMod())
                @include('components.menus.mod-menu')
            @elseif(auth()->user()->isMem())
                @include('components.menus.member-menu')
            @endif
            <li class="nav-item mt-1">
                <a href="{{ route('profile.edit') }}"
                   class="btn {{ Route::is('profile.edit') ? 'btn-info' : 'btn-primary' }}">
                    Change Your Password
                </a>
            </li>
            <li class="nav-item mt-1">
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <a href="{{route('logout')}}" class="btn btn-warning" onclick="event.preventDefault(); this.closest('form').submit();">
                        {{ __('Log Out') }}
                    </a>
                </form>
            </li>
        </ul>
    </div>
</div>

<!-- Button để mở menu -->
<button class="btn btn-primary btn-menu bg-skyblue-custom" id="openSidebar" style="background: transparent !important;position: fixed;border: none;">
    <i class="fas fa-bars text-warning">Menu</i>
</button>
