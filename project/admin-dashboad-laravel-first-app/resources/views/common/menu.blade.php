<!-- ========== App Menu ========== -->
<div class="app-menu navbar-menu">
    <!-- LOGO -->
    <div class="navbar-brand-box">
        <!-- Dark Logo-->
        <a href="index.html" class="logo logo-dark">
            <span class="logo-sm">
                <img src="{{ asset('assets/images/logo-sm.png') }}" alt="" height="22">
            </span>
            <span class="logo-lg">
                <img src="{{ asset('assets/images/logo-dark.png') }}" alt="" height="17">
            </span>
        </a>
        <!-- Light Logo-->
        <a href="index.html" class="logo logo-light">
            <span class="logo-sm">
                <img src="{{ asset('assets/images/logo-sm.png') }}" alt="" height="22">
            </span>
            <span class="logo-lg">
                <img src="{{ asset('assets/images/logo-light.png') }}" alt="" height="17">
            </span>
        </a>
        <button type="button" class="btn btn-sm p-0 fs-20 header-item float-end btn-vertical-sm-hover" id="vertical-hover">
            <i class="ri-record-circle-line"></i>
        </button>
    </div>

    <div id="scrollbar">
        <div class="container-fluid">
            <div id="two-column-menu"></div>
            <ul class="navbar-nav" id="navbar-nav">
                <li class="menu-title"><span data-key="t-menu">Menu</span></li>
                @include('common.menu_item.menu_dashboards')
                @include('common.menu_item.menu_apps')
                @include('common.menu_item.menu_layouts')

                <li class="menu-title"><i class="ri-more-fill"></i> <span data-key="t-pages">Pages</span></li>
                @include('common.menu_item.pages.menu_authentication')
                @include('common.menu_item.pages.menu_pages')
                @include('common.menu_item.pages.menu_landing')

                <li class="menu-title"><i class="ri-more-fill"></i> <span data-key="t-components">Components</span></li>
                @include('common.menu_item.components.menu_base_ui')
                @include('common.menu_item.components.menu_advance_ui')
                @include('common.menu_item.components.menu_widgets')
                @include('common.menu_item.components.menu_forms')
                @include('common.menu_item.components.menu_tables')
                @include('common.menu_item.components.menu_forms')
                @include('common.menu_item.components.menu_charts')
                @include('common.menu_item.components.menu_icons')
                @include('common.menu_item.components.menu_maps')
                @include('common.menu_item.components.menu_multi_level')
            </ul>
        </div>
    </div>

    <div class="sidebar-background"></div>
</div>
<!-- Left Sidebar End -->
<!-- Vertical Overlay-->
<div class="vertical-overlay"></div>
