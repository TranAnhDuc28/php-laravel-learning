import Toastify from 'toastify-js';

const ToastifyWrapper = {
    show: (message, type = 'info', options = {}) => {
        const className = {success: 'bg-success', error: 'bg-danger', info: 'bg-info', warning: 'bg-warning'}[type] || 'bg-info';

        Toastify({
            text: message,
            className,
            duration: 3000,
            close: true,
            gravity: 'top',
            position: 'right',
            stopOnFocus: true,
            ...options
        }).showToast();
    },

    success: (message) => ToastifyWrapper.show(message, 'success'),
    error: (message) => ToastifyWrapper.show(message, 'error'),
    info: (message) => ToastifyWrapper.show(message, 'info'),
    warning: (message) => ToastifyWrapper.show(message, 'warning'),
};

export default ToastifyWrapper;
