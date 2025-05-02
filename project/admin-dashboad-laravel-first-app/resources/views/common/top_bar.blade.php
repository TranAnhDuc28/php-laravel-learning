<header id="page-topbar">
    <div class="layout-width">
        <div class="navbar-header">
            <div class="d-flex">
                <!-- LOGO -->
                <div class="navbar-brand-box horizontal-logo">
                    <a href="index.html" class="logo logo-dark">
                        <span class="logo-sm">
                            <img src="{{ asset('build/images/logo-sm.png') }}" alt="" height="22">
                        </span>
                        <span class="logo-lg">
                            <img src="{{ asset('build/images/logo-dark.png') }}" alt="" height="17">
                        </span>
                    </a>
                    <a href="index.html" class="logo logo-light">
                        <span class="logo-sm">
                            <img src="{{ asset('build/images/logo-sm.png') }}" alt="" height="22">
                        </span>
                        <span class="logo-lg">
                            <img src="{{ asset('build/images/logo-light.png') }}" alt="" height="17">
                        </span>
                    </a>
                </div>

                <button type="button" class="btn btn-sm px-3 fs-16 header-item vertical-menu-btn topnav-hamburger" id="topnav-hamburger-icon">
                    <span class="hamburger-icon">
                        <span></span>
                        <span></span>
                        <span></span>
                    </span>
                </button>

                @include('common.top_bar_item.left.app_search')
            </div>

            <div class="d-flex align-items-center">
                @include('common.top_bar_item.right.search')
                @include('common.top_bar_item.right.language')
                @include('common.top_bar_item.right.web_apps')
                @include('common.top_bar_item.right.cart')

                <div class="ms-1 header-item d-none d-sm-flex">
                    <button type="button" class="btn btn-icon btn-topbar btn-ghost-secondary rounded-circle" data-toggle="fullscreen">
                        <i class='bx bx-fullscreen fs-22'></i>
                    </button>
                </div>

                <div class="ms-1 header-item d-none d-sm-flex">
                    <button type="button" class="btn btn-icon btn-topbar btn-ghost-secondary rounded-circle light-dark-mode">
                        <i class='bx bx-moon fs-22'></i>
                    </button>
                </div>

                @include('common.top_bar_item.right.notifications')
                @include('common.top_bar_item.right.users')
            </div>
        </div>
    </div>
</header>

