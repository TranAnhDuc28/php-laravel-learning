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

    show: (message, type = 'info', options = {}) => {
        const toastContainer = BootstrapToastWrapper.init();

        // Create toast element.
        const toast = document.createElement('div');
        toast.className = `toast toast-border-${type}`;
        toast.setAttribute('role', 'alert');
        toast.setAttribute('aria-live', 'assertive');
        toast.setAttribute('aria-atomic', 'true');

        const iconToasts = {
            'info': '<i class="ri-user-smile-line"></i>',
            'success': '<i class="ri-checkbox-circle-fill align-middle"></i>',
            'danger': '<i class="ri-alert-line align-middle"></i>',
            'warning': '<i class="ri-notification-off-line align-middle"></i>',
        };

        // Content toast.
        toast.innerHTML = `
            <div class="toast-header d-flex justify-content-between">
                <div class="d-flex align-items-center">
                    <div class="flex-shrink-0 me-2">
                        <div class="text-${type}">${iconToasts[type]}</div>
                    </div>
                    <div class="flex-grow-1">
                        <strong class="me-auto">${options.title ?? 'Bootstrap'}</strong>
                    </div>
                </div>
                <div class="d-flex align-items-center">
                    <small>${(new Date()).getHours()}:${(new Date()).getMinutes()}</small>
                    <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
                </div>
            </div>
            <div class="toast-body">
                ${message}
            </div>
            `;

        toastContainer.appendChild(toast);

        // Init toast.
        const bootstrapToast = new Toast(toast, {autohide: true, delay: 3000, ...options});
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
