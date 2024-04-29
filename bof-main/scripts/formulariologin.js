document.addEventListener('DOMContentLoaded', function() {
    document.getElementById('login-form').addEventListener('submit', function(event) {
        event.preventDefault(); // Evitar envío del formulario por defecto
        
        var username = document.getElementById('username').value;
        var password = document.getElementById('password').value;
        
        if (username.trim() === '' || password.trim() === '') {
            alert('Por favor, complete todos los campos.');
            return;
        }
        
        alert('¡Formulario enviado correctamente!');
        // Aquí puedes agregar más lógica, como enviar el formulario o realizar otras acciones
    });
    
    document.getElementById('create-account').addEventListener('click', function() {
        // Lógica para el botón "Crear Cuenta"
        alert('Lógica para crear cuenta aquí');
    });
});
