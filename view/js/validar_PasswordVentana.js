document.addEventListener('DOMContentLoaded', function() {
    const password = document.getElementById('password');
    const confirmPassword = document.getElementById('password_verified_at');
    const strengthBar = document.querySelector('.password-strength');
    const matchMessage = document.querySelector('.password-match');

    function checkPasswordStrength(password) {
        let strength = 0;
        if (password.length >= 8) strength++;
        if (password.match(/[a-z]/) && password.match(/[A-Z]/)) strength++;
        if (password.match(/\d/)) strength++;
        return strength;
    }

    function updateStrengthBar(strength) {
        strengthBar.className = 'password-strength';
        switch(strength) {
            case 0:
                strengthBar.classList.add('strength-weak');
                break;
            case 1:
                strengthBar.classList.add('strength-medium');
                break;
            case 2:
            case 3:
                strengthBar.classList.add('strength-strong');
                break;
        }
    }

    function checkPasswordMatch() {
        if (password.value === confirmPassword.value && password.value !== '') {
            matchMessage.textContent = 'Las contraseñas coinciden';
            matchMessage.style.color = 'green';
        } else if (confirmPassword.value !== '') {
            matchMessage.textContent = 'Las contraseñas no coinciden';
            matchMessage.style.color = 'red';
        } else {
            matchMessage.textContent = '';
        }
    }

    password.addEventListener('input', function() {
        const strength = checkPasswordStrength(this.value);
        updateStrengthBar(strength);
        checkPasswordMatch();
    });

    confirmPassword.addEventListener('input', checkPasswordMatch);
});
