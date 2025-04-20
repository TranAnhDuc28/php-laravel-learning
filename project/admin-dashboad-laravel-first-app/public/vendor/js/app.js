

/**
 * Scrolls the page to the top.
 * Works on both Safari (body.scrollTop) and Chrome/Firefox (documentElement.scrollTop)
 */
function scrollToTop() {
    document.body.scrollTop = 0;
    document.documentElement.scrollTop = 0;
}
