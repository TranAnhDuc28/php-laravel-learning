import Collapse from 'bootstrap/js/dist/collapse';
import Tooltip from 'bootstrap/js/dist/tooltip';
import Popover from 'bootstrap/js/dist/popover';
import 'bootstrap/js/dist/dropdown';
import 'bootstrap/js/dist/offcanvas';
import SimpleBar from 'simplebar';
import feather from 'feather-icons';
import DataTable from 'datatables.net-bs5';


(function () {
    'use strict';

    /* Global variables. */
    let navbarMenuHTML = document.querySelector('.navbar-menu').innerHTML;

    /* DataTable Init remove default. */
    DataTable.defaults.layout = {
        topStart: null,
        topEnd: null,
        bottomStart: null,
        bottomEnd: null
    };

    /* On click collapse menu. */
    const isCollapseMenu = () => {
        /* Sidebar menu collapse.*/
        if (document.querySelectorAll('.navbar-nav .collapse')) {
            let collapses = document.querySelectorAll('.navbar-nav .collapse');
            Array.from(collapses).forEach((collapse) => {
                // Init collapses.
                let collapseInstance = new Collapse(collapse, {
                    toggle: false,
                });

                // Hide sibling collapses on `show.bs.collapse`.
                collapse.addEventListener('show.bs.collapse', (e) => {
                    e.stopPropagation();
                    let closestCollapse = collapse.parentElement.closest('.collapse');
                    if (closestCollapse) {
                        let siblingCollapses = closestCollapse.querySelectorAll('.collapse');
                        Array.from(siblingCollapses).forEach((siblingCollapse) => {
                            let siblingCollapseInstance = Collapse.getInstance(siblingCollapse);
                            if (siblingCollapseInstance === collapseInstance) {
                                return;
                            }
                            siblingCollapseInstance.hide();
                        });
                    } else {
                        const getSiblings = (elem) => {
                            // Setup siblings array and get the first sibling.
                            let siblings = [];
                            let sibling = elem.parentNode.firstChild;

                            // Loop through each sibling and push to the array.
                            while (sibling) {
                                if (sibling.nodeType === 1 && sibling !== elem) {
                                    siblings.push(sibling);
                                }
                                sibling = sibling.nextSibling;
                            }
                            return siblings;
                        };

                        let siblings = getSiblings(collapse.parentElement);
                        Array.from(siblings).forEach((item) => {
                            if (item.childNodes.length > 2) {
                                item.firstElementChild.setAttribute('aria-expanded', 'false');
                            }

                            let ids = item.querySelectorAll('*[id]');
                            Array.from(ids).forEach((item1) => {
                                item1.classList.remove('show');
                                if (item1.childNodes.length > 2) {
                                    let val = item1.querySelectorAll('ul li a');
                                    Array.from(val).forEach((subitem) => {
                                        if (subitem.hasAttribute('aria-expanded'))
                                            subitem.setAttribute('aria-expanded', 'false');
                                    });
                                }
                            });
                        });
                    }
                });

                // Hide nested collapses on `hide.bs.collapse`.
                collapse.addEventListener('hide.bs.collapse', (e) => {
                    e.stopPropagation();
                    let childCollapses = collapse.querySelectorAll('.collapse');
                    Array.from(childCollapses).forEach((childCollapse) => {
                        let childCollapseInstance = Collapse.getInstance(childCollapse);
                        childCollapseInstance.hide();
                    });
                });
            });
        }
    }

    /**
     *
     * @param el
     * @returns {boolean}
     */
    const elementInViewport = (el) => {
        if (el) {
            let top = el.offsetTop;
            let left = el.offsetLeft;
            let width = el.offsetWidth;
            let height = el.offsetHeight;

            if (el.offsetParent) {
                while (el.offsetParent) {
                    el = el.offsetParent;
                    top += el.offsetTop;
                    left += el.offsetLeft;
                }
            }
            return (
                top >= window.scrollY &&
                left >= window.scrollX &&
                top + height <= window.scrollY + window.innerHeight &&
                left + width <= window.scrollX + window.innerWidth
            );
        }
    }

    /**
     *
     */
    function initLeftMenuCollapse() {
        // Vertical layout menu scroll add.
        if (document.documentElement.getAttribute('data-layout') === 'vertical') {
            if (document.querySelector('.navbar-menu')) {
                document.querySelector('.navbar-menu').innerHTML = navbarMenuHTML;
            }
            document.getElementById('scrollbar').setAttribute('data-simplebar', '');
            document.getElementById('navbar-nav').setAttribute('data-simplebar', '');
            document.getElementById('scrollbar').classList.add('h-100');
        }
    }

    /**
     *
     */
    const isLoadBodyElement = () => {
        let verticalOverlay = document.getElementsByClassName('vertical-overlay');
        if (verticalOverlay) {
            Array.from(verticalOverlay).forEach((element) => {
                element.addEventListener('click', () => {
                    document.body.classList.remove('vertical-sidebar-enable');
                    if (sessionStorage.getItem('data-layout') === 'twocolumn') {
                        document.body.classList.add('twocolumn-panel');
                    } else {
                        document.documentElement.setAttribute('data-sidebar-size', sessionStorage.getItem('data-sidebar-size'));
                    }
                });
            });
        }
    }

    /**
     *
     */
    const windowResizeHover = () => {
        feather.replace();
        let windowSize = document.documentElement.clientWidth;
        if (windowSize < 1025 && windowSize > 767) {
            document.body.classList.remove('twocolumn-panel');
            if (sessionStorage.getItem('data-layout') === 'twocolumn') {
                document.documentElement.setAttribute('data-layout', 'twocolumn');
                if (document.getElementById('customizer-layout03')) {
                    document.getElementById('customizer-layout03').click();
                }
                isCollapseMenu();
            }
            if (sessionStorage.getItem('data-layout') === 'vertical') {
                document.documentElement.setAttribute('data-sidebar-size', 'sm');
            }
            if (document.querySelector('.hamburger-icon')) {
                document.querySelector('.hamburger-icon').classList.add('open');
            }
        } else if (windowSize >= 1025) {
            document.body.classList.remove('twocolumn-panel');
            if (sessionStorage.getItem('data-layout') === 'twocolumn') {
                document.documentElement.setAttribute('data-layout', 'twocolumn');
                if (document.getElementById('customizer-layout03')) {
                    document.getElementById('customizer-layout03').click();
                }
                isCollapseMenu();
            }
            if (sessionStorage.getItem('data-layout') === 'vertical') {
                document.documentElement.setAttribute('data-sidebar-size', sessionStorage.getItem('data-sidebar-size'));
            }
            if (sessionStorage.getItem('data-layout') === 'semibox') {
                document.documentElement.setAttribute('data-sidebar-size', sessionStorage.getItem('data-sidebar-size'));
            }
            if (document.querySelector('.hamburger-icon')) {
                document.querySelector('.hamburger-icon').classList.remove('open');
            }
        } else if (windowSize <= 767) {
            document.body.classList.remove('vertical-sidebar-enable');
            document.body.classList.add('twocolumn-panel');
            if (sessionStorage.getItem('data-layout') === 'twocolumn') {
                document.documentElement.setAttribute('data-layout', 'vertical');
                hideShowLayoutOptions('vertical');
                isCollapseMenu();
            }
            if (sessionStorage.getItem('data-layout') !== 'horizontal') {
                document.documentElement.setAttribute('data-sidebar-size', 'lg');
            }
            if (document.querySelector('.hamburger-icon')) {
                document.querySelector('.hamburger-icon').classList.add('open');
            }
        }

        let isElement = document.querySelectorAll('#navbar-nav > li.nav-item');
        Array.from(isElement).forEach((item) => {
            item.addEventListener('click', menuItem.bind(this), false);
            item.addEventListener('mouseover', menuItem.bind(this), false);
        });
    }

    /**
     *
     * @param e
     */
    const menuItem = (e) => {
        if (e.target && e.target.matches('a.nav-link span')) {
            if (elementInViewport(e.target.parentElement.nextElementSibling) === false) {
                e.target.parentElement.nextElementSibling.classList.add('dropdown-custom-right');
                e.target.parentElement.parentElement.parentElement.parentElement.classList.add('dropdown-custom-right');
                let eleChild = e.target.parentElement.nextElementSibling;
                Array.from(eleChild.querySelectorAll('.menu-dropdown')).forEach(function (item) {
                    item.classList.add('dropdown-custom-right');
                });
            } else if (elementInViewport(e.target.parentElement.nextElementSibling) === true) {
                if (window.innerWidth >= 1848) {
                    let elements = document.getElementsByClassName('dropdown-custom-right');
                    while (elements.length > 0) {
                        elements[0].classList.remove('dropdown-custom-right');
                    }
                }
            }
        }

        if (e.target && e.target.matches('a.nav-link')) {
            if (elementInViewport(e.target.nextElementSibling) === false) {
                e.target.nextElementSibling.classList.add('dropdown-custom-right');
                e.target.parentElement.parentElement.parentElement.classList.add('dropdown-custom-right');
                let eleChild = e.target.nextElementSibling;
                Array.from(eleChild.querySelectorAll('.menu-dropdown')).forEach(function (item) {
                    item.classList.add('dropdown-custom-right');
                });
            } else if (elementInViewport(e.target.nextElementSibling) === true) {
                if (window.innerWidth >= 1848) {
                    let elements = document.getElementsByClassName('dropdown-custom-right');
                    while (elements.length > 0) {
                        elements[0].classList.remove('dropdown-custom-right');
                    }
                }
            }
        }
    }

    /**
     *
     */
    const toggleHamburgerMenu = () => {
        let windowSize = document.documentElement.clientWidth;

        if (windowSize > 767) {
            document.querySelector('.hamburger-icon').classList.toggle('open');
        }

        if (windowSize <= 1025 && windowSize > 767) {
            document.body.classList.remove('vertical-sidebar-enable');
            document.documentElement.getAttribute('data-sidebar-size') === 'sm'
                ? document.documentElement.setAttribute('data-sidebar-size', '')
                : document.documentElement.setAttribute('data-sidebar-size', 'sm');
        } else if (windowSize > 1025) {
            document.body.classList.remove('vertical-sidebar-enable');
            document.documentElement.getAttribute('data-sidebar-size') === 'lg'
                ? document.documentElement.setAttribute('data-sidebar-size', 'sm')
                : document.documentElement.setAttribute('data-sidebar-size', 'lg');
        } else if (windowSize <= 767) {
            document.body.classList.add('vertical-sidebar-enable');
            document.documentElement.setAttribute('data-sidebar-size', 'lg');
        }
    }

    /**
     *
     */
    const windowLoadContent = () => {// Demo show code.
        window.addEventListener('resize', windowResizeHover);
        windowResizeHover();

        document.addEventListener('scroll', () => {
            windowScroll();
        });

        window.addEventListener('load', () => {
            isLoadBodyElement();
            addEventListenerOnSmHoverMenu();
        });

        if (document.getElementById('topnav-hamburger-icon')) {
            document.getElementById('topnav-hamburger-icon').addEventListener('click', toggleHamburgerMenu);
        }

        let isValues = sessionStorage.getItem('defaultAttribute');
        let defaultValues = JSON.parse(isValues);
        let windowSize = document.documentElement.clientWidth;

        if (defaultValues['data-layout'] === 'twocolumn' && windowSize < 767) {
            Array.from(document.getElementById('two-column-menu').querySelectorAll('li')).forEach((item) => {
                item.addEventListener('click', () => {
                    document.body.classList.remove('twocolumn-panel');
                });
            });
        }
    }

    /**
     * Page topbar class added.
     */
    const windowScroll = () => {
        let pageTopbar = document.getElementById('page-topbar');
        if (pageTopbar) {
            document.body.scrollTop >= 50 || document.documentElement.scrollTop >= 50
                ? pageTopbar.classList.add('topbar-shadow')
                : pageTopbar.classList.remove('topbar-shadow');
        }
    }

    /**
     *
     */
    const initComponents = () => {
        // Tooltip.
        let tooltipTriggerList = [].slice.call(document.querySelectorAll(`[data-bs-toggle="tooltip"]`));
        tooltipTriggerList.map((tooltipTriggerEl) => {
            return new Tooltip(tooltipTriggerEl);
        });

        // Popover.
        let popoverTriggerList = [].slice.call(document.querySelectorAll(`[data-bs-toggle="tooltip"]`));
        popoverTriggerList.map((popoverTriggerEl) => {
            return new Popover(popoverTriggerEl);
        });
    }

    /**
     * Hide and show options of layout.
     */
    const hideShowLayoutOptions = () => {
        const themeSettingsOffcanvas = document.getElementById('theme-settings-offcanvas');
        const twoColumnMenu = document.getElementById('two-column-menu');
        const sidebarSize = document.getElementById('sidebar-size');
        const sidebarView = document.getElementById('sidebar-view');
        const sidebarColor = document.getElementById('sidebar-color');
        const sidebarImg = document.getElementById('sidebar-img');
        const layoutPosition = document.getElementById('layout-position');
        const layoutWidth = document.getElementById('layout-width');
        const sidebarVisibility = document.getElementById('sidebar-visibility');

        twoColumnMenu.innerHTML = '';
        if (document.querySelector('.navbar-menu')) {
            document.querySelector('.navbar-menu').innerHTML = navbarMenuHTML;
        }
        if (themeSettingsOffcanvas) {
            sidebarSize.style.display = 'block';
            sidebarView.style.display = 'block';
            sidebarColor.style.display = 'block';
            if (sidebarImg) {
                sidebarImg.style.display = 'block';
            }
            layoutPosition.style.display = 'block';
            layoutWidth.style.display = 'block';
            sidebarVisibility.style.display = 'none';
        }
        initLeftMenuCollapse();
        addEventListenerOnSmHoverMenu();
        initMenuItemScroll();
    }

    /**
     * Add listener Sidebar Hover icon on change layout from setting.
     */
    const addEventListenerOnSmHoverMenu = () => {
        const dataSidebarSizeAttribute = document.documentElement.getAttribute('data-sidebar-size');
        document.getElementById('vertical-hover').addEventListener('click', () => {
            if (dataSidebarSizeAttribute === 'sm-hover') {
                document.documentElement.setAttribute('data-sidebar-size', 'sm-hover-active');
            } else if (dataSidebarSizeAttribute === 'sm-hover-active') {
                document.documentElement.setAttribute('data-sidebar-size', 'sm-hover');
            } else {
                document.documentElement.setAttribute('data-sidebar-size', 'sm-hover');
            }
        });
    }

    const initMenuItemScroll = () => {
        setTimeout(() => {
            const sidebarMenu = document.getElementById('navbar-nav');
            if (sidebarMenu) {
                let activeMenu = sidebarMenu.querySelector('.nav-item .active');
                let offset = activeMenu ? activeMenu.offsetTop : 0;
                if (offset > 300) {
                    let verticalMenu = document.getElementsByClassName('app-menu') ? document.getElementsByClassName('app-menu')[0] : '';
                    if (verticalMenu && verticalMenu.querySelector('.simplebar-content-wrapper')) {
                        setTimeout(() => {
                            offset === 330
                                ? (verticalMenu.querySelector('.simplebar-content-wrapper').scrollTop = offset + 85)
                                : (verticalMenu.querySelector('.simplebar-content-wrapper').scrollTop = offset);
                        }, 0);
                    }
                }
            }
        }, 250);
    }

    /* Add change event listener on right layout setting. */
    let resizeEvent = new Event('resize');

    /**
     *
     */
    const setDefaultAttribute = () => {
        if (!sessionStorage.getItem('defaultAttribute')) {
            let attributesValue = document.documentElement.attributes;
            let isLayoutAttributes = {};
            Array.from(attributesValue).forEach((attr) => {
                if (attr && attr.nodeName && attr.nodeName !== 'undefined') {
                    let nodeKey = attr.nodeName;
                    isLayoutAttributes[nodeKey] = attr.nodeValue;
                    sessionStorage.setItem(nodeKey, attr.nodeValue);
                }
            });
            sessionStorage.setItem('defaultAttribute', JSON.stringify(isLayoutAttributes));

            // Open right sidebar on first time load.
            let offCanvas = document.querySelector(".btn[data-bs-target='#theme-settings-offcanvas']");
            offCanvas ? offCanvas.click() : '';
        }
    }

    /**
     * Set mode for layout.
     * @param mode
     * @param modeType
     * @param modeTypeId
     * @param html
     */
    const setLayoutMode = (mode, modeType, modeTypeId, html) => {
        const isModeTypeId = document.getElementById(modeTypeId);
        html.setAttribute(mode, modeType);
        if (isModeTypeId) {
            document.getElementById(modeTypeId).click();
        }
    }

    /**
     *
     */
    const initModeSetting = () => {
        let html = document.getElementsByTagName('HTML')[0];
        let lightDarkBtn = document.querySelectorAll('.light-dark-mode');
        if (lightDarkBtn && lightDarkBtn.length) {
            lightDarkBtn[0].addEventListener('click', () => {
                html.hasAttribute('data-bs-theme') && html.getAttribute('data-bs-theme') === 'dark'
                    ? setLayoutMode('data-bs-theme', 'light', 'layout-mode-light', html)
                    : setLayoutMode('data-bs-theme', 'dark', 'layout-mode-dark', html);

                // Dispatch the resize event on the window object.
                window.dispatchEvent(resizeEvent);
            });
        }
    }

    /**
     * Initialize.
     */
    const init = () => {
        setDefaultAttribute();
        initModeSetting();
        windowLoadContent();
        initLeftMenuCollapse();
        initComponents();
        isCollapseMenu();
        initMenuItemScroll();
    }
    init();

    let timeOutFunctionId;

    /**
     *
     */
    const setResize = () => {
        let currentLayout = document.documentElement.getAttribute('data-layout');
        if (currentLayout !== 'horizontal') {
            if (document.getElementById('navbar-nav')) {
                const simpleBar = new SimpleBar(document.getElementById('navbar-nav'));
                if (simpleBar) simpleBar.getContentElement();
            }

            if (document.getElementsByClassName('twocolumn-iconview')[0]) {
                const simpleBar1 = new SimpleBar(
                    document.getElementsByClassName('twocolumn-iconview')[0]
                );
                if (simpleBar1) simpleBar1.getContentElement();
            }
            clearTimeout(timeOutFunctionId);
        }
    }

    window.addEventListener('resize', () => {
        if (timeOutFunctionId) clearTimeout(timeOutFunctionId);
        timeOutFunctionId = setTimeout(setResize, 2000);
    });

    document.addEventListener('DOMContentLoaded', () => {
        document.getElementById('current-year').textContent = new Date().getFullYear().toString();
    });
})();

/********************* Scroll top js ************************/
const btnBackToTop = document.getElementById('back-to-top');

if (btnBackToTop) {
    // When the user scrolls down 20px from the top of the document, show the button.
    window.onscroll = () => {
        handleShowAndHiddenBtnScrollToTop();
    };

    /**
     *
     */
    const handleShowAndHiddenBtnScrollToTop = () => {
        if (document.body.scrollTop > 50 || document.documentElement.scrollTop > 50) {
            btnBackToTop.style.display = 'block';
        } else {
            btnBackToTop.style.display = 'none';
        }
    }

    /**
     * Scrolls the page to the top.
     * Works on both Safari (body.scrollTop) and Chrome/Firefox (documentElement.scrollTop)
     */
    const scrollToTop = () => {
        document.body.scrollTop = 0;
        document.documentElement.scrollTop = 0;
    }

    btnBackToTop.addEventListener('click', () => {
        scrollToTop();
    })
}
