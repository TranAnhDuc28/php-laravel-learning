import Toast from 'bootstrap/js/dist/toast.js';

const BootstrapToastWrapper = {
    init: () => {
        // Create container for toast if not exits.
        let toastContainer = document.querySelector('.toast-container');
        if (!toastContainer) {
            toastContainer = document.createElement('div');
            toastContainer.className = 'toast-container position-fixed bottom-0 end-0 p-3';
            document.body.appendChild(toastContainer);
        }
        return toastContainer;
    },

    show: (message, type = 'info') => {
        const toastContainer = BootstrapToastWrapper.init();

        // Create toast element.
        const toast = document.createElement('div');
        toast.className = `toast`;
        toast.setAttribute('role', 'alert');
        toast.setAttribute('aria-live', 'assertive');
        toast.setAttribute('aria-atomic', 'true');

        // Content toast.
        toast.innerHTML = `
            <div class="toast-header">
                <i class="ri-notification-off-line text-${type}"></i>
                <strong class="me-auto"></strong>
                <small>${(new Date()).getHours()}:${(new Date()).getMinutes()}</small>
                <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
            </div>
            <div class="toast-body">
                ${message}
            </div>
            `;

        toastContainer.appendChild(toast);

        // Init toast.
        const bootstrapToast = new Toast(toast, {autohide: true, delay: 3000});
        bootstrapToast.show();

        // Delete toast when toast is hidden.
        toast.addEventListener('hidden.bs.toast', () => {
            toast.remove();
        });
    },

    success: (message) => BootstrapToastWrapper.show(message, 'success'),
    error: (message) => BootstrapToastWrapper.show(message, 'danger'),
    info: (message) => BootstrapToastWrapper.show(message, 'info'),
    warning: (message) => BootstrapToastWrapper.show(message, 'warning'),
};

export default BootstrapToastWrapper;
