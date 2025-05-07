import Collapse from 'bootstrap/js/dist/collapse';
import Tooltip from 'bootstrap/js/dist/tooltip';
import Popover from 'bootstrap/js/dist/popover';
import SimpleBar from 'simplebar';
import feather from 'feather-icons';
import Choices from 'choices.js';
import Toastify from 'toastify-js';
import flatpickr from 'flatpickr';
import Waves from 'node-waves';

(function () {
    'use strict';

    /* Global variables. */
    let navbarMenuHTML = document.querySelector('.navbar-menu').innerHTML;
    let horizontalMenuSplit = 7; // After this number all horizontal menus will be moved in More menu options.
    let default_lang = 'en'; // set Default Language.
    let language = localStorage.getItem('language');

    /**
     *
     */
    const initLanguage = () => {
        // Set new language.
        (language === null) ? setLanguage(default_lang) : setLanguage(language);
        let languages = document.getElementsByClassName('language');
        languages && Array.from(languages).forEach((dropdown) => {
            dropdown.addEventListener('click', () => {
                setLanguage(dropdown.getAttribute('data-lang'));
            });
        });
    }

    /**
     *
     * @param lang
     */
    const setLanguage = (lang) => {
        if (document.getElementById('header-lang-img')) {
            if (lang === 'en') {
                document.getElementById('header-lang-img').src = '../build/images/flags/us.svg';
            } else if (lang === 'sp') {
                document.getElementById('header-lang-img').src = '../build/images/flags/spain.svg';
            } else if (lang === 'gr') {
                document.getElementById('header-lang-img').src = '../build/images/flags/germany.svg';
            } else if (lang === 'it') {
                document.getElementById('header-lang-img').src = '../build/images/flags/italy.svg';
            } else if (lang === 'ru') {
                document.getElementById('header-lang-img').src = '../build/images/flags/russia.svg';
            } else if (lang === 'ch') {
                document.getElementById('header-lang-img').src = '../build/images/flags/china.svg';
            } else if (lang === 'fr') {
                document.getElementById('header-lang-img').src = '../build/images/flags/french.svg';
            } else if (lang === 'ar') {
                document.getElementById('header-lang-img').src = '../build/images/flags/ae.svg';
            }
            localStorage.setItem('language', lang);
            language = localStorage.getItem('language');
            getLanguage();
        }
    }

    /**
     * Multi language setting.
     */
    const getLanguage = () => {
        // language == null ? setLanguage(default_lang) : false;
        // let request = new XMLHttpRequest();
        // // Instantiating the request object.
        // request.open('GET', '../build/lang/' + language + '.json');
        // // Defining event listener for readystatechange event.
        // request.onreadystatechange = () => {
        //     // Check if the request is compete and was successful.
        //     if (this.readyState && this.readyState === 4 && this.status === 200) {
        //         let data = JSON.parse(this.responseText);
        //         Object.keys(data).forEach((key) => {
        //             let elements = document.querySelectorAll(`[data-key="${key}"]`);
        //             Array.from(elements).forEach((elem) => {
        //                 elem.textContent = data[key];
        //             });
        //         });
        //     }
        // };
        // // Sending the request to the server.
        // request.send();
    }

    /**
     * Common plugins
     */
    const pluginData = () => {
        /* Toast UI Notification. */
        let toastExamples = document.querySelectorAll('[data-toast]');
        Array.from(toastExamples).forEach((element) => {
            element.addEventListener('click', () => {
                let toastData = {};
                let isToastVal = element.attributes;
                if (isToastVal['data-toast-text']) {
                    toastData.text = isToastVal['data-toast-text'].value.toString();
                }
                if (isToastVal['data-toast-gravity']) {
                    toastData.gravity = isToastVal['data-toast-gravity'].value.toString();
                }
                if (isToastVal['data-toast-position']) {
                    toastData.position = isToastVal['data-toast-position'].value.toString();
                }
                if (isToastVal['data-toast-className']) {
                    toastData.className = isToastVal['data-toast-className'].value.toString();
                }
                if (isToastVal['data-toast-duration']) {
                    toastData.duration = isToastVal['data-toast-duration'].value.toString();
                }
                if (isToastVal['data-toast-close']) {
                    toastData.close = isToastVal['data-toast-close'].value.toString();
                }
                if (isToastVal['data-toast-style']) {
                    toastData.style = isToastVal['data-toast-style'].value.toString();
                }
                if (isToastVal['data-toast-offset']) {
                    toastData.offset = isToastVal['data-toast-offset'];
                }
                Toastify({
                    newWindow: true,
                    text: toastData.text,
                    gravity: toastData.gravity,
                    position: toastData.position,
                    className: 'bg-' + toastData.className,
                    stopOnFocus: true,
                    offset: {
                        x: toastData.offset ? 50 : 0, // horizontal axis - can be a number or a string indicating unity. eg: '2em'
                        y: toastData.offset ? 10 : 0, // vertical axis - can be a number or a string indicating unity. eg: '2em'
                    },
                    duration: toastData.duration,
                    close: toastData.close === 'close',
                    style: toastData.style === 'style' ? {
                        background: 'linear-gradient(to right, #0AB39C, #405189)'
                    } : '',
                }).showToast();
            });
        });

        /* Choices Select plugin. */
        let choicesExamples = document.querySelectorAll('[data-choices]');
        Array.from(choicesExamples).forEach((item) => {
            let choiceData = {};
            let isChoicesVal = item.attributes;
            if (isChoicesVal['data-choices-groups']) {
                choiceData.placeholderValue = 'This is a placeholder set in the config';
            }
            if (isChoicesVal['data-choices-search-false']) {
                choiceData.searchEnabled = false;
            }
            if (isChoicesVal['data-choices-search-true']) {
                choiceData.searchEnabled = true;
            }
            if (isChoicesVal['data-choices-removeItem']) {
                choiceData.removeItemButton = true;
            }
            if (isChoicesVal['data-choices-sorting-false']) {
                choiceData.shouldSort = false;
            }
            if (isChoicesVal['data-choices-sorting-true']) {
                choiceData.shouldSort = true;
            }
            if (isChoicesVal['data-choices-multiple-remove']) {
                choiceData.removeItemButton = true;
            }
            if (isChoicesVal['data-choices-limit']) {
                choiceData.maxItemCount = isChoicesVal['data-choices-limit'].value.toString();
            }
            if (isChoicesVal['data-choices-limit']) {
                choiceData.maxItemCount = isChoicesVal['data-choices-limit'].value.toString();
            }
            if (isChoicesVal['data-choices-editItem-true']) {
                choiceData.maxItemCount = true;
            }
            if (isChoicesVal['data-choices-editItem-false']) {
                choiceData.maxItemCount = false;
            }
            if (isChoicesVal['data-choices-text-unique-true']) {
                choiceData.duplicateItemsAllowed = false;
            }
            if (isChoicesVal['data-choices-text-disabled-true']) {
                choiceData.addItems = false;
            }
            isChoicesVal['data-choices-text-disabled-true'] ? new Choices(item, choiceData).disable() : new Choices(item, choiceData);
        });

        /* Flatpickr. */
        let flatpickrExamples = document.querySelectorAll('[data-provider]');
        Array.from(flatpickrExamples).forEach((item) => {
            if (item.getAttribute('data-provider') === 'flatpickr') {
                let dateData = {};
                let isFlatpickrVal = item.attributes;
                dateData.disableMobile = 'true';
                if (isFlatpickrVal['data-date-format'])
                    dateData.dateFormat = isFlatpickrVal['data-date-format'].value.toString();
                if (isFlatpickrVal['data-enable-time']) {
                    dateData.enableTime = true;
                    dateData.dateFormat = isFlatpickrVal['data-date-format'].value.toString() + ' H:i';
                }
                if (isFlatpickrVal['data-altFormat']) {
                    dateData.altInput = true;
                    dateData.altFormat = isFlatpickrVal['data-altFormat'].value.toString();
                }
                if (isFlatpickrVal['data-minDate']) {
                    dateData.minDate = isFlatpickrVal['data-minDate'].value.toString();
                    dateData.dateFormat = isFlatpickrVal['data-date-format'].value.toString();
                }
                if (isFlatpickrVal['data-maxDate']) {
                    dateData.maxDate = isFlatpickrVal['data-maxDate'].value.toString();
                    dateData.dateFormat = isFlatpickrVal['data-date-format'].value.toString();
                }
                if (isFlatpickrVal['data-deafult-date']) {
                    dateData.defaultDate = isFlatpickrVal['data-deafult-date'].value.toString();
                    dateData.dateFormat = isFlatpickrVal['data-date-format'].value.toString();
                }
                if (isFlatpickrVal['data-multiple-date']) {
                    dateData.mode = 'multiple';
                    dateData.dateFormat = isFlatpickrVal['data-date-format'].value.toString();
                }
                if (isFlatpickrVal['data-range-date']) {
                    dateData.mode = 'range';
                    dateData.dateFormat = isFlatpickrVal['data-date-format'].value.toString();
                }
                if (isFlatpickrVal['data-inline-date']) {
                    dateData.inline = true;
                    dateData.defaultDate = isFlatpickrVal['data-deafult-date'].value.toString();
                    dateData.dateFormat = isFlatpickrVal['data-date-format'].value.toString();
                }
                if (isFlatpickrVal['data-disable-date']) {
                    let dates = [];
                    dates.push(isFlatpickrVal['data-disable-date'].value);
                    dateData.disable = dates.toString().split(',');
                }
                if (isFlatpickrVal['data-week-number']) {
                    // let dates = [];
                    // dates.push(isFlatpickrVal['data-week-number'].value);
                    dateData.weekNumbers = true;
                }
                flatpickr(item, dateData);
            } else if (item.getAttribute('data-provider') === 'timepickr') {
                let timeData = {};
                let isTimepickerVal = item.attributes;
                if (isTimepickerVal['data-time-basic']) {
                    timeData.enableTime = true;
                    timeData.noCalendar = true;
                    timeData.dateFormat = 'H:i';
                }
                if (isTimepickerVal['data-time-hrs']) {
                    timeData.enableTime = true;
                    timeData.noCalendar = true;
                    timeData.dateFormat = 'H:i';
                    timeData.time_24hr = true;
                }
                if (isTimepickerVal['data-min-time']) {
                    timeData.enableTime = true;
                    timeData.noCalendar = true;
                    timeData.dateFormat = 'H:i';
                    timeData.minTime = isTimepickerVal['data-min-time'].value.toString();
                }
                if (isTimepickerVal['data-max-time']) {
                    timeData.enableTime = true;
                    timeData.noCalendar = true;
                    timeData.dateFormat = 'H:i';
                    timeData.minTime = isTimepickerVal['data-max-time'].value.toString();
                }
                if (isTimepickerVal['data-default-time']) {
                    timeData.enableTime = true;
                    timeData.noCalendar = true;
                    timeData.dateFormat = 'H:i';
                    timeData.defaultDate = isTimepickerVal['data-default-time'].value.toString();
                }
                if (isTimepickerVal['data-time-inline']) {
                    timeData.enableTime = true;
                    timeData.noCalendar = true;
                    timeData.defaultDate = isTimepickerVal['data-time-inline'].value.toString();
                    timeData.inline = true;
                }
                flatpickr(item, timeData);
            }
        });

        /* Dropdown. */
        Array.from(document.querySelectorAll('.dropdown-menu a[data-bs-toggle="tab"]')).forEach((element) => {
            element.addEventListener('click', (e) => {
                e.stopPropagation();
                bootstrap.Tab.getInstance(e.target).show();
            });
        });
    }

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
     * Generate two column menu.
     */
    const twoColumnMenuGenerate = () => {
        let isTwoColumn = document.documentElement.getAttribute('data-layout');
        let isValues = sessionStorage.getItem('defaultAttribute');
        let defaultValues = JSON.parse(isValues);

        if (defaultValues && (isTwoColumn === 'twocolumn' || defaultValues['data-layout'] === 'twocolumn')) {
            if (document.querySelector('.navbar-menu')) {
                document.querySelector('.navbar-menu').innerHTML = navbarMenuHTML;
            }
            let ul = document.createElement('ul');
            ul.innerHTML = `
                    <a href="#" class="logo">
                        <img src="../images/logo-sm.png" alt="" height="20">
                    </a>`;

            Array.from(document.getElementById('navbar-nav').querySelectorAll('.menu-link')).forEach((item) => {
                ul.className = 'twocolumn-iconview';
                let li = document.createElement('li');
                let a = item;
                a.querySelectorAll('span').forEach((element) => {
                    element.classList.add('d-none');
                });

                if (item.parentElement.classList.contains('twocolumn-item-show')) {
                    item.classList.add('active');
                }
                li.appendChild(a);
                ul.appendChild(li);

                a.classList.contains('nav-link') ? a.classList.replace('nav-link', 'nav-icon') : '';
                a.classList.remove('collapsed', 'menu-link');
            });

            let currentPath = location.pathname === '/' ? 'index' : location.pathname.substring(1);
            currentPath = currentPath.substring(currentPath.lastIndexOf('/') + 1);
            if (currentPath) {
                let navbarNav = document.getElementById('navbar-nav').querySelector(`[href="${currentPath}"]`);

                if (navbarNav) {
                    let parentCollapseDiv = navbarNav.closest('.collapse.menu-dropdown');
                    if (parentCollapseDiv) {
                        parentCollapseDiv.classList.add('show');
                        parentCollapseDiv.parentElement.children[0].classList.add('active');
                        parentCollapseDiv.parentElement.children[0].setAttribute('aria-expanded', 'true');
                        if (parentCollapseDiv.parentElement.closest('.collapse.menu-dropdown')) {
                            parentCollapseDiv.parentElement.closest('.collapse').classList.add('show');
                            if (parentCollapseDiv.parentElement.closest('.collapse').previousElementSibling)
                                parentCollapseDiv.parentElement.closest('.collapse').previousElementSibling.classList.add('active');
                            if (parentCollapseDiv.parentElement.parentElement.parentElement.parentElement.closest('.collapse.menu-dropdown')) {
                                parentCollapseDiv.parentElement.parentElement.parentElement.parentElement.closest('.collapse').classList.add('show');
                                if (parentCollapseDiv.parentElement.parentElement.parentElement.parentElement.closest('.collapse').previousElementSibling) {
                                    parentCollapseDiv.parentElement.parentElement.parentElement.parentElement.closest('.collapse').previousElementSibling.classList.add('active');
                                }
                            }
                        }
                    }
                }
            }

            // Add all sidebar menu icons.
            document.getElementById('two-column-menu').innerHTML = ul.outerHTML;

            // Show submenu on sidebar menu click.
            Array.from(document.querySelector('#two-column-menu ul').querySelectorAll('li a')).forEach((element) => {
                let currentPath = location.pathname === '/' ? 'index' : location.pathname.substring(1);
                currentPath = currentPath.substring(currentPath.lastIndexOf('/') + 1);

                element.addEventListener('click', (e) => {
                    if (!(currentPath === '/' + element.getAttribute('href') && !element.getAttribute('data-bs-toggle')))
                        document.body.classList.contains('twocolumn-panel') ? document.body.classList.remove('twocolumn-panel') : '';
                    document.getElementById('navbar-nav').classList.remove('twocolumn-nav-hide');
                    document.querySelector('.hamburger-icon').classList.remove('open');

                    if ((e.target && e.target.matches('a.nav-icon')) || (e.target && e.target.matches('i'))) {
                        if (document.querySelector('#two-column-menu ul .nav-icon.active') !== null)
                            document.querySelector('#two-column-menu ul .nav-icon.active').classList.remove('active');
                        e.target.matches('i') ? e.target.closest('a').classList.add('active') : e.target.classList.add('active');

                        let twoColumnItem = document.getElementsByClassName('twocolumn-item-show');

                        twoColumnItem.length > 0 ? twoColumnItem[0].classList.remove('twocolumn-item-show') : '';

                        let currentMenu = e.target.matches('i') ? e.target.closest('a') : e.target;
                        let childMenusId = currentMenu.getAttribute('href').slice(1);
                        if (document.getElementById(childMenusId)) {
                            document.getElementById(childMenusId).parentElement.classList.add('twocolumn-item-show');
                        }
                    }
                });

                // Add active class to the sidebar menu icon who has direct link.
                if (currentPath === '/' + element.getAttribute('href') && !element.getAttribute('data-bs-toggle')) {
                    element.classList.add('active');
                    document.getElementById('navbar-nav').classList.add('twocolumn-nav-hide');
                    if (document.querySelector('.hamburger-icon')) {
                        document.querySelector('.hamburger-icon').classList.add('open');
                    }
                }
            });

            let currentLayout = document.documentElement.getAttribute('data-layout');
            if (currentLayout !== 'horizontal') {
                const simpleBar = new SimpleBar(document.getElementById('navbar-nav'));
                if (simpleBar) simpleBar.getContentElement();

                const simpleBar1 = new SimpleBar(
                    document.getElementsByClassName('twocolumn-iconview')[0]
                );
                if (simpleBar1) simpleBar1.getContentElement();
            }
        }
    }

    /**
     * Search menu dropdown on Topbar.
     */
    const isCustomDropdown = () => {
        // Search bar.
        const searchOptions = document.getElementById('search-close-options');
        const dropdown = document.getElementById('search-dropdown');
        const searchInput = document.getElementById('search-options');

        if (searchInput) {
            searchInput.addEventListener('focus', () => {
                let inputLength = searchInput.value.length;
                if (inputLength > 0) {
                    dropdown.classList.add('show');
                    searchOptions.classList.remove('d-none');
                } else {
                    dropdown.classList.remove('show');
                    searchOptions.classList.add('d-none');
                }
            });

            searchInput.addEventListener('keyup', () => {
                let inputLength = searchInput.value.length;
                if (inputLength > 0) {
                    dropdown.classList.add('show');
                    searchOptions.classList.remove('d-none');

                    let inputVal = searchInput.value.toLowerCase();

                    let notifyItem = document.getElementsByClassName('notify-item');

                    Array.from(notifyItem).forEach(function (element) {
                        let notifyTxt = ''
                        if (element.querySelector('h6')) {
                            let spanText = element.getElementsByTagName('span')[0].innerText.toLowerCase()
                            let name = element.querySelector('h6').innerText.toLowerCase()
                            if (name.includes(inputVal)) {
                                notifyTxt = name
                            } else {
                                notifyTxt = spanText
                            }
                        } else if (element.getElementsByTagName('span')) {
                            notifyTxt = element.getElementsByTagName('span')[0].innerText.toLowerCase()
                        }

                        if (notifyTxt)
                            element.style.display = notifyTxt.includes(inputVal) ? 'block' : 'none';

                    });
                } else {
                    dropdown.classList.remove('show');
                    searchOptions.classList.add('d-none');
                }
            });

            searchOptions.addEventListener('click', () => {
                searchInput.value = '';
                dropdown.classList.remove('show');
                searchOptions.classList.add('d-none');
            });

            document.body.addEventListener('click', (e) => {
                if (e.target.getAttribute('id') !== 'search-options') {
                    dropdown.classList.remove('show');
                    searchOptions.classList.add('d-none');
                }
            });
        }
    }

    /**
     * Search menu dropdown on topbar.
     */
    const isCustomDropdownResponsive = () => {
        // Search bar.
        const searchOptions = document.getElementById('search-close-options');
        const dropdownResponsive = document.getElementById('search-dropdown-reponsive');
        const searchInputResponsive = document.getElementById('search-options-reponsive');

        if (searchOptions && dropdownResponsive && searchInputResponsive) {
            searchInputResponsive.addEventListener('focus', () => {
                let inputLength = searchInputResponsive.value.length;
                if (inputLength > 0) {
                    dropdownResponsive.classList.add('show');
                    searchOptions.classList.remove('d-none');
                } else {
                    dropdownResponsive.classList.remove('show');
                    searchOptions.classList.add('d-none');
                }
            });

            searchInputResponsive.addEventListener('keyup', () => {
                let inputLength = searchInputResponsive.value.length;
                if (inputLength > 0) {
                    dropdownResponsive.classList.add('show');
                    searchOptions.classList.remove('d-none');
                } else {
                    dropdownResponsive.classList.remove('show');
                    searchOptions.classList.add('d-none');
                }
            });

            searchOptions.addEventListener('click', () => {
                searchInputResponsive.value = '';
                dropdownResponsive.classList.remove('show');
                searchOptions.classList.add('d-none');
            });

            document.body.addEventListener('click', (e) => {
                if (e.target.getAttribute('id') !== 'search-options') {
                    dropdownResponsive.classList.remove('show');
                    searchOptions.classList.add('d-none');
                }
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
        if (document.documentElement.getAttribute('data-layout') === 'vertical' ||
            document.documentElement.getAttribute('data-layout') === 'semibox') {
            document.getElementById('two-column-menu').innerHTML = '';
            if (document.querySelector('.navbar-menu')) {
                document.querySelector('.navbar-menu').innerHTML = navbarMenuHTML;
            }
            document.getElementById('scrollbar').setAttribute('data-simplebar', '');
            document.getElementById('navbar-nav').setAttribute('data-simplebar', '');
            document.getElementById('scrollbar').classList.add('h-100');
        }

        // Two-column layout menu scroll add.
        if (document.documentElement.getAttribute('data-layout') === 'twocolumn') {
            document.getElementById('scrollbar').removeAttribute('data-simplebar');
            document.getElementById('scrollbar').classList.remove('h-100');
        }

        // Horizontal layout menu.
        if (document.documentElement.getAttribute('data-layout') === 'horizontal') {
            updateHorizontalMenus();
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
                twoColumnMenuGenerate();
                initTwoColumnActiveMenu();
                isCollapseMenu();
            }
            if (sessionStorage.getItem('data-layout') === 'vertical') {
                document.documentElement.setAttribute('data-sidebar-size', 'sm');
            }
            if (sessionStorage.getItem('data-layout') === 'semibox') {
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
                twoColumnMenuGenerate();
                initTwoColumnActiveMenu();
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
        Array.from(isElement).forEach(function (item) {
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

        if (windowSize > 767)
            document.querySelector('.hamburger-icon').classList.toggle('open');

        // For collapse horizontal menu.
        if (document.documentElement.getAttribute('data-layout') === 'horizontal') {
            document.body.classList.contains('menu') ? document.body.classList.remove('menu') : document.body.classList.add('menu');
        }

        // For collapse vertical menu.
        if (document.documentElement.getAttribute('data-layout') === 'vertical') {
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

        // Semibox menu.
        if (document.documentElement.getAttribute('data-layout') === 'semibox') {
            if (windowSize > 767) {
                // (document.querySelector('.hamburger-icon').classList.contains('open')) ? document.documentElement.setAttribute('data-sidebar-visibility', 'show'): '';
                if (document.documentElement.getAttribute('data-sidebar-visibility') === 'show') {
                    document.documentElement.getAttribute('data-sidebar-size') === 'lg'
                        ? document.documentElement.setAttribute('data-sidebar-size', 'sm')
                        : document.documentElement.setAttribute('data-sidebar-size', 'lg');
                } else {
                    document.getElementById('sidebar-visibility-show').click();
                    document.documentElement.setAttribute('data-sidebar-size', document.documentElement.getAttribute('data-sidebar-size'));
                }
            } else if (windowSize <= 767) {
                document.body.classList.add('vertical-sidebar-enable');
                document.documentElement.setAttribute('data-sidebar-size', 'lg');
            }
        }

        // Two column menu.
        if (document.documentElement.getAttribute('data-layout') === 'twocolumn') {
            document.body.classList.contains('twocolumn-panel')
                ? document.body.classList.remove('twocolumn-panel')
                : document.body.classList.add('twocolumn-panel');
        }
    }

    /**
     *
     */
    const windowLoadContent = () => {
        // Demo show code.
        document.addEventListener('DOMContentLoaded', () => {
            let checkboxes = document.getElementsByClassName('code-switcher');
            Array.from(checkboxes).forEach((checkbox) => {
                checkbox.addEventListener('change', () => {
                    let card = checkbox.closest('.card');
                    if (!card) return;

                    let livePreviews = card.querySelectorAll('.live-preview');
                    let codeViews = card.querySelectorAll('.code-view');

                    if (checkbox.checked) {
                        livePreviews.forEach((preview) => preview.classList.add('d-none'));
                        codeViews.forEach((codeView) => codeView.classList.remove('d-none'));
                    } else {
                        livePreviews.forEach((preview) => preview.classList.remove('d-none'));
                        codeViews.forEach((codeView) => codeView.classList.add('d-none'));
                    }
                });
            });
            feather.replace();
        });

        window.addEventListener('resize', windowResizeHover);
        windowResizeHover();

        /* Init waves effect for tag class="waves-effect" */
        Waves.init();

        document.addEventListener('scroll', () => {
            windowScroll();
        });

        window.addEventListener('load', () => {
            let isTwoColumn = document.documentElement.getAttribute('data-layout');
            if (isTwoColumn === 'twocolumn') {
                initTwoColumnActiveMenu();
            } else {
                initActiveMenu();
            }
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
     * Two-column menu activation.
     */
    const initTwoColumnActiveMenu = () => {
        feather.replace();

        // Two column sidebar active js.
        let currentPath = location.pathname === '/' ? 'index' : location.pathname.substring(1);
        currentPath = currentPath.substring(currentPath.lastIndexOf('/') + 1);

        if (currentPath) {
            if (document.body.className === 'twocolumn-panel') {
                document.getElementById('two-column-menu').querySelector(`[href="${currentPath}"]`).classList.add('active');
            }
            // Navbar-nav.
            let navbarNav = document.getElementById('navbar-nav').querySelector(`[href="${currentPath}"]`);

            if (navbarNav) {
                navbarNav.classList.add('active');
                let parentCollapseDiv = navbarNav.closest('.collapse.menu-dropdown');
                if (parentCollapseDiv && parentCollapseDiv.parentElement.closest('.collapse.menu-dropdown')) {
                    parentCollapseDiv.classList.add('show');
                    parentCollapseDiv.parentElement.children[0].classList.add('active');
                    parentCollapseDiv.parentElement.closest('.collapse.menu-dropdown').parentElement.classList.add('twocolumn-item-show');
                    if (parentCollapseDiv.parentElement.parentElement.parentElement.parentElement.closest('.collapse.menu-dropdown')) {
                        let menuIdSub = parentCollapseDiv.parentElement.parentElement.parentElement.parentElement.closest('.collapse.menu-dropdown').getAttribute('id');
                        parentCollapseDiv.parentElement.parentElement.parentElement.parentElement.closest('.collapse.menu-dropdown').parentElement.classList.add('twocolumn-item-show');
                        parentCollapseDiv.parentElement.closest('.collapse.menu-dropdown').parentElement.classList.remove('twocolumn-item-show');
                        if (document.getElementById('two-column-menu').querySelector(`[href="#${menuIdSub}"]`)) {
                            document.getElementById('two-column-menu').querySelector(`[href="#${menuIdSub}"]`).classList.add('active');
                        }
                    }
                    let menuId = parentCollapseDiv.parentElement.closest('.collapse.menu-dropdown').getAttribute('id');
                    if (document.getElementById('two-column-menu').querySelector(`[href="#${menuId}"]`)) {
                        document.getElementById('two-column-menu').querySelector(`[href="#${menuId}"]`).classList.add('active');
                    }
                } else {
                    navbarNav.closest('.collapse.menu-dropdown').parentElement.classList.add('twocolumn-item-show');
                    let menuId = parentCollapseDiv.getAttribute('id');
                    if (document.getElementById('two-column-menu').querySelector(`[href="#${menuId}"]`)) {
                        document.getElementById('two-column-menu').querySelector(`[href="#${menuId}"]`).classList.add('active');
                    }
                }
            } else {
                document.body.classList.add('twocolumn-panel');
            }
        }
    }

    /**
     * Two-column sidebar active js.
     */
    const initActiveMenu = () => {
        let currentPath = location.pathname === '/' ? 'index' : location.pathname.substring(1);
        currentPath = currentPath.substring(currentPath.lastIndexOf('/') + 1);

        if (currentPath) {
            // Navbar-nav.
            let navbarNav = document.getElementById('navbar-nav').querySelector(`[href="currentPath"]`);
            if (navbarNav) {
                navbarNav.classList.add('active');
                let parentCollapseDiv = navbarNav.closest('.collapse.menu-dropdown');
                if (parentCollapseDiv) {
                    parentCollapseDiv.classList.add('show');
                    parentCollapseDiv.parentElement.children[0].classList.add('active');
                    parentCollapseDiv.parentElement.children[0].setAttribute('aria-expanded', 'true');
                    if (parentCollapseDiv.parentElement.closest('.collapse.menu-dropdown')) {
                        parentCollapseDiv.parentElement.closest('.collapse').classList.add('show');
                        if (parentCollapseDiv.parentElement.closest('.collapse').previousElementSibling)
                            parentCollapseDiv.parentElement.closest('.collapse').previousElementSibling.classList.add('active');

                        if (parentCollapseDiv.parentElement.parentElement.parentElement.parentElement.closest('.collapse.menu-dropdown')) {
                            parentCollapseDiv.parentElement.parentElement.parentElement.parentElement.closest('.collapse').classList.add('show');
                            if (parentCollapseDiv.parentElement.parentElement.parentElement.parentElement.closest('.collapse').previousElementSibling) {

                                parentCollapseDiv.parentElement.parentElement.parentElement.parentElement.closest('.collapse').previousElementSibling.classList.add('active');
                                if ((document.documentElement.getAttribute('data-layout') === 'horizontal') && parentCollapseDiv.parentElement.parentElement.parentElement.parentElement.parentElement.parentElement.parentElement.closest('.collapse')) {
                                    parentCollapseDiv.parentElement.parentElement.parentElement.parentElement.parentElement.parentElement.parentElement.closest('.collapse').previousElementSibling.classList.add('active')
                                }
                            }
                        }
                    }
                }
            }
        }
    }

    // Notification cart dropdown.
    const initTopbarComponents = () => {
        if (document.getElementsByClassName('dropdown-item-cart')) {
            let dropdownItemCart = document.querySelectorAll('.dropdown-item-cart').length;

            Array.from(document.querySelectorAll('#page-topbar .dropdown-menu-cart .remove-item-btn')).forEach((item) => {
                item.addEventListener('click', () => {
                    dropdownItemCart--;
                    this.closest('.dropdown-item-cart').remove();
                    Array.from(document.getElementsByClassName('cartitem-badge')).forEach((e) => {
                        e.innerHTML = dropdownItemCart + '';
                    });
                    updateCartPrice();
                    if (document.getElementById('empty-cart')) {
                        document.getElementById('empty-cart').style.display = dropdownItemCart === 0 ? 'block' : 'none';
                    }
                    if (document.getElementById('checkout-elem')) {
                        document.getElementById('checkout-elem').style.display = dropdownItemCart === 0 ? 'none' : 'block';
                    }
                });
            });

            Array.from(document.getElementsByClassName('cartitem-badge')).forEach((e) => {
                e.innerHTML = dropdownItemCart + '';
            });

            if (document.getElementById('empty-cart')) {
                document.getElementById('empty-cart').style.display = 'none';
            }

            if (document.getElementById('checkout-elem')) {
                document.getElementById('checkout-elem').style.display = 'block';
            }

            /**
             *
             */
            const updateCartPrice = () => {
                let currencySign = '$';
                let subtotal = 0;

                Array.from(document.getElementsByClassName('cart-item-price')).forEach((e) => {
                    subtotal += parseFloat(e.innerHTML);
                });

                if (document.getElementById('cart-item-total')) {
                    document.getElementById('cart-item-total').innerHTML = currencySign + subtotal.toFixed(2);
                }
            }

            updateCartPrice();
        }

        // Notification messages.
        if (document.getElementsByClassName('notification-check')) {
            const emptyNotification = () => {
                Array.from(document.querySelectorAll('#notificationItemsTabContent .tab-pane')).forEach((elem) => {
                    if (elem.querySelectorAll('.notification-item').length > 0) {
                        if (elem.querySelector('.view-all')) {
                            elem.querySelector('.view-all').style.display = 'block';
                        }
                    } else {
                        let emptyNotificationElem = elem.querySelector('.empty-notification-elem');

                        if (elem.querySelector('.view-all')) {
                            elem.querySelector('.view-all').style.display = 'none';
                        }

                        if (!emptyNotificationElem) {
                            elem.innerHTML += `
                            <div class="empty-notification-elem">
                                <div class="w-25 w-sm-50 pt-3 mx-auto">
                                    <img src="/build/images/svg/bell.svg" class="img-fluid" alt="user-pic">
                                </div>
                                <div class="text-center pb-5 mt-2">
                                    <h6 class="fs-18 fw-semibold lh-base">Hey! You have no any notifications </h6>
                                </div>
                            </div>`
                        }
                    }
                });
            }
            emptyNotification();

            Array.from(document.querySelectorAll('.notification-check input')).forEach((element) => {
                element.addEventListener('change', (el) => {
                    el.target.closest('.notification-item').classList.toggle('active');

                    let checkedCount = document.querySelectorAll('.notification-check input:checked').length;

                    if (el.target.closest('.notification-item').classList.contains('active')) {
                        (checkedCount > 0)
                            ? document.getElementById('notification-actions').style.display = 'block'
                            : document.getElementById('notification-actions').style.display = 'none';
                    } else {
                        (checkedCount > 0)
                            ? document.getElementById('notification-actions').style.display = 'block'
                            : document.getElementById('notification-actions').style.display = 'none';
                    }
                    document.getElementById('select-content').innerHTML = checkedCount + '';
                });

                const notificationDropdown = document.getElementById('notificationDropdown')
                notificationDropdown.addEventListener('hide.bs.dropdown', () => {
                    element.checked = false;
                    document.querySelectorAll('.notification-item').forEach((item) => {
                        item.classList.remove('active');
                    })
                    document.getElementById('notification-actions').style.display = '';
                });
            });

            const removeItem = document.getElementById('removeNotificationModal');
            removeItem.addEventListener('show.bs.modal', () => {
                document.getElementById('delete-notification').addEventListener('click', () => {
                        Array.from(document.querySelectorAll('.notification-item')).forEach((element) => {
                            if (element.classList.contains('active')) {
                                element.remove();
                            }
                        });
                        emptyNotification();

                        document.getElementById('NotificationModalbtn-close').click();
                    }
                );
            });
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
     * Counter Number.
     */
    const counter = () => {
        let counter = document.querySelectorAll('.counter-value');
        let speed = 250; // The lower the slower.

        counter && Array.from(counter).forEach((counterValue) => {
            function updateCount() {
                let target = +counterValue.getAttribute('data-target');
                let count = +counterValue.innerText;
                let inc = target / speed;

                if (inc < 1) {
                    inc = 1;
                }

                // Check if target is reached.
                if (count < target) {
                    // Add inc to count and output in counterValue.
                    counterValue.innerText = (count + inc).toFixed(0);
                    // Call function every ms.
                    setTimeout(updateCount, 1);
                } else {
                    counterValue.innerText = numberWithCommas(target);
                }
                numberWithCommas(counterValue.innerText);
            }

            updateCount();
        });

        /**
         *
         * @param x
         * @returns {string}
         */
        const numberWithCommas = (x) => {
            return x.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ',');
        }
    }

    /**
     *
     */
    const updateHorizontalMenus = () => {
        document.getElementById('two-column-menu').innerHTML = '';
        if (document.querySelector('.navbar-menu')) {
            document.querySelector('.navbar-menu').innerHTML = navbarMenuHTML;
        }
        document.getElementById('scrollbar').removeAttribute('data-simplebar');
        document.getElementById('navbar-nav').removeAttribute('data-simplebar');
        document.getElementById('scrollbar').classList.remove('h-100');

        let splitMenu = horizontalMenuSplit;
        let extraMenuName = 'More';
        let menuData = document.querySelectorAll('ul.navbar-nav > li.nav-item');
        let newMenus = '';
        let splitItem = '';

        Array.from(menuData).forEach((item, index) => {
            if (index + 1 === splitMenu) {
                splitItem = item;
            }

            if (index + 1 > splitMenu) {
                newMenus += item.outerHTML;
                item.remove();
            }

            if (index + 1 === menuData.length) {
                if (splitItem.insertAdjacentHTML) {
                    splitItem.insertAdjacentHTML('afterend',
                        `<li class="nav-item">
                            <a class="nav-link" href="#sidebarMore" data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="sidebarMore">
                                <i class="ri-briefcase-2-line"></i>
                                <span data-key="t-more">${extraMenuName}</span>
						    </a>
						    <div class="collapse menu-dropdown" id="sidebarMore">
						        <ul class="nav nav-sm flex-column">
						            ${newMenus}
						        </ul>
						    </div>
					    </li>`
                    );
                }
            }
        });
    }

    /**
     * Hide and show options of layout.
     * @param dataLayout
     */
    const hideShowLayoutOptions = (dataLayout) => {
        const themeSettingsOffcanvas = document.getElementById('theme-settings-offcanvas');
        const twoColumnMenu = document.getElementById('two-column-menu');
        const sidebarSize = document.getElementById('sidebar-size');
        const sidebarView = document.getElementById('sidebar-view');
        const sidebarColor = document.getElementById('sidebar-color');
        const sidebarImg = document.getElementById('sidebar-img');
        const layoutPosition = document.getElementById('layout-position');
        const layoutWidth = document.getElementById('layout-width');
        const sidebarVisibility = document.getElementById('sidebar-visibility');

        if (dataLayout === 'vertical') {
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
            initActiveMenu();
            addEventListenerOnSmHoverMenu();
            initMenuItemScroll();
        } else if (dataLayout === 'horizontal') {
            updateHorizontalMenus();
            if (themeSettingsOffcanvas) {
                sidebarSize.style.display = 'none';
                sidebarView.style.display = 'none';
                sidebarColor.style.display = 'none';
                if (sidebarImg) {
                    sidebarImg.style.display = 'none';
                }
                layoutPosition.style.display = 'block';
                layoutWidth.style.display = 'block';
                sidebarVisibility.style.display = 'none';
            }
            initActiveMenu();
        } else if (dataLayout === 'twocolumn') {
            document.getElementById('scrollbar').removeAttribute('data-simplebar');
            document.getElementById('scrollbar').classList.remove('h-100');
            if (themeSettingsOffcanvas) {
                sidebarSize.style.display = 'none';
                sidebarView.style.display = 'none';
                sidebarColor.style.display = 'block';
                if (sidebarImg) {
                    sidebarImg.style.display = 'block';
                }
                layoutPosition.style.display = 'none';
                layoutWidth.style.display = 'none';
                sidebarVisibility.style.display = 'none';
            }
        } else if (dataLayout === 'semibox') {
            twoColumnMenu.innerHTML = '';
            if (document.querySelector('.navbar-menu')) {
                document.querySelector('.navbar-menu').innerHTML = navbarMenuHTML;
            }
            if (themeSettingsOffcanvas) {
                sidebarSize.style.display = 'block';
                sidebarView.style.display = 'none';
                sidebarColor.style.display = 'block';
                if (sidebarImg) {
                    sidebarImg.style.display = 'block';
                }
                layoutPosition.style.display = 'block';
                layoutWidth.style.display = 'none';
                sidebarVisibility.style.display = 'block';
            }
            initLeftMenuCollapse();
            initActiveMenu();
            addEventListenerOnSmHoverMenu();
            initMenuItemScroll();
        }
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

    /**
     * Set full layout.
     * @param isLayoutAttributes
     */
    const layoutSwitch = (isLayoutAttributes) => {
        const dataLayout = sessionStorage.getItem('data-layout');
        if (isLayoutAttributes && typeof isLayoutAttributes === 'object') {
            /* Set layout. */
            switch (isLayoutAttributes['data-layout']) {
                case 'vertical':
                    getElementUsingTagName('data-layout', 'vertical');
                    sessionStorage.setItem('data-layout', 'vertical');
                    document.documentElement.setAttribute('data-layout', 'vertical');
                    hideShowLayoutOptions('vertical');
                    isCollapseMenu();
                    break;
                case 'horizontal':
                    getElementUsingTagName('data-layout', 'horizontal');
                    sessionStorage.setItem('data-layout', 'horizontal');
                    document.documentElement.setAttribute('data-layout', 'horizontal');
                    hideShowLayoutOptions('horizontal');
                    break;
                case 'twocolumn':
                    getElementUsingTagName('data-layout', 'twocolumn');
                    sessionStorage.setItem('data-layout', 'twocolumn');
                    document.documentElement.setAttribute('data-layout', 'twocolumn');
                    hideShowLayoutOptions('twocolumn');
                    break;
                case 'semibox':
                    getElementUsingTagName('data-layout', 'semibox');
                    sessionStorage.setItem('data-layout', 'semibox');
                    document.documentElement.setAttribute('data-layout', 'semibox');
                    hideShowLayoutOptions('semibox');
                    break;
                default:
                    if (dataLayout && dataLayout === 'vertical') {
                        getElementUsingTagName('data-layout', 'vertical');
                        sessionStorage.setItem('data-layout', 'vertical');
                        document.documentElement.setAttribute('data-layout', 'vertical');
                        hideShowLayoutOptions('vertical');
                        isCollapseMenu();
                    } else if (dataLayout === 'horizontal') {
                        getElementUsingTagName('data-layout', 'horizontal');
                        sessionStorage.setItem('data-layout', 'horizontal');
                        document.documentElement.setAttribute('data-layout', 'horizontal');
                        hideShowLayoutOptions('horizontal');
                    } else if (dataLayout === 'twocolumn') {
                        getElementUsingTagName('data-layout', 'twocolumn');
                        sessionStorage.setItem('data-layout', 'twocolumn');
                        document.documentElement.setAttribute('data-layout', 'twocolumn');
                        hideShowLayoutOptions('twocolumn');
                    } else if (dataLayout === 'semibox') {
                        getElementUsingTagName('data-layout', 'semibox');
                        sessionStorage.setItem('data-layout', 'semibox');
                        document.documentElement.setAttribute('data-layout', 'semibox');
                        hideShowLayoutOptions('semibox');
                    }
                    break;
            }

            /* Set theme layout. */
            if (isLayoutAttributes['data-topbar'] === 'light') {
                getElementUsingTagName('data-topbar', 'light');
                sessionStorage.setItem('data-topbar', 'light');
                document.documentElement.setAttribute('data-topbar', 'light');
            } else if (isLayoutAttributes['data-topbar'] === 'dark') {
                getElementUsingTagName('data-topbar', 'dark');
                sessionStorage.setItem('data-topbar', 'dark');
                document.documentElement.setAttribute('data-topbar', 'dark');
            } else {
                if (sessionStorage.getItem('data-topbar') === 'dark') {
                    getElementUsingTagName('data-topbar', 'dark');
                    sessionStorage.setItem('data-topbar', 'dark');
                    document.documentElement.setAttribute('data-topbar', 'dark');
                } else {
                    getElementUsingTagName('data-topbar', 'light');
                    sessionStorage.setItem('data-topbar', 'light');
                    document.documentElement.setAttribute('data-topbar', 'light');
                }
            }

            /* Set visibility of sidebar. */
            if (isLayoutAttributes['data-sidebar-visibility'] === 'hidden') {
                getElementUsingTagName('data-sidebar-visibility', 'hidden');
                sessionStorage.setItem('data-sidebar-visibility', 'hidden');
                document.documentElement.setAttribute('data-sidebar-visibility', 'hidden');
            } else {
                getElementUsingTagName('data-sidebar-visibility', 'show');
                sessionStorage.setItem('data-sidebar-visibility', 'show');
                document.documentElement.setAttribute('data-sidebar-visibility', 'show');
            }

            /* Set layout style. */
            if (isLayoutAttributes['data-layout-style'] === 'default') {
                getElementUsingTagName('data-layout-style', 'default');
                sessionStorage.setItem('data-layout-style', 'default');
                document.documentElement.setAttribute('data-layout-style', 'default');
            } else if (isLayoutAttributes['data-layout-style'] === 'detached') {
                getElementUsingTagName('data-layout-style', 'detached');
                sessionStorage.setItem('data-layout-style', 'detached');
                document.documentElement.setAttribute('data-layout-style', 'detached');
            } else {
                if (sessionStorage.getItem('data-layout-style') === 'detached') {
                    getElementUsingTagName('data-layout-style', 'detached');
                    sessionStorage.setItem('data-layout-style', 'detached');
                    document.documentElement.setAttribute('data-layout-style', 'detached');
                } else {
                    getElementUsingTagName('data-layout-style', 'default');
                    sessionStorage.setItem('data-layout-style', 'default');
                    document.documentElement.setAttribute('data-layout-style', 'default');
                }
            }

            /* Set size of sidebar. */
            const dataSidebarSize = sessionStorage.getItem('data-sidebar-size');
            switch (isLayoutAttributes['data-sidebar-size']) {
                case 'lg':
                    getElementUsingTagName('data-sidebar-size', 'lg');
                    document.documentElement.setAttribute('data-sidebar-size', 'lg');
                    sessionStorage.setItem('data-sidebar-size', 'lg');
                    break;
                case 'sm':
                    getElementUsingTagName('data-sidebar-size', 'sm');
                    document.documentElement.setAttribute('data-sidebar-size', 'sm');
                    sessionStorage.setItem('data-sidebar-size', 'sm');
                    break;
                case 'md':
                    getElementUsingTagName('data-sidebar-size', 'md');
                    document.documentElement.setAttribute('data-sidebar-size', 'md');
                    sessionStorage.setItem('data-sidebar-size', 'md');
                    break;
                case 'sm-hover':
                    getElementUsingTagName('data-sidebar-size', 'sm-hover');
                    document.documentElement.setAttribute('data-sidebar-size', 'sm-hover');
                    sessionStorage.setItem('data-sidebar-size', 'sm-hover');
                    break;
                default:
                    if (dataSidebarSize === 'sm') {
                        document.documentElement.setAttribute('data-sidebar-size', 'sm');
                        getElementUsingTagName('data-sidebar-size', 'sm');
                        sessionStorage.setItem('data-sidebar-size', 'sm');
                    } else if (dataSidebarSize === 'md') {
                        document.documentElement.setAttribute('data-sidebar-size', 'md');
                        getElementUsingTagName('data-sidebar-size', 'md');
                        sessionStorage.setItem('data-sidebar-size', 'md');
                    } else if (dataSidebarSize === 'sm-hover') {
                        document.documentElement.setAttribute('data-sidebar-size', 'sm-hover');
                        getElementUsingTagName('data-sidebar-size', 'sm-hover');
                        sessionStorage.setItem('data-sidebar-size', 'sm-hover');
                    } else {
                        document.documentElement.setAttribute('data-sidebar-size', 'lg');
                        getElementUsingTagName('data-sidebar-size', 'lg');
                        sessionStorage.setItem('data-sidebar-size', 'lg');
                    }
                    break;
            }

            /* Set theme full layout. */
            const dataBsTheme = sessionStorage.getItem('data-bs-theme');
            if (isLayoutAttributes['data-bs-theme'] === 'light') {
                getElementUsingTagName('data-bs-theme', 'light');
                document.documentElement.setAttribute('data-bs-theme', 'light');
                sessionStorage.setItem('data-bs-theme', 'light');
            } else if (isLayoutAttributes['data-bs-theme'] === 'dark') {
                getElementUsingTagName('data-bs-theme', 'dark');
                document.documentElement.setAttribute('data-bs-theme', 'dark');
                sessionStorage.setItem('data-bs-theme', 'dark');
            } else {
                if (dataBsTheme && dataBsTheme === 'dark') {
                    sessionStorage.setItem('data-bs-theme', 'dark');
                    document.documentElement.setAttribute('data-bs-theme', 'dark');
                    getElementUsingTagName('data-bs-theme', 'dark');
                } else {
                    sessionStorage.setItem('data-bs-theme', 'light');
                    document.documentElement.setAttribute('data-bs-theme', 'light');
                    getElementUsingTagName('data-bs-theme', 'light');
                }
            }

            /* Set width layout. */
            if (isLayoutAttributes['data-layout-width'] === 'fluid') {
                getElementUsingTagName('data-layout-width', 'fluid');
                document.documentElement.setAttribute('data-layout-width', 'fluid');
                sessionStorage.setItem('data-layout-width', 'fluid');
            } else if (isLayoutAttributes['data-layout-width'] === 'boxed') {
                getElementUsingTagName('data-layout-width', 'boxed');
                document.documentElement.setAttribute('data-layout-width', 'boxed');
                sessionStorage.setItem('data-layout-width', 'boxed');
            } else {
                if (sessionStorage.getItem('data-layout-width') === 'boxed') {
                    sessionStorage.setItem('data-layout-width', 'boxed');
                    document.documentElement.setAttribute('data-layout-width', 'boxed');
                    getElementUsingTagName('data-layout-width', 'boxed');
                } else {
                    sessionStorage.setItem('data-layout-width', 'fluid');
                    document.documentElement.setAttribute('data-layout-width', 'fluid');
                    getElementUsingTagName('data-layout-width', 'fluid');
                }
            }

            /* Set theme of sidebar. */
            const dataSidebar = sessionStorage.getItem('data-sidebar');
            switch (isLayoutAttributes['data-sidebar']) {
                case 'light':
                    getElementUsingTagName('data-sidebar', 'light');
                    sessionStorage.setItem('data-sidebar', 'light');
                    document.documentElement.setAttribute('data-sidebar', 'light');
                    break;
                case 'dark':
                    getElementUsingTagName('data-sidebar', 'dark');
                    sessionStorage.setItem('data-sidebar', 'dark');
                    document.documentElement.setAttribute('data-sidebar', 'dark');
                    break;
                case 'gradient':
                    getElementUsingTagName('data-sidebar', 'gradient');
                    sessionStorage.setItem('data-sidebar', 'gradient');
                    document.documentElement.setAttribute('data-sidebar', 'gradient');
                    break;
                case 'gradient-2':
                    getElementUsingTagName('data-sidebar', 'gradient-2');
                    sessionStorage.setItem('data-sidebar', 'gradient-2');
                    document.documentElement.setAttribute('data-sidebar', 'gradient-2');
                    break;
                case 'gradient-3':
                    getElementUsingTagName('data-sidebar', 'gradient-3');
                    sessionStorage.setItem('data-sidebar', 'gradient-3');
                    document.documentElement.setAttribute('data-sidebar', 'gradient-3');
                    break;
                case 'gradient-4':
                    getElementUsingTagName('data-sidebar', 'gradient-4');
                    sessionStorage.setItem('data-sidebar', 'gradient-4');
                    document.documentElement.setAttribute('data-sidebar', 'gradient-4');
                    break;
                default:
                    if (dataSidebar && dataSidebar === 'light') {
                        sessionStorage.setItem('data-sidebar', 'light');
                        getElementUsingTagName('data-sidebar', 'light');
                        document.documentElement.setAttribute('data-sidebar', 'light');
                    } else if (dataSidebar === 'dark') {
                        sessionStorage.setItem('data-sidebar', 'dark');
                        getElementUsingTagName('data-sidebar', 'dark');
                        document.documentElement.setAttribute('data-sidebar', 'dark');
                    } else if (dataSidebar === 'gradient') {
                        sessionStorage.setItem('data-sidebar', 'gradient');
                        getElementUsingTagName('data-sidebar', 'gradient');
                        document.documentElement.setAttribute('data-sidebar', 'gradient');
                    } else if (dataSidebar === 'gradient-2') {
                        sessionStorage.setItem('data-sidebar', 'gradient-2');
                        getElementUsingTagName('data-sidebar', 'gradient-2');
                        document.documentElement.setAttribute('data-sidebar', 'gradient-2');
                    } else if (dataSidebar === 'gradient-3') {
                        sessionStorage.setItem('data-sidebar', 'gradient-3');
                        getElementUsingTagName('data-sidebar', 'gradient-3');
                        document.documentElement.setAttribute('data-sidebar', 'gradient-3');
                    } else if (dataSidebar === 'gradient-4') {
                        sessionStorage.setItem('data-sidebar', 'gradient-4');
                        getElementUsingTagName('data-sidebar', 'gradient-4');
                        document.documentElement.setAttribute('data-sidebar', 'gradient-4');
                    }
                    break;
            }

            /* Set background image of sidebar. */
            const dataSidebarImage = sessionStorage.getItem('data-sidebar-image');
            switch (isLayoutAttributes['data-sidebar-image']) {
                case 'none':
                    getElementUsingTagName('data-sidebar-image', 'none');
                    sessionStorage.setItem('data-sidebar-image', 'none');
                    document.documentElement.setAttribute('data-sidebar-image', 'none');
                    break;
                case 'img-1':
                    getElementUsingTagName('data-sidebar-image', 'img-1');
                    sessionStorage.setItem('data-sidebar-image', 'img-1');
                    document.documentElement.setAttribute('data-sidebar-image', 'img-1');
                    break;
                case 'img-2':
                    getElementUsingTagName('data-sidebar-image', 'img-2');
                    sessionStorage.setItem('data-sidebar-image', 'img-2');
                    document.documentElement.setAttribute('data-sidebar-image', 'img-2');
                    break;
                case 'img-3':
                    getElementUsingTagName('data-sidebar-image', 'img-3');
                    sessionStorage.setItem('data-sidebar-image', 'img-3');
                    document.documentElement.setAttribute('data-sidebar-image', 'img-3');
                    break;
                case 'img-4':
                    getElementUsingTagName('data-sidebar-image', 'img-4');
                    sessionStorage.setItem('data-sidebar-image', 'img-4');
                    document.documentElement.setAttribute('data-sidebar-image', 'img-4');
                    break;
                default:
                    if (dataSidebarImage && dataSidebarImage === 'none') {
                        sessionStorage.setItem('data-sidebar-image', 'none');
                        getElementUsingTagName('data-sidebar-image', 'none');
                        document.documentElement.setAttribute('data-sidebar-image', 'none');
                    } else if (dataSidebarImage === 'img-1') {
                        sessionStorage.setItem('data-sidebar-image', 'img-1');
                        getElementUsingTagName('data-sidebar-image', 'img-1');
                        document.documentElement.setAttribute('data-sidebar-image', 'img-2');
                    } else if (dataSidebarImage === 'img-2') {
                        sessionStorage.setItem('data-sidebar-image', 'img-2');
                        getElementUsingTagName('data-sidebar-image', 'img-2');
                        document.documentElement.setAttribute('data-sidebar-image', 'img-2');
                    } else if (dataSidebarImage === 'img-3') {
                        sessionStorage.setItem('data-sidebar-image', 'img-3');
                        getElementUsingTagName('data-sidebar-image', 'img-3');
                        document.documentElement.setAttribute('data-sidebar-image', 'img-3');
                    } else if (dataSidebarImage === 'img-4') {
                        sessionStorage.setItem('data-sidebar-image', 'img-4');
                        getElementUsingTagName('data-sidebar-image', 'img-4');
                        document.documentElement.setAttribute('data-sidebar-image', 'img-4');
                    }
                    break;
            }

            /* Set position of layout. */
            const dataLayoutPosition = sessionStorage.getItem('data-layout-position');
            if (isLayoutAttributes['data-layout-position'] === 'fixed') {
                getElementUsingTagName('data-layout-position', 'fixed');
                sessionStorage.setItem('data-layout-position', 'fixed');
                document.documentElement.setAttribute('data-layout-position', 'fixed');
            } else if (isLayoutAttributes['data-layout-position'] === 'scrollable') {
                getElementUsingTagName('data-layout-position', 'scrollable');
                sessionStorage.setItem('data-layout-position', 'scrollable');
                document.documentElement.setAttribute('data-layout-position', 'scrollable');
            } else {
                if (dataLayoutPosition && dataLayoutPosition === 'scrollable') {
                    getElementUsingTagName('data-layout-position', 'scrollable');
                    sessionStorage.setItem('data-layout-position', 'scrollable');
                    document.documentElement.setAttribute('data-layout-position', 'scrollable');
                } else {
                    getElementUsingTagName('data-layout-position', 'fixed');
                    sessionStorage.setItem('data-layout-position', 'fixed');
                    document.documentElement.setAttribute('data-layout-position', 'fixed');
                }
            }

            /* Set disable and enable preloader */
            const preloader = document.getElementById('preloader');
            const dataPreloader = sessionStorage.getItem('data-preloader');
            if (isLayoutAttributes['data-preloader'] === 'disable') {
                getElementUsingTagName('data-preloader', 'disable');
                sessionStorage.setItem('data-preloader', 'disable');
                document.documentElement.setAttribute('data-preloader', 'disable');
            } else if (isLayoutAttributes['data-preloader'] === 'enable') {
                getElementUsingTagName('data-preloader', 'enable');
                sessionStorage.setItem('data-preloader', 'enable');
                document.documentElement.setAttribute('data-preloader', 'enable');
                if (preloader) {
                    window.addEventListener('load', function () {
                        preloader.style.opacity = '0';
                        preloader.style.visibility = 'hidden';
                    });
                }
            } else {
                if (dataPreloader && dataPreloader === 'disable') {
                    getElementUsingTagName('data-preloader', 'disable');
                    sessionStorage.setItem('data-preloader', 'disable');
                    document.documentElement.setAttribute('data-preloader', 'disable');

                } else if (dataPreloader === 'enable') {
                    getElementUsingTagName('data-preloader', 'enable');
                    sessionStorage.setItem('data-preloader', 'enable');
                    document.documentElement.setAttribute('data-preloader', 'enable');
                    if (preloader) {
                        window.addEventListener('load', function () {
                            preloader.style.opacity = '0';
                            preloader.style.visibility = 'hidden';
                        });
                    }
                } else {
                    document.documentElement.setAttribute('data-preloader', 'disable');
                }
            }

            /* Set sidebar body image. */
            const dataBodyImage = sessionStorage.getItem('data-body-image');
            switch (isLayoutAttributes['data-body-image']) {
                case 'img-1':
                    getElementUsingTagName('data-body-image', 'img-1');
                    sessionStorage.setItem('data-body-image', 'img-1');
                    document.documentElement.setAttribute('data-body-image', 'img-1');
                    if (document.getElementById('theme-settings-offcanvas')) {
                        document.documentElement.removeAttribute('data-sidebar-image');
                    }
                    break;
                case 'img-2':
                    getElementUsingTagName('data-body-image', 'img-2');
                    sessionStorage.setItem('data-body-image', 'img-2');
                    document.documentElement.setAttribute('data-body-image', 'img-2');
                    break;
                case 'img-3':
                    getElementUsingTagName('data-body-image', 'img-3');
                    sessionStorage.setItem('data-body-image', 'img-3');
                    document.documentElement.setAttribute('data-body-image', 'img-3');
                    break;
                case 'none':
                    getElementUsingTagName('data-body-image', 'none');
                    sessionStorage.setItem('data-body-image', 'none');
                    document.documentElement.setAttribute('data-body-image', 'none');
                    break;

                default:
                    if (dataBodyImage && dataBodyImage === 'img-1') {
                        sessionStorage.setItem('data-body-image', 'img-1');
                        getElementUsingTagName('data-body-image', 'img-1');
                        document.documentElement.setAttribute('data-body-image', 'img-1');

                        if (document.getElementById('theme-settings-offcanvas')) {
                            const sidebarImg = document.getElementById('sidebar-img');
                            if (sidebarImg) {
                                sidebarImg.style.display = 'none';
                                document.documentElement.removeAttribute('data-sidebar-image');
                            }
                        }
                    } else if (dataBodyImage === 'img-2') {
                        sessionStorage.setItem('data-body-image', 'img-2');
                        getElementUsingTagName('data-body-image', 'img-2');
                        document.documentElement.setAttribute('data-body-image', 'img-2');
                    } else if (dataBodyImage === 'img-3') {
                        sessionStorage.setItem('data-body-image', 'img-3');
                        getElementUsingTagName('data-body-image', 'img-3');
                        document.documentElement.setAttribute('data-body-image', 'img-3');
                    } else if (dataBodyImage === 'none') {
                        sessionStorage.setItem('data-body-image', 'none');
                        getElementUsingTagName('data-body-image', 'none');
                        document.documentElement.setAttribute('data-body-image', 'none');
                    }
                    break;
            }
        }
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

    const getElementUsingTagName = (element, value) => {
        Array.from(document.querySelectorAll(`input[name="${element}"]`)).forEach((x) => {
            value === x.value ? (x.checked = true) : (x.checked = false);

            x.addEventListener('change', function () {
                document.documentElement.setAttribute(element, x.value);
                sessionStorage.setItem(element, x.value);
                initLanguage();

                if (element === 'data-layout-width' && x.value === 'boxed') {
                    document.documentElement.setAttribute('data-sidebar-size', 'sm-hover');
                    sessionStorage.setItem('data-sidebar-size', 'sm-hover');
                    document.getElementById('sidebar-size-small-hover').checked = true;
                } else if (element === 'data-layout-width' && x.value === 'fluid') {
                    document.documentElement.setAttribute('data-sidebar-size', 'lg');
                    sessionStorage.setItem('data-sidebar-size', 'lg');
                    document.getElementById('sidebar-size-default').checked = true;
                }

                if (element === 'data-layout') {
                    if (x.value === 'vertical') {
                        hideShowLayoutOptions('vertical');
                        isCollapseMenu();
                        feather.replace();
                    } else if (x.value === 'horizontal') {
                        if (document.getElementById('sidebarimg-none')) {
                            document.getElementById('sidebarimg-none').click();
                        }
                        hideShowLayoutOptions('horizontal');
                        feather.replace();
                    } else if (x.value === 'twocolumn') {
                        hideShowLayoutOptions('twocolumn');
                        document.documentElement.setAttribute('data-layout-width', 'fluid');
                        document.getElementById('layout-width-fluid').click();
                        twoColumnMenuGenerate();
                        initTwoColumnActiveMenu();
                        isCollapseMenu();
                        feather.replace();
                    } else if (x.value === 'semibox') {
                        hideShowLayoutOptions('semibox');
                        document.documentElement.setAttribute('data-layout-width', 'fluid');
                        document.getElementById('layout-width-fluid').click();
                        document.documentElement.setAttribute('data-layout-style', 'default');
                        document.getElementById('sidebar-view-default').click();
                        isCollapseMenu();
                        feather.replace();
                    }
                }

                let sidebarSections = 'block';
                if (document.documentElement.getAttribute('data-layout') === 'semibox') {
                    if (document.documentElement.getAttribute('data-sidebar-visibility') === 'hidden') {
                        document.documentElement.removeAttribute('data-sidebar');
                        document.documentElement.removeAttribute('data-sidebar-image');
                        document.documentElement.removeAttribute('data-sidebar-size');
                        sidebarSections = 'none';
                    } else {
                        document.documentElement.setAttribute('data-sidebar', sessionStorage.getItem('data-sidebar'));
                        document.documentElement.setAttribute('data-sidebar-image', sessionStorage.getItem('data-sidebar-image'));
                        document.documentElement.setAttribute('data-sidebar-size', sessionStorage.getItem('data-sidebar-size'));
                    }
                }
                document.getElementById('sidebar-size').style.display = sidebarSections;
                document.getElementById('sidebar-color').style.display = sidebarSections;
                if (document.getElementById('sidebar-img')) {
                    document.getElementById('sidebar-img').style.display = sidebarSections;
                }

                if (element === 'data-preloader' && x.value === 'enable') {
                    document.documentElement.setAttribute('data-preloader', 'enable');
                    const preloader = document.getElementById('preloader');
                    if (preloader) {
                        setTimeout(() => {
                            preloader.style.opacity = '0';
                            preloader.style.visibility = 'hidden';
                        }, 1000);
                    }
                    document.getElementById('customizerclose-btn').click();
                } else if (element === 'data-preloader' && x.value === 'disable') {
                    document.documentElement.setAttribute('data-preloader', 'disable');
                    document.getElementById('customizerclose-btn').click();
                }

                if (element === 'data-bs-theme') {
                    // Dispatch the resize event on the window object.
                    window.dispatchEvent(resizeEvent);
                }
            });
        });

        const collapseBgGradient = document.getElementById('collapseBgGradient');
        if (collapseBgGradient) {
            Array.from(document.querySelectorAll('#collapseBgGradient .form-check input')).forEach((subElem) => {

                if ((subElem.checked === true)) {
                    let bsCollapse = new Collapse(collapseBgGradient, {
                        toggle: false,
                    });
                    bsCollapse.show();
                }

                if (document.querySelector("[data-bs-target='#collapseBgGradient']")) {
                    document.querySelector("[data-bs-target='#collapseBgGradient']").addEventListener('click', () => {
                        document.getElementById('sidebar-color-gradient').click();
                    });
                }
            });
        }

        if (document.querySelectorAll("[data-bs-target='#collapseBgGradient.show']")) {
            Array.from(document.querySelectorAll("[data-bs-target='#collapseBgGradient.show']")).forEach((subElem) => {
                subElem.addEventListener('click', () => {
                    let bsCollapse = new Collapse(collapseBgGradient, {
                        toggle: false,
                    })
                    bsCollapse.hide();
                })
            });
        }

        Array.from(document.querySelectorAll("[name='data-sidebar']")).forEach((element) => {
            if (document.querySelector("[data-bs-target='#collapseBgGradient']")) {
                if (document.querySelector('#collapseBgGradient .form-check input:checked')) {
                    document.querySelector("[data-bs-target='#collapseBgGradient']").classList.add('active');
                } else {
                    document.querySelector("[data-bs-target='#collapseBgGradient']").classList.remove('active');
                }

                element.addEventListener('change', function () {
                    if (document.querySelector('#collapseBgGradient .form-check input:checked')) {
                        document.querySelector("[data-bs-target='#collapseBgGradient']").classList.add('active');
                    } else {
                        document.querySelector("[data-bs-target='#collapseBgGradient']").classList.remove('active');
                    }
                });
            }
        });
    }

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
            layoutSwitch(isLayoutAttributes);

            // Open right sidebar on first time load.
            let offCanvas = document.querySelector(".btn[data-bs-target='#theme-settings-offcanvas']");
            offCanvas ? offCanvas.click() : '';
        } else {
            let isLayoutAttributes = {};
            isLayoutAttributes['data-layout'] = sessionStorage.getItem('data-layout');
            isLayoutAttributes['data-sidebar-size'] = sessionStorage.getItem('data-sidebar-size');
            isLayoutAttributes['data-bs-theme'] = sessionStorage.getItem('data-bs-theme');
            isLayoutAttributes['data-layout-width'] = sessionStorage.getItem('data-layout-width');
            isLayoutAttributes['data-sidebar'] = sessionStorage.getItem('data-sidebar');
            isLayoutAttributes['data-sidebar-image'] = sessionStorage.getItem('data-sidebar-image');
            isLayoutAttributes['data-layout-position'] = sessionStorage.getItem('data-layout-position');
            isLayoutAttributes['data-layout-style'] = sessionStorage.getItem('data-layout-style');
            isLayoutAttributes['data-topbar'] = sessionStorage.getItem('data-topbar');
            isLayoutAttributes['data-preloader'] = sessionStorage.getItem('data-preloader');
            isLayoutAttributes['data-body-image'] = sessionStorage.getItem('data-body-image');
            layoutSwitch(isLayoutAttributes);
        }
    }

    /**
     * Initializes fullscreen functionality for modern browsers.
     */
    const initFullScreen = () => {
        let fullscreenBtn = document.querySelector("[data-toggle='fullscreen']");

        /**
         * Delete class 'fullscreen-enable' when exit fullscreen and re-update UI.
         */
        const exitHandler = () => {
            if (!document.fullscreenElement && !document.webkitIsFullScreen && !document.mozFullScreen) {
                document.body.classList.remove('fullscreen-enable');
            }
        }

        fullscreenBtn && fullscreenBtn.addEventListener('click', async (e) => {
            e.preventDefault();
            document.body.classList.toggle('fullscreen-enable');

            try {
                // Check if the document is not currently in fullscreen mode.
                if (!document.fullscreenElement && !document.mozFullScreenElement && !document.webkitFullscreenElement) {
                    document.body.classList.toggle('fullscreen-enable');

                    // Current working methods.
                    if (document.documentElement.requestFullscreen) {
                        // Standard API (returns a Promise).
                        await document.documentElement.requestFullscreen();
                    } else if (document.documentElement.mozRequestFullScreen) {
                        // Older Firefox API.
                        await document.documentElement.mozRequestFullScreen();
                    } else if (document.documentElement.webkitRequestFullscreen) {
                        // Older WebKit-based browsers.
                        await document.documentElement.webkitRequestFullscreen(Element.ALLOW_KEYBOARD_INPUT);
                    }
                } else {
                    document.body.classList.remove('fullscreen-enable');

                    if (document.exitFullscreen) {
                        await document.exitFullscreen();
                    } else if (document.mozCancelFullScreen) {
                        await document.mozCancelFullScreen();
                    } else if (document.webkitExitFullscreen) {
                        await document.webkitExitFullscreen();
                    }
                }
            } catch (error) {
                console.error('Fullscreen operation failed:', error);

                // Revert the `fullscreen-enable` class to keep UI in sync.
                document.body.classList.remove('fullscreen-enable');
            }
        });

        // Remove existing event listeners to prevent duplicates.
        document.removeEventListener('fullscreenchange', exitHandler);
        document.removeEventListener('webkitfullscreenchange', exitHandler);
        document.removeEventListener('mozfullscreenchange', exitHandler);

        // Add event listeners for fullscreen state changes across different browsers.
        document.addEventListener('fullscreenchange', exitHandler); // Standard API.
        document.addEventListener('webkitfullscreenchange', exitHandler); // Older WebKit browsers.
        document.addEventListener('mozfullscreenchange', exitHandler); // Older Firefox.
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
     * Reset layout.
     */
    const resetLayout = () => {
        if (document.getElementById('reset-layout')) {
            document.getElementById('reset-layout').addEventListener('click', () => {
                sessionStorage.clear();
                window.location.reload();
            });
        }
    }

    /**
     * Initialize.
     */
    const init = () => {
        setDefaultAttribute();
        twoColumnMenuGenerate();
        isCustomDropdown();
        isCustomDropdownResponsive();
        initFullScreen();
        initModeSetting();
        windowLoadContent();
        counter();
        initLeftMenuCollapse();
        initTopbarComponents();
        initComponents();
        resetLayout();
        pluginData();
        initLanguage();
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
        if (document.body.scrollTop > 100 || document.documentElement.scrollTop > 100) {
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
