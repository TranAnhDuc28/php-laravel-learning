// back to top button
$(document).ready(function () {
    // Show/hide back to top button
    $(window).scroll(function () {
        if ($(this).scrollTop() > $(window).height()) {
            $('#backToTop').fadeIn();
        } else {
            $('#backToTop').fadeOut();
        }
    });

    // Scroll to top when button clicked
    $('#backToTop').click(function () {
        $('html, body').animate({scrollTop: 0}, 'slow');
        return false;
    });
});

document.addEventListener('DOMContentLoaded', function () {
    const sidebar = document.getElementById('sidebar');
    const overlay = document.getElementById('overlay');
    const openBtn = document.getElementById('openSidebar');
    const closeBtn = document.getElementById('closeSidebar');

    // Mở sidebar
    if (openBtn != null) {
        openBtn.addEventListener('click', function () {
            sidebar.classList.add('active');
            overlay.style.display = 'block';
            document.body.style.overflow = 'hidden'; // Ngăn scroll body
        });
    }

    // Đóng sidebar
    function closeSidebar() {
        sidebar.classList.remove('active');
        overlay.style.display = 'none';
        document.body.style.overflow = ''; // Cho phép scroll body
    }

    if (closeBtn != null) {
        closeBtn.addEventListener('click', closeSidebar);
    }
    if (overlay != null) {
        overlay.addEventListener('click', closeSidebar);
    }

    // Đóng sidebar khi nhấn ESC
    document.addEventListener('keydown', function (e) {
        if (e.key === 'Escape') {
            closeSidebar();
        }
    });
});
