// Load password requirements from JSON file
fetch('../config/password_requirements.json')
    .then(response => response.json())
    .then(data => {
        const passwordRequirements = data.requirements;
        initializePasswordValidation(passwordRequirements);
    })
    .catch(error => console.error('Error loading password requirements:', error));

function initializePasswordValidation(requirements) {
    const form = document.getElementById('resetPasswordForm');
    const newPasswordInput = document.getElementById('new_password');
    const confirmPasswordInput = document.getElementById('confirm_password');
    const popup = document.getElementById('passwordRequirementsPopup');

    function togglePassword(inputId) {
        const input = document.getElementById(inputId);
        const icon = input.nextElementSibling;
        input.type = input.type === 'password' ? 'text' : 'password';
        icon.textContent = input.type === 'password' ? '👁️' : '🔒';
    }

    function showPasswordRequirements() {
        const password = newPasswordInput.value;
        const requirementsList = requirements.map(req => {
            const isMet = new RegExp(req.regex).test(password);
            return `<div class="${isMet ? 'met' : ''}">${req.description}</div>`;
        }).join('');
        
        popup.innerHTML = requirementsList;
        popup.style.display = 'block';
        
        const rect = newPasswordInput.getBoundingClientRect();
        popup.style.top = `${rect.bottom + window.scrollY}px`;
        popup.style.left = `${rect.left + window.scrollX}px`;
    }

    function validatePassword(password) {
        return requirements.every(req => new RegExp(req.regex).test(password));
    }

    function validateForm() {
        const password = newPasswordInput.value;
        const confirmPassword = confirmPasswordInput.value;

        if (!validatePassword(password)) {
            alert('La contraseña no cumple con los requisitos de seguridad.');
            return false;
        }

        if (password !== confirmPassword) {
            alert('Las contraseñas no coinciden.');
            return false;
        }

        return true;
    }

    newPasswordInput.addEventListener('focus', showPasswordRequirements);
    newPasswordInput.addEventListener('input', showPasswordRequirements);
    newPasswordInput.addEventListener('blur', () => popup.style.display = 'none');

    confirmPasswordInput.addEventListener('input', () => {
        const isMatch = newPasswordInput.value === confirmPasswordInput.value;
        confirmPasswordInput.setCustomValidity(isMatch ? '' : 'Las contraseñas no coinciden');
    });

    form.addEventListener('submit', function(event) {
        if (!validateForm()) {
            event.preventDefault();
        }
    });
}