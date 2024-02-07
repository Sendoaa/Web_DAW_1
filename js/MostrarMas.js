//FUNCION:
//Scrpt para el boton de mostrar mas que se muestra cuando la resolucion de la pantalla se minimiza.

// Obtener referencia al botón y al elemento oculto
var botonMostrarOcultar = document.getElementById('botonMostrarOcultar');
var elementoOculto = document.getElementById('elementoOculto');

// Agregar un evento de clic al botón
botonMostrarOcultar.addEventListener('click', function () {
    // Alternar entre mostrar y ocultar el elemento
    if (elementoOculto.style.display === 'none' || elementoOculto.style.display === '') {
        elementoOculto.style.display = 'block';
    } else {
        elementoOculto.style.display = 'none';
    }
});

