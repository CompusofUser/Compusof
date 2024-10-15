function togglePassword(inputId) {
    const input = document.getElementById(inputId);
    const icon = input.nextElementSibling;
    if (input.type === 'password') {
        input.type = 'text';
        icon.textContent = '🔒';
    } else {
        input.type = 'password';
        icon.textContent = '👁️';
    }
}

function showPasswordRequirements(requirements, popupId) {
    const popup = document.getElementById(popupId);
    popup.innerHTML = requirements.map(req => `<div class="${req.met ? 'met' : ''}">${req.text}</div>`).join('');
    popup.style.display = 'block';
    
    const passwordInput = document.getElementById('password');
    const rect = passwordInput.getBoundingClientRect();
    popup.style.top = `${rect.bottom + window.scrollY}px`;
    popup.style.left = `${rect.left + window.scrollX}px`;
}

function checkPasswordStrength(password) {
    return [
        { text: 'Al menos 8 caracteres', met: password.length >= 8 },
        { text: 'Al menos una letra mayúscula', met: /[A-Z]/.test(password) },
        { text: 'Al menos una letra minúscula', met: /[a-z]/.test(password) },
        { text: 'Al menos un número', met: /\d/.test(password) },
        { text: 'Al menos un carácter especial (@$!%*?&)', met: /[@$!%*?&]/.test(password) }
    ];
}

function validatePassword(password) {
    const requirements = checkPasswordStrength(password);
    return requirements.every(req => req.met);
}

function initializePasswordRequirements(passwordId, confirmPasswordId, popupId) {
    const password = document.getElementById(passwordId);
    const confirmPassword = document.getElementById(confirmPasswordId);
    const popup = document.getElementById(popupId);
    const form = document.getElementById('registrationForm');

    password.addEventListener('focus', function() {
        showPasswordRequirements(checkPasswordStrength(this.value), popupId);
    });

    password.addEventListener('input', function() {
        showPasswordRequirements(checkPasswordStrength(this.value), popupId);
        updatePasswordStrength(this.value);
    });

    password.addEventListener('blur', function() {
        popup.style.display = 'none';
    });

    confirmPassword.addEventListener('input', function() {
        updatePasswordMatch(password.value, this.value);
    });

    form.addEventListener('submit', function(event) {
        if (!validatePassword(password.value)) {
            event.preventDefault();
            alert('La contraseña no cumple con los requisitos de seguridad.');
        } else if (password.value !== confirmPassword.value) {
            event.preventDefault();
            alert('Las contraseñas no coinciden.');
        }
    });
}

function updatePasswordStrength(password) {
    const strengthMeter = document.querySelector('.password-strength');
    const requirements = checkPasswordStrength(password);
    const strength = requirements.filter(req => req.met).length;
    
    let strengthText = '';
    let strengthColor = '';

    if (strength === 0) {
        strengthText = 'Muy débil';
        strengthColor = '#ff4d4d';
    } else if (strength <= 2) {
        strengthText = 'Débil';
        strengthColor = '#ffa64d';
    } else if (strength <= 4) {
        strengthText = 'Media';
        strengthColor = '#ffff4d';
    } else {
        strengthText = 'Fuerte';
        strengthColor = '#4dff4d';
    }

    strengthMeter.textContent = strengthText;
    strengthMeter.style.color = strengthColor;
}

function updatePasswordMatch(password, confirmPassword) {
    const matchIndicator = document.querySelector('.password-match');
    if (password === confirmPassword && password !== '') {
        matchIndicator.textContent = 'Las contraseñas coinciden';
        matchIndicator.style.color = '#4dff4d';
    } else if (confirmPassword !== '') {
        matchIndicator.textContent = 'Las contraseñas no coinciden';
        matchIndicator.style.color = '#ff4d4d';
    } else {
        matchIndicator.textContent = '';
    }
}