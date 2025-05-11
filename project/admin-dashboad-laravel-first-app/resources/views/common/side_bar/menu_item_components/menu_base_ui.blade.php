<li class="nav-item">
    <a class="nav-link menu-link {{ request()->is('base-ui*') ? '' : 'collapsed' }}" href="#sidebarUI"
       data-bs-toggle="collapse" role="button" aria-expanded="{{ request()->is('base-ui*') ? 'true' : 'false' }}" aria-controls="sidebarUI">
        <i class="ri-pencil-ruler-2-line"></i> <span data-key="t-base-ui">Base UI</span>
    </a>
    <div class="collapse menu-dropdown mega-dropdown-menu {{ request()->routeIs('baseUi.*') ? 'show' : '' }}" id="sidebarUI">
        <div class="row">
            <div class="col-lg-4">
                <ul class="nav nav-sm flex-column">
                    <li class="nav-item">
                        <a href="{{ route('baseUi.alerts') }}" class="nav-link {{ request()->routeIs('baseUi.alerts') ? 'active' : '' }}" data-key="t-alerts">Alerts</a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('baseUi.badges') }}" class="nav-link {{ request()->routeIs('baseUi.badges') ? 'active' : '' }}" data-key="t-badges">Badges</a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('baseUi.buttons') }}" class="nav-link {{ request()->routeIs('baseUi.buttons') ? 'active' : '' }}" data-key="t-buttons">Buttons</a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('baseUi.colors') }}" class="nav-link {{ request()->routeIs('baseUi.colors') ? 'active' : '' }}" data-key="t-colors">Colors</a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('baseUi.cards') }}" class="nav-link {{ request()->routeIs('baseUi.cards') ? 'active' : '' }}" data-key="t-cards">Cards</a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('baseUi.carousel') }}" class="nav-link {{ request()->routeIs('baseUi.carousel') ? 'active' : '' }}" data-key="t-carousel">Carousel</a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('baseUi.dropdowns') }}" class="nav-link {{ request()->routeIs('baseUi.dropdowns') ? 'active' : '' }}" data-key="t-dropdowns">Dropdowns</a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('baseUi.grid') }}" class="nav-link {{ request()->routeIs('baseUi.grid') ? 'active' : '' }}" data-key="t-grid">Grid</a>
                    </li>
                </ul>
            </div>
            <div class="col-lg-4">
                <ul class="nav nav-sm flex-column">
                    <li class="nav-item">
                        <a href="{{ route('baseUi.images') }}" class="nav-link {{ request()->routeIs('baseUi.images') ? 'active' : '' }}" data-key="t-images">Images</a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('baseUi.tabs') }}" class="nav-link {{ request()->routeIs('baseUi.tabs') ? 'active' : '' }}" data-key="t-tabs">Tabs</a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('baseUi.accordions') }}" class="nav-link {{ request()->routeIs('baseUi.accordions') ? 'active' : '' }}" data-key="t-accordion-collapse">Accordion & Collapse</a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('baseUi.modals') }}" class="nav-link {{ request()->routeIs('baseUi.modals') ? 'active' : '' }}" data-key="t-modals">Modals</a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('baseUi.offcanvas') }}" class="nav-link {{ request()->routeIs('baseUi.offcanvas') ? 'active' : '' }}" data-key="t-offcanvas">Offcanvas</a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('baseUi.placeholders') }}" class="nav-link {{ request()->routeIs('baseUi.placeholders') ? 'active' : '' }}" data-key="t-placeholders">Placeholders</a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('baseUi.progress') }}" class="nav-link {{ request()->routeIs('baseUi.progress') ? 'active' : '' }}" data-key="t-progress">Progress</a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('baseUi.notifications') }}" class="nav-link {{ request()->routeIs('baseUi.notifications') ? 'active' : '' }}" data-key="t-notifications">Notifications</a>
                    </li>
                </ul>
            </div>
            <div class="col-lg-4">
                <ul class="nav nav-sm flex-column">
                    <li class="nav-item">
                        <a href="{{ route('baseUi.media') }}" class="nav-link {{ request()->routeIs('baseUi.media') ? 'active' : '' }}" data-key="t-media-object">Media object</a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('baseUi.embedVideo') }}" class="nav-link {{ request()->routeIs('baseUi.embedVideo') ? 'active' : '' }}" data-key="t-embed-video">Embed Video</a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('baseUi.typography') }}" class="nav-link {{ request()->routeIs('baseUi.typography') ? 'active' : '' }}" data-key="t-typography">Typography</a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('baseUi.lists') }}" class="nav-link {{ request()->routeIs('baseUi.lists') ? 'active' : '' }}" data-key="t-lists">Lists</a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('baseUi.links') }}" class="nav-link {{ request()->routeIs('baseUi.links') ? 'active' : '' }}">
                            <span data-key="t-links">Links</span> <span class="badge badge-pill bg-success" data-key="t-new">New</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('baseUi.general') }}" class="nav-link {{ request()->routeIs('baseUi.general') ? 'active' : '' }}" data-key="t-general">General</a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('baseUi.ribbons') }}" class="nav-link {{ request()->routeIs('baseUi.ribbons') ? 'active' : '' }}" data-key="t-ribbons">Ribbons</a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('baseUi.utilities') }}" class="nav-link {{ request()->routeIs('baseUi.utilities') ? 'active' : '' }}" data-key="t-utilities">Utilities</a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</li>
