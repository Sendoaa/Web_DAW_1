//Formulario
document.querySelector('form').addEventListener('submit', function(e) {
    e.preventDefault();
    var nombre = document.querySelector('form input[name="nombre"]').value;
    alert('¡Gracias ' + nombre + ', tu mensaje ha sido enviado correctamente!');
    document.querySelector('form').reset();
  });