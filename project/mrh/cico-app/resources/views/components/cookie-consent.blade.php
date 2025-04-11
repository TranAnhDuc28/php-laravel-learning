<div id="cookie-consent" class="fixed-bottom bg-skyblue-custom shadow p-3 d-none">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-md-8 mb-3 mb-md-0">
                <h3 class="h5 fw-bold mb-2">We value your privacy</h3>
                <p class="text-muted mb-0">
                    This website uses cookies, pixels, and other tracking technologies to personalize content and analyze how our sites are used. We disclose data about website users to third parties so we can target our ads to you on other websites, and those third parties may use that data for their own purposes.
                </p>
            </div>
            <div class="col-md-4">
                <div class="d-flex gap-2 justify-content-md-end">
{{--                    <button onclick="manageCookies()" class="btn btn-outline-secondary">--}}
{{--                        Manage--}}
{{--                    </button>--}}
                    <button onclick="rejectAllCookies()" class="btn btn-outline-secondary">
                        Reject All
                    </button>
                    <button onclick="acceptAllCookies()" class="btn btn-warning text-white">
                        Accept All
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        if (!getCookie('cookie_consent')) {
            document.getElementById('cookie-consent').classList.remove('d-none');
        }
    });

    function setCookie(name, value, days) {
        let expires = "";
        if (days) {
            const date = new Date();
            date.setTime(date.getTime() + (days * 24 * 60 * 60 * 1000));
            expires = "; expires=" + date.toUTCString();
        }
        document.cookie = name + "=" + (value || "") + expires + "; path=/";
    }

    function getCookie(name) {
        const nameEQ = name + "=";
        const ca = document.cookie.split(';');
        for(let i = 0; i < ca.length; i++) {
            let c = ca[i];
            while (c.charAt(0) == ' ') c = c.substring(1, c.length);
            if (c.indexOf(nameEQ) == 0) return c.substring(nameEQ.length, c.length);
        }
        return null;
    }

    function acceptAllCookies() {
        setCookie('cookie_consent', 'accepted', 365);
        document.getElementById('cookie-consent').classList.add('d-none');
        // Thêm logic khởi tạo các cookie khác ở đây
    }

    function rejectAllCookies() {
        setCookie('cookie_consent', 'rejected', 365);
        document.getElementById('cookie-consent').classList.add('d-none');
        // Thêm logic xóa các cookie không cần thiết ở đây
    }

    // function manageCookies() {
    //     // Thêm logic để mở modal quản lý cookie chi tiết
    //     alert('Tính năng đang được phát triển');
    // }
</script>
