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


document.addEventListener('DOMContentLoaded', function() {
    const password = document.getElementById('password');
    const confirmPassword = document.getElementById('password_verified_at');
    const passwordRequirements = document.getElementById('passwordRequirements');
    const confirmPasswordRequirements = document.getElementById('confirmPasswordRequirements');
    const requirements = {
        length: document.getElementById('length'),
        uppercase: document.getElementById('uppercase'),
        lowercase: document.getElementById('lowercase'),
        number: document.getElementById('number'),
        special: document.getElementById('special'),
        passwordMatch: document.getElementById('passwordMatch')
    };

    function checkPasswordStrength(password) {
        requirements.length.classList.toggle('met', password.length >= 8);
        requirements.uppercase.classList.toggle('met', /[A-Z]/.test(password));
        requirements.lowercase.classList.toggle('met', /[a-z]/.test(password));
        requirements.number.classList.toggle('met', /\d/.test(password));
        requirements.special.classList.toggle('met', /[@$!%*?&]/.test(password));
    }

    function checkPasswordMatch() {
        const match = password.value === confirmPassword.value && password.value !== '';
        requirements.passwordMatch.classList.toggle('met', match);
        requirements.passwordMatch.textContent = match ? 'Las contraseñas coinciden' : 'Las contraseñas deben coincidir';
    }

    password.addEventListener('input', function() {
        checkPasswordStrength(this.value);
        checkPasswordMatch();
    });

    function showPasswordRequirements(requirements) {
        const popup = document.getElementById('passwordRequirementsPopup');
        popup.innerHTML = requirements.map(req => `<div class="${req.met ? 'met' : ''}">${req.text}</div>`).join('');
        popup.style.display = 'block';
        
        // Position the popup near the password input
        const passwordInput = document.getElementById('password');
        const rect = passwordInput.getBoundingClientRect();
        popup.style.top = `${rect.bottom + window.scrollY}px`;
        popup.style.left = `${rect.left + window.scrollX}px`;
    }

    function checkPasswordStrength(password) {
        const requirements = [
            { text: 'Al menos 8 caracteres', met: password.length >= 8 },
            { text: 'Al menos una letra mayúscula', met: /[A-Z]/.test(password) },
            { text: 'Al menos una letra minúscula', met: /[a-z]/.test(password) },
            { text: 'Al menos un número', met: /\d/.test(password) },
            { text: 'Al menos un carácter especial (@$!%*?&)', met: /[@$!%*?&]/.test(password) }
        ];
        showPasswordRequirements(requirements);
    }

    confirmPassword.addEventListener('input', checkPasswordMatch);

    password.addEventListener('focus', function() {
        showPasswordRequirements([
            { text: 'Al menos 8 caracteres', met: this.value.length >= 8 },
            { text: 'Al menos una letra mayúscula', met: /[A-Z]/.test(this.value) },
            { text: 'Al menos una letra minúscula', met: /[a-z]/.test(this.value) },
            { text: 'Al menos un número', met: /\d/.test(this.value) },
            { text: 'Al menos un carácter especial (@$!%*?&)', met: /[@$!%*?&]/.test(this.value) }
        ]);
    });
    
    password.addEventListener('blur', function() {
        document.getElementById('passwordRequirementsPopup').style.display = 'none';
    });
    
    confirmPassword.addEventListener('focus', function() {
        showPasswordRequirements([
            { text: 'Las contraseñas deben coincidir', met: this.value === password.value && this.value !== '' }
        ]);
    });
    
    confirmPassword.addEventListener('blur', function() {
        document.getElementById('passwordRequirementsPopup').style.display = 'none';
    });

    



    document.getElementById('email').addEventListener('input', function() {
        if (!this.value.endsWith('@compusof.mx')) {
            this.setCustomValidity('Por favor, use una dirección de correo electrónico con el dominio @compusof.mx');
        } else {
            this.setCustomValidity('');
        }
    });
});