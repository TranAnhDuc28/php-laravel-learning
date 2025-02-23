(function () {
    const passwordInputs = document.querySelectorAll('.show-password-input');

    if (passwordInputs) {
        passwordInputs.forEach(passwordInput => {
            // nếu chưa có thẻ cha có class position-relative
            if (!passwordInput.parentElement.classList.contains('position-relative')) {
                // Tạo wrapper mới
                const wrapper = document.createElement('div');
                wrapper.classList.add('position-relative');

                // Chèn wrapper vào trước input
                /** Phương thức insertBefore() được sử dụng để chèn một phần tử (newNode) vào trước một phần tử con (referenceNode) trong DOM.
                 * Cú pháp: [ parentNode.insertBefore(newNode, referenceNode); ]
                 *      trong đó:
                 *          + parentNode: Phần tử cha chứa referenceNode.
                 *          + newNode: Phần tử mới cần chèn.
                 *          + referenceNode: Phần tử con mà newNode sẽ được chèn vào trước nó.
                 *              Nếu referenceNode là null, newNode sẽ được chèn vào cuối danh sách con.
                 */
                passwordInput.parentNode.insertBefore(wrapper, passwordInput);

                // Đưa input vào trong wrapper
                wrapper.appendChild(passwordInput);
            }

            // Tạo icon toggle password <i> và chèn vào
            const toggleIcon = document.createElement('i');
            toggleIcon.classList.add('bi', 'bi-eye', 'show-password-toggle-icon');
            passwordInput.parentElement.appendChild(toggleIcon);

            // Sự kiện pointerdown để ẩn/hiện password
            toggleIcon.addEventListener('pointerdown', (e) => {
                e.preventDefault();
                // Toggle input type between password and text
                if (passwordInput.type === 'password') {
                    passwordInput.type = 'text';
                    toggleIcon.classList.replace('bi-eye', 'bi-eye-slash');
                } else if (passwordInput.type === 'text') {
                    passwordInput.type = 'password';
                    toggleIcon.classList.replace('bi-eye-slash', 'bi-eye');
                }
            });

            // Sự kiện focus và blur để hiển thị/ẩn icon
            const toggleVisibility = () => {
                if (passwordInput.value || document.activeElement === passwordInput) {
                    toggleIcon.style.display = 'block';
                } else {
                    toggleIcon.style.display = 'none';
                }
            };

            passwordInput.addEventListener('focus', toggleVisibility);
            passwordInput.addEventListener('blur', toggleVisibility);
            passwordInput.addEventListener('input', toggleVisibility);

            // Ẩn icon lúc đầu nếu input không có giá trị
            toggleVisibility();
        });
    }
})();