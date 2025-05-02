import Prism from 'prismjs'
import 'prismjs/components/prism-markup.min.js';
import 'prismjs/plugins/line-numbers/prism-line-numbers.min.js';
import 'prismjs/plugins/toolbar/prism-toolbar.min.js';
import 'prismjs/plugins/copy-to-clipboard/prism-copy-to-clipboard.min.js';
import 'prismjs/plugins/normalize-whitespace/prism-normalize-whitespace.min.js';
import Toast from 'bootstrap/js/dist/toast.js';
import Toastify from "toastify-js";

document.addEventListener('DOMContentLoaded', () => {
    Prism.plugins.NormalizeWhitespace.setDefaults({
        'remove-trailing': true,    // Xóa khoảng trắng thừa ở cuối dòng
        'remove-indent': true,      // Xóa thụt lề (khoảng trắng đầu dòng)
        'left-trim': true,          // Xóa khoảng trắng ở đầu toàn bộ khối mã
        'right-trim': true,         // Xóa khoảng trắng ở cuối toàn bộ khối mã
        'remove-initial-line-feed': false, // Xóa dòng trống đầu tiên
        /*'break-lines': 80,        // Tự động ngắt dòng nếu dòng dài hơn 80 ký tự
        'indent': 2,               // Thêm thụt lề (2 khoảng trắng) cho mỗi cấp
        'tabs-to-spaces': 4,       // Chuyển tab thành 4 khoảng trắng
        'spaces-to-tabs': 4*/      // Chuyển 4 khoảng trắng thành 1 tab
    });

    Prism.highlightAll();

    /* Placement toast. */
    const toastPlacement = document.getElementById('toastPlacement');
    if (toastPlacement) {
        document.getElementById('selectToastPlacement').addEventListener('change', (e) => {
            // if 'data-original-class' not exists, create 'data-original-class' and set class name of element with ID 'toastPlacement'.
            if (!toastPlacement.dataset.originalClass) {
                toastPlacement.dataset.originalClass = toastPlacement.className
            }
            // Set placement on element Toast that.
            toastPlacement.className = toastPlacement.dataset.originalClass + ' ' + e.target.value
        });
    }

    Array.from(document.querySelectorAll('.bd-example .toast')).forEach((toastElement) => {
        let toast = new Toast(toastElement, {
            autohide: false
        });
        toast.show();
    });

    /* Bordered with Icon Toast. */
    const toastTrigger1 = document.getElementById('borderedToast1Btn');
    const toastLiveExample1 = document.getElementById('borderedToast1');
    if (toastTrigger1 && toastLiveExample1) {
        toastTrigger1.addEventListener('click', () => {
            let toast1 = new Toast(toastLiveExample1);
            toast1.show();
        });
    }

    const toastTrigger2 = document.getElementById('borderedToast2Btn');
    const toastLiveExample2 = document.getElementById('borderedToast2');
    if (toastTrigger2 && toastLiveExample2) {
        toastTrigger2.addEventListener('click', () => {
            let toast2 = new Toast(toastLiveExample2);
            toast2.show();
        });
    }

    const toastTrigger3 = document.getElementById('borderedToast3Btn');
    const toastLiveExample3 = document.getElementById('borderedToast3');
    if (toastTrigger3 && toastLiveExample3) {
        toastTrigger3.addEventListener('click', () => {
            let toast3 = new Toast(toastLiveExample3);
            toast3.show();
        });
    }

    const toastTrigger4 = document.getElementById('borderedToast4Btn');
    const toastLiveExample4 = document.getElementById('borderedToast4');
    if (toastTrigger4 && toastLiveExample4) {
        toastTrigger4.addEventListener('click', () => {
            let toast4 = new Toast(toastLiveExample4);
            toast4.show();
        });
    }

    /* Toastfy JS. */
    const btnToastfyJsDefault = document.getElementById('btn-toastfy-js-default');
    btnToastfyJsDefault && btnToastfyJsDefault.addEventListener('click', () => {
        Toastify({
            text: 'Welcome Back! This is a Toast Notification.',
            className: 'bg-primary',
            duration: 3000,
            close: true,
            gravity: 'top', // `top` or `bottom`
            position: 'right', // `left`, `center` or `right`
            stopOnFocus: true, // Prevents dismissing of toast on hover
            style: {
                background: 'linear-gradient(to right, #00b09b, #96c93d)',
            }
        }).showToast();
    });

    const btnToastfyJsSuccess = document.getElementById('btn-toastfy-js-success');
    btnToastfyJsSuccess && btnToastfyJsSuccess.addEventListener('click', () => {
        Toastify({
            text: 'Your application was successfully sent.',
            className: 'bg-success',
            duration: 3000,
            close: true,
            gravity: 'top',
            position: 'center',
            stopOnFocus: true,
        }).showToast();
    });

    const btnToastfyJsWarning = document.getElementById('btn-toastfy-js-warning');
    btnToastfyJsWarning && btnToastfyJsWarning.addEventListener('click', () => {
        Toastify({
            text: 'Warning! Something went wrong try again.',
            className: 'bg-warning',
            duration: 3000,
            close: true,
            gravity: 'top',
            position: 'center',
            stopOnFocus: true,
        }).showToast();
    });

    const btnToastfyJsDanger = document.getElementById('btn-toastfy-js-error');
    btnToastfyJsDanger && btnToastfyJsDanger.addEventListener('click', () => {
        Toastify({
            text: 'Error! An error occurred.',
            className: 'bg-danger',
            duration: 3000,
            close: true,
            gravity: 'top',
            position: 'center',
            stopOnFocus: true,
        }).showToast();
    });

    /* Display Position. */
    const groupToastfyDisplayPosition = document.getElementById('group-btn-toastfy-display-position');
    if (groupToastfyDisplayPosition) {
        const btnToastfies = groupToastfyDisplayPosition.getElementsByTagName('button');
        Array.from(btnToastfies).forEach((btn) => {
            btn.addEventListener('click', (e) => {
                Toastify({
                    text: 'Welcome Back! This is a Toast Notification.',
                    duration: 3000,
                    close: true,
                    gravity: e.target.getAttribute('data-gravity'),
                    position: e.target.getAttribute('data-position'),
                    stopOnFocus: true,
                }).showToast();
            });
        });
    }

    /* Offset Position. */
    const btnToastfyOffsetPosition = document.getElementById('btn-toastfy-offset-position');
    btnToastfyOffsetPosition.addEventListener('click', () => {
        Toastify({
            text: 'Welcome Back! This is a Toast Notification.',
            duration: 3000,
            close: true,
            gravity: 'top',
            position: 'right',
            stopOnFocus: true,
            offset: {
                x: 50, // horizontal axis - can be a number or a string indicating unity. eg: '2em'
                y: 10 // vertical axis - can be a number or a string indicating unity. eg: '2em'
            },
        }).showToast();
    });

    /* Close icon Display. */
    const btnToastfyCloseIcon = document.getElementById('btn-toastfy-close-icon');
    btnToastfyCloseIcon.addEventListener('click', () => {
        Toastify({
            text: 'Welcome Back! This is a Toast Notification.',
            duration: 3000,
            close: true,
            position: 'right',
            stopOnFocus: true,
        }).showToast();
    });

    /* Duration. */
    const btnToastfyDuration = document.getElementById('btn-toastfy-duration');
    btnToastfyDuration.addEventListener('click', () => {
        Toastify({
            text: 'Toast Duration 5s.',
            duration: 5000,
            close: true,
            gravity: 'top',
            position: 'right',
            stopOnFocus: true,
        }).showToast();
    });
});


