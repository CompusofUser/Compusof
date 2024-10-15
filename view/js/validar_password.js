function validatePasswords(event) {
    const newPassword = document.getElementById('new_password').value;
    const confirmPassword = document.getElementById('confirm_password').value;

    if (newPassword !== confirmPassword) {
        event.preventDefault(); // Previene el envío del formulario
        alert('Las contraseñas no coinciden. Por favor, inténtalo de nuevo.');
    }
}
