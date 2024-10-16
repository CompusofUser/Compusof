document.addEventListener('DOMContentLoaded', function() {
    const emailInput = document.getElementById('email');
    const form = document.getElementById('registrationForm');

    function validateEmail(email) {
        return email.toLowerCase().endsWith('@compusof.mx');
    }

    if (emailInput && form) {
        emailInput.addEventListener('blur', function() {
            if (this.value && !validateEmail(this.value)) {
                alert('Por favor, use una dirección de correo electrónico que termine con @compusof.mx');
                this.value = '';
                this.focus();
            }
        });

        form.addEventListener('submit', function(e) {
            if (!validateEmail(emailInput.value)) {
                e.preventDefault();
                alert('Por favor, use una dirección de correo electrónico que termine con @compusof.mx');
                emailInput.focus();
            }
        });
    }
});