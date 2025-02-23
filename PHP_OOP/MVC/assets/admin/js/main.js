(function () {
    const passwordInputs = document.querySelectorAll('.show-password-input');

    if (passwordInputs) {
        passwordInputs.forEach(passwordInput => {
            // Tạo icon <i> và chèn vào
            const toggleIcon = document.createElement('i');
            toggleIcon.classList.add('bi', 'bi-eye', 'show-password-toggle-icon');
            passwordInput.parentNode.appendChild(toggleIcon);

            console.log(passwordInput.parentNode);

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